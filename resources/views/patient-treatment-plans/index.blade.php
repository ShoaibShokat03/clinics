@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Treatment Plans')</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('patient-treatment-plans-create')
                <a href="{{ route('patient-treatment-plans.create') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-plus"></i> @lang('Add New Plan')
                </a>
                @endcan
            </div>
        </div>
    </div>
</section>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3 border-bottom-0">
                        <h3 class="card-title font-weight-bold">@lang('Treatment Plans')</h3>
                        <div class="card-tools">
                            <a class="btn btn-success btn-sm" target="_blank"
                                href="{{ route('patient-treatment-plans.index') }}?export=1">
                                <i class="fas fa-cloud-download-alt"></i> @lang('Export')
                            </a>
                            <button class="btn btn-default btn-sm" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> @lang('Filter')
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="filter" class="collapse @if (request()->isFilterActive) show @endif">
                            <div class="card-body border mb-3">
                                <form action="" method="get" role="form" autocomplete="off">
                                    <input type="hidden" name="isFilterActive" value="true">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>@lang('MRN Number')</label>
                                                <input type="text" name="mrn_number" class="form-control"
                                                    value="{{ request()->mrn_number }}" placeholder="@lang('MRN Number')">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>@lang('Patient')</label>
                                                <select name="patient_id" class="form-control select2">
                                                    <option value="">@lang('Select Patient')</option>
                                                    @foreach ($patientsinfo->sortBy(fn($patient) => strtolower($patient->user->name ?? '')) as $patient)
                                                    <option value="{{ $patient->user_id }}"
                                                        {{ request()->patient_id == $patient->user_id ? 'selected' : '' }}>
                                                        {{ ($patient->user->name ?? '') . ' - ' . ($patient->mrn_number ?? '') }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>@lang('Doctor')</label>
                                                <select name="doctor_id" class="form-control select2">
                                                    <option value="">@lang('Select Doctor')</option>
                                                    @foreach ($doctors->sortBy(fn($doctor) => strtolower($doctor->user->name ?? '')) as $doctor)
                                                    @isset($doctor->user->name)
                                                    <option value="{{ $doctor->user_id }}"
                                                        {{ request()->doctor_id == $doctor->user_id ? 'selected' : '' }}>
                                                        {{ $doctor->user->name }}
                                                    </option>
                                                    @endisset
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>@lang('Examination Number')</label>
                                                <input type="text" name="examination_number" class="form-control"
                                                    value="{{ request()->examination_number }}"
                                                    placeholder="@lang('Examination Number')">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-info btn-sm px-4">@lang('Submit')</button>
                                            @if (request()->isFilterActive)
                                            <a href="{{ route('patient-treatment-plans.index') }}"
                                                class="btn btn-secondary btn-sm px-4">@lang('Clear')</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="laravel_datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>@lang("Treatment Plan's")</th>
                                        <th style="text-wrap:nowrap;">@lang("Examination No")</th>
                                        <th>@lang("Patient's")</th>
                                        <th>@lang("Doctor's")</th>
                                        <th class="text-right">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patientTreatmentPlans as $patientTreatmentPlan)
                                    <tr>
                                        <td>{{ $patientTreatmentPlan->treatment_plan_number ?? '-' }}</td>
                                        <td>{{ $patientTreatmentPlan->examinvestigation->examination_number ?? '-' }}</td>
                                        <td>{{ $patientTreatmentPlan->patient->name ?? '-' }}</td>
                                        <td>{{ $patientTreatmentPlan->doctor->name ?? '-' }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('patient-treatment-plans.show', $patientTreatmentPlan->id) }}"
                                                class="btn btn-sm btn-outline-info"
                                                data-toggle="tooltip" title="@lang('View')">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @can('patient-treatment-plans-update')
                                            <a href="{{ route('patient-treatment-plans.edit', $patientTreatmentPlan->id) }}"
                                                class="btn btn-sm btn-outline-warning ml-1"
                                                data-toggle="tooltip" title="@lang('Edit')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('patient-treatment-plans-delete')
                                            <a href="#"
                                                data-href="{{ route('patient-treatment-plans.destroy', $patientTreatmentPlan) }}"
                                                class="btn btn-sm btn-outline-danger ml-1"
                                                data-toggle="modal" data-target="#myModal" title="@lang('Delete')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $patientTreatmentPlans->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.delete_modal')
@endsection