<?php

use App\Models\Notification;

use Carbon\Carbon;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

use App\Models\{
    HospitalDepartment,
    ExamInvestigation,
    PatientTreatmentPlan,
    User,
    PatientAppointment,
    PatientCaseStudy,
    Prescription,
    Invoice,
    Payment,
    DentalLabOrder,
    InsuranceProvider,
    Inventory,
    Task
};

use App\Mail\DynamicMail;
use Illuminate\Support\Facades\Mail;

if (!function_exists('sendDynamicEmail')) {
    function sendDynamicEmail($recipientName, $recipientEmail, $messageBody)
    {
        // Validate email address format
        if (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email address provided.");
        }

        Mail::to($recipientEmail)->send(new DynamicMail($recipientName, $messageBody));
    }
}

if (!function_exists('getDocNumber')) {
    function getDocNumber($id, $type = '')
    {
        return $type . date('y') . date('m') . str_pad($id,  STR_PAD_LEFT);
    }
}


if (!function_exists('displayIndexValue')) {
    function displayIndexValue($index, $array)
    {
        $index = trim($index);
        if (is_numeric($index)) {
            if (array_key_exists($index, $array)) {
                return $array[$index];
            } else {
                return $index;
            }
        } else if (!empty($index)) {
            return $index;
        }
    }
}




if (!function_exists('calculateAge')) {
    function calculateAge($date_of_birth)
    {
        $dob = Carbon::parse($date_of_birth);
        $today = Carbon::now();

        $years = $today->diffInYears($dob); // Use $dob instead of $date_of_birth

        return [
            'years' => $years,
        ];
    }
}


if (!function_exists('sendNotification')) {
    function sendNotification($Id, $url, $msg, $userId = null)
    {
        $notification = new Notification([
            'notification_from' => auth()->id(),
            'notification_to' => $userId ?? 1,
            'text' => $msg,
            'url' => route($url, $Id),
        ]);
        $notification->save();
    }
}



/**
 * General Dashboard Data (shared helper)
 */
if (!function_exists('getDashboardData')) {
    function getDashboardData()
    {
        $dashboardCounts = getDashboardCounts();
        $monthlyDebitCredit = getMonthlyDebitCredit();
        $currentYearDebitCredit = getCurrentYearDebitCredit();
        $overallDebitCredit = getOverallDebitCredit();

        // ✅ Convert both to JSON strings
        $statsJson = json_encode($dashboardCounts, JSON_UNESCAPED_UNICODE);
        $chartsJson = json_encode([
            'monthly_debit_credit' => $monthlyDebitCredit,
            'current_year_debit_credit' => $currentYearDebitCredit,
            'overall_debit_credit' => $overallDebitCredit,
        ], JSON_UNESCAPED_UNICODE);

        // ✅ Return main array (PHP array, both values are JSON strings)
        return [
            'stats' => $statsJson,
            'charts' => $chartsJson,
        ];
    }
}



/**
 * Get cached dashboard counts
 */
if (!function_exists('getDashboardCounts')) {
    function getDashboardCounts()
    {
        return [
            'departments' => HospitalDepartment::count(),
            'exam_investigation' => ExamInvestigation::count(),
            'treatment_plans' => PatientTreatmentPlan::count(),
            'doctors' => User::role('Doctor')->count(),
            'active_doctors' => User::role('Doctor')->where('status', '1')->count(),
            'nonactive_doctors' => User::role('Doctor')->where('status', '0')->count(),
            'patients' => User::role('Patient')->count(),
            'active_patients' => User::role('Patient')->where('status', '1')->count(),
            'nonactive_patients' => User::role('Patient')->where('status', '0')->count(),
            'appointments' => PatientAppointment::count(),
            'cancel' => PatientAppointment::where('appointment_status_id', 4)->count(),
            'processed' => PatientAppointment::where('appointment_status_id', 3)->count(),
            'case_studies' => PatientCaseStudy::count(),
            'prescriptions' => Prescription::count(),
            'invoices' => Invoice::count(),
            'payments' => Payment::count(),
            'totaldiscount' => Invoice::sum('total_discount'),
            'total' => Invoice::sum('total'),
            'labReports' => DentalLabOrder::count(),
            'paid' => Invoice::sum('paid'),
            'totalAmount' => Payment::sum('amount'),
            'insuranceProviders' => InsuranceProvider::count(),
            'inventories' => Inventory::count(),
            'tasks' => Task::count(),
        ];
    }
}

/**
 * Monthly debit/credit data for bar chart
 */
if (!function_exists('getMonthlyDebitCredit')) {
    function getMonthlyDebitCredit()
    {
        $credits = [];
        $debits = [];
        $labels = [];

        $results = DB::select('
                SELECT DISTINCT YEAR(invoice_date) AS year, MONTH(invoice_date) AS month
                FROM invoices
                ORDER BY year DESC, month DESC
                LIMIT 12
            ');

        foreach ($results as $result) {
            $monthYear = date('F Y', mktime(0, 0, 0, $result->month, 10, $result->year));
            $labels[] = $monthYear;
            $credits[] = (float) Payment::whereYear('payment_date', $result->year)
                ->whereMonth('payment_date', $result->month)
                ->sum('amount');
            $debits[] = (float) Invoice::whereYear('invoice_date', $result->year)
                ->whereMonth('invoice_date', $result->month)
                ->sum('grand_total');
        }

        return [
            'credits' => $credits,
            'debits' => $debits,
            'labels' => $labels
        ];
    }
}

/**
 * Current year debit/credit
 */
if (!function_exists('getCurrentYearDebitCredit')) {
    function getCurrentYearDebitCredit()
    {
        $credits = (float) Payment::whereYear('payment_date', date('Y'))->sum('amount');
        $debits = (float) Invoice::whereYear('invoice_date', date('Y'))->sum('grand_total');

        return [
            'credits' => $credits,
            'debits' => $debits
        ];
    }
}

/**
 * Overall debit/credit
 */
if (!function_exists('getOverallDebitCredit')) {
    function getOverallDebitCredit()
    {
        $credits = (float) Payment::sum('amount');
        $debits = (float) Invoice::sum('grand_total');

        return [
            'credits' => $credits,
            'debits' => $debits
        ];
    }
}

/**
 * Get current project slug from request
 * This is used throughout the application to get the current project segment
 */
if (!function_exists('getCurrentProject')) {
    function getCurrentProject()
    {
        // Try URL defaults first (set by TenantDatabase middleware)
        try {
            $defaults = URL::getDefaultParameters();
            if (isset($defaults['project']) && !empty($defaults['project'])) {
                return $defaults['project'];
            }
        } catch (\Exception $e) {
            // If URL facade is not available, continue to fallback
        }

        // Fallback: get from current request segment
        $segment = getenv('URL_SEGMENT');
        if ($segment && function_exists('request') && request()) {
            $project = request()->segment($segment);
            if ($project) {
                return $project;
            }
        }

        return null;
    }
}

/**
 * Get full upload path for database storage
 * Returns path starting from 'public/' for storing in database
 * Example: public/uploads/project-1/patient/123/profile_picture/file.jpg
 * 
 * @param string $relativePath Path relative to the uploads folder (e.g., 'patient/123/profile_picture')
 * @return string Full path from public directory
 */
if (!function_exists('getFullUploadPath')) {
    function getFullUploadPath($relativePath = '')
    {
        $project = getCurrentProject();
        $basePath = $project ? "public/uploads/{$project}" : 'public/uploads';

        if ($relativePath) {
            $basePath .= '/' . trim($relativePath, '/');
        }

        return $basePath;
    }
}

/**
 * Get upload path for current project
 * All uploads are organized in public/uploads/{project}/ folder structure
 * 
 * @param string $subfolder Subfolder name (e.g., 'student', 'user', 'assets')
 * @return string Full path relative to public directory
 */
if (!function_exists('getUploadPath')) {
    function getUploadPath($subfolder = '')
    {
        $project = getCurrentProject();
        $basePath = $project ? "uploads/{$project}" : 'uploads';

        if ($subfolder) {
            $basePath .= '/' . trim($subfolder, '/');
        }

        return $basePath;
    }
}

/**
 * Get full public path for uploads
 * Creates directory if it doesn't exist
 * 
 * @param string $subfolder Subfolder name (e.g., 'student', 'user', 'assets')
 * @return string Full absolute path
 */
if (!function_exists('getUploadPublicPath')) {
    function getUploadPublicPath($subfolder = '')
    {
        $relativePath = getUploadPath($subfolder);
        $fullPath = public_path($relativePath);

        // Create directory if it doesn't exist
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        return $fullPath;
    }
}

/**
 * Generate URL with automatic project segment inclusion
 * This works like url() but automatically includes the project segment from URL defaults
 */
if (!function_exists('urlWithProject')) {
    function urlWithProject($path = '', $parameters = [], $secure = null)
    {
        $project = getCurrentProject();

        // If path starts with /, remove it
        $path = ltrim($path, '/');

        // If project exists, prepend it to the path
        if ($project) {
            $path = $project . '/' . $path;
        }

        // Use Laravel's url() helper with the modified path
        return url($path, $parameters, $secure);
    }
}

/**
 * Enhanced route helper that automatically includes project parameter
 * This wraps Laravel's route() helper to ensure project is always included
 * 
 * Usage: route_with_project('dashboard') or route_with_project('users.show', $user->id)
 */
if (!function_exists('route_with_project')) {
    function route_with_project($name, $parameters = [], $absolute = true)
    {
        $project = getCurrentProject();

        if ($project) {
            if (is_array($parameters)) {
                if (!isset($parameters['project'])) {
                    $parameters['project'] = $project;
                }
            } elseif ($parameters !== null && $parameters !== []) {
                // If single parameter (like ID), convert to array
                if (is_numeric($parameters) || is_string($parameters)) {
                    $parameters = ['project' => $project, $parameters];
                } else {
                    $parameters = ['project' => $project] + (is_array($parameters) ? $parameters : []);
                }
            } else {
                $parameters = ['project' => $project];
            }
        }

        return route($name, $parameters, $absolute);
    }
}

/**
 * Enhanced url() helper that automatically includes project segment
 * This wraps Laravel's url() helper to prepend the project segment
 * 
 * Since Laravel's url() helper is already loaded, we can't override it directly.
 * Instead, we'll use URL::to() directly with project segment prepended.
 * 
 * Usage: url('path') will automatically become '/project-1/path'
 * 
 * NOTE: This function will be called when url() is used, but Laravel's url()
 * is already defined, so this won't work. Instead, use urlWithProject() or
 * update all url() calls to use URL::to() with getCurrentProject() prepended.
 */
if (!function_exists('url_with_project_segment')) {
    function url_with_project_segment($path = null, $parameters = [], $secure = null)
    {
        // Get current project
        $project = getCurrentProject();

        // If project exists and path is provided
        if ($project && $path !== null && $path !== '') {
            // Skip if path is already a full URL
            if (
                !str_starts_with($path, 'http://') &&
                !str_starts_with($path, 'https://') &&
                !str_starts_with($path, '//')
            ) {
                // Remove leading slash if present
                $path = ltrim($path, '/');

                // Check if path already starts with project segment
                if (!str_starts_with($path, $project . '/')) {
                    // Prepend project segment
                    $path = $project . '/' . $path;
                }
            }
        }

        // Use Laravel's URL facade directly
        return URL::to($path, $parameters, $secure);
    }
}
