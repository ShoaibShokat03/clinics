<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLogs;
use App\Models\PatientCaseStudy;
use App\Models\PatientDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientCaseStudyController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:patient-case-studies-read|patient-case-studies-create|patient-case-studies-update|patient-case-studies-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:patient-case-studies-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patient-case-studies-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patient-case-studies-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patientCaseStudies = $this->filter($request)->orderBy('id', 'desc')->paginate(10);
        $patients = PatientDetail::all();
        return view('patient-case-study.index', compact('patientCaseStudies', 'patients'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        $query = PatientCaseStudy::whereHas('user', function ($q) use ($request) {
            $q->where('company_id', session('company_id'));


            if (auth()->user()->hasRole('Patient'))
                $q->where('id', auth()->id());

            if ($request->user_id) {
                $q->where('user_id', $request->user_id);
            }

            if ($request->phone)
                $q->where('phone', 'like', $request->phone . '%');

            if ($request->email)
                $q->where('email', 'like', $request->email . '%');
        });

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = PatientDetail::all();
        return view('patient-case-study.create', compact('patients'));
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

        $patient = PatientCaseStudy::where('user_id', '=', $request->user_id)->first();
        if ($patient === null) {
            $patientCaseStudyData = $request->only(['user_id', 'food_allergy', 'heart_disease', 'high_blood_pressure', 'diabetic', 'surgery', 'accident', 'others', 'family_medical_history', 'current_medication', 'pregnancy', 'breastfeeding', 'health_insurance']);
            $onlyUserIdProvided = collect($patientCaseStudyData)
                ->except('user_id')
                ->filter(function ($value) {
                    return !empty($value);
                })
                ->isEmpty();

            if ($onlyUserIdProvided) {
                return redirect('patient-case-studies/create')->with('error', 'Add at least one case study for the patient ')->withInput();
            } else {
                dd("✅ Valid data to save:", $patientCaseStudyData);
            }
            $logoUrl = "";
            if ($request->file) {
                $logo = $request->file;
                $logoNewName = time() . $logo->getClientOriginalName();
                $uploadPath = getUploadPublicPath('patient-case-studies');
                $logo->move($uploadPath, $logoNewName);
                $logoUrl = getFullUploadPath('patient-case-studies/' . $logoNewName);
                $patientCaseStudyData['file'] = $logoUrl;
            }

            DB::transaction(function () use ($patientCaseStudyData, &$patientCaseStudy) {
                $patientCaseStudy = PatientCaseStudy::create($patientCaseStudyData);
            });

            return redirect()->route('patient-case-studies.edit', $patientCaseStudy->id)->with('success', trans('Patient Case Study Added Successfully'));
        } else {
            return redirect()->route('patient-case-studies.create')->with('warning', trans('For This Patient Case Study Added Before'))->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientCaseStudy  $patientCaseStudy
     * @return \Illuminate\Http\Response
     */
    public function show(PatientCaseStudy $patientCaseStudy)
    {
        if (auth()->user()->hasRole('Patient') && auth()->id() != $patientCaseStudy->user_id)
            return redirect()->route('dashboard');

        return view('patient-case-study.show', compact('patientCaseStudy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatientCaseStudy  $patientCaseStudy
     * @return \Illuminate\Http\Response
     */
    public function edit(PatientCaseStudy $patientCaseStudy)
    {
        $patients = PatientDetail::all();
        return view('patient-case-study.edit', compact('patientCaseStudy', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientCaseStudy  $patientCaseStudy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatientCaseStudy $patientCaseStudy)
    {
        $this->validation($request, $patientCaseStudy->id);
        $patient = PatientCaseStudy::where('user_id', '=', $request->user_id)->first();
        if ($patientCaseStudy->user_id == $request->user_id) {
            $patient = null;
        }
        if ($patient === null) {
            $data = $request->only(['user_id', 'food_allergy', 'heart_disease', 'high_blood_pressure', 'diabetic', 'surgery', 'accident', 'others', 'family_medical_history', 'current_medication', 'pregnancy', 'breastfeeding', 'health_insurance']);

            $logoUrl = "";
            if ($request->file) {
                $logo = $request->file;
                $logoNewName = time() . $logo->getClientOriginalName();
                $uploadPath = getUploadPublicPath('patient-case-studies');
                $logo->move($uploadPath, $logoNewName);
                $logoUrl = getFullUploadPath('patient-case-studies/' . $logoNewName);
                $data['file'] = $logoUrl;
            }

            DB::transaction(function () use ($patientCaseStudy, $data) {
                $patientCaseStudy->update($data);
            });
            return redirect()->route('patient-case-studies.index')->with('success', trans('Patient Case Study Update Successfully'));
        } else {
            return redirect()->route('patient-case-studies.edit', $patientCaseStudy->id)->with('warning', trans('For This Patient Case Study Added Before'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientCaseStudy  $patientCaseStudy
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientCaseStudy $patientCaseStudy)
    {
        $patientCaseStudy->delete();
        return redirect()->route('patient-case-studies.index')->with('success', trans('Patient Case Study Deleted Successfully'));
    }

    /**
     * validation check for create & edit
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'user_id' => ['required', 'string', 'max:255'],
            'food_allergy' => ['nullable', 'string', 'max:255'],
            'heart_disease' => ['nullable', 'string', 'max:255'],
            'high_blood_pressure' => ['nullable', 'string', 'max:255'],
            'diabetic' => ['nullable', 'string', 'max:255'],
            'surgery' => ['nullable', 'string', 'max:255'],
            'accident' => ['nullable', 'string', 'max:255'],
            'others' => ['nullable', 'string', 'max:255'],
            'family_medical_history' => ['nullable', 'string', 'max:255'],
            'current_medication' => ['nullable', 'string', 'max:255'],
            'pregnancy' => ['nullable', 'string', 'max:255'],
            'breastfeeding' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'mimes:jpeg,png,jpg,pdf', 'max:5120'],
            'health_insurance' => ['nullable', 'string', 'max:255']
        ]);
    }
}
