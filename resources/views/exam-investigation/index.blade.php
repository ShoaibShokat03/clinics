@extends('layouts.layout')
@section('content')
<style>
    body {
        overscroll-x: hidden;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Exam & Diagnosis List')</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('exam-investigations-create')
                <a href="{{ route('exam-investigations.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> @lang('Add Exam & Diagnosis')
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
                        <h3 class="card-title font-weight-bold ml-1">@lang('Filter Exam & Diagnosis')</h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-primary btn-sm" target="_blank"
                                href="{{ route('exam-investigations.index') }}?export=1">
                                <i class="fas fa-cloud-download-alt"></i> @lang('Export')
                            </a>
                            <button class="btn btn-outline-secondary btn-sm ml-2" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> @lang('Filter')
                            </button>
                        </div>
                    </div>

                    <div id="filter" class="collapse @if (request()->isFilterActive) show @endif">
                        <div class="card-body p-3 bg-light border-bottom">
                            <form action="" method="get" role="form" autocomplete="off">
                                <input type="hidden" name="isFilterActive" value="true">
                                <div class="row align-items-end">
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Examination Number')</label>
                                            <input type="text" name="examination_number" class="form-control form-control-sm"
                                                value="{{ request()->examination_number }}" placeholder="@lang('Exm. #')">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('MRN Number')</label>
                                            <input type="text" name="mrn_number" class="form-control form-control-sm"
                                                value="{{ request()->mrn_number }}" placeholder="@lang('MRN #')">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Patient')</label>
                                            <select name="patient_id" class="form-control form-control-sm select2">
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
                                    <div class="col-sm-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Doctor')</label>
                                            <select name="doctor_id" class="form-control form-control-sm select2">
                                                <option value="">@lang('Select Doctor')</option>
                                                @foreach ($doctors->sortBy(fn($doctors) => strtolower($doctors->name ?? '')) as $doctor)
                                                <option value="{{ $doctor->id }}"
                                                    {{ request()->doctor_id == $doctor->id ? 'selected' : '' }}>
                                                    {{ $doctor->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <div class="form-group mb-2">
                                            <button type="submit" class="btn btn-info btn-sm">@lang('Submit')</button>
                                            @if (request()->isFilterActive)
                                            <a href="{{ route('exam-investigations.index') }}"
                                                class="btn btn-secondary btn-sm ml-2">@lang('Clear')</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0" id="laravel_datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="pl-3">@lang('Examination Number')</th>
                                        <th>@lang('MRN Number')</th>
                                        <th>@lang('Patient')</th>
                                        <th>@lang('Doctor')</th>
                                        <th>@lang('Date Created')</th>
                                        <th data-orderable="false" class="text-right pr-3">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($examInvestigations as $examInvestigation)
                                    <tr>
                                        <td class="pl-3 font-weight-bold text-primary">{{ $examInvestigation->examination_number }}</td>
                                        <td><span class="badge badge-light border">{{ $examInvestigation->patient->patientDetails->mrn_number ?? '-'}}</span></td>
                                        <td>{{ $examInvestigation->patient->name ?? '-' }}</td>
                                        <td>{{ $examInvestigation->doctor->name ?? '-' }}</td>
                                        <td>{{ $examInvestigation->created_at->format('d-m-Y') }}</td>
                                        <td class="text-right pr-3">
                                            <div class="btn-group">
                                                <a href="{{ route('exam-investigations.show', $examInvestigation) }}"
                                                    class="btn btn-sm btn-outline-info"
                                                    data-toggle="tooltip" title="@lang('View')">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                @can('exam-investigations-update')
                                                <a href="{{ route('exam-investigations.edit', $examInvestigation) }}"
                                                    class="btn btn-sm btn-outline-warning ml-1" data-toggle="tooltip"
                                                    title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endcan

                                                @can('exam-investigations-delete')
                                                <a href="#" data-href="{{ route('exam-investigations.destroy', $examInvestigation) }}"
                                                    class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal" data-target="#myModal"
                                                    title="@lang('Delete')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">@lang('No records found')</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white">
                            {{ $examInvestigations->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection