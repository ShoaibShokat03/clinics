<?php

use App\Http\Controllers\Mobile\MobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// TenantDatabase middleware wraps routes with {project} prefix
// It runs BEFORE SubstituteBindings (via middleware priority) to switch database early
Route::prefix('{project}/api')->middleware(\App\Http\Middleware\TenantDatabase::class)->group(function () {


    Route::post('/user/login', [MobileController::class, 'Login']);
    Route::post('/user/logout', [MobileController::class, 'Logout']);


    /*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

    // Route::get('/doctor-list', [App\Http\Controllers\DoctorDetailController::class, 'getDoctorList']);
    // Route::get('/doctor-schedules', [App\Http\Controllers\PatientAppointmentController::class, 'getScheduleDoctorWise']);
    // Route::get('/book-schedules', [App\Http\Controllers\PatientAppointmentController::class, 'bookAppointment']);
    Route::get('/admin/patient/list', [MobileController::class, 'patientDetails']);
    Route::get('/patient/dashboard/{patientId}', [MobileController::class, 'patientDashboard']);
    // one patient all its appointments
    Route::get('/patient/patient-appointments/{patientId}', [MobileController::class, 'patientAppointments']); //done
    Route::get('/patient/patient-prescriptions/{patientId}', [MobileController::class, 'patientPrescriptions']); //done
    Route::get('/patient/prescriptions-list/{patientId}', [MobileController::class, 'patientPrescriptionsList']); //done
    Route::get('/patient/prescription-view/{id}', [MobileController::class, 'patientPrescriptionView']); //done
    Route::get('/patient/invoices-view/{id}', [MobileController::class, 'InvoiceView']); //done
    Route::get('/doctor/doctor-list', [MobileController::class, 'doctorList']); //done
    Route::get('/doctor/doctor-view/{id}', [MobileController::class, 'doctorView']); //done
    //one doctor all its appointments
    Route::get('/doctor/doctor-appointments/{id}', [MobileController::class, 'doctorAppointments']); //done
    //one doctor all its patients
    Route::get('/doctor/doctor-patients/{id}', [MobileController::class, 'doctorPatients']); //done
    //doctor view his invoices
    Route::get('/doctor/doctor-invoices/{patientAppointment}', [MobileController::class, 'doctorInvoices']); //done
    // owner
    Route::get('/doctor/all-doctors', [MobileController::class, 'allDocstors']); //done
    Route::get('/patient/all-patients', [MobileController::class, 'allPatients']); //done
    Route::get('/patient/all-appointments', [MobileController::class, 'allAppointments']); //done
    Route::get('/invoices/all-invoices', [MobileController::class, 'allInvoices']); //done
    // contact us
    Route::get('/contact/contact-us', [MobileController::class, 'contact']); //done
    // application settings (public)
    Route::get('/settings/application', [MobileController::class, 'applicationSettings']); //done
    //POST
    Route::post('/patient/book-appointment', [MobileController::class, 'BookAppointment']);

    Route::get('/patient/notifications', [MobileController::class, 'patientNotifications']); //done


    // Admin + Owner shared entry points
    Route::prefix('admin')->controller(MobileController::class)->group(function () {
        Route::get('/dashboard', 'adminDashboard');
        Route::get('/doctors-list', 'adminDoctorsList');
        Route::get('/doctors-show/{id}', 'adminDoctorsShow');
        Route::get('/patients-list', 'adminPatientsList');
        Route::get('/appointments-list', 'adminAppointmentsList');
        Route::get('/invoices-list', 'adminInvoicesList');
        Route::match(['get', 'post'], '/contact-management', 'adminContactManagement');
        Route::get('/notifications', 'adminNotifications');
        Route::get('/prescriptions-list', 'adminPrescriptionsList');
        Route::get('/prescription-show/{id}', 'adminPrescriptionShow');
    });

    Route::prefix('owner')->controller(MobileController::class)->group(function () {
        Route::get('/dashboard', 'adminDashboard');
        Route::get('/doctors-list', 'adminDoctorsList');
        Route::get('/doctors-show/{id}', 'adminDoctorsShow');
        Route::get('/patients-list', 'adminPatientsList');
        Route::get('/appointments-list', 'adminAppointmentsList');
        Route::get('/invoices-list', 'adminInvoicesList');
        Route::match(['get', 'post'], '/contact-management', 'adminContactManagement');
        Route::get('/notifications', 'adminNotifications');
        Route::get('/prescriptions-list', 'adminPrescriptionsList');
        Route::get('/prescription-show/{id}', 'adminPrescriptionShow');
    });
});

// Route::get('/admin/payments-list', [MobileController::class, 'adminPaymentsList']);
