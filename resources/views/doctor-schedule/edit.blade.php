@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Edit Doctor Schedule')</h1>
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
                    <div class="card-header bg-white p-3 border-bottom-0">
                        <h3 class="card-title font-weight-bold">@lang('Schedule Information')</h3>
                    </div>
                    <div class="card-body">
                        <form id="scheduleForm" class="form-material form-horizontal" action="{{ route('doctor-schedules.update', $doctorSchedule) }}" method="POST" data-parsley-validate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small" for="user_id">@lang('Select Doctor') <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                            </div>
                                            <select name="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id" required>
                                                <option value="">--@lang('Select')--</option>
                                                @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}" {{ old('user_id', $doctorSchedule->user_id) == $doctor->id ? 'selected' : '' }}>
                                                    {{ $doctor->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('user_id')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small" for="weekday">@lang('Select Weekday') <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                            </div>
                                            <select name="weekday" class="form-control @error('weekday') is-invalid @enderror" id="weekday" required>
                                                <option value="">--@lang('Select')--</option>
                                                @foreach (config('constant.weekdays') as $weekday)
                                                <option value="{{ $weekday }}" {{ old('weekday', $doctorSchedule->weekday) == $weekday ? 'selected' : '' }}>@lang($weekday)</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('weekday')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small" for="status">@lang('Status') <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                            </div>
                                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                                <option value="1" {{ old('status', $doctorSchedule->status) == '1' ? 'selected' : '' }}>@lang('Active')</option>
                                                <option value="0" {{ old('status', $doctorSchedule->status) == '0' ? 'selected' : '' }}>@lang('Inactive')</option>
                                            </select>
                                        </div>
                                        @error('status')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small" for="start_time">@lang('Start Time') <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="text" name="start_time" id="start_time" class="form-control flatpickr-pick-time @error('start_time') is-invalid @enderror" value="{{ old('start_time', $doctorSchedule->start_time) }}" required>
                                        </div>
                                        @error('start_time')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small" for="end_time">@lang('End Time') <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="text" name="end_time" id="end_time" class="form-control flatpickr-pick-time @error('end_time') is-invalid @enderror" value="{{ old('end_time', $doctorSchedule->end_time) }}" required>
                                        </div>
                                        @error('end_time')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small" for="avg_appointment_duration">@lang('Duration (Mins)') <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                                            </div>
                                            <input type="number" name="avg_appointment_duration" id="avg_appointment_duration" class="form-control @error('avg_appointment_duration') is-invalid @enderror" value="{{ old('avg_appointment_duration', $doctorSchedule->avg_appointment_duration) }}" required min="1">
                                        </div>
                                        @error('avg_appointment_duration')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small" for="serial_type">@lang('Serial Type') <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                                            </div>
                                            <select name="serial_type" class="form-control @error('serial_type') is-invalid @enderror" id="serial_type" required>
                                                <option value="Sequential" {{ old('serial_type', $doctorSchedule->serial_type) == 'Sequential' ? 'selected' : '' }}>@lang('Sequential')</option>
                                                <option value="Social" {{ old('serial_type', $doctorSchedule->serial_type) == 'Social' ? 'selected' : '' }}>@lang('Social')</option>
                                            </select>
                                        </div>
                                        @error('serial_type')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right mt-3">
                                    <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                    <a href="{{ route('doctor-schedules.index') }}" class="btn btn-secondary ml-2">@lang('Cancel')</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection