@extends('layouts.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Add New Plan')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('patient-treatment-plans.index') }}" class="btn btn-outline-primary btn-sm">
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
                            <h3 class="card-title font-weight-bold">@lang('Create Treatment Plan')</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('patient-treatment-plans.store') }}" method="POST"
                                data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Patient') <b class="text-danger">*</b></label>
                                            @if (isset($examinationData))
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-user-injured"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="{{ $examinationData->patient->name }}" readonly>
                                                </div>
                                                <input type="hidden" name="patient_id"
                                                    value="{{ $examinationData->patient_id }}">
                                            @else
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-user-injured"></i></span>
                                                    </div>
                                                    <select
                                                        class="form-control select2 @error('patient_id') is-invalid @enderror"
                                                        id="patient_id" name="patient_id" required
                                                        data-parsley-required="true">
                                                        <option value="">@lang('Select Patient')</option>
                                                        @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                            <option value="{{ $patient->id }}"
                                                                @if (old('patient_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : $selectedPatientId ?? '') ==
                                                                        $patient->id) selected @endif>
                                                                {{ ($patient->name ?? '') . ' - ' . ($patient->patientDetails->mrn_number ?? '') }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('patient_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Examination')</label>
                                            @if (isset($examinationData))
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-plus-square"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="{{ $examinationData->examination_number ?? '-' }}" readonly>
                                                </div>
                                                <input type="hidden" name="examination_id"
                                                    value="{{ $examinationData->id }}">
                                            @else
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-plus-square"></i></span>
                                                    </div>
                                                    <select
                                                        class="form-control @error('examination_id') is-invalid @enderror"
                                                        id="examination_id" name="examination_id">
                                                        <option value="">@lang('Select Teeth Examination')</option>
                                                    </select>
                                                    @error('examination_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Doctor') <b class="text-danger">*</b></label>
                                            @if (isset($examinationData))
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="{{ $examinationData->doctor->name }}" readonly>
                                                </div>
                                                <input type="hidden" name="doctor_id"
                                                    value="{{ $examinationData->doctor_id }}">
                                            @else
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                                    </div>
                                                    <select class="form-control @error('doctor_id') is-invalid @enderror"
                                                        id="doctor_id" name="doctor_id" required
                                                        data-parsley-required="true">
                                                        <option value="">@lang('Select Doctor')</option>
                                                        @foreach ($doctors as $doctor)
                                                            @isset($doctor->user->name)
                                                                <option value="{{ $doctor->user_id }}">
                                                                    {{ $doctor->user->name }}
                                                                </option>
                                                            @endisset
                                                        @endforeach
                                                    </select>
                                                    @error('doctor_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Comments')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                                </div>
                                                <input type="text" name="comments" class="form-control"
                                                    placeholder="@lang('Any internal notes or comments...')" value="{{ old('comments') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12 text-right">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg px-5">@lang('Submit')</button>
                                        <a href="{{ route('patient-treatment-plans.index') }}"
                                            class="btn btn-outline-secondary btn-lg px-5 ml-2">@lang('Cancel')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#patient_id').on('change', function() {
                var patientId = $(this).val();
                $('#examination_id').html('<option value="">@lang('Loading...')</option>');
                $.ajax({
                    url: '{{ route('fetch.procedures') }}',
                    type: 'GET',
                    data: {
                        patient_id: patientId
                    },
                    success: function(data) {
                        var procedures = data.procedures;
                        var options = '<option value="">@lang('Select Examination')</option>';
                        $.each(procedures, function(index, procedure) {
                            options += '<option value="' + procedure.id + '">' +
                                procedure.examination_number + '</option>';
                        });
                        $('#examination_id').html(options);
                    },
                    error: function() {
                        $('#examination_id').html(
                            '<option value="">@lang('Error loading examinations')</option>');
                    }
                });
            });

            $('#examination_id').on('change', function() {
                var examinationId = $(this).val();
                if (!examinationId) return;
                $.ajax({
                    url: '{{ route('fetch.teeth') }}',
                    type: 'GET',
                    data: {
                        examination_id: examinationId
                    },
                    success: function(data) {
                        var doctor = data.doctorDetails;
                        if (doctor) {
                            $('#doctor_id').val(doctor.id).trigger('change');
                        }
                    }
                });
            });
        });
    </script>
@endsection
