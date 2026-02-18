<?php

namespace App\Http\Controllers\Mobile;

use App\Components\FirebaseComponent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\PatientDetail;
use App\Models\PatientAppointment;
use App\Models\DeviceToken;
use App\Models\Prescription;
use App\Models\AppNotifications;
use App\Models\Invoice;
use App\Models\PatientTreatmentPlan;
use App\Models\ExamInvestigation;
use App\Models\DoctorDetail;
use App\Models\AppointmentStatus;
use App\Models\Notification;
use App\Models\User;
use App\Services\NotificationService;
use App\Models\Setting;
use App\Models\ApplicationSetting;
use App\Models\UserLogs;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use Illuminate\Validation\ValidationException;
use NumberFormatter;

class MobileController extends Controller
{

    public function patientDetails()
    {
        $patientDetail = PatientDetail::all();
        return response()->json([
            'status' => 'success',
            'data' => $patientDetail
        ]);
    }
    //  authentication
    private function Authentication(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            $token = $request->input('access_token');  // Try from body or query string
        }
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'UnAutherized User'
            ]);
        }

        $user = User::where('access_token', $token)->first();

        if (!$user || $user->access_expire < Now()) {
            return response()->json([
                'status' => 'error',
                'message' => 'invalid unauthorized user or expire token '
            ]);
        }
        return $user;
    }

    private function jsonResponse($payload, int $status = 200, array $headers = [], int $options = 0)
    {
        return response()->json(
            $this->replaceNullWithEmptyString($payload),
            $status,
            $headers,
            $options
        );
    }

    private function replaceNullWithEmptyString($payload)
    {
        if ($payload instanceof Arrayable) {
            $payload = $payload->toArray();
        }

        if (is_array($payload)) {
            foreach ($payload as $key => $value) {
                $payload[$key] = $this->replaceNullWithEmptyString($value);
            }
            return $payload;
        }

        return $payload === null ? '' : $payload;
    }
    //patient
    public function patientDashboard($patientId, Request $request)
    {
        try {

            $AuthenticUser = $this->Authentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }
            $appointments = PatientAppointment::where('user_id', '=', $patientId)->get()->count();
            $prescriptions = Prescription::where('user_id', $patientId)->get()->count();
            $invoice = Invoice::where('user_id', $patientId)->get()->count();
            $treatmentPlan = PatientTreatmentPlan::where('patient_id', $patientId)->get()->count();
            $examInvestigation = ExamInvestigation::where('patient_id', $patientId)->get()->count();
            $stats = [
                'Appointments' => $appointments,
                'Prescription' => $prescriptions,
                'Invoice' => $invoice,
                'TreatmentPlan' => $treatmentPlan,
                'ExamInvestigation' => $examInvestigation,

            ];
            $data = [
                'stats' => $stats
            ];
            return response()->json(['status' => 'true', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    public function patientAppointments($patientId, Request $request)
    {
        try {
            // $AuthenticUser = $this->Authentication($request);
            // if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
            //     return $AuthenticUser;
            // }
            $appointments = PatientAppointment::with('doctor:id,name', 'appointmentstatus:id,name')->where('user_id', '=', $patientId)->get();
            $data = [
                'appointments' => $appointments->map(function ($appointment) {
                    return [
                        'appointment_id' => $appointment->id,
                        'appointment_number' => $appointment->appointment_number,
                        'appointment_time' => $appointment->start_time,
                        'doctor_name' => $appointment->doctor->name ?? null,
                        'date' => $appointment->appointment_date,
                        'status' => $appointment->appointmentstatus->name
                    ];
                })
            ];
            return response()->json(['status' => 'success',  'data' => $data]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function patientNotifications(Request $request)
    {
        try {
            $AuthenticUser = $this->Authentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $query = Notification::where('notification_to', $AuthenticUser->id);

            if ($request->filled('status')) {
                $query->where('status', $request->get('status'));
            }

            $page = $request->get('page');
            $limit = min((int) $request->get('limit', 20), 100);
            $totalCount = $query->count();
            $paginationData = [];

            if ($page) {
                $notifications = $query->orderBy('created_at', 'desc')
                    ->skip(($page - 1) * $limit)
                    ->take($limit)
                    ->get();

                $paginationData = [
                    'total_count' => $totalCount,
                    'page' => (int) $page,
                    'limit' => (int) $limit,
                    'total_pages' => ceil($totalCount / $limit)
                ];
            } else {
                $notifications = $query->orderBy('created_at', 'desc')->get();
            }

            $notificationsData = $notifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->text ?? $notification->title ?? '',
                    'description' => $notification->description ?? '',
                    'status' => $notification->status,
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at ? $notification->created_at->toDateTimeString() : null
                ];
            });

            return $this->jsonResponse([
                'status' => 'success',
                'notifications' => $notificationsData,
                'pagination' => $paginationData
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function viewAppointments($patientId, $appointmentId, Request $request)
    {
        try {

            $AuthenticUser = $this->Authentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }
            $appointments = PatientAppointment::where('user_id', '=', $patientId,)
                ->where('id', '=', $appointmentId)
                ->get();
            $data = [
                'appointment' => $appointments
            ];
            return response()->json(['status' => 'true',  'data' => $data]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    //Doctors
    public function doctorList(Request $request)
    {
        try {
            $AuthenticUser = $this->Authentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }
            $doctors = DoctorDetail::with('user:id,name,email,status')->wherehas('user')
                ->select('user_id', 'specialist', 'designation', 'fee', 'experience', 'day_from', 'day_to', 'timing', 'availability', 'address')->get()->makehidden('user_id');
            $doctorData = [];
            $hasWorkingDays = !empty($doctor->day_from);

            foreach ($doctors as $doctor) {
                $doctorData[] = [
                    'doctor_id' => $doctor->user->id,
                    'name' => $doctor->user->name,
                    'email' => $doctor->user->email,
                    'status' => $doctor->user->status,
                    'specialist' => $doctor->specialist,
                    'designation' => $doctor->designation,
                    'details' => [
                        'doctor_id' => $doctor->user->id,
                        'name' => $doctor->user->name,
                        'email' => $doctor->user->email,
                        'specialist' => $doctor->specialist,
                        'designation' => $doctor->designation,
                        'fee' => $doctor->fee,
                        'experience' => $doctor->experience,
                        'working_days' => $doctor->day_to
                            ? $doctor->day_from . ' to ' . $doctor->day_to
                            : $doctor->day_from,
                        'timing' => $doctor->timing,
                        // 'availability' => $hasWorkingDays ? 'Available' : $doctor->availability,
                        'availability' => 'Available',
                        'address' => $doctor->address
                    ]
                ];
            }
            $data = [
                'doctors' => $doctorData
            ];
            return response()->json(['status' => true,  'data' => $data]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    public function doctorView($id, Request $request)
    {
        try {

            $AuthenticUser = $this->Authentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }
            $doctorView = DoctorDetail::with('user:id,name,email')->where('user_id', '=', $id)->wherehas('user')
                ->select('user_id', 'specialist', 'designation', 'fee', 'experience', 'day_from', 'day_to', 'timing', 'availability', 'address')->first()->makehidden(['user_id']);
            if (!$doctorView) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Doctor Details'

                ]);
            }
            $doctor = [
                'id' => $doctorView->user->id,
                'name' => $doctorView->user->name,
                'email' => $doctorView->user->email,
                'specialist' => $doctorView->specialist,
                'designation' => $doctorView->designation,
                'fee' => $doctorView->fee,
                'experience' => $doctorView->experience,
                'working_days' => $doctorView->day_to
                    ? $doctorView->day_from . ' to ' . $doctorView->day_to
                    : $doctorView->day_from,
                'timing' => $doctorView->timing,
                'availability' => "Available",
                'address' => $doctorView->address,

            ];
            $data = [
                'doctor' => $doctor
            ];
            return response()->json(['status' => 'success', 'message' => 'Doctor Details',  'data' => $data]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    //  one doctor  all appointments
    public function doctorAppointments($id, Request $request)
    {
        try {

            $AuthenticUser = $this->Authentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }
            $appointments = PatientAppointment::with('user:id,name', 'doctor:id,name')->where('doctor_id', '=', $id)->wherehas('doctor') // doctor_id, not user_id
                ->select('id', 'user_id', 'doctor_id', 'appointment_number', 'start_time', 'end_time', 'appointment_date', 'problem')
                ->get();
            $_appointments = [];
            foreach ($appointments as $appointment) {
                $_appointments[] = [
                    'patient_name' => $appointment->user->name,
                    'doctor_name' => $appointment->doctor->name,
                    'appointment_id' => $appointment->id,
                    'appointment_number' => $appointment->appointment_number,
                    'start_time' => $appointment->start_time,
                    'end_time' => $appointment->end_time,
                    'appointment_date' => $appointment->appointment_date,
                    'problem' => $appointment->problem,
                ];
            }
            $data = [
                'appointments' => $_appointments
            ];
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    // Book appointment
    public function BookAppointment(Request $request,)
    {
        try {
            $AuthenticUser = $this->Authentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'doctor_id' => 'required|exists:users,id',
                'appointment_date' => 'required|date|after_or_equal:today',
                'start_time' => 'required|date_format:H:i',
                'problem' => 'nullable|min:5'
            ]);
            $doctorDetails = DoctorDetail::where('user_id',  $request->doctor_id)->first();
            $dayfrom = $doctorDetails->day_from;
            $dayto = $doctorDetails->day_to;
            $appointmentDay = strtolower(Carbon::parse($request->appointment_date)->format('l'));
            $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $allowAppointment = false;
            if ($dayto == null) {
                if ($appointmentDay == $dayfrom) {
                    // appointment allowed
                    $allowAppointment = true;
                }
            } else {
                $fromIndex = array_search($dayfrom, $weekDays);
                $toIndex = array_search($dayto, $weekDays);
                $appointmentIndex = array_search($appointmentDay, $weekDays);
                if ($appointmentIndex >= $fromIndex && $appointmentIndex <= $toIndex) {
                    // appointment allowed
                    $allowAppointment = true;
                }
            }
            if (!$allowAppointment) {
                return response()->json([
                    'status' => 'error',
                    'Message' => "Doctor is not availabale to day ",
                    'Appointment Day' => $appointmentDay,
                    'Doctor Day from' => $dayfrom,
                    'Doctor Day to' => $dayto
                ]);
            }
            $patientAppointment = new PatientAppointment();
            $start_time = Carbon::createFromFormat('H:i', $request->start_time);
            $end_time = $start_time->copy()->addMinutes(15)->toTimeString();
            $existingappointment = PatientAppointment::where('doctor_id', $request->doctor_id)->where('appointment_date', $request->appointment_date)
                ->where(function ($query) use ($request, $end_time) {
                    $query->whereBetween('start_time', [$request->start_time, $request->end_time])->orwhereBetween('end_time', [$request->start_time, $request->end_time])
                        ->orwhere(function ($q) use ($request, $end_time) {
                            $q->where('start_time', '<=', $request->start_time)
                                ->where('end_time', '>=', $end_time);
                        });
                })->first();
            if ($existingappointment) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Time slot already booked'
                    ]
                );
            }
            $patientAppointment->fill($request->all());
            $patientAppointment->created_by = $request->user_id;
            $patientAppointment->end_time = $end_time;
            $patientAppointment->save();
            $start_time = Carbon::createFromFormat('H:i', $patientAppointment->start_time);
            $patientAppointment->end_time = $start_time->copy()->addMinutes(15)->toTimeString();
            $appointmentNumber = getDocNumber($patientAppointment->id, 'APT');
            $patientAppointment->appointment_number = $appointmentNumber;
            $patientAppointment->save();
            $data = [
                'appointment' => $patientAppointment->makeHidden(['created_at', 'updated_at', 'id'])
            ];


            return response()->json(['status' => 'success',  'data' => $data]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors() // this will show field-specific validation errors
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    //invoices view patient
    public function InvoiceView($id, Request $request)
    {
        try {

            // $AuthenticUser = $this->Authentication($request);
            // if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
            //     return $AuthenticUser;
            // }
            $invoices = Invoice::with('user:id', 'users:id,name')->where('user_id', '=', $id)->wherehas('user')
                ->orderBy('created_at', 'desc')->select()->get()->makeHidden('user_id')
                ->map(function ($doctors) {
                    $appointment = patientAppointment::where('user_id', $doctors->user_id)
                        ->where('doctor_id', $doctors->doctor_id)
                        ->whereDate('appointment_date', $doctors->invoice_date)
                        ->first();
                    return [
                        'id' => $doctors->id,
                        'company' => $doctors->company_id,
                        // 'date' => $doctors->invoice_date,
                        'date' => date('Y-m-d', strtotime($doctors->invoice_date)),
                        'total' => $doctors->total,
                        'vat-percentage' => $doctors->vat_percentage,
                        'total-vat' => $doctors->total_vat,
                        'discount-percentage' => $doctors->discount_percentage,
                        'total-discount' => $doctors->total_discount,
                        'grand-total' => $doctors->grand_total,
                        'paid' => $doctors->paid,
                        'due' => $doctors->due,
                        'doctor-Id' => $doctors->doctor_id,
                        'name' => $doctors->users->name,
                        'invoice_number' => $doctors->invoice_number,
                        'commission-percentage' => $doctors->commission_percentage,
                        'total-commission' => $doctors->total_commission,
                    ];
                });
            return response()->json(['status' => true,  'invoices' => $invoices]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    //login and logout
    public function Login(Request $request)
    {
        try {

            $role = "";
            $data = $request->all();
            $mrn_number = $data['mrn_number'] ?? null;
            $email = $data['email'] ?? null;
            $password = $data['password'] ?? null;
            if (!$mrn_number && !$email) {
                return response()->json(['status' => 'error', 'error' => 'MRN number or email is required'], 400);
            }

            if ($mrn_number) {

                $role = "Patient";
                // Step 1: Find patient detail by MRN
                $patient = PatientDetail::where('mrn_number', $request->mrn_number)->first();
                if (!$patient) {
                    return response()->json(['status' => 'error', 'error' => 'MRN not found in patient details'], 404);
                }
                // Step 2: Get user using patient.user_id
                $user = User::find($patient->user_id);
                if (!$user) {
                    return response()->json(['status' => 'error', 'error' => 'User not found for this MRN'], 404);
                }

                // Step 3: Generate and save tokens
                $accessToken = $this->generateAccessToken(86);
                $refreshToken = $this->generateRefreshToken(86);
                $user->access_token = $accessToken;
                $user->refresh_token = $refreshToken;
                $user->access_expire = Carbon::now()->addMinutes(60);
                $user->save();
                if ($request->has('device_token') && !empty($request->device_token) && $request->device_token != 'null') {

                    $deviceTokenData = DeviceToken::registerToken(
                        $user->id,
                        $request->device_token,
                        $request->device_type ?? 'android',
                        $request->app_version ?? null
                    );
                }
                $settings = Setting::pluck('value', 'key')->toArray();
                // Step 4: Response
                $data = [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'gender' => $user->gender,
                    'mrn' => $patient->mrn_number,
                    'role' => $role,
                    'access_token' => $accessToken,
                    'refresh_token' => $refreshToken,
                    'expires_in' => Carbon::now()->addMinutes(60)->toDateTimeString(),
                    'app_name' => $settings['general.company_name'],
                    'device_token' => $deviceTokenData->device_token ?? "",
                    'device_type' => $deviceTokenData->device_type ?? "",
                    'app_version' => $deviceTokenData->app_version ?? "",
                    'status' => $deviceTokenData->status ?? "",
                ];
                return response()->json([
                    'status' => 'success',
                    'login' => 'successfully logged in',
                    'data' => $data
                ]);
            }
            if (!$password) {
                return response()->json(['status' => 'error', 'error' => 'Password is required for email login'], 400);
            }

            // Email-based login logic here
            $user = User::where('email', $email)->first();
            if (!$user || !Hash::check($password, $user->password)) {
                return response()->json(['status' => 'error', 'error' => 'Invalid email or password'], 401);
            }
            // Generate and save tokens
            $accessToken = $this->generateAccessToken(86);
            $refreshToken = $this->generateRefreshToken(86);
            $user->access_token = $accessToken;
            $user->refresh_token = $refreshToken;
            $user->access_expire = Carbon::now()->addMinutes(60);
            $user->save();
            $role = "Super Admin";

            $settings = Setting::pluck('value', 'key')->toArray();
            // Response
            $data = [
                'user_id' => $user->id,
                'name' => $user->name,
                'gender' => $user->gender,
                'role' => $role,
                'email' => $user->email,
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'expires_in' => Carbon::now()->addMinutes(60)->toDateTimeString(),
                'app_name' => $settings['general.company_name'],
            ];
            return response()->json([
                'status' => 'success',
                'login' => 'successfully logged in',
                'data' => $data
            ]);
        } catch (Exception $e) {
            // file lock
            $messages = "Login successful, but failed to send notification: " . $e->getMessage();
            Storage::disk('local')->append('error.log', $messages);
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function Logout(Request $request)
    {
        $token = $token = $request->bearerToken();
        if (!$token) {
            $token = $request->input('access_token');  // Try from body or query string
        }
        // if (!$token) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'please login '
        //     ]);
        // }
        $user = User::where('access_token', '=', $token)->first();
        // if (!$token) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Please login'
        //     ]);
        // }
        if ($user) {
            $user->access_token = null;
            $user->refresh_token = null;
            $user->access_expire = null;
            $user->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Logout Successfully'
        ]);
    }
    //doctor view his patinet
    public function doctorPatients($id, Request $request)
    {
        $AuthenticUser = $this->Authentication($request);
        if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
            return $AuthenticUser;
        }
        try {
            // 1. DoctorDetail ke through doctor ka user nikalo
            $doctorDetail = DoctorDetail::with('user.doctorAppointments.patient.patientDetails')->where('user_id', $id)->first();
            if (!$doctorDetail) {
                return response()->json(['message' => 'Doctor not found'], 404);
            }
            // 2. Doctor user
            $doctor = $doctorDetail->user;
            // 3. Appointments se patients nikalo
            $patients = $doctor->doctorAppointments->map(function ($appointment) {
                $patientUser = $appointment->patient;
                return [
                    'id' => $patientUser->id,
                    'name' => $patientUser->name,
                    'email' => $patientUser->email,
                    'cnic' => optional($patientUser->patientDetails)->cnic,
                    'mrn_number' => optional($patientUser->patientDetails)->mrn_number,
                    'martial status' => optional($patientUser->patientDetails)->marital_status,
                ];
            });
            return response()->json([
                'status' => 'success',
                'doctor' => $doctor->name,
                'patients' => $patients
            ]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', $e->getMessage()], 404);
        }
    }
    private function generateAccessToken($length = 86)
    {
        $string = str::random(86);
        $numbers = random_int(1000, 9999);
        $combined = $string . $numbers;
        $token = str_shuffle($combined);
        return $token;
    }
    private function generateRefreshToken($length = 86)
    {
        $string = str::random(86);
        $numbers = random_int(1000, 9999);
        $combined = $string . $numbers;
        $token = str_shuffle($combined);
        return $token;
    }

    //invoice view
    public function invoiceDetail($id, Request $request)
    {
        // $AuthenticUser = $this->Authentication($request);
        // if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
        //     return $AuthenticUser;
        // }
        try {
            $invoice = Invoice::with(['user.patientDetails', 'users', 'invoiceItems'])->where('id', $id)->first();
            // $setting = DB::Table('settings');
            $setting = Setting::pluck('value', 'key')->toArray();
            if (!$invoice) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'no invoice'
                ]);
            }

            $patient = $invoice->user;
            $patientDetail = $patient->patientDetails;
            $doctor = $invoice->users;
            $items = $invoice->invoiceItems;
            return view('invoiceView.invoiceView', ['patient' => $patient, 'patientDetail' => $patientDetail, 'doctor' => $doctor, 'items' => $items, 'invoice' => $invoice, 'setting' => $setting]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', $e->getMessage()], 404);
        }
    }

    public function prescriptionDetail($id, Request $request)
    {
        // $AuthenticUser = $this->Authentication($request);
        // if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
        //     return $AuthenticUser;
        // }
        try {
            $prescription = Prescription::with(['user.patientDetails', 'doctor', 'patientmedicineitem.ddmedicine', 'patientmedicineitem.ddmedicinetype'])->where('id', $id)->first();
            // $setting = DB::Table('settings');
            $setting = Setting::pluck('value', 'key')->toArray();
            if (!$prescription) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'no prescription'
                ]);
            }

            $patient = $prescription->user;
            $patientDetail = $patient->patientDetails;
            $doctor = $prescription->doctor;
            $items = $prescription->patientmedicineitem;
            return view('prescriptionView.prescriptionView', ['patient' => $patient, 'patientDetail' => $patientDetail, 'doctor' => $doctor, 'items' => $items, 'prescription' => $prescription, 'setting' => $setting]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', $e->getMessage()], 404);
        }
    }


    // owner dashboard
    // view all doctors
    public function allDocstors(Request $request)
    {
        $AuthenticUser = $this->Authentication($request);
        if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
            return $AuthenticUser;
        }
        try {
            $detail = DoctorDetail::with('user:id,name,email,gender')->whereHas('user')->select('user_id', 'specialist', 'designation', 'experience', 'timing', 'day_from', 'day_to', 'availability', 'address', 'fee')
                ->get();
            $doctors = $detail->map(function ($doctor) {
                return [

                    'doctor_id'  => $doctor->user->id,
                    'doctor_name' => $doctor->user->name,
                    'doctor_email' => $doctor->user->email,
                    'doctor_gender' => $doctor->user->gender,

                    'specialist' => $doctor->specialist,
                    'designation' => $doctor->designation,
                    'experience' => $doctor->experience,
                    'timing' => $doctor->timing,
                    'day_from' => $doctor->day_from,
                    'day_to' => $doctor->day_to,
                    // 'availability' => $doctor->availability,
                    'availability' => "Available",
                    'address' => $doctor->address,
                    'fee' => $doctor->address,
                ];
            });
            $data = [
                'doctors' => $doctors
            ];
            return response()->json([
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                $e->getMessage()
            ], 400);
        }
    }
    //all patient
    public function allPatients(Request $request)
    {
        $AuthenticUser = $this->Authentication($request);
        if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
            return $AuthenticUser;
        }
        try {
            $detail = patientDetail::with('user:id,name,email,gender')->whereHas('user')->select('user_id', 'mrn_number', 'marital_status', 'insurance_number', 'cnic', 'city', 'area')
                ->get();
            $patients = $detail->map(function ($patient) {
                return [

                    'patient'  => $patient->user->id,
                    'doctor_name' => $patient->user->name,
                    'doctor_email' => $patient->user->email,
                    'doctor_gender' => $patient->user->gender,

                    'specialist' => $patient->specialist,
                    'designation' => $patient->designation,
                    'experience' => $patient->experience,
                    'timing' => $patient->timing,
                    'day_from' => $patient->day_from,
                    'day_to' => $patient->day_to,
                    'availability' => $patient->availability,
                    'address' => $patient->address,
                    'fee' => $patient->address,

                ];
            });
            $data = [
                'patients' => $patients
            ];
            return response()->json([
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                $e->getMessage()
            ], 400);
        }
    }
    // all appointment
    public function allAppointments(Request $request)
    {
        $AuthenticUser = $this->Authentication($request);
        if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
            return $AuthenticUser;
        }
        try {
            $patientAppointments = patientAppointment::with('patient:id,name,email,gender', 'patient.patientDetails:user_id,mrn_number', 'doctor:id,name')->whereHas('patient')
                ->select('user_id', 'doctor_id', 'appointment_number', 'appointment_date', 'problem')
                ->get();
            $appointment = $patientAppointments->map(function ($appointment) {
                return [
                    'patient_id'  => $appointment->patient->id,
                    'patient_name'  => $appointment->patient->name,
                    'patient_mrn_number'  => $appointment->patient->patientDetails->mrn_number,
                    'doctor_name'  => $appointment->doctor->name,
                    'appointment_number' => $appointment->appointment_number,
                    'appointment_date' => $appointment->appointment_date,
                    'problem' => $appointment->problem
                ];
            });
            $data = [
                'patients' => $appointment
            ];
            return response()->json([
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                $e->getMessage()
            ], 400);
        }
    }
    public function allInvoices(Request $request)
    {
        $AuthenticUser = $this->Authentication($request);
        if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
            return $AuthenticUser;
        }
        try {

            $invoices = Invoice::with([
                'user:id,name',
                // 'users:id,name'
            ])->wherehas('user')->whereHas('users')->select('id', 'user_id', 'doctor_id', 'invoice_date', 'total')->get();

            $all = $invoices->map(function ($invoice) {
                // 'patient_id'  => $invoice->user->id,
                return [
                    'invoice_id' => $invoice->id,
                    'patient_name'  => $invoice->user->name,
                    'doctor_name'  => $invoice->users->name,
                    'invoice_date' => $invoice->invoice_date,
                    'invoice_total' => $invoice->total,
                ];
            });
            $data = [
                'patients' => $all
            ];
            return response()->json([
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                $e->getMessage()
            ], 404);
        }
    }
    // Contact Us API (Public - No Auth Required)
    public function contact(Request $request)
    {
        try {
            // Get application settings from application_settings table
            $appSetting = ApplicationSetting::first();

            if (!$appSetting) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Contact information not found'
                ], 404);
            }

            // Build logo URL - same as sidebar.blade.php
            $logoUrl = $appSetting->logo ? asset('public/' . $appSetting->logo) : null;

            $data = [
                'app_name' => $appSetting->item_name ?? '',
                'contact' => $appSetting->contact ?? '',
                'email' => $appSetting->company_email ?? '',
                'address' => $appSetting->company_address ?? '',
                'logo_url' => $logoUrl,
            ];

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Application Settings API (Public - No Auth Required)
    public function applicationSettings(Request $request)
    {
        try {
            // Get application settings from application_settings table
            $appSetting = ApplicationSetting::first();

            if (!$appSetting) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Application settings not found',
                    'code' => 404
                ], 404);
            }

            // Build logo URL - same as sidebar.blade.php
            $logoUrl = $appSetting->logo ? asset('public/' . $appSetting->logo) : null;

            $data = [
                'app_name' => $appSetting->item_name ?? '',
                'contact' => $appSetting->contact ?? '',
                'email' => $appSetting->company_email ?? '',
                'address' => $appSetting->company_address ?? '',
                'logo_url' => $logoUrl,
            ];

            return $this->jsonResponse([
                'status' => 'success',
                'settings' => $data
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Authentication Helper
    private function AdminAuthentication(Request $request)
    {
        $user = $this->Authentication($request);
        if ($user instanceof \Illuminate\Http\JsonResponse) {
            return $user;
        }

        // Check if user has admin role
        if (!$this->userHasAdminVisibility($user)) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Access denied. Admin only.',
                'code' => 403
            ], 403);
        }

        return $user;
    }

    private function userHasAdminVisibility($user): bool
    {
        $roles = ['Super Admin', 'Admin', 'admin', 'Doctor', 'doctor', 'Owner', 'owner'];

        foreach ($roles as $role) {
            if (method_exists($user, 'hasRole') && $user->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    // Admin Dashboard
    public function adminDashboard(Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $totalDoctors = DoctorDetail::whereHas('user')->count();
            $totalPatients = PatientDetail::whereHas('user')->count();
            $totalAppointments = PatientAppointment::count();
            $totalInvoices = Invoice::count();
            $pendingAppointments = PatientAppointment::whereHas('appointmentstatus', function ($q) {
                $q->where('name', 'like', '%pending%');
            })->count();
            $completedAppointments = PatientAppointment::whereHas('appointmentstatus', function ($q) {
                $q->where('name', 'like', '%completed%');
            })->count();
            $totalRevenue = Invoice::sum('grand_total');
            $paidAmount = Invoice::sum('paid');
            $dueAmount = Invoice::sum('due');

            $data = [
                'stats' => [
                    'total_doctors' => $totalDoctors,
                    'total_patients' => $totalPatients,
                    'total_appointments' => $totalAppointments,
                    'total_invoices' => $totalInvoices,
                    'pending_appointments' => $pendingAppointments,
                    'completed_appointments' => $completedAppointments,
                    'total_revenue' => $totalRevenue,
                    'paid_amount' => $paidAmount,
                    'due_amount' => $dueAmount
                ]
            ];

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Doctors List
    public function adminDoctorsList(Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $query = DoctorDetail::with('user:id,name,email,phone,gender,date_of_birth,status')
                ->whereHas('user');

            // Filters
            if ($request->has('start_date') && !empty($request->start_date)) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $query->whereHas('user', function ($q) use ($startDate) {
                    $q->where('created_at', '>=', $startDate);
                });
            }

            if ($request->has('end_date') && !empty($request->end_date)) {
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                $query->whereHas('user', function ($q) use ($endDate) {
                    $q->where('created_at', '<=', $endDate);
                });
            }

            if ($request->has('active') && $request->active !== '') {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('status', $request->active == 'true' ? 1 : 0);
                });
            }

            if ($request->has('specialization') && !empty($request->specialization)) {
                $query->where('specialist', 'like', '%' . $request->specialization . '%');
            }

            if ($request->has('min_experience') && !empty($request->min_experience)) {
                $query->where('experience', '>=', $request->min_experience);
            }

            if ($request->has('max_experience') && !empty($request->max_experience)) {
                $query->where('experience', '<=', $request->max_experience);
            }

            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    })
                        ->orWhere('specialist', 'like', '%' . $search . '%')
                        ->orWhere('designation', 'like', '%' . $search . '%');
                });
            }

            // Pagination
            $page = $request->get('page', 1);
            $limit = min($request->get('limit', 20), 100);
            $totalCount = $query->count();
            $doctors = $query->skip(($page - 1) * $limit)->take($limit)->get();

            $doctorsData = $doctors->map(function ($doctor) {
                $totalAppointments = PatientAppointment::where('doctor_id', $doctor->user_id)->count();
                return [
                    'doctor_id' => $doctor->user_id,
                    'name' => $doctor->user->name,
                    'email' => $doctor->user->email,
                    'phone' => $doctor->user->phone,
                    'specialization' => $doctor->specialist,
                    'qualification' => $doctor->designation,
                    'experience' => $doctor->experience,
                    'license_number' => null, // Add if available in model
                    'is_active' => $doctor->user->status == 1,
                    'total_appointments' => $totalAppointments,
                    'created_at' => $doctor->user->created_at ? $doctor->user->created_at->toDateTimeString() : null,
                    'details' => [
                        'email' => $doctor->user->email,
                        'phone' => $doctor->user->phone,
                        'specialization' => $doctor->specialist,
                        'qualification' => $doctor->designation,
                        'experience' => $doctor->experience,
                        'license_number' => null,
                    ]
                ];
            });

            return $this->jsonResponse([
                'status' => 'success',
                'doctors' => $doctorsData,
                'pagination' => [
                    'total_count' => $totalCount,
                    'page' => (int)$page,
                    'limit' => (int)$limit,
                    'total_pages' => ceil($totalCount / $limit)
                ]
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Doctor Show
    public function adminDoctorsShow($id, Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $doctor = DoctorDetail::with('user:id,name,email,phone,gender,date_of_birth,status,address')
                ->where('user_id', $id)
                ->whereHas('user')
                ->first();

            if (!$doctor) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Doctor not found',
                    'code' => 404
                ], 404);
            }

            $totalAppointments = PatientAppointment::where('doctor_id', $id)->count();
            $totalPatients = PatientAppointment::where('doctor_id', $id)->distinct('user_id')->count('user_id');

            $data = [
                'doctor_id' => $doctor->user_id,
                'name' => $doctor->user->name,
                'email' => $doctor->user->email,
                'phone' => $doctor->user->phone,
                'gender' => $doctor->user->gender,
                'date_of_birth' => $doctor->user->date_of_birth,
                'specialization' => $doctor->specialist,
                'qualification' => $doctor->designation,
                'experience' => $doctor->experience,
                'fee' => $doctor->fee,
                'timing' => $doctor->timing,
                'availability' => $doctor->availability,
                'address' => $doctor->address ?? $doctor->user->address,
                'working_days' => $doctor->day_to ? $doctor->day_from . ' to ' . $doctor->day_to : $doctor->day_from,
                'is_active' => $doctor->user->status == 1,
                'total_appointments' => $totalAppointments,
                'total_patients' => $totalPatients,
                'created_at' => $doctor->user->created_at ? $doctor->user->created_at->toDateTimeString() : null
            ];

            return $this->jsonResponse([
                'status' => 'success',
                'doctor' => $data
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Patients List
    public function adminPatientsList(Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $query = PatientDetail::with('user:id,name,email,phone,gender,date_of_birth,address,created_at')
                ->whereHas('user');

            // Filters
            if ($request->has('start_date') && !empty($request->start_date)) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $query->whereHas('user', function ($q) use ($startDate) {
                    $q->where('created_at', '>=', $startDate);
                });
            }

            if ($request->has('end_date') && !empty($request->end_date)) {
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                $query->whereHas('user', function ($q) use ($endDate) {
                    $q->where('created_at', '<=', $endDate);
                });
            }

            if ($request->has('gender') && !empty($request->gender)) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('gender', $request->gender);
                });
            }

            if ($request->has('min_age') && !empty($request->min_age)) {
                $maxBirthDate = Carbon::now()->subYears($request->min_age)->endOfDay();
                $query->whereHas('user', function ($q) use ($maxBirthDate) {
                    $q->where('date_of_birth', '<=', $maxBirthDate);
                });
            }

            if ($request->has('max_age') && !empty($request->max_age)) {
                $minBirthDate = Carbon::now()->subYears($request->max_age + 1)->startOfDay();
                $query->whereHas('user', function ($q) use ($minBirthDate) {
                    $q->where('date_of_birth', '>=', $minBirthDate);
                });
            }

            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    })
                        ->orWhere('mrn_number', 'like', '%' . $search . '%');
                });
            }

            // Pagination
            $page = $request->get('page', 1);
            $limit = min($request->get('limit', 20), 100);
            $totalCount = $query->count();
            $paginationData = [];
            $patients = $query->get();
            if ($request->get("page")) {
                $patients = $query->skip(($page - 1) * $limit)->take($limit)->get();
                $paginationData = [
                    'total_count' => $totalCount,
                    'page' => (int)$page,
                    'limit' => (int)$limit,
                    'total_pages' => ceil($totalCount / $limit)
                ];
            }

            $patientsData = $patients->map(function ($patient) {
                $age = $patient->user->date_of_birth ? Carbon::parse($patient->user->date_of_birth)->age : null;
                $totalAppointments = PatientAppointment::where('user_id', $patient->user_id)->count();
                $totalInvoices = Invoice::where('user_id', $patient->user_id)->count();

                return [
                    'patient_id' => $patient->user_id,
                    'name' => $patient->user->name,
                    'email' => $patient->user->email,
                    'phone' => $patient->user->phone,
                    'gender' => $patient->user->gender,
                    'age' => $age,
                    'mrn_number' => $patient->mrn_number,
                    'address' => $patient->user->address,
                    'date_of_birth' => $patient->user->date_of_birth,
                    'joining_date' => $patient->user->created_at ? $patient->user->created_at->format('F j Y') : "",
                    'total_appointments' => $totalAppointments,
                    'total_invoices' => $totalInvoices
                ];
            });

            return $this->jsonResponse([
                'status' => 'success',
                'patients' => $patientsData,
                'pagination' => $paginationData
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Appointments List
    public function adminAppointmentsList(Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $query = PatientAppointment::with([
                'doctor:id,name',
                'patient:id,name',
                'appointmentstatus:id,name'
            ])->whereHas('doctor')->whereHas('patient');

            // Filters
            if ($request->has('start_date') && !empty($request->start_date)) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $query->where('appointment_date', '>=', $startDate->format('Y-m-d'));
            }

            if ($request->has('end_date') && !empty($request->end_date)) {
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                $query->where('appointment_date', '<=', $endDate->format('Y-m-d'));
            }

            if ($request->has('status') && !empty($request->status)) {
                $query->whereHas('appointmentstatus', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->status . '%');
                });
            }

            if ($request->has('doctor_id') && !empty($request->doctor_id)) {
                $query->where('doctor_id', $request->doctor_id);
            }

            if ($request->has('patient_id') && !empty($request->patient_id)) {
                $query->where('user_id', $request->patient_id);
            }

            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('appointment_number', 'like', '%' . $search . '%')
                        ->orWhere('problem', 'like', '%' . $search . '%');
                });
            }

            // Pagination
            $page = $request->get('page', 1);
            $limit = min($request->get('limit', 20), 100);
            $totalCount = $query->count();

            $paginationData = [];

            // page param is set
            if ($request->get("page")) {
                $appointments = $query->orderBy('appointment_date', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->skip(($page - 1) * $limit)
                    ->take($limit)
                    ->get();
                $paginationData = [
                    'total_count' => $totalCount,
                    'page' => (int)$page,
                    'limit' => (int)$limit,
                    'total_pages' => ceil($totalCount / $limit)
                ];
            } else {
                $appointments = $query->orderBy('appointment_date', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }


            $appointmentsData = $appointments->map(function ($appointment) {
                return [
                    'appointment_id' => $appointment->id,
                    'appointment_number' => $appointment->appointment_number,
                    'doctor_name' => $appointment->doctor->name ?? null,
                    'doctor_id' => $appointment->doctor_id,
                    'patient_name' => $appointment->patient->name ?? null,
                    'patient_id' => $appointment->user_id,
                    'appointment_date' => $appointment->appointment_date,
                    'appointment_time' => $appointment->start_time,
                    'status' => $appointment->appointmentstatus->name ?? null,
                    'appointment_reason' => $appointment->problem,
                    'notes' => $appointment->problem,
                    'created_at' => $appointment->created_at ? $appointment->created_at->toDateTimeString() : null
                ];
            });

            return $this->jsonResponse([
                'status' => 'success',
                'appointments' => $appointmentsData,
                'pagination' => $paginationData
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Invoices List
    public function adminInvoicesList(Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $query = Invoice::with([
                'user:id,name',
                'users:id,name'
            ])->whereHas('user')->whereHas('users');

            // Filters
            if ($request->has('start_date') && !empty($request->start_date)) {
                $startDate = Carbon::parse($request->start_date)->startOfDay();
                $query->where('invoice_date', '>=', $startDate->format('Y-m-d'));
            }

            if ($request->has('end_date') && !empty($request->end_date)) {
                $endDate = Carbon::parse($request->end_date)->endOfDay();
                $query->where('invoice_date', '<=', $endDate->format('Y-m-d'));
            }

            if ($request->has('payment_status') && !empty($request->payment_status)) {
                if ($request->payment_status == 'paid') {
                    $query->where('due', '<=', 0);
                } elseif ($request->payment_status == 'pending') {
                    $query->where('due', '>', 0);
                } elseif ($request->payment_status == 'overdue') {
                    $query->where('due', '>', 0)
                        ->where('invoice_date', '<', Carbon::now()->format('Y-m-d'));
                }
            }

            if ($request->has('doctor_id') && !empty($request->doctor_id)) {
                $query->where('doctor_id', $request->doctor_id);
            }

            if ($request->has('patient_id') && !empty($request->patient_id)) {
                $query->where('user_id', $request->patient_id);
            }

            if ($request->has('min_amount') && !empty($request->min_amount)) {
                $query->where('grand_total', '>=', $request->min_amount);
            }

            if ($request->has('max_amount') && !empty($request->max_amount)) {
                $query->where('grand_total', '<=', $request->max_amount);
            }

            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where('invoice_number', 'like', '%' . $search . '%');
            }

            // Pagination
            $page = $request->get('page', 1);
            $limit = min($request->get('limit', 20), 100);
            $totalCount = $query->count();

            $paginationData = [];
            $invoices = [];

            if ($request->get("page")) {
                $invoices = $query->orderBy('invoice_date', 'desc')
                    ->skip(($page - 1) * $limit)
                    ->take($limit)
                    ->get();
                $paginationData = [
                    'total_count' => $totalCount,
                    'page' => (int)$page,
                    'limit' => (int)$limit,
                    'total_pages' => ceil($totalCount / $limit)
                ];
            } else {
                $invoices = $query->orderBy('invoice_date', 'desc')
                    ->get();
            }

            $invoicesData = $invoices->map(function ($invoice) {
                $paymentStatus = 'paid';
                if ($invoice->due > 0) {
                    $paymentStatus = Carbon::parse($invoice->invoice_date)->isPast() ? 'overdue' : 'pending';
                }

                return [
                    'invoice_id' => $invoice->id,
                    'invoice_number' => $invoice->invoice_number,
                    'invoice_date' => $invoice->invoice_date ? date('d-m-y', strtotime($invoice->invoice_date)) : null,
                    'patient_name' => $invoice->user->name ?? null,
                    'patient_id' => $invoice->user_id,
                    'doctor_name' => $invoice->users->name ?? null,
                    'doctor_id' => $invoice->doctor_id,
                    'subtotal' => $invoice->total,
                    'discount' => $invoice->total_discount,
                    'tax' => $invoice->total_vat,
                    'net_amount' => $invoice->grand_total,
                    'paid' => $invoice->paid,
                    'payment_status' => $paymentStatus,
                    'created_at' => $invoice->created_at ? $invoice->created_at->toDateTimeString() : null
                ];
            });

            return $this->jsonResponse([
                'status' => 'success',
                'invoices' => $invoicesData,
                'pagination' => $paginationData
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Contact Management
    public function adminContactManagement(Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $action = $request->get('action', 'view');

            if ($action == 'view') {
                $settings = Setting::pluck('value', 'key')->toArray();

                $contactInfo = [
                    'software_name' => $settings['general.company_name'] ?? 'Dental Lite',
                    'contact_email' => $settings['general.company_email'] ?? '',
                    'phone' => $settings['general.company_phone'] ?? '',
                    'address' => $settings['general.company_address'] ?? '',
                    'website' => $settings['general.company_website'] ?? '',
                    'business_hours' => $settings['general.business_hours'] ?? '9:00 AM - 6:00 PM',
                    'emergency_contact' => $settings['general.emergency_contact'] ?? $settings['general.company_phone'] ?? ''
                ];

                return $this->jsonResponse([
                    'status' => 'success',
                    'contact_info' => $contactInfo
                ]);
            } elseif ($action == 'update') {
                $request->validate([
                    'software_name' => 'nullable|string|max:255',
                    'contact_email' => 'nullable|email|max:255',
                    'phone' => 'nullable|string|max:50',
                    'address' => 'nullable|string',
                    'website' => 'nullable|url|max:255',
                    'business_hours' => 'nullable|string|max:100',
                    'emergency_contact' => 'nullable|string|max:50'
                ]);

                $settingsMap = [
                    'software_name' => 'general.company_name',
                    'contact_email' => 'general.company_email',
                    'phone' => 'general.company_phone',
                    'address' => 'general.company_address',
                    'website' => 'general.company_website',
                    'business_hours' => 'general.business_hours',
                    'emergency_contact' => 'general.emergency_contact'
                ];

                foreach ($settingsMap as $requestKey => $settingKey) {
                    if ($request->has($requestKey)) {
                        Setting::updateOrCreate(
                            ['key' => $settingKey],
                            ['value' => $request->input($requestKey)]
                        );
                    }
                }

                $settings = Setting::pluck('value', 'key')->toArray();
                $contactInfo = [
                    'software_name' => $settings['general.company_name'] ?? '',
                    'contact_email' => $settings['general.company_email'] ?? '',
                    'phone' => $settings['general.company_phone'] ?? '',
                    'address' => $settings['general.company_address'] ?? '',
                    'website' => $settings['general.company_website'] ?? '',
                    'business_hours' => $settings['general.business_hours'] ?? '9:00 AM - 6:00 PM',
                    'emergency_contact' => $settings['general.emergency_contact'] ?? $settings['general.company_phone'] ?? ''
                ];

                return $this->jsonResponse([
                    'status' => 'success',
                    'message' => 'Contact information updated successfully',
                    'contact_info' => $contactInfo
                ]);
            } else {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Invalid action. Use "view" or "update"',
                    'code' => 400
                ], 400);
            }
        } catch (ValidationException $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'code' => 422
            ], 422);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Notifications
    public function adminNotifications(Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $query = Notification::query();

            // Pagination
            $page = $request->get('page', 1);
            $limit = min($request->get('limit', 20), 100);
            $totalCount = $query->count();

            $paginationData = [];
            $notifications = [];
            if ($request->get("page")) {
                $notifications = $query->orderBy('created_at', 'desc')
                    ->skip(($page - 1) * $limit)
                    ->take($limit)
                    ->get();
            } else {
                $notifications = $query->orderBy('created_at', 'desc')
                    ->get();
                $paginationData = [
                    'total_count' => $totalCount,
                    'page' => (int)$page,
                    'limit' => (int)$limit,
                    'total_pages' => ceil($totalCount / $limit)
                ];
            }

            $notificationsData = $notifications->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'user_id' => $notification->user_id,
                    'title' => $notification->text,
                    'description' => $notification->description,
                    'status' => $notification->status,
                    'created_at' => $notification->created_at ? $notification->created_at->toDateTimeString() : null
                ];
            });

            return $this->jsonResponse([
                'status' => 'success',
                'notifications' => $notificationsData,
                'pagination' => $paginationData
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Prescriptions List
    public function adminPrescriptionsList(Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $query = Prescription::with([
                'doctor:id,name',
                'user:id,name'
            ])->whereHas('doctor')->whereHas('user');

            // Filters
            if ($request->has('start_date') && !empty($request->start_date)) {
                $query->where('prescription_date', '>=', $request->start_date);
            }

            if ($request->has('end_date') && !empty($request->end_date)) {
                $query->where('prescription_date', '<=', $request->end_date);
            }

            if ($request->has('doctor_id') && !empty($request->doctor_id)) {
                $query->where('doctor_id', $request->doctor_id);
            }

            if ($request->has('patient_id') && !empty($request->patient_id)) {
                $query->where('user_id', $request->patient_id);
            }

            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('prs_number', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($uq) use ($search) {
                            $uq->where('name', 'like', '%' . $search . '%');
                        });
                });
            }

            // Pagination
            $page = $request->get('page', 1);
            $limit = min($request->get('limit', 20), 100);
            $totalCount = $query->count();

            $paginationData = [];
            $prescriptions = [];

            if ($request->get("page")) {
                $prescriptions = $query->orderBy('prescription_date', 'desc')
                    ->skip(($page - 1) * $limit)
                    ->take($limit)
                    ->get();
                $paginationData = [
                    'total_count' => $totalCount,
                    'page' => (int)$page,
                    'limit' => (int)$limit,
                    'total_pages' => ceil($totalCount / $limit)
                ];
            } else {
                $prescriptions = $query->orderBy('prescription_date', 'desc')->get();
            }

            $prescriptionsData = $prescriptions->map(function ($prescription) {
                return [
                    'id' => $prescription->id,
                    'prescription_number' => $prescription->prs_number,
                    'prescription_date' => $prescription->prescription_date,
                    'doctor_name' => $prescription->doctor->name ?? null,
                    'patient_name' => $prescription->user->name ?? null,
                    'patient_id' => $prescription->user_id,
                    'doctor_id' => $prescription->doctor_id,
                    'created_at' => $prescription->created_at ? $prescription->created_at->toDateTimeString() : null
                ];
            });

            return $this->jsonResponse([
                'status' => 'success',
                'prescriptions' => $prescriptionsData,
                'pagination' => $paginationData
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Admin Prescription Show
    public function adminPrescriptionShow($id, Request $request)
    {
        try {
            $AuthenticUser = $this->AdminAuthentication($request);
            if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
                return $AuthenticUser;
            }

            $prescription = Prescription::with([
                'doctor:id,name,email',
                'user:id,name', // Patient
                'patientmedicineitem.ddmedicine:id,name',
                'patientmedicineitem.ddmedicinetype:id,name',
                'patientdiagnosisitem.dddiagnosis:id,name'
            ])->where('id', $id)->first();

            if (!$prescription) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Prescription not found',
                    'code' => 404
                ], 404);
            }

            $medicines = $prescription->patientmedicineitem->map(function ($item) {
                return [
                    'medicine_name' => $item->ddmedicine->name ?? 'Unknown',
                    'type' => $item->ddmedicinetype->name ?? '',
                    'instruction' => $item->instruction,
                    'days' => $item->day
                ];
            });

            $diagnoses = $prescription->patientdiagnosisitem->map(function ($item) {
                return [
                    'diagnosis_name' => $item->dddiagnosis->name ?? 'Unknown',
                    'instruction' => $item->instruction
                ];
            });

            $data = [
                'id' => $prescription->id,
                'prescription_number' => $prescription->prs_number,
                'prescription_date' => $prescription->prescription_date,
                'note' => $prescription->note,
                'doctor' => [
                    'id' => $prescription->doctor_id,
                    'name' => $prescription->doctor->name ?? null,
                ],
                'patient' => [
                    'id' => $prescription->user_id,
                    'name' => $prescription->user->name ?? null,
                ],
                'medicines' => $medicines,
                'diagnoses' => $diagnoses
            ];

            return $this->jsonResponse([
                'status' => 'success',
                'prescription' => $data
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Patient Prescriptions List
    public function patientPrescriptions($patientId, Request $request)
    {
        try {
            // $AuthenticUser = $this->Authentication($request);
            // if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
            //     return $AuthenticUser;
            // }

            $prescriptions = Prescription::with('doctor:id,name')
                ->where('user_id', $patientId)
                ->orderBy('prescription_date', 'desc')
                ->get();

            $data = $prescriptions->map(function ($prescription) {
                return [
                    'id' => $prescription->id,
                    'prescription_number' => $prescription->prs_number,
                    'doctor_name' => $prescription->doctor->name ?? null,
                    'doctor_id' => $prescription->doctor_id,
                    'date' => $prescription->prescription_date,
                    'note' => $prescription->note
                ];
            });

            return $this->jsonResponse([
                'status' => 'success',
                'data' => [
                    'prescriptions' => $data
                ]
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    // Patient Prescriptions List (Same format as Admin Prescriptions List)
    public function patientPrescriptionsList($patientId, Request $request)
    {
        try {
            // Verify patient exists
            $patient = User::find($patientId);
            if (!$patient) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Patient not found',
                    'code' => 404
                ], 404);
            }

            $query = Prescription::with([
                'doctor:id,name',
                'user:id,name'
            ])->where('user_id', $patientId)->whereHas('doctor');

            // Filters
            if ($request->has('start_date') && !empty($request->start_date)) {
                $query->where('prescription_date', '>=', $request->start_date);
            }

            if ($request->has('end_date') && !empty($request->end_date)) {
                $query->where('prescription_date', '<=', $request->end_date);
            }

            if ($request->has('doctor_id') && !empty($request->doctor_id)) {
                $query->where('doctor_id', $request->doctor_id);
            }

            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('prs_number', 'like', '%' . $search . '%')
                        ->orWhereHas('doctor', function ($dq) use ($search) {
                            $dq->where('name', 'like', '%' . $search . '%');
                        });
                });
            }

            // Pagination
            $page = $request->get('page', 1);
            $limit = min($request->get('limit', 20), 100);
            $totalCount = $query->count();

            $paginationData = [];
            $prescriptions = [];

            if ($request->get("page")) {
                $prescriptions = $query->orderBy('prescription_date', 'desc')
                    ->skip(($page - 1) * $limit)
                    ->take($limit)
                    ->get();
                $paginationData = [
                    'total_count' => $totalCount,
                    'page' => (int)$page,
                    'limit' => (int)$limit,
                    'total_pages' => ceil($totalCount / $limit)
                ];
            } else {
                $prescriptions = $query->orderBy('prescription_date', 'desc')->get();
            }

            $prescriptionsData = $prescriptions->map(function ($prescription) {
                return [
                    'id' => $prescription->id,
                    'prescription_number' => $prescription->prs_number,
                    'prescription_date' => $prescription->prescription_date,
                    'doctor_name' => $prescription->doctor->name ?? null,
                    'patient_name' => $prescription->user->name ?? null,
                    'patient_id' => $prescription->user_id,
                    'doctor_id' => $prescription->doctor_id,
                    'created_at' => $prescription->created_at ? $prescription->created_at->toDateTimeString() : null
                ];
            });

            return $this->jsonResponse([
                'status' => 'success',
                'prescriptions' => $prescriptionsData,
                'pagination' => $paginationData
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // Patient Prescription View
    public function patientPrescriptionView($id, Request $request)
    {
        try {
            // $AuthenticUser = $this->Authentication($request);
            // if ($AuthenticUser instanceof \Illuminate\Http\JsonResponse) {
            //     return $AuthenticUser;
            // }

            $prescription = Prescription::with([
                'doctor:id,name,email',
                'user:id,name', // Patient
                'patientmedicineitem.ddmedicine:id,name',
                'patientmedicineitem.ddmedicinetype:id,name',
                'patientdiagnosisitem.dddiagnosis:id,name'
            ])->where('id', $id)->first();

            if (!$prescription) {
                return $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Prescription not found'
                ], 404);
            }

            $medicines = $prescription->patientmedicineitem->map(function ($item) {
                return [
                    'medicine_name' => $item->ddmedicine->name ?? 'Unknown',
                    'type' => $item->ddmedicinetype->name ?? '',
                    'instruction' => $item->instruction,
                    'days' => $item->day
                ];
            });

            $diagnoses = $prescription->patientdiagnosisitem->map(function ($item) {
                return [
                    'diagnosis_name' => $item->dddiagnosis->name ?? 'Unknown',
                    'instruction' => $item->instruction
                ];
            });

            $data = [
                'id' => $prescription->id,
                'prescription_number' => $prescription->prs_number,
                'date' => $prescription->prescription_date,
                'note' => $prescription->note,
                'doctor' => [
                    'id' => $prescription->doctor_id,
                    'name' => $prescription->doctor->name ?? null,
                ],
                'patient' => [
                    'id' => $prescription->user_id,
                    'name' => $prescription->user->name ?? null,
                ],
                'medicines' => $medicines,
                'diagnoses' => $diagnoses
            ];

            return $this->jsonResponse([
                'status' => 'success',
                'data' => [
                    'prescription' => $data
                ]
            ]);
        } catch (Exception $e) {
            return $this->jsonResponse([
                'status' => 'error',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
