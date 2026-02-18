<?php

namespace App\Http\Controllers;

use App\Models\DentalLabOrder;
use App\Models\DoctorDetail;
use App\Models\User;
use App\Models\Lab;
use App\Models\PatientDetail;
use Illuminate\Http\Request;
use App\Mail\LabReportNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
use App\Models\ApplicationSetting;
use App\Models\PageSetting;

class DentalLabOrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:lab-report-read|lab-report-create|lab-report-update|lab-report-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:lab-report-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:lab-report-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:lab-report-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $orders = $this->filter($request)->orderBy('id', 'desc')->paginate(10);
        $patients = PatientDetail::all();
        $doctors = DoctorDetail::all();
        return view('dental_lab_orders.index', compact('orders', 'patients', 'doctors'));
    }

    private function filter(Request $request)
    {
        $query = DentalLabOrder::query();

        if ($request->has('patient_id') && !empty($request->input('patient_id'))) {
            $query->where('patient_id', $request->input('patient_id'));
        }
        if ($request->has('doctor_id') && !empty($request->input('doctor_id'))) {
            $query->where('doctor_id', $request->input('doctor_id'));
        }

        return $query;
    }

    public function create()
    {
        $patients = PatientDetail::all();
        $labs = Lab::all();
        $doctors = DoctorDetail::with('user')->get();
        return view('dental_lab_orders.create', compact('patients', 'doctors', 'labs'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer',
            'lab_id' => 'required|integer',
            'sending_date' => 'required|date',
            'returning_date' => 'nullable|date',
        ], [
            'doctor_id.required' => 'The Doctor field is required.',
            'doctor_id.integer' => 'The Doctor must be a valid number.',

            'patient_id.required' => 'The Patient field is required.',
            'patient_id.integer' => 'The Patient must be a valid number.',

            'lab_id.required' => 'The Lab field is required.',
            'lab_id.integer' => 'The Lab must be a valid number.',
        ]);

        $lab = User::find($validated['lab_id']); // Assuming the lab is a user
        // or if you have a Lab model:
        // $lab = App\Models\Lab::find($validated['lab_id']);

        // Check if lab/user exists, then get the email

        // Get all data including shade fields and text fields
        $data = $request->only([
            'doctor_id',
            'patient_id',
            'lab_id',
            'sending_date',
            'returning_date',
            'time',
            // Shade text fields
            'shade_left_1_3a',
            'shade_left_2_3a',
            'shade_left_2_3b',
            'shade_main_1',
            'shade_left_1_1',
            'shade_left_1_2',
            'shade_left_1_3',
            'shade_right_1_1',
            'shade_right_1_2',
            'shade_right_1_3',
            'shade_main_2',
            'shade_left_2_1',
            'shade_left_2_2',
            'shade_left_2_3',
            'shade_right_2_1',
            'shade_right_2_2',
            'shade_right_2_3',
            'shade_right_2_4',
            // Shade checkbox fields (store color values)
            'shade_d_top_8',
            'shade_d_top_7',
            'shade_d_top_6',
            'shade_d_top_5',
            'shade_d_top_4',
            'shade_d_top_3',
            'shade_d_top_2',
            'shade_d_top_1',
            'shade_d_bottom_1',
            'shade_d_bottom_2',
            'shade_d_bottom_3',
            'shade_d_bottom_4',
            'shade_d_bottom_5',
            'shade_d_bottom_6',
            'shade_d_bottom_7',
            'shade_d_bottom_8',
            'shade_m_top_8',
            'shade_m_top_7',
            'shade_m_top_6',
            'shade_m_top_5',
            'shade_m_top_4',
            'shade_m_top_3',
            'shade_m_top_2',
            'shade_m_top_1',
            'shade_m_bottom_1',
            'shade_m_bottom_2',
            'shade_m_bottom_3',
            'shade_m_bottom_4',
            'shade_m_bottom_5',
            'shade_m_bottom_6',
            'shade_m_bottom_7',
            'shade_m_bottom_8',
            // Text fields
            'further_instructions',
            'instructions_from_lab',
            'items_furthers',
        ]);

        $checkboxFields = [
            'zirconia_mono',
            'zirconia_layered',
            'zirconia_non_pre_veneers',
            'zirconia_veneers',
            'zirconia_crown',
            'zirconia_bridges',

            // E-MAX Section
            'e_max_milled',
            'e_max_pressed',
            'e_max_non_pre_veneers',
            'e_max_veneers',
            'e_max_crown',
            'e_max_bridges',

            // PFM Section
            'pfm_porcelain',
            'pfm_non_pres',
            'pfm_implant',
            'pfm_post_and_core',
            'pfm_crown',
            'pfm_bridges',

            // PEEK Section
            'peek_removable_partial_denture',
            'peek_fixed_prosthetic_framework',
            'peek_attachment_restorations',
            'peek_supported',
            'peek_screw',
            'peek_retained',
            'peek_implant',
            'peek_superstructures',

            // Removable Prosthetics Section
            'removable_diagnostic_wax_up',
            'removable_hybrid_denture',
            'removable_tooth_addition',
            'removable_over_denture',
            'removable_relining_hard_soft',
            'removable_veneers',
            'removable_flexible',
            'removable_crown',
            'removable_bridges',
            'removable_screw',
            'removable_implant',
            'removable_retained',

            // Items Sending Section
            'items_imp',
            'items_partial',
            'items_bite',
            'items_photo',
            'items_study_models',
            'items_shade_tab',
            'items_digital_impression',
            'items_further',

            // Removable Appliance Section
            'appliance_ortho',
            'appliance_retainer',
            'appliance_night_guard',
            'appliance_occlusal_splint',
            'appliance_sheet_press_retainer',
            'appliance_wire',
            'appliance_hyrax',
            'appliance_tpa',
            'appliance_obturator',
            'appliance_space_maintainer',
        ];

        foreach ($checkboxFields as $field) {
            $data[$field] = $request->has($field) ? 1 : 0;
        }

        DentalLabOrder::create($data);
        // $id = auth()->id();
        // $url = 'doctor-details.show';
        // $msg = "New Doctor Has been registered";
        // sendNotification($id, $url, $msg);


        // if ($_SERVER['SERVER_NAME'] !== 'localhost') {
        //     $applicationSetting = \App\Models\ApplicationSetting::first();
        //     $companyEmail = $applicationSetting->company_email;



        //     Mail::to($lab->email)->send(new LabReportNotification('doctor', $lab->doctor_name));
        //     Mail::to($companyEmail)->send(new LabReportNotification('admin', null));

        // }

        return redirect()->route('dental_lab_orders.index')->with('success', 'Dental Lab Order created successfully.');
    }




    public function show(DentalLabOrder $dentalLabOrder)
    {
        // $id = $dentalLabOrder->lab_id;

        // $user = User::find($id);
        $user = User::find($dentalLabOrder->lab_id);

        if (isset($user->lab->lab_name)) {
            $laboratorist_name = $user->lab->lab_name;
        } else {
            $laboratorist_name = '';
        }

        $applicationSettings = ApplicationSetting::all()->toArray();
        $pageSetting = PageSetting::where('page_name', 'dental_lab_order_show')->first();
        $pageSettings = $pageSetting ? $pageSetting->settings : [];

        return view('dental_lab_orders.show', compact('dentalLabOrder', 'laboratorist_name', 'applicationSettings', 'pageSettings'));
    }

    public function edit(DentalLabOrder $dentalLabOrder)
    {
        $patients = PatientDetail::all();
        $labs = Lab::all();
        $doctors = DoctorDetail::with('user')->get();
        return view('dental_lab_orders.edit', compact('dentalLabOrder', 'patients', 'doctors', 'labs'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $validated = $request->validate([
            'doctor_id' => 'integer',
            'patient_id' => 'integer',
            'lab_id' => 'integer',
            'sending_date' => 'date',
            'returning_date' => 'nullable|date',
        ]);

        $lab = User::find($validated['lab_id']); // Assuming the lab is a user

        // Retrieve the existing DentalLabOrder by ID
        $dentalLabOrder = DentalLabOrder::findOrFail($id);

        $data = $request->all();

        $checkboxFields = [
            'zirconia_mono',
            'zirconia_layered',
            'zirconia_non_pre_veneers',
            'zirconia_veneers',
            'zirconia_crown',
            'zirconia_bridges',


            // E-MAX Section
            'e_max_milled',
            'e_max_pressed',
            'e_max_non_pre_veneers',
            'e_max_veneers',
            'e_max_crown',
            'e_max_bridges',

            // PFM Section
            'pfm_porcelain',
            'pfm_non_pres',
            'pfm_implant',
            'pfm_post_and_core',
            'pfm_crown',
            'pfm_bridges',

            // PEEK Section
            'peek_removable_partial_denture',
            'peek_fixed_prosthetic_framework',
            'peek_attachment_restorations',
            'peek_supported',
            'peek_screw',
            'peek_retained',
            'peek_implant',
            'peek_superstructures',

            // Removable Prosthetics Section
            'removable_diagnostic_wax_up',
            'removable_hybrid_denture',
            'removable_tooth_addition',
            'removable_over_denture',
            'removable_relining_hard_soft',
            'removable_veneers',
            'removable_flexible',
            'removable_crown',
            'removable_bridges',
            'removable_screw',
            'removable_implant',
            'removable_retained',

            // Items Sending Section
            'items_imp',
            'items_partial',
            'items_bite',
            'items_photo',
            'items_study_models',
            'items_shade_tab',
            'items_digital_impression',
            'items_further',

            // Removable Appliance Section
            'appliance_ortho',
            'appliance_retainer',
            'appliance_night_guard',
            'appliance_occlusal_splint',
            'appliance_sheet_press_retainer',
            'appliance_wire',
            'appliance_hyrax',
            'appliance_tpa',
            'appliance_obturator',
            'appliance_space_maintainer',

        ];

        foreach ($checkboxFields as $field) {
            $data[$field] = $request->has($field) ? 1 : 0;
        }

        // Shade Checkbox Fields (Values are Strings like 'DarkCyan' or '0')
        // We must handle these explicitly because unchecking them removes them from the request entirely.
        $shadeCheckboxFields = [
            'shade_d_top_8', 'shade_d_top_7', 'shade_d_top_6', 'shade_d_top_5', 'shade_d_top_4', 'shade_d_top_3', 'shade_d_top_2', 'shade_d_top_1',
            'shade_d_bottom_1', 'shade_d_bottom_2', 'shade_d_bottom_3', 'shade_d_bottom_4', 'shade_d_bottom_5', 'shade_d_bottom_6', 'shade_d_bottom_7', 'shade_d_bottom_8',
            'shade_m_top_8', 'shade_m_top_7', 'shade_m_top_6', 'shade_m_top_5', 'shade_m_top_4', 'shade_m_top_3', 'shade_m_top_2', 'shade_m_top_1',
            'shade_m_bottom_1', 'shade_m_bottom_2', 'shade_m_bottom_3', 'shade_m_bottom_4', 'shade_m_bottom_5', 'shade_m_bottom_6', 'shade_m_bottom_7', 'shade_m_bottom_8',
        ];

        foreach ($shadeCheckboxFields as $field) {
            // Use input() to get value or null if missing. 
            $data[$field] = $request->input($field, null);
        }

        // Update the DentalLabOrder with the new data

        $dentalLabOrder->update($data);
        // if ($_SERVER['SERVER_NAME'] !== 'localhost') {
        //     $applicationSetting = \App\Models\ApplicationSetting::first();
        //     $companyEmail = $applicationSetting->company_email;

        //     Mail::to($lab->email)->send(new LabReportNotification('doctor', $lab->doctor_name));
        //     Mail::to($companyEmail)->send(new LabReportNotification('admin', null));


        // }


        return redirect()->route('dental_lab_orders.index')->with('success', 'Dental Lab Order updated successfully.');
    }


    public function destroy(DentalLabOrder $dentalLabOrder)
    {
        $dentalLabOrder->delete();
        return redirect()->route('dental_lab_orders.index');
    }
}
