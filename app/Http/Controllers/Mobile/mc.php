<?php

namespace App\Http\Controllers\Mobile;

use App\Components\FirebaseComponent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
            $doctors = DoctorDetail::with('user:id,name,email')->wherehas('user')
                ->select('user_id', 'specialist', 'designation', 'fee', 'experience', 'day_from', 'day_to', 'timing', 'availability', 'address')->get()->makehidden('user_id');
            $doctorData = [];
            foreach ($doctors as $doctor) {
                $doctorData[] = [
                    'doctor_id' => $doctor->user->id,
                    'name' => $doctor->user->name,
                    'email' => $doctor->user->email,
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
                        'availability' => $doctor->availability,
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
                'availability' => $doctorView->availability,
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
            // $request->validate([
            //     'user_id' => 'required|exists:users,id',
            //     'doctor_id' => 'required|exiss:users,id',
            //     'appointment_date' => 'required|date|after_or_equal:today',
            //     'start_time' => 'required|date_format:H:i',
            //     'problem' => 'nullable|min:5'
            // ]);

            if (
                empty($request->problem)
                || empty($request->start_time)
            ) {
                return [
                    'status' => 'error',
                    'message' => 'Fill all fileds'
                ];
            }

            $doctorDetails = DoctorDetail::where('user_id',  $request->doctor_id)->first();
            $dayfrom = $doctorDetails->day_from;
            $dayto = $doctorDetails->day_to;
            $appointmentDay = Carbon::parse($request->appointment_date)->format('l');
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
                    'Message' => "Doctor is not availabale to day "
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
                        'ammount' => $doctors->ammount,
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
                sleep(1); // Ensure the token is registered before sending notification
                // Send notification to user
                NotificationService::sendToUser(
                    $user->id,                        // kis user ko bhejna hai
                    'Login Successful',               // title
                    'You have successfully logged in', // message
                    ['user_id' => $user->id]          // extra payload (agar chahiye)
                );
            }
            $settings = Setting::pluck('value', 'key')->toArray();
            // Step 4: Response
            $data = [
                'user_id' => $user->id,
                'name' => $user->name,
                'gender' => $user->gender,
                'mrn' => $patient->mrn_number,
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'expires_in' => Carbon::now()->addMinutes(60)->toDateTimeString(),
                'app_name' => $settings['general.company_name'],
                'device_token' => $deviceTokenData->device_token ?? null,
                'device_type' => $deviceTokenData->device_type ?? null,
                'app_version' => $deviceTokenData->app_version ?? null,
                'status' => $deviceTokenData->status ?? null,
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
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'please login '
            ]);
        }
        $user = User::where('access_token', '=', $token)->first();
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please login'
            ]);
        }
        $user->access_token = null;
        $user->refresh_token = null;
        $user->access_expire = null;
        $user->save();
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
                    'availability' => $doctor->availability,
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
                'address' => $appSetting->company_address ?? '',
                'phone' => $appSetting->contact ?? '',
                'email' => $appSetting->company_email ?? '',
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
}
