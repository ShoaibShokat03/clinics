@extends('layouts.layout')

@section('content')
<style>
    body {
        overflow-x: hidden;
    }
</style>
<section class="content-header">
    <meta name="base-url" content="{{ url('/') }}">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <div class="d-flex align-items-center">
                    <h1 class="m-0 text-dark mr-3">@lang('Edit Prescription')</h1>
                </div>
            </div>
            <div class="col-sm-6 text-right">
            
                    <a href="{{ route('prescriptions.create') }}" class="btn btn-outline-primary btn-sm mr-2">
                        <i class="fas fa-plus"></i> @lang('New')
                    </a>
                <a href="{{ route('prescriptions.show', $prescription) }}" class="btn btn-outline-info btn-sm mr-2">
                    <i class="fas fa-print"></i> @lang('Print')
                </a>
                <a href="{{ route('prescriptions.index') }}" class="btn btn-outline-secondary btn-sm">
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
                        <form id="prescriptionForm" action="{{ route('prescriptions.update', $prescription) }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_id" class="font-weight-bold">@lang('Select Patient') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                            </div>
                                            <select name="user_id" id="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" required data-parsley-required="true" data-parsley-required-message="Please select patient.">
                                                <option value="">-- @lang('Select') --</option>
                                                @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                <option value="{{ $patient->id }}" {{ $patient->id == $prescription->user_id ? 'selected' : '' }}>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prescription_date" class="font-weight-bold">@lang('Prescription Date') <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="text" name="prescription_date" id="prescription_date" class="form-control flatpickr @error('prescription_date') is-invalid @enderror" placeholder="@lang('Prescription Date')" value="{{ old('prescription_date', $prescription->prescription_date) }}" required>
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
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Medical History</a>
                                        </li>
                                        <!-- Other tabs -->
                                        <li class="nav-item"><a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab">Drug History</a></li>
                                        <li class="nav-item"><a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab">Social History</a></li>
                                        <li class="nav-item"><a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab">Dental History</a></li>
                                    </ul>
                                    <div class="tab-content p-3 border border-top-0" id="myTabContent">
                                        <!-- Tab Contents -->
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"></div>
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
                                            <tbody id="medicine-rows">
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
                                                @else
                                                @foreach ($prescription->patientmedicineitem as $item)
                                                <tr>
                                                    <td>
                                                        <select name="medicine_type[]" class="form-control form-control-sm">
                                                            <option value="" disabled>@lang('Type')</option>
                                                            @foreach ($medicineTypes as $type)
                                                            <option value="{{ $type->id }}" {{ $item->medicine_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="medicine_name[]" class="form-control form-control-sm">
                                                            <option value="" disabled>@lang('Name')</option>
                                                            @foreach ($medicineNames as $medicineName)
                                                            <option value="{{ $medicineName->id }}" {{ $item->medicine_id == $medicineName->id ? 'selected' : '' }}>{{ $medicineName->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="medicine_description[]" class="form-control form-control-sm" value="{{ $item->instruction }}">
                                                    </td>
                                                    <td>
                                                        <select name="days[]" class="form-control form-control-sm">
                                                            <option value="">0</option>
                                                            @for ($i = 1; $i <= 31; $i++)
                                                                <option value="{{ $i }}" {{ ($item->days == $i || $item->days == (string)$i) ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                        </select>
                                                    </td>
                                                    <td style="display: none;">
                                                        <select name="weeks[]" class="form-control form-control-sm">
                                                            <option value="">0</option>
                                                            @for ($i = 1; $i <= 52; $i++)
                                                                <option value="{{ $i }}" {{ ($item->weeks == $i || $item->weeks == (string)$i) ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                        </select>
                                                    </td>
                                                    <td style="display: none;">
                                                        <select name="months[]" class="form-control form-control-sm">
                                                            <option value="">0</option>
                                                            @for ($i = 1; $i <= 12; $i++)
                                                                <option value="{{ $i }}" {{ ($item->months == $i || $item->months == (string)$i) ? 'selected' : '' }}>{{ $i }}</option>
                                                                @endfor
                                                        </select>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <button type="button" class="btn btn-sm btn-primary m-add"><i class="fas fa-plus"></i></button>
                                                        <button type="button" class="btn btn-sm btn-outline-danger m-remove"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden Template for JS -->
                            <table style="display: none;">
                                <tbody id="medicine-template">
                                    <tr>
                                        <td>
                                            <select name="medicine_type[]" class="form-control form-control-sm">
                                                <option value="" disabled selected>@lang('Select Type')</option>
                                                @foreach ($medicineTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="medicine_name[]" class="form-control form-control-sm">
                                                <option value="" disabled selected>@lang('Select Name')</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="medicine_description[]" class="form-control form-control-sm" placeholder="@lang('Description')"></td>
                                        <td>
                                            <select name="days[]" class="form-control form-control-sm">
                                                <option value="">0</option>
                                                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
                                            </select>
                                        </td>
                                        <td style="display:none;">
                                            <select name="weeks[]" class="form-control form-control-sm">
                                                <option value="">0</option>
                                                @for ($i = 1; $i <= 52; $i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
                                            </select>
                                        </td>
                                        <td style="display:none;">
                                            <select name="months[]" class="form-control form-control-sm">
                                                <option value="">0</option>
                                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
                                            </select>
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-sm btn-primary m-add"><i class="fas fa-plus"></i></button>
                                            <button type="button" class="btn btn-sm btn-outline-danger m-remove"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="note" class="font-weight-bold">@lang('Note')</label>
                                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" rows="3" placeholder="@lang('Note')">{{ old('note', $prescription->note) }}</textarea>
                                        @error('note')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right mt-3">
                                    <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                    <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary ml-2">@lang('Cancel')</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if ($logs && $logs->count() > 0)
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-white p-3 border-bottom-0">
                        <h3 class="card-title font-weight-bold ml-1">@lang('User Logs')</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>@lang('User')</th>
                                        <th>@lang('Action')</th>
                                        <th>@lang('Table')</th>
                                        <th>@lang('Column')</th>
                                        <th>@lang('Old Value')</th>
                                        <th>@lang('New Value')</th>
                                        <th>@lang('Timestamp')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ $log->user->name }}</td>
                                        <td>{{ $log->action }}</td>
                                        <td>{{ $log->table_name }}</td>
                                        <td>{{ $log->field_name }}</td>
                                        <td>{{ $log->old_value }}</td>
                                        <td>{{ $log->new_value }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let template = $("#medicine-template").html();
        var baseUrl = $('meta[name="base-url"]').attr("content");

        // Add/Remove logic
        $(document).on("click", ".m-add", function() {
            $("#medicine-rows").append(template);
        });
        $(document).on("click", ".m-remove", function() {
            if ($("#medicine-rows tr").length > 1) {
                $(this).closest("tr").remove();
            } else {
                alert("You must have at least one medicine row.");
            }
        });

        // Dynamic Types/Names logic
        $("body").on("change", 'select[name="medicine_type[]"]', function() {
            var medicineTypeId = $(this).val();
            var $medicineNameDropdown = $(this).closest("tr").find('select[name="medicine_name[]"]');
            $medicineNameDropdown.empty();
            $.ajax({
                url: baseUrl + "/getmedicinestype/" + medicineTypeId,
                type: "GET",
                success: function(data) {
                    $.each(data, function(key, value) {
                        $medicineNameDropdown.append('<option value="' + value.id + '">' + value.name + "</option>");
                    });
                    if (data.length > 0) $medicineNameDropdown.val(data[0].id).trigger('change');
                },
            });
        });

        $("body").on("change", 'select[name="medicine_name[]"]', function() {
            var medicineId = $(this).val();
            var $descriptionField = $(this).closest("tr").find('input[name="medicine_description[]"]');
            $descriptionField.val("");
            $.ajax({
                url: baseUrl + "/getmedicinedescription/" + medicineId,
                type: "GET",
                success: function(data) {
                    if (data && data.description) $descriptionField.val(data.description);
                },
            });
        });

        // Procedure Fetching Logic (Preserved)
        function fetchProcedures(userId, selectedProcedureId) {
            $.ajax({
                url: '{{ route("fetchexamination") }}',
                type: 'GET',
                data: {
                    user_id: userId
                },
                success: function(data) {
                    var options = '<option value="" disabled>Select Examination</option>';
                    $.each(data.examInvestigations, function(index, exam) {
                        options += '<option value="' + exam.id + '"' + (exam.id == selectedProcedureId ? ' selected' : '') + '>' + exam.examination_number + '</option>';
                    });
                    $('#examination_id').html(options);
                }
            });
        }

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        var userId = getUrlParameter('user_id');
        if (userId) fetchProcedures(userId, '{{ $prescription->examination_id }}');

        $('#user_id').on('change', function() {
            fetchProcedures($(this).val(), '');
        });
    });
</script>
@endsection