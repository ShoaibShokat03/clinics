<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Company;
use App\Models\ExtraOral;
use App\Models\IntraOral;
use App\Models\HardTissue;
use App\Models\ToothIssue;
use App\Models\SoftTissues;
use App\Models\PatientTeeth;
use Illuminate\Http\Request;
use App\Exports\GenericExport;
use App\Models\ExamInvestigation;
use App\Models\PatientAppointment;
use App\Models\PatientTreatmentPlan;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PatientMedicalHistory;
use App\Models\PatientDentalHistory;
use App\Models\PatientDrugHistory;
use App\Models\PatientSocialHistory;
use Illuminate\Support\Facades\Storage;
use App\Models\HistoryOfChiefComplaints;
use App\Models\ExtraOralExamInvestigation;
use App\Models\IntraOralExamInvestigation;
use App\Models\SoftTissuesExamInvestigation;
use App\Models\DdDiagnosis;
use App\Models\DdFinding;
use App\Models\PatientDetail;
use App\Models\DoctorDetail;
use App\Models\PageSetting;
use App\Models\ApplicationSetting;
use App\Models\Setting;


class ExamInvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:exam-investigations-read|exam-investigations-create|exam-investigations-update|exam-investigations-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:exam-investigations-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:exam-investigations-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:exam-investigations-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->export) {
            return $this->doExport($request);
        }

        // Apply filters and get paginated results, eager loading relationships to prevent N+1 queries
        $examInvestigations = $this->filter($request)
            ->with(['patient.patientDetails', 'doctor'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Get all doctors and patients based on their relationships, sorted by name in DB
        $doctors = User::role('Doctor')
            ->whereHas('doctorexamInvestigation')
            ->orderBy('name', 'asc')
            ->get();

        $patients = User::role('Patient')
            ->whereHas('patientexamInvestigation')
            ->orderBy('name', 'asc')
            ->get();

        // Optimize PatientDetail loading: Join users to sort by name and eager load user
        $patientsinfo = PatientDetail::select('patient_details.*')
            ->join('users', 'patient_details.user_id', '=', 'users.id')
            ->with('user')
            ->orderBy('users.name', 'asc')
            ->get();
        // Pass data to the view
        return view('exam-investigation.index', compact('examInvestigations', 'patients', 'doctors', 'patientsinfo'));
    }


    private function filter(Request $request)
    {
        $query = ExamInvestigation::query();

        if ($request->has('examination_number') && !empty($request->input('examination_number'))) {
            $query->where('examination_number', 'like', $request->input('examination_number') . '%');
        }
        if ($request->has('mrn_number') && !empty($request->input('mrn_number'))) {
            $query->whereHas('patient.patientDetails', function ($q) use ($request) {
                $q->where('mrn_number', 'like', $request->input('mrn_number') . '%');
            });
        }
        if ($request->has('patient_id') && !empty($request->input('patient_id'))) {
            $query->where('patient_id', $request->input('patient_id'));
            // dd($request->input('patient_id'));
            // exit;
        }
        if ($request->has('doctor_id') && !empty($request->input('doctor_id'))) {
            $query->where('doctor_id', $request->input('doctor_id'));
        }

        return $query;
    }

    public function doExport(Request $request)
    {
        $examInvestigationsQuery = $this->filter($request);
        $examInvestigations = $examInvestigationsQuery->with(['patient', 'doctor'])->get();

        $data = $examInvestigations->map(function ($investigation) {
            return [
                'ID' => $investigation->id,
                'Examination Number' => $investigation->examination_number,
                'Patient Name' => $investigation->patient->name ?? 'N/A',
                'Doctor Name' => $investigation->doctor->name ?? 'N/A',
                'Comments' => $investigation->comments,
                'Patient Appointment ID' => $investigation->patient_appointment_id,
                'Created At' => $investigation->created_at,
                'Updated At' => $investigation->updated_at,
            ];
        })->toArray();

        $headers = [
            'ID',
            'Examination Number',
            'Patient Name',
            'Doctor Name',
            'Comments',
            'Patient Appointment ID',
            'Created At',
            'Updated At'
        ];

        return Excel::download(new GenericExport($data, $headers), 'ExamInvestigations.xlsx');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $selectedPatientId = $request->patient_id;
        $patients = User::role('Patient')
            // ->whereHas('patientAppointments')
            ->orderBy('id', 'desc')
            ->get();
        $ddDiagnosises = DdDiagnosis::get(['id', 'name']);
        $ddFindings = DdFinding::where('status', '1')->get(['id', 'name']);
        return view('exam-investigation.edit', compact('patients', 'ddDiagnosises', 'ddFindings', 'selectedPatientId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $data = $request->only(['examination_number', 'patient_id', 'patient_appointment_id', 'doctor_id', 'comments']);
        $examInvestigation = ExamInvestigation::create($data);
        $examInvestigation['examination_number'] = "EX" . "-" . date('y') . "-" . date('m') . "-" . $examInvestigation->id;
        $examInvestigation['created_by'] = auth()->id();
        $examInvestigation->save();
        return redirect()->route('exam-investigations.edit', $examInvestigation->refresh()->id)->with('success', 'New Examination Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamInvestigation  $examInvestigation
     * @return \Illuminate\Http\Response
     */
    public function show(ExamInvestigation $examInvestigation)
    {
        $teeth = PatientTeeth::with('toothIssues')->where('examination_id', $examInvestigation->id)->get();

        // Try to get company from session, fallback to company_id 1
        $companyId = session('company_id') ?? 1;
        $company = Company::find($companyId);

        if (!$company) {
            return redirect()->route('exam-investigations.index')->with('error', trans('Company not found'));
        }

        $company->setSettings();
        $files = File::where('record_id', $examInvestigation->id)->get();

        $settings = Setting::pluck('value', 'key')->toArray();
        $applicationSettings = ApplicationSetting::all()->toArray();
        $pageSetting = PageSetting::where('page_name', 'exam_investigation_show')->first();
        $pageSettings = $pageSetting ? $pageSetting->settings : [];

        // Group teeth by issues
        $groupedTeeth = $teeth->groupBy(function ($tooth) {
            return $tooth->toothIssues->pluck('tooth_issue')->sort()->join(',');
        });

        return view('exam-investigation.show', compact('examInvestigation', 'company', 'groupedTeeth', 'files', 'settings', 'applicationSettings', 'pageSettings'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamInvestigation  $examInvestigation
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamInvestigation $examInvestigation)
    {
        if (auth()->user()->hasRole('Doctor')) {
            if ($examInvestigation->doctor_id != auth()->id()) {
                return redirect()->route('exam-investigations.index')->with('error', trans('You Cannot Modify Other Doctors Exam Investigations'));
            }
        }
        $patientAppointments  = PatientAppointment::get();
        $doctors = User::role('Doctor')->get();
        $patients = User::role('Patient')->get();
        $existingPlans = PatientTreatmentPlan::where('examination_id', $examInvestigation->id)->get();
        $toothIssuesCount = ToothIssue::join('patient_teeths', 'tooth_issues.p_teeth_id', '=', 'patient_teeths.id')
            ->where('patient_teeths.examination_id', $examInvestigation->id)
            ->count();
        $filesCount = File::where('table_name', 'exam_investigations')->where('child_table_name', 'teeth_files')->where('record_id', $examInvestigation->id)->count();
        $counter = ($toothIssuesCount > 0 || $filesCount > 0) ? 1 : 0;

        $chiefcomplaints = HistoryOfChiefComplaints::all();
        $extraOrals = ExtraOral::all();
        $intraOrals = IntraOral::all();
        $softTissues = SoftTissues::all();
        $hardTissues = HardTissue::all();


        // Fetch the selected intra_oral, extra_oral, soft_tissues records and corresponding comments
        $selectedIntraOrals = $examInvestigation->intraOralInvestigations;
        $selectedExtraOrals = $examInvestigation->extraOralInvestigations;
        $selectedSoftTissues = $examInvestigation->softTissuesInvestigations;

        $ddDiagnosises = DdDiagnosis::get(['id', 'name']);
        $ddFindings = DdFinding::where('status', '1')->get(['id', 'name']);

        $patient_record = ExamInvestigation::with('user')->find($examInvestigation->id);

        // $examInvestigation = ExamInvestigation::with('patientMedicalHistory')->find(34);

        $medicalRecords = PatientMedicalHistory::where('patient_id', $examInvestigation->patient_id)->get();

        $drugRecords = PatientDrugHistory::where('patient_id', $examInvestigation->patient_id)->get();

        $socialRecords = PatientSocialHistory::where('patient_id', $examInvestigation->patient_id)->get();

        $dentalRecords = PatientDentalHistory::where('patient_id', $examInvestigation->patient_id)->get();

        $patientTeeths = PatientTeeth::with('toothIssues')->where('examination_id', $examInvestigation->id)->get();

        return view('exam-investigation.edit', compact('examInvestigation', 'patients', 'doctors', 'patientAppointments', 'existingPlans', 'counter', 'chiefcomplaints', 'extraOrals', 'intraOrals', 'softTissues', 'hardTissues', 'patient_record', 'dentalRecords', 'socialRecords', 'drugRecords', 'medicalRecords', 'selectedIntraOrals', 'selectedExtraOrals', 'selectedSoftTissues', 'ddDiagnosises', 'ddFindings', 'patientTeeths'));
    }


    public function storechief(Request $request)
    {

        $examInvestigation = ExamInvestigation::where('id', $request->exam_investigation_id)->first();
        $examInvestigation->chief_complaints = $request->chief_complaints;
        $examInvestigation->save();
        return response()->json(['message' => 'Record saved successfully!']);
    }


    public function storeintraoraldata(Request $request)
    {
        // Find the related ExamInvestigation
        $examInvestigation = ExamInvestigation::where('id', $request->exam_investigation_id)->first();

        if (!$examInvestigation) {
            return response()->json(['message' => 'Invalid Exam Investigation ID'], 400);
        }

        IntraOralExamInvestigation::where('exam_investigation_id', $examInvestigation->id)->delete();
        // Loop through extra_oral and extra_oral_comments arrays
        foreach ($request->input('intra_oral') as $key => $singleRecordId) {
            $intraOralExamInvestigation = new IntraOralExamInvestigation(); // New instance for each record
            $intraOralExamInvestigation->intra_oral_id = $singleRecordId;
            $intraOralExamInvestigation->exam_investigation_id = $examInvestigation->id;
            $intraOralExamInvestigation->created_by =  auth()->user()->id;
            // Access corresponding comment for each extra_oral
            $intraOralExamInvestigation->comments = $request->input('intra_oral_comments')[$key];
            $intraOralExamInvestigation->save();
        }

        return response()->json(['message' => 'Record saved successfully!']);
    }



    public function storesofttissuedata(Request $request)
    {
        // Find the related ExamInvestigation
        $examInvestigation = ExamInvestigation::where('id', $request->exam_investigation_id)->first();

        if (!$examInvestigation) {
            return response()->json(['message' => 'Invalid Exam Investigation ID'], 400);
        }

        SoftTissuesExamInvestigation::where('exam_investigation_id', $examInvestigation->id)->delete();
        // Loop through extra_oral and extra_oral_comments arrays
        foreach ($request->input('soft_tissues') as $key => $singleRecordId) {
            $softTissuesExamInvestigation = new SoftTissuesExamInvestigation(); // New instance for each record
            $softTissuesExamInvestigation->soft_tissue_id = $singleRecordId;
            $softTissuesExamInvestigation->exam_investigation_id = $examInvestigation->id;
            $softTissuesExamInvestigation->created_by =  auth()->user()->id;
            // Access corresponding comment for each extra_oral
            $softTissuesExamInvestigation->comments = $request->input('soft_tissues_comments')[$key];
            $softTissuesExamInvestigation->save();
        }

        return response()->json(['message' => 'Record saved successfully!']);
    }

    public function storeextraoraldata(Request $request)
    {
        // Find the related ExamInvestigation
        $examInvestigation = ExamInvestigation::where('id', $request->exam_investigation_id)->first();

        if (!$examInvestigation) {
            return response()->json(['message' => 'Invalid Exam Investigation ID'], 400);
        }

        ExtraOralExamInvestigation::where('exam_investigation_id', $examInvestigation->id)->delete();
        // Loop through extra_oral and extra_oral_comments arrays
        foreach ($request->input('extra_oral') as $key => $singleRecordId) {
            $extraOralExamInvestigation = new ExtraOralExamInvestigation(); // New instance for each record
            $extraOralExamInvestigation->extra_oral_id = $singleRecordId;
            $extraOralExamInvestigation->exam_investigation_id = $examInvestigation->id;
            $extraOralExamInvestigation->created_by =  auth()->user()->id;
            // Access corresponding comment for each extra_oral
            $extraOralExamInvestigation->comments = $request->input('extra_oral_comments')[$key];
            $extraOralExamInvestigation->save();
        }

        return response()->json(['message' => 'Record saved successfully!']);
    }

    public function extraOral(Request $request)
    {
        //$examInvestigation = ExamInvestigation::where('id',$request->exam_investigation_id)->first();
        //$examInvestigation->extra_oral = $request->extra_oral;
        //$examInvestigation->save();



        return response()->json(['message' => 'Record saved successfully!']);
    }

    public function intraOral(Request $request)
    {
        $examInvestigation = ExamInvestigation::where('id', $request->exam_investigation_id)->first();
        $examInvestigation->intra_oral_id = $request->intra_oral_id;
        $examInvestigation->save();
        return response()->json(['message' => 'Record saved successfully!']);
    }

    public function softTissue(Request $request)
    {
        $examInvestigation = ExamInvestigation::where('id', $request->exam_investigation_id)->first();
        $examInvestigation->soft_tissue_id = $request->soft_tissue_id;
        $examInvestigation->save();
        return response()->json(['message' => 'Record saved successfully!']);
    }

    public function hardTissue(Request $request)
    {
        $examInvestigation = ExamInvestigation::where('id', $request->exam_investigation_id)->first();
        $examInvestigation->hard_tissue_id = $request->hard_tissue_id;
        $examInvestigation->save();
        return response()->json(['message' => 'Record saved successfully!']);
    }



    public function getToothIssues($examinationId, $patientId, $toothNumber)
    {
        $patientTeeth = PatientTeeth::where('examination_id', $examinationId)->where('patient_id', $patientId)
            ->where('tooth_number', $toothNumber)
            ->first();

        if ($patientTeeth) {
            $toothIssues = $patientTeeth->toothIssues()->get();
            return response()->json($toothIssues);
        } else {
            return response()->json([]);
        }
    }
    public function getTeethIssues($examination_id)
    {
        $teethIssues = PatientTeeth::where('examination_id', $examination_id)->pluck('tooth_number');
        return response()->json($teethIssues);
    }

    public function getTeethFiles(Request $request)
    {
        $examinationId = $request->query('examination_id');
        $toothNumber = $request->query('tooth_number');
        $response = [
            'files' => []
        ];

        // Get all teeth files for the record, procedure, and tooth number from the database
        $files = File::where('record_id', $examinationId)
            ->where('child_record_id', $toothNumber)
            ->where('record_type', 'teeth_files')
            ->get();

        // Get all unique user IDs from the files
        $userIds = $files->pluck('created_by')->unique();

        // Fetch all users that are referenced in the files
        $users = User::whereIn('id', $userIds)->get()->keyBy('id');

        // Prepare the response data
        foreach ($files as $file) {
            $fileData = [
                'file_name' => $file->file_name,
                'uploaded_by' => isset($users[$file->created_by]) ? $users[$file->created_by]->name : 'Unknown',
                'uploaded_at' => $file->created_at->format('Y-m-d H:i:s')
            ];

            $response['files'][] = $fileData;
        }

        return response()->json($response);
    }

    public function fetchAppointments(Request $request)
    {
        if (auth()->user()->hasRole('Doctor')) {
            $patientId = $request->input('patient_id');
            $appointments = PatientAppointment::where('doctor_id', auth()->id())->where('user_id', $patientId)->orderBy('created_at', 'desc')->get(['id', 'appointment_number']);
            return response()->json(['appointments' => $appointments]);
        }
        $patientId = $request->input('patient_id');
        $appointments = PatientAppointment::where('user_id', $patientId)->orderBy('created_at', 'desc')->get(['id', 'appointment_number']);
        return response()->json(['appointments' => $appointments]);
    }

    public function fetchDoctors(Request $request)
    {
        $patient_appointment_id = $request->input('patient_appointment_id');

        // Check if an appointment ID exists and find the associated doctor_id
        $doctor_id = $patient_appointment_id
            ? PatientAppointment::where('id', $patient_appointment_id)->value('doctor_id')
            : null;

        if ($doctor_id) {
            // Fetch only the specific doctor
            $doctors = User::where('id', $doctor_id)->get(['id', 'name']);
        } else {
            // Fetch all users who are doctors
            // Note: You might want to add a role check here, e.g., ->where('role', 'doctor')
            $doctors = DoctorDetail::whereHas('user') // Ensures the doctor MUST have a user record
                ->with(['user' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->get(['id', 'user_id'])
                ->map(function ($doctor) {
                    return [
                        'id'   => $doctor->user->id,
                        'name' => $doctor->user->name,
                    ];
                });
        }

        return response()->json(['doctors' => $doctors]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamInvestigation  $examInvestigation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamInvestigation $examInvestigation)
    {
        $this->validation($request);
        $data = $request->only(['pr_number', 'patient_id', 'doctor_id', 'comments']);
        $data['updated_by'] = auth()->id();

        $examInvestigation->update($data);
        return redirect()->route('exam-investigations.index')->with('success', 'Exam Investogation Updated.');
    }


    public function updateJawType(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:exam_investigations,id',
            'jaw_type' => 'required|string',
        ]);

        $examInvestigation = ExamInvestigation::findOrFail($request->id);
        $examInvestigation->jaw_type = $request->jaw_type;
        $examInvestigation->save();

        return response()->json(['message' => 'Jaw type updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamInvestigation  $examInvestigation
     * @return \Illuminate\Http\Response
     */

    public function destroy(ExamInvestigation $examInvestigation)
    {
        if (auth()->user()->hasRole('Doctor')) {
            if ($examInvestigation->doctor_id != auth()->id()) {
                return redirect()->route('exam-investigations.index')->with('error', trans('You Cannot Delete Other Doctors Exam Investigations'));
            }
        }

        if ($examInvestigation->patienttreatmentplan()->exists())
            return redirect()->route('exam-investigations.index')->with('error', trans('Exam Ivestigation Cannot be deleted Because Treatment  Plan Already Exists'));

        $examInvestigation->delete();
        return redirect()->route('exam-investigations.index')->with('success', 'Exam Investogation Deleted.');
    }




    public function deleteFiles(Request $request)
    {
        $fileName = $request->input('fileName');
        $fileType = $request->input('fileType');
        $recordId = $request->input('recordId');
        $tableName = $request->input('table_name');
        $teethNumber = $request->input('teethNumber');

        try {
            // First, try to find by exact unique filename. 
            // Since filenames contain a uniqid(), they are globally unique.
            $fileRecord = File::where('file_name', $fileName)->first();

            // If not found by exact path, try with the strict constraints (legacy/fallback)
            if (!$fileRecord) {
                // Extract the filename (basename) relative match if full path failed
                $baseFileName = basename($fileName);
                $query = File::where('file_name', 'like', '%' . $baseFileName)
                    ->where('record_type', $fileType)
                    ->where('table_name', $tableName);

                if ($recordId && $fileType !== 'teeth_files') {
                    // Only apply recordId check if NOT teeth_files, to avoid the PatientID vs ExamID mismatch
                    $query->where('record_id', $recordId);
                }

                if ($teethNumber) {
                    $query->where('child_record_id', $teethNumber);
                }

                $fileRecord = $query->first(); // Execute query
            }


            if ($fileRecord) {
                // Try to delete from storage directly if it is a relative path
                if (Storage::exists($fileRecord->file_name)) {
                    Storage::delete($fileRecord->file_name);
                }
                // Fallback to checking full path on disk (legacy behavior from deleteFile)
                else {
                    $fullPath = base_path($fileRecord->file_name);
                    // Also check public_path just in case
                    $publicPath = public_path($fileRecord->file_name);

                    if (file_exists($fullPath)) {
                        unlink($fullPath);
                    } elseif (file_exists($publicPath)) {
                        unlink($publicPath);
                    }
                }

                $fileRecord->delete();

                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'error' => 'File not found in database.', 'debug_info' => $request->all()]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'patient_id' => ['required', 'integer'],
            'doctor_id' => ['required', 'integer'],
            'comments' => ['nullable', 'string', 'max:100']
        ]);
    }


    public function uploadFile(Request $request)
    {
        $tableName = $request->table_name;
        $recordId = $request->record_id;
        $inputFields = $request->input('input_fields', []);
        $response = ['success' => true, 'files' => [], 'errors' => []];

        foreach ($inputFields as $inputField) {
            if ($request->hasFile($inputField)) {
                foreach ($request->file($inputField) as $file) {
                    $uniqueId = uniqid();
                    $fileName = $inputField . '_' . $uniqueId . '.' . $file->getClientOriginalExtension();

                    if ($inputField == 'teeth_files') {
                        $relativePath = "{$tableName}/{$recordId}/{$request->Childtable}/{$request->examinationId}/{$request->toothNumber}";
                        $filePath = $file->storeAs($relativePath, $fileName, 'public');
                        $fullPath = getFullUploadPath($relativePath . '/' . $fileName);
                        $fileTableName = $request->Childtable;
                        $fileRecordId = $request->examinationId;
                        $child_table = 'teeth_files';
                        $tooth = $request->toothNumber;
                    } else {
                        $relativePath = "{$tableName}/{$recordId}/{$inputField}";
                        $filePath = $file->storeAs($relativePath, $fileName, 'public');
                        $fullPath = getFullUploadPath($relativePath . '/' . $fileName);
                        $fileTableName = $tableName;
                        $fileRecordId = $recordId;
                        $child_table = null;
                        $tooth = null;
                    }

                    if ($filePath) {
                        // Check if input field is 'profile_picture' and delete existing profile picture
                        if ($inputField === 'profile_picture') {
                            $existingProfilePicture = File::where('record_id', $recordId)
                                ->where('record_type', 'profile_picture')
                                ->first();

                            if ($existingProfilePicture) {
                                // Delete existing profile picture from storage
                                Storage::delete("{$tableName}/{$recordId}/profile_picture/{$existingProfilePicture->file_name}");
                                // Delete existing profile picture record from the database
                                $existingProfilePicture->delete();
                            }
                        }

                        $fileRecord = new File();
                        $fileRecord->table_name = $fileTableName;
                        $fileRecord->child_table_name = $child_table;
                        $fileRecord->record_id = $fileRecordId;
                        $fileRecord->child_record_id = $tooth;
                        $fileRecord->record_type = $inputField;
                        $fileRecord->file_name = $fullPath;
                        $fileRecord->created_by = auth()->user()->id;
                        $fileRecord->save();

                        $response['files'][] = [
                            'file_name' => $fileName,
                            'file_path' => $filePath,
                            'record_type' => $inputField,
                            'created_at' => now(),
                            'created_by' => auth()->user()->name
                        ];
                    } else {
                        $response['errors'][] = "Failed to store file: " . $file->getClientOriginalName();
                    }
                }
            }
        }

        if (!empty($response['errors'])) {
            $response['success'] = false;
        }

        return response()->json($response);
    }


    public function getFiles(Request $request, $id)
    {
        $tableName = $request->query('table_name'); // Expecting 'module' to be provided in the request
        $response = [
            'files' => []
        ];

        // Get all files for the record from the database
        $files = File::where('record_id', $id)->where('table_name', $tableName)->get();

        // Get all unique user IDs from the files
        $userIds = $files->pluck('created_by')->unique();

        // Fetch all users that are referenced in the files
        $users = User::whereIn('id', $userIds)->get()->keyBy('id');

        // Group files by type
        foreach ($files as $file) {
            $fileData = [
                'file_name' => $file->file_name,
                'uploaded_by' => isset($users[$file->created_by]) ? $users[$file->created_by]->name : 'Unknown',
                'uploaded_at' => $file->created_at->format('Y-m-d H:i:s')
            ];

            if (!isset($response['files'][$file->record_type])) {
                $response['files'][$file->record_type] = [];
            }

            $response['files'][$file->record_type][] = $fileData;
        }

        return response()->json($response);
    }

    public function deleteFile(Request $request)
    {
        $fileName = $request->input('fileName');
        $fileType = $request->input('fileType');
        $recordId = $request->input('recordId');
        $tableName = $request->input('table_name');

        try {
            $fileRecord = File::where('file_name', $fileName)
                ->where('record_id', $recordId)
                ->where('record_type', $fileType)
                ->where('table_name', $tableName)
                ->first();

            if ($fileRecord) {
                $fullPath = base_path($fileRecord->file_name);

                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }

                $fileRecord->delete();

                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'error' => 'File not found in database.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // Add this new method to your ExamInvestigationController
    // (or wherever your patient-teeths.store route points to — assuming it's here or in a separate controller)

    public function storePatientTeethIssues(Request $request)
    {
        $data = $request->json()->all();

        // Validate basic structure
        if (!isset($data['examination_id']) || !isset($data['teeth']) || !isset($data['issues'])) {
            return response()->json(['success' => false, 'message' => 'Invalid data structure'], 400);
        }

        $examinationId = $data['examination_id'];
        $teethNumbers  = $data['teeth'];        // Array of tooth numbers (e.g., ['11', '12', ...])
        $issues        = $data['issues'];       // Array of issues to apply to each tooth

        // Optional: fetch patient_id from examination (for consistency)
        $exam = ExamInvestigation::find($examinationId);
        if (!$exam) {
            return response()->json(['success' => false, 'message' => 'Examination not found'], 404);
        }
        $patientId = $exam->patient_id;

        // Optional: prevent duplicates — delete existing records for these teeth first
        // (Uncomment if you want to replace instead of duplicate)
        /*
    PatientTeeth::where('examination_id', $examinationId)
        ->whereIn('tooth_number', $teethNumbers)
        ->delete();
    */

        foreach ($teethNumbers as $toothNumber) {
            // Create or get the PatientTeeth record
            $patientTeeth = PatientTeeth::firstOrCreate(
                [
                    'examination_id' => $examinationId,
                    'patient_id'     => $patientId,
                    'tooth_number'   => $toothNumber,
                ]
            );

            // Apply every issue to this tooth
            foreach ($issues as $issue) {
                ToothIssue::create([
                    'p_teeth_id'    => $patientTeeth->id,
                    'tooth_issue'   => $issue['tooth_issue'] ?? null,
                    'description'   => $issue['description'] ?? null,
                    'diagnosis_id'  => $issue['diagnosis_id'] ?? null,
                    'created_by'    => auth()->id(),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Findings applied to ' . count($teethNumbers) . ' teeth successfully!'
        ]);
    }
}
