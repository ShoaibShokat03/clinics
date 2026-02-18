@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Edit Appointment')</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('patient-appointments.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> @lang('Back to List')
                </a>
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
                        <h3 class="card-title font-weight-bold ml-1">@lang('Appointment Details')</h3>
                    </div>
                    <div class="card-body">
                        <form id="scheduleForm" action="{{ route('patient-appointments.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_id" class="font-weight-bold">@lang('Select Patient') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                            </div>
                                            <select name="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id" required>
                                                <option value="">-- @lang('Select') --</option>
                                                @foreach ($patients->sortBy(fn($patient) => strtolower($patient->user->name ?? '')) as $patient)
                                                <option value="{{ $patient->id }}" {{ old('user_id', $patientAppointment->user_id) == $patient->id ? 'selected' : '' }}>
                                                    {{ $patient->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('user_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="doctor_id" class="font-weight-bold">@lang('Select Doctor') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                            </div>
                                            <select name="doctor_id" class="form-control select2 @error('doctor_id') is-invalid @enderror" id="doctor_id" required>
                                                <option value="">-- @lang('Select') --</option>
                                                @foreach ($doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')) as $doctor)
                                                <option value="{{ $doctor->id }}" {{ old('doctor_id', $patientAppointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                                    {{ $doctor->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('doctor_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="appointment_date" class="font-weight-bold">@lang('Appointment Date') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                            </div>
                                            <input type="text" name="appointment_date" id="appointment_date" class="form-control flatpickr @error('appointment_date') is-invalid @enderror" placeholder="@lang('Appointment Date')" value="{{ old('appointment_date', $patientAppointment->appointment_date) }}" required>
                                        </div>
                                        @error('appointment_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="appointment_slot" class="font-weight-bold">@lang('Available Slots') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                            </div>
                                            <select name="appointment_slot" id="appointment_slot" class="form-control @error('appointment_slot') is-invalid @enderror" required>
                                                <!-- Populated by JS -->
                                            </select>
                                        </div>
                                        @error('appointment_slot')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="problem" class="font-weight-bold">@lang('Problem')</label>
                                        <textarea name="problem" id="problem" class="form-control @error('problem') is-invalid @enderror" rows="1" placeholder="@lang('Describe the problem...')">{{ old('problem', $patientAppointment->problem) }}</textarea>
                                        @error('problem')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right mt-3">
                                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                                    <a href="{{ route('patient-appointments.index') }}" class="btn btn-secondary ml-2">@lang('Cancel')</a>
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

@push('footer')
<script src="{{ asset('assets/js/custom/patient-appointment.js') }}"></script>
@endpush