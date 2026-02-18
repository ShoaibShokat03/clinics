@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Doctor Schedule Details')</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('doctor-schedules.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> @lang('Back to List')
                </a>
            </div>
        </div>
    </div>
</section>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3 border-bottom-0 d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold">@lang('Schedule Information')</h3>
                        @can('doctor-schedule-update')
                        <a href="{{ route('doctor-schedules.edit', $doctorSchedule) }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit"></i> @lang('Edit')
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="text-secondary small font-weight-bold mb-0 text-uppercase">@lang('Doctor Name')</label>
                                    <p class="h6 font-weight-bold mb-0 text-primary">{{ $doctorSchedule->user->name ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="text-secondary small font-weight-bold mb-0 text-uppercase">@lang('Weekday')</label>
                                    <p class="h6 font-weight-bold mb-0 text-info">{{ ucfirst($doctorSchedule->weekday) }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="text-secondary small font-weight-bold mb-0 text-uppercase">@lang('Status')</label>
                                    <p class="mb-0">
                                        @if($doctorSchedule->status == '1')
                                        <span class="badge badge-success px-3 py-2">@lang('Active')</span>
                                        @else
                                        <span class="badge badge-danger px-3 py-2">@lang('Inactive')</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="text-secondary small font-weight-bold mb-0 text-uppercase">@lang('Shift Hours')</label>
                                    <p class="h6 font-weight-bold mb-0">
                                        <i class="fas fa-clock mr-2 text-warning"></i>
                                        {{ $doctorSchedule->start_time }} - {{ $doctorSchedule->end_time }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="text-secondary small font-weight-bold mb-0 text-uppercase">@lang('Avg Appointment Duration')</label>
                                    <p class="h6 font-weight-bold mb-0">
                                        <i class="fas fa-hourglass-half mr-2 text-secondary"></i>
                                        {{ $doctorSchedule->avg_appointment_duration }} @lang('Minutes')
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="text-secondary small font-weight-bold mb-0 text-uppercase">@lang('Serial Type')</label>
                                    <p class="h6 font-weight-bold mb-0">
                                        <i class="fas fa-list-ol mr-2 text-dark"></i>
                                        {{ $doctorSchedule->serial_type }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="text-secondary small font-weight-bold mb-0 text-uppercase">@lang('Created By')</label>
                                    <p class="font-weight-normal mb-0 small text-muted">
                                        {{ $doctorSchedule->createdBy->name ?? '-' }} (@lang('at') {{ $doctorSchedule->created_at->format('Y-m-d H:i') }})
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection