@extends('layouts.layout')

@section('content')

    <section class="content-header">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 d-flex">
                    <h3 class="mr-2">
                        <a href="{{ route('patient-treatment-plans.create') }}" class="btn btn-outline btn-info">+
                            @lang('Add New Plan')</a>
                        <span class="pull-right"></span>
                    </h3>
                    <h3>
                        <a href="{{ route('patient-treatment-plans.index') }}" class="btn btn-outline btn-info"><i
                                class="fas fa-eye"></i> @lang('View All')</a>

                    </h3>
                </div>
                <div class="col-sm-6 d-flex justify-content-end align-items-center">
                    <a href="{{ route('exam-investigations.show', $patientTreatmentPlan->examination_id) }}"
                        class="btn btn-outline btn-info view-button"><i class="fas fa-eye"></i> @lang('View Exam Investigation')</a>
                    <ol class="breadcrumb float-sm-right ml-4">
                        <li class="breadcrumb-item"><a
                                href="{{ route('patient-treatment-plans.index') }}">@lang('Treatment Plans')</a></li>
                        <li class="breadcrumb-item active">@lang('Edit Plan')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <style>
        .btn-group .btn-print {
            margin-right: 10px;
        }
    </style>
    <div class="row treatment-plan-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">@lang('Treatment Plan')</h3>
                </div>
                <div class="card-body">
                    <form class="bg-custom" action="{{ route('patient-treatment-plans.update', $patientTreatmentPlan) }}"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="patient-treatment-plans-uri" data-uri="{{ route('patient-treatment-plan-procedures.store') }}">
                        <input type="hidden" name="demo_value" id="demo_value"
                            value={{ $patientTreatmentPlan->examination_id }}>
                        <input type="hidden" name="treatment_plan_id" id="treatment_plan_id"
                            value={{ $patientTreatmentPlan->id }}>

                        <div class="row col-12 m-0 p-0">
                            <div class="col-xl-12">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="patient">@lang('Select Patient')</label>
                                        <div class="form-group input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                            </div>
                                            <select name="patient_disabled" id="patient" class="form-control select2"
                                                disabled>
                                                <option value="" disabled>Select Procedure</option>
                                                @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                    <option value="{{ $patient->id }}"
                                                        {{ $patientTreatmentPlan->patient_id == $patient->id ? 'selected' : '' }}>
                                                        {{ $patient->name }} - {{ $patient->patientDetails->mrn_number ?? ' ' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="patient_id"
                                            value="{{ $patientTreatmentPlan->patient_id }}">
                                        @error('patient')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="examination">@lang('Teeth Examination Number')</label>
                                        <div class="form-group input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-plus-square"></i></span>
                                            </div>
                                            <select name="examination_disabled" id="examination"
                                                class="form-control select2" disabled>
                                                <option value="" disabled>Select Procedure</option>
                                                @foreach ($teethProcedures as $procedure)
                                                    <option value="{{ $procedure->id }}"
                                                        {{ $patientTreatmentPlan->examination_id == $procedure->id ? 'selected' : '' }}>
                                                        {{ $procedure->examination_number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="examination_id"
                                            value="{{ $patientTreatmentPlan->examination_id }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="doctor">@lang('Select Doctor')</label>
                                        <div class="form-group input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <select name="doctor_disabled" id="doctor" class="form-control select2"
                                                disabled>
                                                <option value="" disabled>Select Procedure</option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}"
                                                        {{ $patientTreatmentPlan->doctor_id == $doctor->id ? 'selected' : '' }}>
                                                        {{ $doctor->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="doctor_id"
                                            value="{{ $patientTreatmentPlan->doctor_id }}">
                                        @error('doctor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="comments">@lang('Comments')</label>
                                        <div class="form-group input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-file"></i></span>
                                            </div>
                                            <input name="comments" class="form-control"
                                                value="{{ $patientTreatmentPlan->comments }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">

                                    <div class="col-md-4">
                                        <label for="status">@lang('Status')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                            </div>
                                            <select
                                                class="form-control select2 ambitious-form-loading @error('status') is-invalid @enderror"
                                                required name="status" id="status">
                                                <option value="1" @if (old('status', $patientTreatmentPlan->status) == '1') selected @endif>
                                                    @lang('Active')</option>
                                                <option value="0" @if (old('status', $patientTreatmentPlan->status) == '0') selected @endif>
                                                    @lang('Inactive')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <input type="submit" value="{{ __('Update') }}"
                                            class="btn btn-outline btn-info btn-lg" />
                                        <a href="{{ route('patient-treatment-plans.index') }}"
                                            class="btn btn-outline btn-warning btn-lg">{{ __('Cancel') }}</a>

                                    </div>
                                    <div class="col-md-7 text-md-right">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('patient-treatment-plans.show', ['patient_treatment_plan' => $patientTreatmentPlan->id, 'print' => 'all']) }}"
                                                id="print-all-plan"
                                                class="btn-print btn btn-outline btn-secondary mt-2 btn-sm"
                                                style="{{ $hasPlanProcedures ? '' : 'display:none;' }}; align-content:center;">Print
                                                All Plan</a>

                                            <a href="{{ route('patient-treatment-plans.show', ['patient_treatment_plan' => $patientTreatmentPlan->id, 'print' => 'ready']) }}"
                                                id="print-ready-to-procedure"
                                                class="btn-print btn btn-outline btn-secondary mt-2"
                                                style="{{ $hasReadyToStartProcedures ? '' : 'display:none;' }}">Print
                                                Ready to Procedure</a>

                                            <a href="#" id="generate-invoice"
                                                class="btn-print btn btn-outline btn-secondary mt-2"
                                                style="{{ $showGenerateInvoiceButton ? '' : 'display:none;' }}">Generate
                                                Invoice</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    @foreach ($teeth as $tooth)
        <div class="row tooth-row-{{ $tooth->tooth_number }}">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info d-flex align-items-center">
                        <img src="{{ asset('assets/images/teeth/' . $tooth->tooth_number . '.png') }}"
                            onerror="this.style.display='none'"
                            style="max-height: 30px; max-width: 30px; object-fit: contain; margin-right: 10px;">
                        <h3 class="card-title mb-0">{{ $tooth->tooth_number }}</h3>
                    </div>

                    <div class="card-body">
                        <div class="tooth-issues bg-custom p-2 mb-2">
                            @foreach ($tooth->toothIssues as $issue)
                                <div class="alert alert-light" style="display: inline-block; margin-right: 30px;">
                                    <h5 style="font-size:11px; font-weight:bold;">{{ $issue->tooth_issue }} {{ ( $issue->diagnosis)?', '.$issue->diagnosis->name:'' }} </h5>
                                    <p style="font-size:11px;">{{ $issue->description }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover border tooth-treatment">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="border">Procedure Category</th>
                                        <th class="border">Procedure</th>
                                        <th class="border">Cost</th>
                                        <th class="border">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($patientTreatmentPlanProcedures->where('tooth_number', $tooth->tooth_number)->isNotEmpty())
                                        @foreach ($patientTreatmentPlanProcedures->where('tooth_number', $tooth->tooth_number) as $planProcedure)
                                            @php
                                                $isDisabled = $invoiceItems
                                                    ->where('patient_treatment_plan_procedure_id', $planProcedure->id)
                                                    ->isNotEmpty();
                                            @endphp

                                            <tr class="treatment-plan-inner-row" data-id="{{ $planProcedure->id }}">
                                                <!-- {{$planProcedure->id}} -->
                                                <td class="border col-xl-3">
                                                    <div class="input-group mb-3">
                                                    <!-- <input type="hidden" name="proceduerID" id="proceduerID" value="{{$planProcedure->id}}"> -->
                                                        <select required name="procedure_category[]"
                                                            class="form-control choose-treatment-category @error('procedure') is-invalid @enderror"
                                                            id="procedure_category"
                                                            {{ $isDisabled || $planProcedure->is_procedure_started === 'yes' ? 'disabled' : '' }}>
                                                            <option value="" disabled selected>Select Procedure
                                                                Category</option>
                                                            @foreach ($procedureCategories as $procedureCategory)
                                                                <option value="{{ $procedureCategory->id }}"
                                                                    @if (old('procedure_category', $planProcedure->procedure->ddprocedurecategory->id) == $procedureCategory->id) selected @endif>
                                                                    {{ $procedureCategory->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                    </div>
                                                </td>
                                                <td class="border col-xl-3">
                                                    <div class="input-group mb-3">
                                                        <select required name="procedure[]"
                                                            class="form-control choose-treatment-plan @error('procedure') is-invalid @enderror"
                                                            id="procedure"
                                                            {{ $isDisabled || $planProcedure->is_procedure_started === 'yes' ? 'disabled' : '' }}>
                                                            <option value="" disabled selected>Select Procedure
                                                                Category</option>
                                                            @foreach ($procedures as $procedure)
                                                                <option value="{{ $procedure->id }}"
                                                                    @if (old('procedure', $planProcedure->dd_procedure_id) == $procedure->id) selected @endif>
                                                                    {{ $procedure->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                    </div>
                                                </td>
                                                <td class="border">
                                                    <div class="input-group mb-3">
                                                        <span class="cost">{{ $planProcedure->procedure->price }}</span>
                                                        {{-- Here add checkbox --}}
                                                        &nbsp;&nbsp;
                                                        <input type="checkbox" id="showPriceCheckbox"
                                                            data-id="{{ $planProcedure->id }}"
                                                            {{ $planProcedure->show_price ? 'checked' : '' }}>


                                                        {{-- Here add checkbox --}}
                                                    </div>
                                                </td>
                                                <td class="border ">

                                                    <div class="action-tab row">
                                                        <div
                                                            class="treatment-plan-edit-action-tab-list col-xl-6 col-md-12 col-sm-12">



                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="check-readytostart">
                                                                        <input class="form-check-input check-input"
                                                                            {{ $planProcedure->ready_to_start === 'yes' ? 'checked' : '' }}
                                                                            type="checkbox"
                                                                            {{ $isDisabled || $planProcedure->ready_to_start === 'yes' ? 'disabled' : '' }}>
                                                                        <label class="form-check-label">
                                                                            Add to procedure
                                                                        </label>
                                                                    </div>
                                                                    <div class="check-start">
                                                                        <input id="startProcedureCheckbox"
                                                                            class="form-check-input check-input-start"
                                                                            {{ $planProcedure->is_procedure_started === 'yes' ? 'checked' : '' }}
                                                                            type="checkbox"
                                                                            {{ $isDisabled || $planProcedure->is_procedure_started === 'yes' ? 'disabled' : '' }}>
                                                                        <label class="form-check-label">
                                                                            Start Procedure
                                                                        </label>
                                                                    </div>

                                                                    <div class="check-finished"
                                                                        style="{{ $planProcedure->is_procedure_started === 'yes' ? '' : 'display:none;' }}">
                                                                        <input
                                                                            class="form-check-input check-input-finished"
                                                                            {{ $planProcedure->is_procedure_finished === 'yes' ? 'checked' : '' }}
                                                                            type="checkbox"
                                                                            {{ $isDisabled || $planProcedure->is_procedure_finished === 'yes' ? 'disabled' : '' }}>
                                                                        <label class="form-check-label" style="">
                                                                            Procedure Finished
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div id="notesButtons">
                                                                        <!-- Add Button -->
                                                                        <button style="width:107px !important;margin-bottom:5px;" type="button" class="btn btn-sm btn-primary"
                                                                            data-toggle="modal"
                                                                            data-target="#declineModal_{{$tooth->tooth_number}}"
                                                                            data-procedure-id="{{$planProcedure->id}}"
                                                                            >Add Notes</button>

                                                                        <!-- Show Button -->
                                                                        @php
                                                                        $patientNotesCount = \App\Models\TreatmentPlanNotes::where('patient_treatment_plan_id', $patientTreatmentPlan->id)
                                                    ->where('patient_treatment_plan_procedure_id', $planProcedure->id)
                                                    ->where('tooth_number', $tooth->tooth_number)
                                                    ->count();
                                                                        @endphp



                                                                        @if ($patientNotesCount > 0)
                                                                            <button style="width:107px !important; " type="button"
                                                                                class="btn btn-sm btn-secondary show-notes-btn"
                                                                                data-toggle="modal"
                                                                                data-target="#showModal<?= $tooth->tooth_number ?>"
                                                                                data-procedure-id="{{$planProcedure->id}}"
                                                                                data-patient-plan-id="{{$patientTreatmentPlan->id}}">
                                                                                Show Notes
                                                                            </button>


                                                                            <!-- Show Modal -->
                                                            <div class="modal fade show_treatment_notes" id="showModal<?= $tooth->tooth_number ?>"
                                                                data-procedure-id="{{$planProcedure->id}}" tabindex="-1"
                                                                aria-labelledby="showModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="showModalLabel">
                                                                                Treatment plan notes for tooth <?= $tooth->tooth_number ?></h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body" style="height: 400px;overflow-y:scroll;">
                                                                            <table class="table notes-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">#</th>
                                                                                        <th scope="col">Notes</th>
                                                                                        <th scope="col">Notes Date & Time</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="notes-data">
                                                                                    <!-- Notes will be loaded here via AJAX -->
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>






                                                            <div class="modal fade model_add_notes" id="declineModal_{{ $tooth->tooth_number }}" tabindex="-1"
        role="dialog" aria-labelledby="declineModalLabel_{{ $tooth->tooth_number }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="declineModalLabel_{{ $tooth->tooth_number }}">Add notes for tooth {{$tooth->tooth_number}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="notesForm_{{ $tooth->tooth_number }}"
                        class="p-4 rounded bg-light submit_notes_form">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="treatment_notes_{{ $tooth->tooth_number }}" class="form-label fw-bold">Write notes for tooth {{$tooth->tooth_number}}
                                <i class="bi bi-pencil-square ms-2"></i>
                            </label>
                            <textarea name="username" id="treatment_notes_{{ $tooth->tooth_number }}" class="form-control" rows="4"
                                placeholder="Add notes here..."></textarea>
                        </div>
                        <input type="hidden" name="patient_treatment_plan_id" value="{{ $patientTreatmentPlan->id }}">
                        <input type="hidden" name="tooth_number" value="{{ $tooth->tooth_number }}">
                        <input type="hidden" name="plan_procedure_id" class="procedure-id-input" value="">
                        <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-send me-2"></i> Submit
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>






                                                        </div>
                                                        <div
                                                            class="action-tab-btn responsive-width col-xl-6 col-md-12 col-sm-12">
                                                            <button
                                                                {{ $planProcedure->is_procedure_finished === 'yes' ? 'disabled' : '' }}
                                                                type="button"
                                                                class="btn btn-success m-save responsive-width-item"
                                                                {{ $isDisabled ? 'disabled' : '' }}><i
                                                                    class="fas fa-save"></i></button>
                                                            <button
                                                                {{ $planProcedure->is_procedure_finished === 'yes' ? 'disabled' : '' }}
                                                                type="button"
                                                                class="btn btn-danger m-remove responsive-width-item"
                                                                {{ $isDisabled ? 'disabled' : '' }}><i
                                                                    class="fas fa-trash"></i></button>
                                                            <button type="button"
                                                                class="btn btn-info m-add responsive-width-item"><i
                                                                    class="fas fa-plus"></i></button>
                                                            <input type="hidden" name="planProcedure" id="planProcedure"
                                                                value="{{ $planProcedure->id }}">
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="treatment-plan-inner-row" data-id="new-row">
                                            <td class="border col-xl-3">
                                                <div class="input-group mb-3">
                                                    <select required name="procedure_category[]"
                                                        class="form-control choose-treatment-category @error('procedure') is-invalid @enderror"
                                                        id="procedure_category">
                                                        <option value="" disabled selected>Select Procedure Category
                                                        </option>
                                                        @foreach ($procedureCategories as $procedureCategory)
                                                            <option value="{{ $procedureCategory->id }}">
                                                                {{ $procedureCategory->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                </div>
                                            </td>
                                            <td class="border col-xl-3">
                                                <div class="input-group mb-3">
                                                    <select required name="procedure[]"
                                                        class="form-control choose-treatment-plan @error('procedure') is-invalid @enderror"
                                                        id="procedure">
                                                        <option value="" disabled selected>Select Procedure</option>
                                                        <!-- Add options dynamically via JavaScript if needed -->
                                                    </select>
                                                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                                                </div>
                                            </td>
                                            <td class="border">
                                                <div class="input-group mb-3">
                                                    <span class="cost"></span>
                                                </div>
                                            </td>
                                            <td class="border ">

                                                    <div class="action-tab row">
                                                        <div class="treatment-plan-edit-action-tab-list col-xl-6 col-md-12 col-sm-12">



                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="check-readytostart">
                                                                        <input class="form-check-input check-input" type="checkbox">
                                                                        <label class="form-check-label">
                                                                            Add to procedure
                                                                        </label>
                                                                    </div>
                                                                    <div class="check-start">
                                                                        <input id="startProcedureCheckbox" class="form-check-input check-input-start" type="checkbox">
                                                                        <label class="form-check-label">
                                                                            Start Procedure
                                                                        </label>
                                                                    </div>

                                                                    <div class="check-finished" style="display:none;">
                                                                        <input class="form-check-input check-input-finished" type="checkbox">
                                                                        <label class="form-check-label" style="">
                                                                            Procedure Finished
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div id="notesButtons" class="d-none">
                                                                        <!-- Add Button -->
                                                                        <button style="width:107px !important;margin-bottom:5px;" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#declineModal_45" data-procedure-id="194">Add Notes</button>

                                                                        <!-- Show Button -->



                                                                                                                                                <button style="width:107px !important; " type="button" class="btn btn-sm btn-secondary show-notes-btn" data-toggle="modal" data-target="#showModal45" data-procedure-id="194" data-patient-plan-id="41">
                                                                                Show Notes
                                                                            </button>


                                                                            <!-- Show Modal -->
                                                            <div class="modal fade show_treatment_notes" id="showModal45" data-procedure-id="194" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="showModalLabel">
                                                                                Treatment plan notes for tooth 45</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body" style="height: 400px;overflow-y:scroll;">
                                                                            <table class="table notes-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">#</th>
                                                                                        <th scope="col">Notes</th>
                                                                                        <th scope="col">Notes Date &amp; Time</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="notes-data">
                                                                                    <!-- Notes will be loaded here via AJAX -->
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                                                                                            </div>
                                                                </div>
                                                            </div>






                                                            <div class="modal fade model_add_notes" id="declineModal_45" tabindex="-1" role="dialog" aria-labelledby="declineModalLabel_45" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="declineModalLabel_45">Add notes for tooth 45</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="notesForm_45" class="p-4 rounded bg-light submit_notes_form">
                        <input type="hidden" name="_token" value="hemFIyw41AetszNbEGLjpyT0CD7qmffp82AXiVbG">                        <div class="form-group mb-3">
                            <label for="treatment_notes_45" class="form-label fw-bold">Write notes for tooth 45
                                <i class="bi bi-pencil-square ms-2"></i>
                            </label>
                            <textarea name="username" id="treatment_notes_45" class="form-control" rows="4" placeholder="Add notes here..."></textarea>
                        </div>
                        <input type="hidden" name="patient_treatment_plan_id" value="41">
                        <input type="hidden" name="tooth_number" value="45">
                        <input type="hidden" name="plan_procedure_id" class="procedure-id-input" value="">
                        <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-send me-2"></i> Submit
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>






                                                        </div>
                                                        <div class="action-tab-btn responsive-width col-xl-6 col-md-12 col-sm-12">
                                                            <button type="button" class="btn btn-success m-save responsive-width-item"><i class="fas fa-save"></i></button>
                                                            <button type="button" class="btn btn-danger m-remove responsive-width-item"><i class="fas fa-trash"></i></button>
                                                            <button type="button" class="btn btn-info m-add responsive-width-item"><i class="fas fa-plus"></i></button>
                                                            <input type="hidden" name="planProcedure" id="planProcedure" value="194">
                                                        </div>
                                                    </div>

                                                </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row tooth-row d-none">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info d-flex align-items-center">
                    <img src="{{ asset('assets/images/teeth/18.png') }}" onerror="this.style.display='none'"
                        style="max-height: 30px; max-width: 30px; object-fit: contain; margin-right: 10px;">
                    <h3 class="card-title mb-0">Treatment Plan For All Teeth</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover border tooth-treatment" id="all-teeth-table">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="border">Procedure Category</th>
                                    <th class="border">Procedure</th>
                                    <th class="border">Cost</th>
                                    <th class="border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allTeethProcedures as $planProcedure)
                                    @php
                                        $isDisabled = $invoiceItems
                                            ->where('patient_treatment_plan_procedure_id', $planProcedure->id)
                                            ->isNotEmpty();
                                    @endphp
                                    <tr class="treatment-plan-inner-row" data-id="{{ $planProcedure->id }}">
                                        <td class="border col-xl-3">
                                            <div class="input-group mb-3">
                                                <select required name="procedure_category[]"
                                                    class="form-control choose-treatment-category @error('procedure') is-invalid @enderror"
                                                    id="procedure_category"
                                                    {{ $isDisabled || $planProcedure->is_procedure_started === 'yes' ? 'disabled' : '' }}>
                                                    <option value="" disabled selected>Select Procedure Category
                                                    </option>
                                                    @foreach ($procedureCategories as $procedureCategory)
                                                        <option value="{{ $procedureCategory->id }}"
                                                            @if (old('procedure_category', $planProcedure->procedure->ddprocedurecategory->id) == $procedureCategory->id) selected @endif>
                                                            {{ $procedureCategory->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                            </div>
                                        </td>
                                        <td class="border col-xl-3">
                                            <div class="input-group mb-3">
                                                <select required name="procedure[]"
                                                    class="form-control choose-treatment-plan @error('procedure') is-invalid @enderror"
                                                    id="procedure"
                                                    {{ $isDisabled || $planProcedure->is_procedure_started === 'yes' ? 'disabled' : '' }}>
                                                    <option value="" disabled selected>Select Procedure</option>
                                                    @foreach ($procedures as $procedure)
                                                        <option value="{{ $procedure->id }}"
                                                            @if (old('procedure', $planProcedure->dd_procedure_id) == $procedure->id) selected @endif>
                                                            {{ $procedure->title }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="input-group mb-3">
                                                <span class="cost">{{ $planProcedure->procedure->price }}</span>
                                                {{-- <input type="checkbox" value="0"> --}}
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="action-tab row">
                                                <div
                                                    class="treatment-plan-edit-action-tab-list col-xl-6 col-md-12 col-sm-12">
                                                    <div class="check-readytostart">
                                                        <input class="form-check-input check-input"
                                                            {{ $planProcedure->ready_to_start === 'yes' ? 'checked' : '' }}
                                                            type="checkbox"
                                                            {{ $isDisabled || $planProcedure->ready_to_start === 'yes' ? 'disabled' : '' }}>
                                                        <label class="form-check-label">
                                                            Add to procedure
                                                        </label>
                                                    </div>
                                                    <div class="check-start"
                                                        style="{{ $planProcedure->ready_to_start === 'yes' ? '' : 'display:none;' }}">
                                                        <input class="form-check-input check-input-start"
                                                            {{ $planProcedure->is_procedure_started === 'yes' ? 'checked' : '' }}
                                                            type="checkbox"
                                                            {{ $isDisabled || $planProcedure->is_procedure_started === 'yes' ? 'disabled' : '' }}>
                                                        <label class="form-check-label">
                                                            Start Procedure
                                                        </label>
                                                    </div>
                                                    <div class="check-finished"
                                                        style="{{ $planProcedure->is_procedure_started === 'yes' ? '' : 'display:none;' }}">
                                                        <input class="form-check-input check-input-finished"
                                                            {{ $planProcedure->is_procedure_finished === 'yes' ? 'checked' : '' }}
                                                            type="checkbox"
                                                            {{ $isDisabled || $planProcedure->is_procedure_finished === 'yes' ? 'disabled' : '' }}>
                                                        <label class="form-check-label">
                                                            Procedure Finished
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="action-tab-btn responsive-width col-xl-6 col-md-12 col-sm-12">
                                                    <button
                                                        {{ $planProcedure->is_procedure_finished === 'yes' ? 'disabled' : '' }}
                                                        type="button"
                                                        class="btn btn-success m-save responsive-width-item"
                                                        {{ $isDisabled ? 'disabled' : '' }}>
                                                        <i class="fas fa-save"></i>
                                                    </button>
                                                    <button
                                                        {{ $planProcedure->is_procedure_finished === 'yes' ? 'disabled' : '' }}
                                                        type="button"
                                                        class="btn btn-danger m-remove responsive-width-item"
                                                        {{ $isDisabled ? 'disabled' : '' }}>
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-info m-add responsive-width-item">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <input type="hidden" name="planProcedure" id="planProcedure"
                                                        value="{{ $planProcedure->id }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Option to add a new row if no procedures exist -->
                                @if ($allTeethProcedures->isEmpty())
                                    <tr class="treatment-plan-inner-row" data-id="new-row">
                                        <td class="border col-xl-3">
                                            <div class="input-group mb-3">
                                                <select required name="procedure_category[]"
                                                    class="form-control choose-treatment-category @error('procedure') is-invalid @enderror"
                                                    id="procedure_category">
                                                    <option value="" disabled selected>Select Procedure Category
                                                    </option>
                                                    @foreach ($procedureCategories as $procedureCategory)
                                                        <option value="{{ $procedureCategory->id }}">
                                                            {{ $procedureCategory->title }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                            </div>
                                        </td>
                                        <td class="border col-xl-3">
                                            <div class="input-group mb-3">
                                                <select required name="procedure[]"
                                                    class="form-control choose-treatment-plan @error('procedure') is-invalid @enderror"
                                                    id="procedure">
                                                    <option value="" disabled selected>Select Procedure</option>
                                                    <!-- Add options dynamically via JavaScript if needed -->
                                                </select>
                                                <span class="dropdown-wrapper" aria-hidden="true"></span>
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="input-group mb-3">
                                                <span class="cost"></span>
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="action-tab row">
                                                <div class="action-tab-btn responsive-width col-xl-6 col-md-12 col-sm-12">
                                                    <button type="button"
                                                        class="btn btn-success m-save responsive-width-item">
                                                        <i class="fas fa-save"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-danger m-remove responsive-width-item">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-info m-add responsive-width-item">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <input type="hidden" name="planProcedure" id="planProcedure"
                                                        value=1010101010101>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

        });
    </script>



    <script>
        // $(document).ready(function() {
        //     // Initially show or hide the buttons based on the checkbox state
        //     if ($('#startProcedureCheckbox').is(':checked')) {
        //         $('#notesButtons').removeClass('d-none');
        //     }

        //     // Toggle visibility on checkbox change
        //     $('#startProcedureCheckbox').on('change', function() {
        //         if ($(this).is(':checked')) {
        //             $('#notesButtons').removeClass('d-none');
        //         } else {
        //             $('#notesButtons').addClass('d-none');
        //         }
        //     });
        // });
    </script>


    <script>
      $(document).ready(function() {
    // ===== COMMON FUNCTIONS =====
    // Function to create a modal for a specific tooth
    function createAddNotesModal(toothNumber, patientTreatmentPlanId) {
        // Check if modal already exists
        if ($('#declineModal_' + toothNumber).length > 0) {
            return; // Modal already exists, no need to create it again
        }

        var modalHtml = `
            <div class="modal fade model_add_notes" id="declineModal_${toothNumber}" tabindex="-1"
                role="dialog" aria-labelledby="declineModalLabel_${toothNumber}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="declineModalLabel_${toothNumber}">Add notes for tooth ${toothNumber}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="notesForm_${toothNumber}" class="p-4 rounded bg-light submit_notes_form">
                                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                <div class="form-group mb-3">
                                    <label for="treatment_notes_${toothNumber}" class="form-label fw-bold">Write notes for tooth ${toothNumber}
                                        <i class="bi bi-pencil-square ms-2"></i>
                                    </label>
                                    <textarea name="username" id="treatment_notes_${toothNumber}" class="form-control" rows="4"
                                        placeholder="Add notes here..."></textarea>
                                </div>
                                <input type="hidden" name="patient_treatment_plan_id" value="${patientTreatmentPlanId}">
                                <input type="hidden" name="tooth_number" value="${toothNumber}">
                                <input type="hidden" name="plan_procedure_id" class="procedure-id-input" value="">
                                <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-send me-2"></i> Submit
                                </button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>`;

        $('body').append(modalHtml);
    }

    // Function to create a Show Notes modal for a specific tooth
    function createShowNotesModal(toothNumber, procedureId, patientPlanId) {
        // Check if modal already exists
        if ($('#showModal' + toothNumber).length > 0) {
            return; // Modal already exists, no need to create it again
        }

        var showModalHtml = `
            <div class="modal fade show_treatment_notes" id="showModal${toothNumber}"
                data-procedure-id="${procedureId}" tabindex="-1"
                aria-labelledby="showModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showModalLabel">
                                Treatment plan notes for tooth ${toothNumber}</h5>
                            <button type="button" class="close"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="height: 400px;overflow-y:scroll;">
                            <table class="table notes-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Notes Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody class="notes-data">
                                    <!-- Notes will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>`;

        $('body').append(showModalHtml);
    }

    // ===== ROW MANAGEMENT =====
    // When adding a new row
    $(document).on("click", ".m-add", function() {
        var $row = $(this).closest('.treatment-plan-inner-row');
        let rowTreatmentPlan = $row.closest(".table.tooth-treatment").find("tbody tr:first").clone();

        // Clear all values and states
        rowTreatmentPlan.find('select').val('');
        rowTreatmentPlan.find('.cost').text('');
        rowTreatmentPlan.find('input[type="checkbox"]').prop('checked', false);
        rowTreatmentPlan.find('input[type="checkbox"]').prop('disabled', false);
        rowTreatmentPlan.find('select').prop('disabled', false);
        rowTreatmentPlan.find('button').prop('disabled', false);
        rowTreatmentPlan.find('input[type="hidden"]').val('');

        // Hide procedure checkboxes initially
        rowTreatmentPlan.find('.check-start').hide();
        rowTreatmentPlan.find('.check-finished').hide();

        // Remove all modal-related elements and buttons
        rowTreatmentPlan.find('#notesButtons').empty();
        rowTreatmentPlan.attr('data-id', 'new-row');

        // Create new row and append it
        $row.closest(".table.tooth-treatment").find("tbody").append(
            '<tr class="treatment-plan-inner-row" data-id="new-row">' + rowTreatmentPlan.html() + '</tr>'
        );

        // Clear values in the new row
        let $newRow = $row.closest(".table.tooth-treatment").find("tbody tr:last");
        $newRow.find('select').val('');
        $newRow.find('.cost').text('');
        $newRow.find('input[type="checkbox"]').prop('checked', false);
    });

    // ===== SAVING PROCEDURES =====
    $(document).on("click", ".m-save", function() {
        var $row = $(this).closest('.treatment-plan-inner-row');
        var dataId = $row.data('id') ?? '';
        var procedureCategory = $row.find('.choose-treatment-category').val();
        var procedure = $row.find('.choose-treatment-plan').val();
        var ready_to_start = $row.find('.check-input').is(':checked') ? 'yes' : 'no';
        var is_procedure_started = $row.find('.check-input-start').is(':checked') ? 'yes' : 'no';
        var is_procedure_finished = $row.find('.check-input-finished').is(':checked') ? 'yes' : 'no';
        var toothNumber = $row.closest('.card').find('.card-header.bg-info h3.card-title').text().trim();
        var treatmentPlanId = $('input[name="treatment_plan_id"]').val();
        var allTeeth = $row.closest('table').attr('id') === 'all-teeth-table' ? 'yes' : 'no';

        if (allTeeth == 'yes') {
            toothNumber = null;
        }

        if (!procedureCategory || !procedure) {
            alert('Either Category Or Procedure is not selected!');
            return;
        }

        $.ajax({
            url:  $('#patient-treatment-plans-uri').data('uri'),
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                treatment_plan_id: treatmentPlanId,
                data_id: dataId,
                tooth_number: toothNumber,
                procedure: procedure,
                ready_to_start: ready_to_start,
                is_procedure_started: is_procedure_started,
                is_procedure_finished: is_procedure_finished,
                all_teeth: allTeeth
            },
            success: function(response) {
                // Update the row's data-id attribute with the new ID
                $row.attr('data-id', response.planProcedure.id);
                $row.find('input[name="planProcedure"]').val(response.planProcedure.id);

                // Handle the response, update the UI accordingly
                updateRowUI($row, response.planProcedure);

                // Create notes button if needed
                setupNotesButtons($row, toothNumber, response.planProcedure.id, treatmentPlanId);

                alert('Record saved successfully.');
            },
            error: function(xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                if (xhr.status === 403) {
                    alert(response.message);
                } else {
                    alert('Failed to save the record! Please try again.');
                }
            }
        });
    });

    // Function to set up notes buttons for a row
    function setupNotesButtons($row, toothNumber, procedureId, patientPlanId) {
        // Ensure the notes column is set up
        var $notesButtonsDiv = $row.find('.col-6:nth-child(2)');
        if ($notesButtonsDiv.length === 0 || $notesButtonsDiv.find('#notesButtons').length === 0) {
            if ($row.find('.col-6').length === 0) {
                $row.find('.treatment-plan-edit-action-tab-list').append('<div class="row"><div class="col-6"></div><div class="col-6" id="notesButtons"></div></div>');
            } else if ($notesButtonsDiv.find('#notesButtons').length === 0) {
                $notesButtonsDiv.html('<div id="notesButtons"></div>');
            }
            $notesButtonsDiv = $row.find('.col-6:nth-child(2)').find('#notesButtons');
        }

        // Clear existing buttons first
        $notesButtonsDiv.empty();

        // Create the modals for this tooth if they don't exist
        createAddNotesModal(toothNumber, patientPlanId);

        // Add the "Add Notes" button
        var addNotesBtn = `
            <button style="width:107px !important;margin-bottom:5px;" type="button" class="btn btn-sm btn-primary"
                data-toggle="modal"
                data-target="#declineModal_${toothNumber}"
                data-procedure-id="${procedureId}">
                Add Notes
            </button>`;

        $notesButtonsDiv.append(addNotesBtn);

        // Check if notes exist for this procedure via AJAX
        $.ajax({
            url: "{{ route('check.notes.exist') }}",
            type: 'GET',
            data: {
                procedure_id: procedureId,
                patient_plan_id: patientPlanId,
                tooth_number: toothNumber
            },
            success: function(response) {
                if (response.exists) {
                    // Create the "Show Notes" button and modal
                    createShowNotesModal(toothNumber, procedureId, patientPlanId);

                    var showNotesBtn = `
                        <button style="width:107px !important;" type="button"
                            class="btn btn-sm btn-secondary show-notes-btn"
                            data-toggle="modal"
                            data-target="#showModal${toothNumber}"
                            data-procedure-id="${procedureId}"
                            data-patient-plan-id="${patientPlanId}">
                            Show Notes
                        </button>`;

                    $notesButtonsDiv.append(showNotesBtn);
                }
            },
            error: function() {
                console.error("Failed to check for existing notes");
            }
        });
    }

    function updateRowUI($row, planProcedure) {
        var $checkInput = $row.find('.check-input');
        var $checkInputStart = $row.find('.check-input-start');
        var $checkInputFinished = $row.find('.check-input-finished');
        var $dropdowns = $row.find('.choose-treatment-category, .choose-treatment-plan');
        var $saveButton = $row.find('.m-save');
        var $deleteButton = $row.find('.m-remove');

        // Reset all elements initially
        $checkInput.prop('checked', false).prop('disabled', false);
        $checkInputStart.prop('checked', false).prop('disabled', false);
        $checkInputFinished.prop('checked', false).prop('disabled', false);
        $dropdowns.prop('disabled', false);
        $saveButton.prop('disabled', false);
        $deleteButton.prop('disabled', false);
        $('#print-all-plan').css('display', 'block');

        // Show or hide checkboxes based on `planProcedure` data
        if (planProcedure.ready_to_start === 'yes') {
            $checkInput.prop('checked', true).prop('disabled', true);
            $checkInputStart.closest('div').show(); // Show "Start Procedure" if ready to start
            $('#print-ready-to-procedure').css('display', 'block');
            if (planProcedure.is_procedure_started === 'yes') {
                $checkInputStart.prop('checked', true).prop('disabled', true);
                $dropdowns.prop('disabled', true);

                $checkInputFinished.closest('div').show(); // Show "Procedure Finished" if procedure started
                if (planProcedure.is_procedure_finished === 'yes') {
                    $checkInputFinished.prop('checked', true).prop('disabled', true);
                    $saveButton.prop('disabled', true);
                    $deleteButton.prop('disabled', true);
                    $('#generate-invoice').css('display', 'block');
                } else {
                    $checkInputFinished.prop('checked', false).prop('disabled', false);
                }
            } else {
                $checkInputStart.prop('checked', false).prop('disabled', false);
                $checkInputFinished.closest('div').hide();
            }
        } else {
            $checkInput.prop('checked', false).prop('disabled', false);
            $checkInputStart.closest('div').hide();
            $checkInputFinished.closest('div').hide();
        }
    }

    // ===== REMOVING PROCEDURES =====
    $(document).on("click", ".m-remove", function() {
        if (!confirm("Are you sure you want to delete this?")) {
            return;
        }

        var $row = $(this).closest('.treatment-plan-inner-row');
        var planProcedureId = $row.find('input[name="planProcedure"]').val();

        if ($(this).closest('tbody').find('tr').length == 1) {
            alert('You can\'t delete this record!');
            return 0;
        }

        // For new rows that haven't been saved yet
        if (planProcedureId === "" || $row.data('id') === 'new-row') {
            $row.remove();
            return;
        }

        $.ajax({
            url: '{{ url("patient-treatment-plan-procedures") }}/' + planProcedureId,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                _method: 'DELETE',
            },
            success: function(response) {
                alert('Deleted successfully.');
                $row.remove();
            },
            error: function(xhr, status, error) {
                if (xhr.status === 403) {
                    alert('Record cannot be deleted as it is associated with an invoice item.');
                } else if (xhr.status === 404) {
                    alert('Record not found!');
                } else {
                    alert('Failed to delete the record! Please try again.');
                }
            }
        });
    });

    // ===== NOTES FUNCTIONALITY =====
    // Submit notes form
    $(document).on('submit', '.submit_notes_form', function(e) {
        e.preventDefault();

        var $form = $(this);
        var $submitButton = $form.find('button[type="submit"]');
        var toothNumber = $form.find('input[name="tooth_number"]').val();
        var patientPlanId = $form.find('input[name="patient_treatment_plan_id"]').val();

        // Get the procedure ID from the button that opened the modal
        var modalId = $form.closest('.modal').attr('id');
        var procedureId = $('button[data-target="#' + modalId + '"]').data('procedure-id');

        // Set the procedure ID in the form
        $form.find('input[name="plan_procedure_id"]').val(procedureId);

        // Disable the submit button while processing
        $submitButton.prop('disabled', true);

        // Add CSRF token if not already in the form
        if (!$form.find('input[name="_token"]').length) {
            $form.append('<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">');
        }

        var formData = $form.serialize();

        $.ajax({
            type: "POST",
            url: "{{ url('treatmentnotes') }}",
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#' + modalId).modal('hide');
                    alert('Form submitted successfully!');
                    $form[0].reset();

                    // Create show notes modal if it doesn't exist
                    createShowNotesModal(toothNumber, procedureId, patientPlanId);

                    // Add Show Notes button if it doesn't exist
                    var $row = $('button[data-procedure-id="' + procedureId + '"]').closest('.treatment-plan-inner-row');
                    var $notesButtonsDiv = $row.find('.col-6:nth-child(2)').find('#notesButtons');

                    if ($notesButtonsDiv.find('.show-notes-btn').length === 0) {
                        var showNotesBtn = `
                            <button style="width:107px !important;" type="button"
                                class="btn btn-sm btn-secondary show-notes-btn"
                                data-toggle="modal"
                                data-target="#showModal${toothNumber}"
                                data-procedure-id="${procedureId}"
                                data-patient-plan-id="${patientPlanId}">
                                Show Notes
                            </button>`;

                        $notesButtonsDiv.append(showNotesBtn);
                    }
                } else {
                    alert('Failed to submit the form.');
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            },
            complete: function() {
                // Re-enable the submit button whether the request succeeded or failed
                $submitButton.prop('disabled', false);
            }
        });
    });

    // When the "Add Notes" button is clicked
    $(document).on('click', '.btn-primary[data-toggle="modal"]', function() {
        var procedureId = $(this).data('procedure-id');
        var modalId = $(this).data('target');

        // Update the procedure-id-input in the form
        $(modalId).find('input.procedure-id-input').val(procedureId);
    });

    // When the "Show Notes" button is clicked
    $(document).on('click', '.show-notes-btn', function(e) {
        e.preventDefault();

        var procedureId = $(this).data('procedure-id');
        var patientPlanId = $(this).data('patient-plan-id');
        var modalId = $(this).data('target');
        var $modal = $(modalId);

        // Clear existing notes in the modal
        $modal.find('.notes-data').empty();

        // Fetch notes via AJAX
        $.ajax({
            url: '{{ route("treatment.notes") }}',
            type: 'GET',
            data: {
                procedure_id: procedureId,
                procedure_plan_id: patientPlanId
            },
            success: function(response) {
                var tbody = $modal.find('.notes-data');
                var counter = 1;

                // Populate notes in the modal
                response.notes.forEach(function(note) {
                    var row = `<tr>
                        <td>${counter++}</td>
                        <td>${note.username}</td>
                        <td>${note.datetime}</td>
                    </tr>`;
                    tbody.append(row);
                });

                if (response.notes.length === 0) {
                    tbody.append('<tr><td colspan="3" class="text-center">No notes found</td></tr>');
                }

                // Show the modal after data is loaded
                $modal.modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notes:', error);
                $modal.find('.notes-data').html('<tr><td colspan="3" class="text-center">Error loading notes</td></tr>');
                $modal.modal('show'); // Show the modal even if there's an error
            }
        });
    });

    // Additional route for checking if notes exist
    // You'll need to create this route on the server side
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>

@endsection
