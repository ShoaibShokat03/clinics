@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Prescription List')</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('prescription-create')
                <a href="{{ route('prescriptions.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> @lang('Add Prescription')
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
                        <h3 class="card-title font-weight-bold ml-1">@lang('Filter Prescriptions')</h3>
                        <div class="card-tools">
                            <button class="btn btn-outline-secondary btn-sm" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> @lang('Filter')
                            </button>
                        </div>
                    </div>

                    <div id="filter" class="collapse @if(request('isFilterActive')) show @endif">
                        <div class="card-body p-3 bg-light border-bottom">
                            <form action="" method="get" role="form" autocomplete="off">
                                <input type="hidden" name="isFilterActive" value="true">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Patient')</label>
                                            <select name="user_id" class="form-control form-control-sm select2" id="user_id">
                                                <option value="">--@lang('Select')--</option>
                                                @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                <option value="{{ $patient->id }}" {{ (is_array(request('user_id')) ? '' : request('user_id')) == $patient->id ? 'selected' : '' }}>
                                                    {{ $patient->name }} - {{ $patient->patientDetails->mrn_number ?? '' }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Doctor')</label>
                                            <select name="doctor_id" class="form-control form-control-sm select2" id="doctor_id">
                                                <option value="">--@lang('Select')--</option>
                                                @foreach ($doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')) as $doctor)
                                                <option value="{{ $doctor->id }}" {{ (is_array(request('doctor_id')) ? '' : request('doctor_id')) == $doctor->id ? 'selected' : '' }}>
                                                    {{ $doctor->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Prescription Date')</label>
                                            <input type="text" name="prescription_date" id="prescription_date" class="form-control form-control-sm flatpickr" placeholder="@lang('Date')" value="{{ is_array(request('prescription_date')) ? '' : request('prescription_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Start Date')</label>
                                            <input type="text" name="start_date" id="start_date" class="form-control form-control-sm flatpickr" placeholder="@lang('Start')" value="{{ is_array(request('start_date')) ? '' : request('start_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('End Date')</label>
                                            <input type="text" name="end_date" id="end_date" class="form-control form-control-sm flatpickr" placeholder="@lang('End')" value="{{ is_array(request('end_date')) ? '' : request('end_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-right mt-4">
                                        <button type="submit" class="btn btn-info btn-sm">@lang('Submit')</button>
                                        @if(request('isFilterActive'))
                                        <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary btn-sm ml-2">@lang('Clear')</a>
                                        @endif
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
                                        <th>Doctor</th>
                                        <th>Patient</th>
                                        <th>@lang('Date')</th>
                                        <th data-orderable="false" class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prescriptions as $prescription)
                                    <tr>
                                        <td class="align-middle">{{ $prescription->doctor->name ?? '-' }}</td>
                                        <td class="align-middle">{{ $prescription->user->name ?? '-' }}</td>
                                        <td class="align-middle">{{ date($companySettings->date_format ?? 'Y-m-d', strtotime($prescription->prescription_date)) }}</td>
                                        <td class="align-middle text-right">
                                            <div class="btn-group">
                                                <a href="{{ route('prescriptions.show', $prescription) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="@lang('View')">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @can('prescription-update')
                                                <a href="{{ route('prescriptions.edit', $prescription) }}?user_id={{ $prescription->user_id }}" class="btn btn-sm btn-outline-warning ml-1" data-toggle="tooltip" title="@lang('Edit')">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('prescription-delete')
                                                <a href="#" data-href="{{ route('prescriptions.destroy', $prescription) }}" class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal" data-target="#myModal" title="@lang('Delete')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        {{ $prescriptions->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer')
@include('layouts.delete_modal')
@endpush