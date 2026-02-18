@extends('layouts.layout')
<style>
    .err-message~.parsley-errors-list {
        width: 41%;
        top: 96px;
    }

    tr td button.btn {
        padding: 3px !important;
    }
</style>
@push('header')
    @if (old('account_name') || isset($invoice->invoiceItems))
        <meta name="clear-invoice-html" content="clean">
    @endif
    <meta name="invoice-total" content="{{ old('total', $invoice->total ?? 0) }}">
    <meta name="invoice-grand-total" content="{{ old('grand_total', $invoice->grand_total ?? 0) }}">
@endpush

@section('content')
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-gray-800">@lang('Add Invoice')</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> @lang('Back to List')
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light border-bottom">
                    <h5 class="card-title mb-0 font-weight-bold">@lang('Invoice Information')</h5>
                </div>
                <div class="card-body p-4">
                    <form class="form-material form-horizontal bg-custom" action="{{ route('invoices.store') }}"
                        method="POST" data-parsley-validate>
                        @csrf
                        <div class="row col-12 p-0 m-0">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="user_id">@lang('Patient')</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                        </div>
                                        <select name="user_id"
                                            class="form-control select2 @error('user_id') is-invalid @enderror" required
                                            id="user_id" data-parsley-required="true"
                                            data-parsley-required-message="@lang('Please select patient')"
                                            {{ isset($patientTreatmentPlan) ? 'disabled' : '' }}>
                                            <option value="Select Patient" disabled
                                                {{ old('user_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : null) == null ? 'selected' : '' }}>
                                                {{ isset($patientTreatmentPlan) ? '' : 'Select Patient' }}
                                            </option>
                                            @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                <option value="{{ $patient->id }}"
                                                    @if (old('user_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : '') == $patient->id) selected @endif>
                                                    {{ ($patient->name ?? '') . ' - ' . ($patient->patientDetails->mrn_number ?? '') }}

                                                </option>
                                            @endforeach
                                        </select>
                                        @if (isset($patientTreatmentPlan))
                                            <input type="hidden" name="user_id"
                                                value="{{ $patientTreatmentPlan->patient_id }}">
                                            <input type="hidden" name="patient_treatment_plan_id"
                                                value="{{ $patientTreatmentPlan->id }}">
                                        @endif
                                        @error('user_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="doctor_id">@lang('Doctor')</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                        </div>
                                        <select name="doctor_id"
                                            class="form-control select2 @error('doctor_id') is-invalid @enderror" required
                                            id="doctor_id" data-parsley-required="true"
                                            data-parsley-required-message="@lang('Please select doctor')"
                                            {{ isset($patientTreatmentPlan) ? 'disabled' : '' }}>
                                            <option value="Select Doctor" disabled
                                                {{ old('doctor_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->doctor_id : null) == null ? 'selected' : '' }}>
                                                {{ isset($patientTreatmentPlan) ? '' : 'Select Doctor' }}
                                            </option>
                                            @foreach ($doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')) as $doctor)
                                                <option value="{{ $doctor->id }}"
                                                    @if (old('doctor_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->doctor_id : '') == $doctor->id) selected @endif>
                                                    {{ $doctor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if (isset($patientTreatmentPlan))
                                            <input type="hidden" name="doctor_id"
                                                value="{{ $patientTreatmentPlan->doctor_id }}">
                                        @endif
                                        @error('doctor_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label>@lang('Invoice Date') <b class="ambitious-crimson">*</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" name="invoice_date" id="invoice_date"
                                            class="form-control flatpickr @error('invoice_date') is-invalid @enderror"
                                            placeholder="@lang('Invoice Date')"
                                            value="{{ old('invoice_date', date('Y-m-d')) }}" required
                                            data-parsley-required="true">
                                    </div>
                                    @error('invoice_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="hidden" id="commission_percentage" name="commission_percentage"
                                            value="{{ old('commission_percentage', isset($percentage) ? $percentage : '') }}"
                                            class="form-control @error('commission_percentage') is-invalid @enderror"
                                            placeholder="@lang('0.0')"
                                            {{ isset($percentage) ? 'readonly' : 'required' }}>
                                        @error('commission_percentage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="t1" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="custom-th-width-20">Category<b
                                                        class="ambitious-crimson">*</b></th>

                                                <th scope="col" class="custom-th-width-20">Procedure (CPT)<b
                                                        class="ambitious-crimson">*</b></th>
                                                <th scope="col" class="custom-th-width-25">@lang('Description')</th>
                                                <th scope="col">@lang('Quantity')</th>
                                                <th scope="col" class="custom-th-width-15">@lang('Price')</th>
                                                <th scope="col" class="custom-th-width-15">@lang('Sub Total')</th>
                                                <th scope="col" class="custom-white-space">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoice-body">
                                            @if (isset($patientTreatmentPlanProcedures))
                                                @foreach ($patientTreatmentPlanProcedures as $planProcedure)
                                                    <tr>
                                                        <td style="padding-bottom: 30px;">
                                                            <input type="hidden"
                                                                name="patient_treatment_plan_procedure_id[]"
                                                                value="{{ $planProcedure->id }}">

                                                            <input type="hidden" name="account_name[]"
                                                                value="{{ $accountHeader->name }}">

                                                            <select name="procedure_category_id[]"
                                                                class="form-control procedure_category_select" required>
                                                                <option value="">Select Procedure Category</option>
                                                                @foreach ($procedureCategories as $singleCategory)
                                                                    <option value="{{ $singleCategory->id }}"
                                                                        {{ $planProcedure->procedure && $planProcedure->procedure->ddprocedurecategory->id == $singleCategory->id ? 'selected' : '' }}>
                                                                        {{ $singleCategory->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="hidden" name="procedure_id_hidden[]"
                                                                value="{{ $planProcedure->dd_procedure_id }}"
                                                                class="original_procedure_id">

                                                            <select name="procedure_id[]"
                                                                class="form-control procedure_select" required>
                                                                <option value="">Select Procedure</option>
                                                                <!-- Options will be loaded by JS -->
                                                            </select>

                                                            <input type="hidden" name="title[]" class="form-control"
                                                                value="{{ $planProcedure->procedure->title ?? '' }}">
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="text" name="description[]"
                                                                class="form-control"
                                                                value="{{ $planProcedure->procedure->description ?? ($planProcedure->procedure->title ?? '') }}" />
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="number" step="1" name="quantity[]"
                                                                class="form-control quantity" value="1" required
                                                                readonly>
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="number" step=".01" name="price[]"
                                                                class="form-control price"
                                                                value="{{ $planProcedure->procedure->price ?? '0.00' }}"
                                                                readonly>
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="number" step=".01" name="sub_total[]"
                                                                class="form-control sub_total"
                                                                placeholder="@lang('Sub Total')" readonly>
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <button title="Add" type="button"
                                                                class="btn btn-info btn-sm m-add"><i
                                                                    class="fas fa-plus"></i></button>
                                                            <button title="Delete" type="button"
                                                                class="btn btn-outline-danger btn-sm m-remove"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif


                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2" class="ambitious-right">@lang('Total')</td>
                                                <td colspan="2">
                                                    <input type="number" step=".01" name="total"
                                                        class="form-control total" value="{{ old('total', '0.00') }}"
                                                        placeholder="@lang('Total')" readonly>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2" class="text-right">@lang('Discount')</td>
                                                <td class="text-right">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                        <input type="number" step="1" name="discount_percentage"
                                                            value="{{ old('discount_percentage', '0') }}"
                                                            class="form-control discount_percentage" placeholder="">
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <input type="number" step=".01" name="total_discount"
                                                        class="form-control discount"
                                                        value="{{ old('total_discount', '0.00') }}" readonly>
                                                </td>
                                                <!--
                                                    <td>
                                                        <input type="number" step=".01" name="total_discount"
                                                            class="form-control discount"
                                                            value="{{ old('total_discount', '0.00') }}"
                                                            placeholder="@lang('Total Discount')">
                                                    </td>
                                                   <td colspan="2">
                                                        <input type="number" step=".01" name="total_discount" class="form-control discount"
                                                            value="{{ old('total_discount', '0.00') }}" placeholder="@lang('Total Discount')">
                                                    </td>
                                                    -->

                                            </tr>

                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2" class="ambitious-right">@lang('Grand Total')</td>
                                                <td colspan="2">
                                                    <input type="number" step=".01" name="grand_total"
                                                        class="form-control grand_total"
                                                        value="{{ old('grand_total', '0.00') }}"
                                                        placeholder="@lang('Grand Total')" readonly>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2" class="ambitious-right">@lang('Paid')</td>
                                                <td colspan="2">
                                                    <input type="number" step="1" name="paid"
                                                        class="form-control paid" value="{{ old('paid', '0') }}"
                                                        placeholder="@lang('Paid')" readonly>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2" class="ambitious-right">@lang('Due')</td>
                                                <td colspan="2">
                                                    <input type="number" step=".01" name="due"
                                                        class="form-control due" value="{{ old('due') }}"
                                                        placeholder="@lang('Due')" readonly>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row col-12">
                            <div class="col-md-12">
                                <div class="form-group row mt-3 mb-4">
                                    <div class="col-md-12 text-right">
                                        <input type="submit" value="{{ __('Submit') }}" class="btn btn-primary" />
                                        <a href="{{ route('invoices.index') }}"
                                            class="btn btn-outline-secondary ml-2">{{ __('Cancel') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var fetchCommissionUrl = "{{ route('fetch.commission') }}";
    </script>

    <script>
        var baseUrl = "{{ asset('') }}";
        var fetchCommissionUrl = "{{ route('fetch.commission') }}";

        $(document).ready(function() {

            // ========================
            // Load Procedures when Category changes
            // ========================
            $(document).on("change", 'select[name="procedure_category_id[]"]', function() {
                const $row = $(this).closest("tr");
                const categoryId = $(this).val();
                const $procedureSelect = $row.find('select[name="procedure_id[]"]');
                const originalProcedureId = $row.find('.original_procedure_id').val() || '';

                //alert(originalProcedureId);

                $procedureSelect.html('<option value="" disabled selected>Loading...</option>');

                if (!categoryId) {
                    $procedureSelect.html('<option value="" disabled selected>Select Procedure</option>');
                    return;
                }

                $.ajax({
                    url: "{{ url('/getprocedurefromcategory') }}/" + categoryId,
                    type: "GET",
                    success: function(data) {
                        $procedureSelect.empty()
                            .append(
                                '<option value="" disabled selected>Select Procedure</option>');

                        $.each(data, function(key, value) {
                            const isSelected = (value.id == originalProcedureId) ?
                                'selected' : '';
                            $procedureSelect.append(
                                `<option value="${value.id}" ${isSelected}>${value.procedure_code ? '' + value.procedure_code + '' : ''}</option>`
                            );
                        });

                        // If we have pre-selected procedure, trigger change to fill details
                        if (originalProcedureId) {
                            $procedureSelect.val(originalProcedureId).trigger('change');
                        }
                    },
                    error: function() {
                        alert('Failed to load procedures.');
                        $procedureSelect.html(
                            '<option value="" disabled selected>Error loading procedures</option>'
                            );
                    }
                });
            });

            // ========================
            // Load Procedure Details when Procedure is selected
            // ========================
            $(document).on("change", 'select[name="procedure_id[]"]', function() {
                const $row = $(this).closest("tr");
                const procedureId = $(this).val();

                const $descField = $row.find('input[name="description[]"], textarea[name="description[]"]')
                    .first();
                const $priceField = $row.find('input[name="price[]"]');
                const $titleField = $row.find('input[name="title[]"]');

                // Clear previous values
                $descField.val('');
                $priceField.val('');
                $titleField.val('');

                if (!procedureId) return;

                $.ajax({
                    url: "{{ url('/getproceduredescription') }}/" + procedureId,
                    type: "GET",
                    success: function(data) {
                        if (data && data.procedure) {
                            $descField.val(data.procedure.description || '');
                            $priceField.val(data.procedure.price || '0.00').trigger(
                            'input'); // trigger input for calculations
                            $titleField.val(data.procedure.title || '').trigger('change');
                        }
                    },
                    error: function() {
                        alert('Failed to load procedure details.');
                    }
                });
            });

            // ========================
            // CALCULATION FUNCTIONS (your original code - slightly improved)
            // ========================
            function calculateRow($row) {
                if (!$row || $row.length === 0) return;

                const quantity = parseFloat($row.find('.quantity').val()) || 0;
                const price = parseFloat($row.find('.price').val()) || 0;
                const subtotal = quantity * price;

                $row.find('.sub_total').val(subtotal.toFixed(2));
            }

            function calculateTotals() {
                let total = 0;

                $('.sub_total').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });

                $('.total').val(total.toFixed(2));

                // Discount
                const discountPercent = parseFloat($('.discount_percentage').val()) || 0;
                const discountAmount = (total * discountPercent) / 100;
                $('.discount').val(discountAmount.toFixed(2));

                // Grand Total
                const grandTotal = total - discountAmount;
                $('.grand_total').val(grandTotal.toFixed(2));

                // Due
                const paid = parseFloat($('.paid').val()) || 0;
                $('.due').val((grandTotal - paid).toFixed(2));
            }

            // Re-calculate on input/change
            $(document).on('input change keyup', '.quantity, .price, .discount_percentage, .discount, .paid',
                function() {
                    const $row = $(this).closest('tr');
                    if ($row.find('.quantity, .price').length) {
                        calculateRow($row);
                    }
                    calculateTotals();
                });

            // Recalculate after add/remove rows
            $(document).on('click', '.m-add, .m-remove', function() {
                setTimeout(calculateTotals, 100);
            });

            // ========================
            // IMPORTANT: Initialize pre-filled rows
            // ========================
            // Trigger category change for all rows that already have category selected
            $('select[name="procedure_category_id[]"]').each(function() {
                if ($(this).val()) {
                    $(this).trigger('change');
                }
            });

            // Initial totals calculation
            calculateTotals();
        });
    </script>

@endsection
@push('footer')
    <script src="{{ asset('assets/js/custom/invoice.js') }}"></script>
@endpush
