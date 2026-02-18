<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PatientDetail;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class ImportPatientsFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:patients 
                            {--file=data-csv/patients1_1638772.csv : Path to CSV file}
                            {--company=1 : Company ID}
                            {--password=Patient@123 : Default password for imported patients}
                            {--use-csv-mrn : Use MRN from CSV instead of generating new}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import patients from CSV file into the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $csvFile = $this->option('file');
        $defaultCompanyId = (int)$this->option('company');
        $defaultPassword = $this->option('password');
        $useCsvMrn = $this->option('use-csv-mrn');
        
        // Resolve full path
        if (!str_starts_with($csvFile, '/') && !str_starts_with($csvFile, 'C:')) {
            $csvFile = base_path($csvFile);
        }
        
        if (!file_exists($csvFile)) {
            $this->error("CSV file not found: {$csvFile}");
            return 1;
        }
        
        $this->info("Starting patient import from: {$csvFile}");
        $this->info("========================================\n");
        
        $stats = $this->importPatients($csvFile, $defaultCompanyId, $defaultPassword, $useCsvMrn);
        
        // Print summary
        $this->info("\n========================================\n");
        $this->info("Import Summary:");
        $this->info("========================================\n");
        $this->info("Total rows processed: {$stats['total']}");
        $this->info("Successfully imported: {$stats['success']}");
        $this->info("Skipped: {$stats['skipped']}");
        $this->info("Errors: {$stats['errors']}");
        
        if (!empty($stats['errors_list'])) {
            $this->warn("\nError Details:");
            foreach (array_slice($stats['errors_list'], 0, 20) as $error) {
                $this->warn("  - {$error}");
            }
            if (count($stats['errors_list']) > 20) {
                $this->warn("  ... and " . (count($stats['errors_list']) - 20) . " more errors");
            }
        }
        
        $this->info("\nDefault password for all imported patients: {$defaultPassword}");
        $this->info("========================================\n");
        
        return $stats['errors'] > 0 ? 1 : 0;
    }
    
    /**
     * Parse age string to calculate date of birth
     * Format: "30 years, 9 months, 4 days old"
     */
    private function parseAgeToDateOfBirth($ageString, $registrationDate)
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
    private function generateEmail($name, $phone, $index)
    {
        $cleanName = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($name));
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        $email = 'noemail' . ($cleanPhone ?: $index) . '@imported-patient.com';
        
        // Check if email exists, append index if needed
        $counter = 1;
        $originalEmail = $email;
        while (User::where('email', $email)->exists()) {
            $email = str_replace('@imported-patient.com', $counter . '@imported-patient.com', $originalEmail);
            $counter++;
        }
        
        return $email;
    }
    
    /**
     * Get or create Patient role
     */
    private function getPatientRole()
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
    private function generateMrnNumber($userId)
    {
        return 'JDJ' . date('y') . date('m') . str_pad($userId, 4, '0', STR_PAD_LEFT);
    }
    
    /**
     * Clean phone number
     */
    private function cleanPhone($phone)
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
    private function cleanMrn($mrn)
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
    private function importPatients($csvFile, $defaultCompanyId, $defaultPassword, $useCsvMrn)
    {
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
        
        $patientRole = $this->getPatientRole();
        $bar = $this->output->createProgressBar();
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %message%');
        
        // First pass: count total rows
        $totalRows = 0;
        $tempHandle = fopen($csvFile, 'r');
        fgetcsv($tempHandle); // Skip header
        while (fgetcsv($tempHandle) !== false) {
            $totalRows++;
        }
        fclose($tempHandle);
        
        $bar->setMaxSteps($totalRows);
        $bar->setMessage('Starting import...');
        $bar->start();
        
        // Read and process each row
        while (($row = fgetcsv($handle)) !== false) {
            $stats['total']++;
            
            try {
                // Skip empty rows
                if (count(array_filter($row)) === 0) {
                    $stats['skipped']++;
                    $bar->advance();
                    continue;
                }
                
                // Extract data from CSV row
                $mrn = isset($headerMap['MR#']) ? $this->cleanMrn($row[$headerMap['MR#']]) : null;
                $name = isset($headerMap['Patient Name']) ? trim($row[$headerMap['Patient Name']]) : null;
                $gender = isset($headerMap['Gender']) ? strtolower(trim($row[$headerMap['Gender']])) : null;
                $phone = isset($headerMap['Phone']) ? $this->cleanPhone($row[$headerMap['Phone']]) : null;
                $registrationDate = isset($headerMap['REGISTRATION DATE']) ? trim($row[$headerMap['REGISTRATION DATE']]) : null;
                $age = isset($headerMap['AGE']) ? trim($row[$headerMap['AGE']]) : null;
                $address = isset($headerMap['ADDRESS']) ? trim($row[$headerMap['ADDRESS']]) : null;
                $status = isset($headerMap['Status']) ? strtolower(trim($row[$headerMap['Status']])) : 'active';
                
                // Validate required fields
                if (empty($name)) {
                    $stats['skipped']++;
                    $stats['errors_list'][] = "Row {$stats['total']}: Missing patient name";
                    $bar->setMessage("Skipped: Missing name");
                    $bar->advance();
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
                    $bar->setMessage("Skipped: {$name} exists");
                    $bar->advance();
                    continue;
                }
                
                // Calculate date of birth
                $dateOfBirth = $this->parseAgeToDateOfBirth($age, $registrationDate);
                
                // Generate email
                $email = $this->generateEmail($name, $phone, $stats['total']);
                
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
                        $patientData['mrn_number'] = $this->generateMrnNumber($user->id);
                    }
                    
                    // Create patient detail
                    PatientDetail::create($patientData);
                    
                    $stats['success']++;
                });
                
                $bar->setMessage("Imported: {$name}");
                $bar->advance();
                
            } catch (\Exception $e) {
                $stats['errors']++;
                $stats['errors_list'][] = "Row {$stats['total']}: " . $e->getMessage();
                $bar->setMessage("Error: " . substr($e->getMessage(), 0, 30));
                $bar->advance();
            }
        }
        
        $bar->finish();
        fclose($handle);
        
        return $stats;
    }
}

