<?php

/**
 * Patient CSV Import Script
 *
 * This script imports patients from CSV file into the database.
 *
 * Usage: php import-patients.php
 * Or via artisan: php artisan import:patients
 */

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PatientDetail;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Configuration
$csvFile = __DIR__ . '/data-csv/patients1_1638772.csv';
$defaultCompanyId = 1; // Adjust if needed
$defaultPassword = '12345678'; // Default password for imported patients
$useCsvMrn = false; // Set to true to use MRN from CSV, false to generate new

/**
 * Parse age string to calculate date of birth
 * Format: "30 years, 9 months, 4 days old"
 */
function parseAgeToDateOfBirth($ageString, $registrationDate)
{
    if (empty($ageString) || empty($registrationDate)) {
        return null;
    }

    try {
        // Parse registration date
        $regDate = Carbon::createFromFormat('d/m/Y', $registrationDate);

        // Extract years, months, days from age string
        preg_match('/(\d+)\s*years?/', $ageString, $yearsMatch);
        preg_match('/(\d+)\s*months?/', $ageString, $monthsMatch);
        preg_match('/(\d+)\s*days?/', $ageString, $daysMatch);

        $years = isset($yearsMatch[1]) ? (int)$yearsMatch[1] : 0;
        $months = isset($monthsMatch[1]) ? (int)$monthsMatch[1] : 0;
        $days = isset($daysMatch[1]) ? (int)$daysMatch[1] : 0;

        // Calculate date of birth by subtracting age from registration date
        $dateOfBirth = $regDate->copy()
            ->subYears($years)
            ->subMonths($months)
            ->subDays($days);

        return $dateOfBirth->format('Y-m-d');
    } catch (\Exception $e) {
        return null;
    }
}

/**
 * Generate unique email if not provided
 */
function generateEmail($name, $phone, $index)
{
    $cleanName = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($name));
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
    $email = 'noemail' . ($cleanPhone ?: $index) . '@patient.com';

    // Check if email exists, append index if needed
    $counter = 1;
    $originalEmail = $email;
    while (User::where('email', $email)->exists()) {
        $email = str_replace('@patient.com', $counter . '@patient.com', $originalEmail);
        $counter++;
    }

    return $email;
}

/**
 * Get or create Patient role
 */
function getPatientRole()
{
    $role = Role::where('name', 'Patient')->first();
    if (!$role) {
        throw new \Exception('Patient role not found. Please run migrations and seeders first.');
    }
    return $role;
}

/**
 * Generate MRN number
 */
function generateMrnNumber($userId)
{
    return 'SDT' . date('y') . date('m') . str_pad($userId, 4, '0', STR_PAD_LEFT);
}

/**
 * Clean phone number
 */
function cleanPhone($phone)
{
    if (empty($phone)) {
        return null;
    }
    // Remove quotes and spaces
    $phone = trim($phone, "'\" \t\n\r\0\x0B");
    // Keep only digits
    $phone = preg_replace('/[^0-9]/', '', $phone);
    return !empty($phone) ? $phone : null;
}

/**
 * Clean MRN number from CSV
 */
function cleanMrn($mrn)
{
    if (empty($mrn)) {
        return null;
    }
    // Remove quotes
    $mrn = trim($mrn, "'\"");
    return $mrn;
}

/**
 * Main import function
 */
function importPatients($csvFile, $defaultCompanyId, $defaultPassword, $useCsvMrn)
{
    if (!file_exists($csvFile)) {
        throw new \Exception("CSV file not found: {$csvFile}");
    }

    $handle = fopen($csvFile, 'r');
    if (!$handle) {
        throw new \Exception("Cannot open CSV file: {$csvFile}");
    }

    // Read header row
    $headers = fgetcsv($handle);
    if (!$headers) {
        throw new \Exception("Cannot read CSV headers");
    }

    // Map headers to indices
    $headerMap = [];
    foreach ($headers as $index => $header) {
        $headerMap[trim($header)] = $index;
    }

    $stats = [
        'total' => 0,
        'success' => 0,
        'skipped' => 0,
        'errors' => 0,
        'errors_list' => []
    ];

    $patientRole = getPatientRole();
    $batchSize = 100;
    $batch = [];

    echo "Starting patient import...\n";
    echo "========================================\n\n";

    // Read and process each row
    while (($row = fgetcsv($handle)) !== false) {
        $stats['total']++;

        try {
            // Skip empty rows
            if (count(array_filter($row)) === 0) {
                $stats['skipped']++;
                continue;
            }

            // Extract data from CSV row
            $mrn = isset($headerMap['MR#']) ? cleanMrn($row[$headerMap['MR#']]) : null;
            $name = isset($headerMap['Patient Name']) ? trim($row[$headerMap['Patient Name']]) : null;
            $gender = isset($headerMap['Gender']) ? strtolower(trim($row[$headerMap['Gender']])) : null;
            $phone = isset($headerMap['Phone']) ? cleanPhone($row[$headerMap['Phone']]) : null;
            $registrationDate = isset($headerMap['REGISTRATION DATE']) ? trim($row[$headerMap['REGISTRATION DATE']]) : null;
            $age = isset($headerMap['AGE']) ? trim($row[$headerMap['AGE']]) : null;
            $address = isset($headerMap['ADDRESS']) ? trim($row[$headerMap['ADDRESS']]) : null;
            $status = isset($headerMap['Status']) ? strtolower(trim($row[$headerMap['Status']])) : 'active';

            // Validate required fields
            if (empty($name)) {
                $stats['skipped']++;
                $stats['errors_list'][] = "Row {$stats['total']}: Missing patient name";
                continue;
            }

            // Check if patient already exists (by phone or name)
            $existingUser = null;
            if ($phone) {
                $existingUser = User::where('phone', $phone)->first();
            }
            if (!$existingUser) {
                $existingUser = User::where('name', $name)->first();
            }

            if ($existingUser) {
                $stats['skipped']++;
                echo "Skipped row {$stats['total']}: Patient '{$name}' already exists\n";
                continue;
            }

            // Calculate date of birth
            $dateOfBirth = parseAgeToDateOfBirth($age, $registrationDate);

            // Generate email
            $email = generateEmail($name, $phone, $stats['total']);

            // Normalize gender
            $genderValue = null;
            if ($gender === 'male' || $gender === 'm') {
                $genderValue = 'male';
            } elseif ($gender === 'female' || $gender === 'f') {
                $genderValue = 'female';
            }

            // Normalize status
            $statusValue = ($status === 'active') ? '1' : '0';

            // Prepare user data
            $userData = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'gender' => $genderValue,
                'date_of_birth' => $dateOfBirth,
                'status' => $statusValue,
                'company_id' => $defaultCompanyId,
                'password' => bcrypt($defaultPassword),
                'created_at' => $registrationDate ? Carbon::createFromFormat('d/m/Y', $registrationDate)->format('Y-m-d H:i:s') : now(),
                'updated_at' => now(),
            ];

            // Prepare patient detail data
            $patientData = [
                'created_by' => 1, // System user
                'created_at' => $registrationDate ? Carbon::createFromFormat('d/m/Y', $registrationDate)->format('Y-m-d H:i:s') : now(),
                'updated_at' => now(),
            ];

            // Use transaction for data integrity
            DB::transaction(function () use ($userData, $patientData, $patientRole, $defaultCompanyId, $mrn, $useCsvMrn, &$stats) {
                // Create user
                $user = User::create($userData);

                // Assign Patient role
                $user->assignRole([$patientRole->id]);

                // Attach to company
                $user->companies()->attach($defaultCompanyId);

                // Set patient detail user_id
                $patientData['user_id'] = $user->id;

                // Set MRN number
                if ($useCsvMrn && $mrn) {
                    $patientData['mrn_number'] = $mrn;
                } else {
                    $patientData['mrn_number'] = generateMrnNumber($user->id);
                }

                // Create patient detail
                PatientDetail::create($patientData);

                $stats['success']++;
                echo "✓ Imported: {$userData['name']} (MRN: {$patientData['mrn_number']})\n";
            });
        } catch (\Exception $e) {
            $stats['errors']++;
            $stats['errors_list'][] = "Row {$stats['total']}: " . $e->getMessage();
            echo "✗ Error on row {$stats['total']}: {$e->getMessage()}\n";
        }

        // Progress indicator
        if ($stats['total'] % 100 === 0) {
            echo "Processed {$stats['total']} rows...\n";
        }
    }

    fclose($handle);

    // Print summary
    echo "\n========================================\n";
    echo "Import Summary:\n";
    echo "========================================\n";
    echo "Total rows processed: {$stats['total']}\n";
    echo "Successfully imported: {$stats['success']}\n";
    echo "Skipped: {$stats['skipped']}\n";
    echo "Errors: {$stats['errors']}\n";

    if (!empty($stats['errors_list'])) {
        echo "\nError Details:\n";
        foreach (array_slice($stats['errors_list'], 0, 20) as $error) {
            echo "  - {$error}\n";
        }
        if (count($stats['errors_list']) > 20) {
            echo "  ... and " . (count($stats['errors_list']) - 20) . " more errors\n";
        }
    }

    echo "\nDefault password for all imported patients: {$defaultPassword}\n";
    echo "========================================\n";

    return $stats;
}

// Run the import
try {
    $stats = importPatients($csvFile, $defaultCompanyId, $defaultPassword, $useCsvMrn);
    exit(0);
} catch (\Exception $e) {
    echo "FATAL ERROR: {$e->getMessage()}\n";
    exit(1);
}
