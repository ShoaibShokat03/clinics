@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Add Prescription')</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('prescriptions.index') }}" class="btn btn-outline-primary btn-sm">
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
                        <h3 class="card-title font-weight-bold ml-1">@lang('Prescription Details')</h3>
                    </div>
                    <div class="card-body">
                        <form id="prescriptionForm" action="{{ route('prescriptions.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_id" class="font-weight-bold">@lang('Select Patient') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                            </div>
                                            <select name="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id" required data-parsley-required-message="@lang('Please select a patient')">
                                                <option value="">-- @lang('Select') --</option>
                                                @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                <option value="{{ $patient->id }}" {{ old('user_id') == $patient->id ? 'selected' : '' }}>
                                                    {{ $patient->name }} - {{ $patient->patientDetails->mrn_number ?? ' ' }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('user_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prescription_date" class="font-weight-bold">@lang('Prescription Date') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="text" name="prescription_date" id="prescription_date" class="form-control flatpickr @error('prescription_date') is-invalid @enderror" placeholder="@lang('Prescription Date')" value="{{ old('prescription_date', date('Y-m-d')) }}" required>
                                        </div>
                                        @error('prescription_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden History Section -->
                            <div id="history" class="collapse">
                                <div class="card-body border rounded mb-3">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Medical History</a></li>
                                        <li class="nav-item"><a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab">Drug History</a></li>
                                        <li class="nav-item"><a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab">Social History</a></li>
                                        <li class="nav-item"><a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab">Dental History</a></li>
                                    </ul>
                                    <div class="tab-content p-3 border border-top-0" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"></div>
                                        <!-- Other tabs placeholders -->
                                    </div>
                                </div>
                            </div>

                            <!-- Medicines Table -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="font-weight-bold border-bottom pb-2 mb-3">@lang('Medicines')</h5>
                                    <div class="table-responsive">
                                        <table id="t1" class="table table-bordered table-striped">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th style="min-width: 150px;">@lang('Type')</th>
                                                    <th style="min-width: 200px;">@lang('Medicine Name')</th>
                                                    <th style="min-width: 200px;">@lang('Description')</th>
                                                    <th>@lang('Days')</th>
                                                    <th style="display: none;">@lang('Weeks')</th>
                                                    <th style="display: none;">@lang('Months')</th>
                                                    <th class="text-center" style="width: 120px;">@lang('Actions')</th>
                                                </tr>
                                            </thead>
                                            <tbody id="medicine">
                                                @if (old('medicine_name'))
                                                @foreach (old('medicine_name') as $key => $value)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="medicine_type[]" class="form-control form-control-sm" value="{{ old('medicine_type')[$key] }}" placeholder="@lang('Type')">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="medicine_name[]" class="form-control form-control-sm" value="{{ old('medicine_name')[$key] }}" placeholder="@lang('Name')">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="medicine_description[]" class="form-control form-control-sm" value="{{ old('medicine_description')[$key] }}" placeholder="@lang('Description')">
                                                    </td>
                                                    <td>
                                                        <select name="days[]" class="form-control form-control-sm">
                                                            <option value="">0</option>
                                                            @for ($i=1; $i<=31; $i++)
                                                                <option value="{{ $i }}" {{ (old('days') && isset(old('days')[$key]) && (old('days')[$key] == $i)) ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                        </select>
                                                    </td>
                                                    <td style="display: none;">
                                                        <select name="weeks[]" class="form-control form-control-sm">
                                                            <option value="">0</option>
                                                            @for ($i=1; $i<=52; $i++)
                                                                <option value="{{ $i }}" {{ (old('weeks') && isset(old('weeks')[$key]) && (old('weeks')[$key] == $i)) ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                        </select>
                                                    </td>
                                                    <td style="display: none;">
                                                        <select name="months[]" class="form-control form-control-sm">
                                                            <option value="">0</option>
                                                            @for ($i=1; $i<=12; $i++)
                                                                <option value="{{ $i }}" {{ (old('months') && isset(old('months')[$key]) && (old('months')[$key] == $i)) ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                        </select>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <button type="button" class="btn btn-sm btn-outline-danger m-remove"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                                <!-- Template Row (Visible for new entry) -->
                                                <tr>
                                                    <td>
                                                        <select name="medicine_type[]" class="form-control form-control-sm @error('medicine_type') is-invalid @enderror" id="medicine_type">
                                                            <option value="" disabled selected>@lang('Select Type')</option>
                                                            @foreach ($medicineTypes as $medicineType)
                                                            <option value="{{ $medicineType->id }}">{{ $medicineType->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="medicine_name[]" class="form-control form-control-sm @error('medicine_name') is-invalid @enderror" id="medicine_name">
                                                            <option value="" disabled selected>@lang('Select Medicine')</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="medicine_description[]" class="form-control form-control-sm" id="medicine_description" placeholder="@lang('Description')">
                                                    </td>
                                                    <td>
                                                        <select name="days[]" class="form-control form-control-sm" id="days">
                                                            <option value="">0</option>
                                                            @for ($i=1; $i<=31; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                        </select>
                                                    </td>
                                                    <td style="display: none;">
                                                        <select name="weeks[]" class="form-control form-control-sm" id="weeks">
                                                            <option value="">0</option>
                                                            @for ($i=1; $i<=52; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                        </select>
                                                    </td>
                                                    <td style="display: none;">
                                                        <select name="months[]" class="form-control form-control-sm" id="months">
                                                            <option value="">0</option>
                                                            @for ($i=1; $i<=12; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                        </select>
                                                    </td>
                                                    <td class="d-flex text-center align-middle" style="gap:5px;">
                                                        <button type="button" class="btn btn-sm btn-primary m-add"><i class="fas fa-plus"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger m-remove"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="note" class="font-weight-bold">@lang('Note')</label>
                                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" rows="3" placeholder="@lang('Add a note...')">{{ old('note') }}</textarea>
                                        @error('note')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right mt-3">
                                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                                    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary ml-2">@lang('Cancel')</a>
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
        function getQueryParam(param) {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        var storedUserId = getQueryParam('user_id');
        if (storedUserId) {
            $('#user_id').val(storedUserId).trigger('change');
        }

        function fetchProcedures(userId) {
            $.ajax({
                url: '{{ route("fetchexamination") }}',
                type: 'GET',
                data: {
                    user_id: userId
                },
                success: function(data) {
                    var examInvestigations = data.examInvestigations;
                    var options = '<option value="" disabled selected>Select Examination</option>';
                    $.each(examInvestigations, function(index, examInvestigation) {
                        options += '<option value="' + examInvestigation.id + '">' + examInvestigation.examination_number + '</option>';
                    });
                    $('#examination_id').html(options);
                },
                error: function() {
                    // Silent fail
                }
            });
        }

        $('#user_id').on('change', function() {
            var userId = $(this).val();
            if (userId) fetchProcedures(userId);
        });
    });
</script>
@endsection

@push('footer')
<script>
    var getMedicineUrl = '{{ url("getmedicinestype") }}/{medicineId}';
    var getMedicineDescriptionUrl = '{{ url("getmedicinedescription") }}/{medicineId}';
</script>
<script src="{{ asset('assets/js/custom/prescription.js') }}"></script>
@endpush