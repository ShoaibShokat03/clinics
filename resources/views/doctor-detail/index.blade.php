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
                <h1 class="m-0 text-dark">@lang('Doctor List')</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('doctor-detail-create')
                <a href="{{ route('doctor-details.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> @lang('Add Doctor')
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
                        <h3 class="card-title font-weight-bold ml-1">@lang('Filter Doctors')</h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-primary btn-sm" target="_blank"
                                href="{{ route('doctor-details.index') }}?export=1">
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
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Name')</label>
                                            <input type="text" name="name" class="form-control form-control-sm"
                                                value="{{ request()->name }}" placeholder="@lang('Name')">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Email')</label>
                                            <input type="text" name="email" class="form-control form-control-sm"
                                                value="{{ request()->email }}" placeholder="@lang('Email')">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Phone')</label>
                                            <input type="text" name="phone" class="form-control form-control-sm"
                                                value="{{ request()->phone }}" placeholder="@lang('Phone')">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Status')</label>
                                            <select name="status" class="form-control form-control-sm">
                                                <option value="">-- @lang('Select') --</option>
                                                <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>@lang('Active')
                                                </option>
                                                <option value="0" {{ request()->status == '0' ? 'selected' : '' }}>@lang('Inactive')
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Start Date')</label>
                                            <input type="text" name="start_date" id="start_date"
                                                class="form-control form-control-sm flatpickr" placeholder="@lang('Start Date')"
                                                value="{{ old('start_date', request()->start_date) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-right mt-4">
                                        <button type="submit" class="btn btn-info btn-sm">@lang('Submit')</button>
                                        @if(request('isFilterActive'))
                                        <a href="{{ route('doctor-details.index') }}" class="btn btn-secondary btn-sm ml-2">@lang('Clear')</a>
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
                                        <!-- <th>@lang('Photo')</th> -->
                                        <th>@lang('Name')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Phone')</th>
                                        <th>@lang('Specialist')</th>
                                        <th>@lang('Status')</th>
                                        <th data-orderable="false">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctorDetails as $doctorDetail)
                                    <tr>
                                        <!-- <td>
                                            <img src="{{ $doctorDetail->user->photo_url }}" class="img-circle elevation-2" alt="User Image" height="40" width="40" style="object-fit: cover;">
                                        </td> -->
                                        <td>{{ $doctorDetail->user->name ?? '-' }}</td>
                                        <td>{{ $doctorDetail->user->email ?? '-' }}</td>
                                        <td>{{ $doctorDetail->user->phone ?? '-' }}</td>
                                        <td>{{ $doctorDetail->specialist ?? '-' }}</td>
                                        <td>
                                            @if($doctorDetail->user->status == 1)
                                            <span class="badge badge-success">@lang('Active')</span>
                                            @else
                                            <span class="badge badge-danger">@lang('Inactive')</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                @can('doctor-menu-read')
                                                <button type="button" class="btn btn-sm btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="@lang('Menu')">
                                                    <i class="fas fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('doctor-schedules.createFromDoctorDetails', ['userid' => $doctorDetail->user->id]) }}">
                                                        @lang('Create New Schedule')
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('doctor-schedules.index', ['userid' => $doctorDetail->user->id]) }}">
                                                        @lang('View Schedules')
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('patient-appointments.index', ['userid' => $doctorDetail->user->id]) }}">
                                                        @lang('View Appointments')
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('exam-investigations.index', ['doctor_id' => $doctorDetail->id]) }}">
                                                        @lang('View Exam & Investigations')
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('prescriptions.index', ['doctor_id' => $doctorDetail->user->id]) }}">
                                                        @lang('View Prescriptions')
                                                    </a>
                                                </div>
                                                @endcan
                                                <a href="{{ route('doctor-schedules.bulk-edit', ['userid' => $doctorDetail->user->id]) }}" class="btn btn-sm btn-outline-success ml-1" data-toggle="tooltip" title="@lang('Manage Weekly Schedule')">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </a>
                                                <a href="{{ route('doctor-details.show', $doctorDetail) }}" class="btn btn-sm btn-outline-info ml-1" data-toggle="tooltip" title="@lang('View')">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @can('doctor-detail-update')
                                                <a href="{{ route('doctor-details.edit', $doctorDetail) }}" class="btn btn-sm btn-outline-warning ml-1" data-toggle="tooltip" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('doctor-detail-delete')
                                                <a href="#" data-href="{{ route('doctor-details.destroy', $doctorDetail) }}" class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal" data-target="#myModal" title="@lang('Delete')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white">
                            {{ $doctorDetails->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection