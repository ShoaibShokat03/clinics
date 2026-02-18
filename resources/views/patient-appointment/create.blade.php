@extends('layouts.layout')
@section('content')
<style>
    .custom-flash-message {
        position: fixed;
        top: 10px;
        right: 10px;
        padding: 10px 20px;
        border-radius: 5px;
        color: #fff;
        font-size: 14px;
        z-index: 9999;
        display: none;
    }

    .custom-flash-message.alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .custom-flash-message.alert-success {
        background-color: #d4edda;
        color: #155724;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Add Appointment')</h1>
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

                    <div class="col-12 p-2" id="doctor_availability"></div>

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
                                            <select name="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id" required data-parsley-required="true" data-parsley-required-message="Please select patient.">
                                                <option value="">-- @lang('Select') --</option>
                                                @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                <option value="{{ $patient->id }}" {{ (isset($selectedPatientId) && $selectedPatientId == $patient->id) || old('user_id') == $patient->id ? 'selected' : '' }}>
                                                    {{ $patient->name }} - {{ $patient->patientDetails->mrn_number ?? 'N/A' }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#quickAddPatientModal" title="@lang('Quick Add Patient')">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
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
                                            <select name="doctor_id" class="form-control select2 @error('doctor_id') is-invalid @enderror" id="doctor_id" required data-parsley-required="true" data-parsley-required-message="Please select doctor.">
                                                <option value="">-- @lang('Select') --</option>
                                                @foreach ($doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')) as $doctor)
                                                <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
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
                                            <input type="date" name="appointment_date" id="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" placeholder="@lang('Appointment Date')" value="{{ old('appointment_date') }}" required data-parsley-required="true">
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
                                        <label for="start_time" class="font-weight-bold">@lang('Start Time') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <select name="start_time" class="form-control" id="start_time" required>
                                                <option value="">-- @lang('Select Start Time') --</option>
                                                @for ($time = strtotime('00:00'); $time <= strtotime('23:59'); $time=strtotime('+15 minutes', $time))
                                                    <option value="{{ date('H:i', $time) }}">{{ date('h:i A', $time) }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                        @error('start_time')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="end_time" class="font-weight-bold">@lang('End Time') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <select name="end_time" class="form-control" id="end_time" required>
                                                <option value="">-- @lang('Select End Time') --</option>
                                                @for ($time = strtotime('00:00'); $time <= strtotime('23:59'); $time=strtotime('+15 minutes', $time))
                                                    <option value="{{ date('H:i', $time) }}">{{ date('h:i A', $time) }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                        @error('end_time')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="problem" class="font-weight-bold">@lang('Problem')</label>
                                        <textarea name="problem" id="problem" class="form-control @error('problem') is-invalid @enderror" rows="4" placeholder="@lang('Describe the problem...')">{{ old('problem') }}</textarea>
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

{{-- Quick Add Patient Modal --}}
<div class="modal fade" id="quickAddPatientModal" tabindex="-1" role="dialog" aria-labelledby="quickAddPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="quickAddPatientModalLabel">@lang('Quick Add Patient')</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="quickAddPatientForm">
                <div class="modal-body">
                    <div id="quickAddErrors" class="alert alert-danger d-none"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_name">@lang('Name') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="quick_name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_phone">@lang('Phone') <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="quick_phone" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_email">@lang('Email') <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="quick_email" name="email" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="quick_no_email"> <small class="ml-1">@lang('No Email')</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_gender">@lang('Gender')</label>
                                <select class="form-control" id="quick_gender" name="gender">
                                    <option value="">-- @lang('Select') --</option>
                                    <option value="male">@lang('Male')</option>
                                    <option value="female">@lang('Female')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_cnic">@lang('CNIC') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="quick_cnic" name="cnic" required>
                            </div>
                        </div>
                        <input type="hidden" name="password" value="12345678">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Save Patient')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // No Email Logic
        $('#quick_no_email').change(function() {
            var emailField = $('#quick_email');
            var phoneField = $('#quick_phone');
            if ($(this).is(':checked')) {
                var randomValue = Math.floor(Math.random() * 90000) + 10000;
                emailField.val('noemail' + phoneField.val() + randomValue + '@gmail.com');
                emailField.prop('readonly', true);
            } else {
                emailField.val('');
                emailField.prop('readonly', false);
            }
        });

        // AJAX Submission
        $('#quickAddPatientForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('patient-details.store') }}",
                type: "POST",
                data: formData + "&_token={{ csrf_token() }}",
                success: function(response) {
                    if (response.success) {
                        // Add new option to select2
                        var newOption = new Option(response.data.name + ' - ' + response.data.mrn, response.data.id, true, true);
                        $('#user_id').append(newOption).trigger('change');

                        // Close modal and reset form
                        $('#quickAddPatientModal').modal('hide');
                        $('#quickAddPatientForm')[0].reset();
                        $('#quickAddErrors').addClass('d-none');

                        // Show success message
                        if (typeof toastr !== 'undefined') {
                            toastr.success(response.message);
                        } else {
                            alert(response.message);
                        }
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<ul>';
                    if (errors) {
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                    } else {
                        errorHtml += '<li>' + xhr.statusText + '</li>';
                    }
                    errorHtml += '</ul>';
                    $('#quickAddErrors').html(errorHtml).removeClass('d-none');
                }
            });
        });
        // Time Restriction Logic
        var timeSelects = $('#start_time, #end_time');
        var dateInput = $('#appointment_date');

        function filterTimes() {
            var selectedDateVal = dateInput.val();
            if (!selectedDateVal) return;

            var selectedDate = new Date(selectedDateVal).toISOString().split('T')[0];
            var today = new Date().toISOString().split('T')[0];

            if (selectedDate === today) {
                var now = new Date();
                var currentHour = now.getHours();
                var currentMinutes = now.getMinutes();
                var currentTimeVal = (currentHour * 60) + currentMinutes;

                timeSelects.find('option').each(function() {
                    var val = $(this).val();
                    if (!val) return;

                    var parts = val.split(':');
                    var optionMinutes = (parseInt(parts[0]) * 60) + parseInt(parts[1]);

                    if (optionMinutes < currentTimeVal) {
                        $(this).prop('disabled', true).hide();
                    } else {
                        $(this).prop('disabled', false).show();
                    }
                });

                // Reset if selected is disabled
                timeSelects.each(function() {
                    var selectedOption = $(this).find('option:selected');
                    if (selectedOption.length && selectedOption.prop('disabled')) {
                        $(this).val('');
                    }
                });
            } else {
                timeSelects.find('option').prop('disabled', false).show();
            }
        }

        // Initialize Flatpickr manually
        $("#appointment_date").flatpickr({
            enableTime: false,
            minDate: "today",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                // Manually trigger change for other listeners if needed, or just call filter logic
                filterTimes();
            }
        });

        dateInput.on('change', filterTimes);
        // Also listen to flatpickr change if applicable, though 'change' usually triggers.
        // If flatpickr is instance, we might need hooks, but let's try standard change first.
        filterTimes();

    });
</script>
@endsection

@push('footer')
<script src="{{ asset('assets/js/custom/patient-appointment.js') }}"></script>
@endpush