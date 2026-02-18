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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Add Invoice')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary btn-sm">
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
                            <h3 class="card-title font-weight-bold">@lang('Invoice Details')</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-material form-horizontal" action="{{ route('invoices.store') }}"
                                method="POST" data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="user_id"
                                                class="font-weight-bold text-secondary text-uppercase small">@lang('Patient')</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-user-injured"></i></span>
                                                </div>
                                                <select name="user_id"
                                                    class="form-control select2 @error('user_id') is-invalid @enderror"
                                                    required id="user_id" data-parsley-required="true"
                                                    data-parsley-required-message="@lang('Please select patient')"
                                                    {{ isset($patientTreatmentPlan) ? 'disabled' : '' }}>
                                                    <option value="Select Patient" disabled
                                                        {{ old('user_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : $selectedPatientId ?? null) == null ? 'selected' : '' }}>
                                                        {{ isset($patientTreatmentPlan) ? '' : 'Select Patient' }}
                                                    </option>
                                                    @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                        <option value="{{ $patient->id }}"
                                                            @if (old('user_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : $selectedPatientId ?? '') ==
                                                                    $patient->id) selected @endif>
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
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="doctor_id"
                                                class="font-weight-bold text-secondary text-uppercase small">@lang('Doctor')</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                                </div>
                                                <select name="doctor_id"
                                                    class="form-control select2 @error('doctor_id') is-invalid @enderror"
                                                    required id="doctor_id" data-parsley-required="true"
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
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label
                                                class="font-weight-bold text-secondary text-uppercase small">@lang('Invoice Date')
                                                <b class="text-danger">*</b></label>
                                            <div class="input-group">
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
                                    <div class="col-md-4 d-none">
                                        <div class="form-group mb-3">
                                            <div class="input-group">
                                                <input type="hidden" id="commission_percentage"
                                                    name="commission_percentage"
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
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="t1" class="table table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="custom-th-width-20">Category <b
                                                                class="text-danger">*</b></th>
                                                        <th scope="col" class="custom-th-width-20">Procedure (CPT) <b
                                                                class="text-danger">*</b></th>
                                                        <th scope="col" class="custom-th-width-25">@lang('Description')
                                                        </th>
                                                        <th scope="col">@lang('Quantity')</th>
                                                        <th scope="col" class="custom-th-width-15">@lang('Price')
                                                        </th>
                                                        <th scope="col" class="custom-th-width-15">@lang('Sub Total')
                                                        </th>
                                                        <th scope="col" class="custom-white-space">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="invoice-body">
                                                    @if (isset($patientTreatmentPlanProcedures))
                                                        @foreach ($patientTreatmentPlanProcedures as $planProcedure)
                                                            <tr>
                                                                <td style="vertical-align: top;">
                                                                    <input type="hidden"
                                                                        name="patient_treatment_plan_procedure_id[]"
                                                                        value="{{ $planProcedure->id }}">
                                                                    <input type="hidden" name="account_name[]"
                                                                        value="{{ $accountHeader->name }}">

                                                                    <input type="text" name="title[]"
                                                                        class="form-control"
                                                                        value="{{ $planProcedure->procedure->title }}"
                                                                        readonly data-parsley-trigger="change"
                                                                        data-parsley-required="true"
                                                                        data-parsley-required-message="Please enter procedure name">
                                                                </td>
                                                                <td style="vertical-align: top;">
                                                                    <input type="text" name="description[]"
                                                                        class="form-control" />
                                                                </td>
                                                                <td style="vertical-align: top;">
                                                                    <input type="number" step="1"
                                                                        name="quantity[]" class="form-control quantity"
                                                                        value="1" placeholder="@lang('Quantity')"
                                                                        required readonly>
                                                                </td>
                                                                <td style="vertical-align: top;">
                                                                    <input type="number" step=".01" name="price[]"
                                                                        class="form-control price"
                                                                        value="{{ $planProcedure->procedure->price }}"
                                                                        placeholder="@lang('Price')" readonly>
                                                                </td>
                                                                <td style="vertical-align: top;">
                                                                    <input type="number" step=".01"
                                                                        name="sub_total[]" class="form-control sub_total"
                                                                        placeholder="@lang('Sub Total')" readonly>
                                                                </td>
                                                                <td style="vertical-align: top;">
                                                                    <button title="Add" type="button"
                                                                        class="btn btn-outline-info btn-sm m-add"><i
                                                                            class="fas fa-plus"></i></button>
                                                                    <button title="Delete" type="button"
                                                                        class="btn btn-outline-danger btn-sm m-remove"><i
                                                                            class="fas fa-minus"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    @if (!isset($patientTreatmentPlanProcedures))
                                                        <tr>
                                                            <input type="hidden"
                                                                name="patient_treatment_plan_procedure_id[]"
                                                                value="">
                                                            <input type="hidden" name="account_name[]"
                                                                value="{{ $accountHeader->name }}">
                                                            <td style="vertical-align: top;">
                                                                <select name="procedure_category_id[]"
                                                                    class="form-control  @error('procedure_category_id') is-invalid @enderror"
                                                                    id="procedure_category_id">
                                                                    <option value="" disabled selected>Select
                                                                        Procedure Category
                                                                    </option>
                                                                    @foreach ($procedureCategories as $singleCategory)
                                                                        <option value="{{ $singleCategory->id }}">
                                                                            {{ $singleCategory->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <select name="procedure_id[]"
                                                                    class="form-control  @error('procedure_id') is-invalid @enderror"
                                                                    id="procedure_id">
                                                                    <option value="" disabled selected>Select
                                                                        Procedure</option>
                                                                    <option value=""></option>
                                                                </select>
                                                                <input type="hidden" name="title[]"
                                                                    class="form-control" />
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <input type="text" name="description[]"
                                                                    class="form-control" />
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <select name="quantity[]" class="form-control quantity"
                                                                    required>
                                                                    @for ($i = 1; $i <= 10; $i++)
                                                                        <option value="{{ $i }}">
                                                                            {{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <input type="number" step=".01" name="price[]"
                                                                    class="form-control err-message price"
                                                                    placeholder="@lang('Price')" required
                                                                    data-parsley-required-message="Please enter price">
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <input type="number" step=".01" name="sub_total[]"
                                                                    class="form-control sub_total"
                                                                    placeholder="@lang('Sub Total')" readonly>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <button title="Add" type="button"
                                                                    class="btn btn-outline-info btn-sm m-add"><i
                                                                        class="fas fa-plus"></i></button>
                                                                <button title="Delete" type="button"
                                                                    class="btn btn-outline-danger btn-sm m-remove"><i
                                                                        class="fas fa-minus"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                                <tbody>
                                                    <tr>
                                                        <td class="font-weight-bold text-right">@lang('Total')</td>
                                                        <td>
                                                            <input type="number" step=".01" name="total"
                                                                class="form-control total"
                                                                value="{{ old('total', '0.00') }}" readonly>
                                                        </td>
                                                        <td class="font-weight-bold text-right">@lang('Discount') %</td>
                                                        <td colspan="2">
                                                            <input type="number" step=".01" min="0"
                                                                value="0" max="100" name="discount_percentage"
                                                                class="form-control discount_percentage" placeholder="%">
                                                        </td>
                                                        <td colspan="2">
                                                            <input type="number" step=".01" name="total_discount"
                                                                class="form-control discount"
                                                                value="{{ old('total_discount', '0.00') }}" readonly>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold text-right">@lang('Grand Total')</td>
                                                        <td>
                                                            <input type="number" step=".01" name="grand_total"
                                                                class="form-control grand_total"
                                                                value="{{ old('grand_total', '0.00') }}" readonly>
                                                        </td>
                                                        <td class="font-weight-bold text-right">@lang('Paid')</td>
                                                        <td colspan="2">
                                                            <input type="number" step="1" name="paid"
                                                                class="form-control paid" value="{{ old('paid', '0') }}"
                                                                readonly>
                                                        </td>
                                                        <td colspan="2">
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <span
                                                                    class="font-weight-bold text-right">@lang('Due')</span>
                                                                <span>&nbsp;</span>
                                                                <input type="number" step=".01" name="due"
                                                                    class="form-control due" value="{{ old('due') }}"
                                                                    readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-right mt-3 mb-4">
                                        <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                                        <a href="{{ route('invoices.index') }}"
                                            class="btn btn-secondary ml-2">@lang('Cancel')</a>
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
        var fetchCommissionUrl = "{{ route('fetch.commission') }}";
    </script>

    <script>
        var baseUrl = "{{ asset('') }}";
        var fetchCommissionUrl = "{{ route('fetch.commission') }}";

        $(document).ready(function() {

            // ========================
            // AJAX: Load Procedures by Category
            // ========================
            $("body").on("change", 'select[name="procedure_category_id[]"]', function() {
                const $row = $(this).closest("tr");
                const procedureCatId = $(this).val();
                const $procedureSelect = $row.find('select[name="procedure_id[]"]');

                $procedureSelect.empty().append('<option value="" disabled selected>Loading...</option>');

                if (!procedureCatId) {
                    $procedureSelect.empty().append(
                        '<option value="" disabled selected>Select Procedure</option>');
                    return;
                }

                $.ajax({
                    url: "{{ url('/getprocedurefromcategory') }}/" + procedureCatId,
                    type: "GET",
                    success: function(data) {
                        $procedureSelect.empty().append(
                            '<option value="" disabled selected>Select Procedure</option>');
                        $.each(data, function(key, value) {
                            $procedureSelect.append('<option value="' + value.id +
                                '">' + value.procedure_code + '</option>');
                        });
                    },
                    error: function() {
                        alert('Failed to load procedures.');
                        $procedureSelect.empty().append(
                            '<option value="" disabled selected>Error loading</option>');
                    }
                });
            });

            // ========================
            // AJAX: Load Procedure Details (price, title, description)
            // ========================
            $("body").on("change", 'select[name="procedure_id[]"]', function() {
                const $row = $(this).closest("tr");
                const procedureId = $(this).val();

                const $descField = $row.find('input[name="description[]"], textarea[name="description[]"]')
                    .first();
                const $priceField = $row.find('input[name="price[]"]');
                const $titleField = $row.find('input[name="title[]"]');

                // Clear first
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
                            $priceField.val(data.procedure.price || '0.00').trigger('change');
                            $titleField.val(data.procedure.title || '').trigger('change');
                        }
                    },
                    error: function() {
                        alert('Failed to load procedure details.');
                    }
                });
            });

            // ========================
            // CALCULATION FUNCTIONS
            // ========================
            function calculateRow($row) {
                if (!$row || $row.length === 0) return;

                const quantity = parseFloat($row.find('.quantity').val()) || 0;
                const price = parseFloat($row.find('.price').val()) || 0;
                const subtotal = quantity * price;

                $row.find('.sub_total').val(subtotal.toFixed(2));
            }

            function calculateTotals(e) {
                let total = 0;

                $('.sub_total').each(function() {
                    total += parseFloat($(this).val()) || 0;
                });

                $('.total').val(total.toFixed(2));

                const $target = e ? $(e.target) : null;
                let discountAmount = 0;
                let discountPercent = 0;

                if ($target && $target.hasClass('discount')) {
                    // User edited Amount -> Calc Percent
                    discountAmount = parseFloat($('.discount').val()) || 0;
                    if (total > 0) {
                        discountPercent = (discountAmount / total) * 100;
                        $('.discount_percentage').val(discountPercent.toFixed(2));
                    }
                } else {
                    // User edited Percent or other fields -> Calc Amount
                    discountPercent = parseFloat($('.discount_percentage').val()) || 0;
                    discountAmount = (total * discountPercent) / 100;
                    $('.discount').val(discountAmount.toFixed(2));
                }

                // Grand Total
                const grandTotal = total - discountAmount;
                $('.grand_total').val(grandTotal.toFixed(2));

                // Due = Grand Total - Paid
                const paid = parseFloat($('.paid').val()) || 0;
                $('.due').val((grandTotal - paid).toFixed(2));
            }

            // Trigger recalculation on any change
            $(document).on('input change keyup', '.quantity, .price, .discount_percentage, .discount, .paid',
                function(e) {
                    const $row = $(this).closest('tr');
                    if ($row.find('.quantity, .price').length) {
                        calculateRow($row);
                    }
                    calculateTotals(e);
                });

            // Recalculate when rows are added/removed
            $(document).on('click', '.m-add, .m-remove', function() {
                setTimeout(calculateTotals, 100); // small delay to ensure DOM updated
            });

            // Initial calculation on page load
            calculateTotals();
        });
    </script>

@endsection
@push('footer')
    <script src="{{ asset('assets/js/custom/invoice.js') }}"></script>
@endpush
