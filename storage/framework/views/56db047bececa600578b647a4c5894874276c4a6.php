<style>
    .err-message~.parsley-errors-list {
        width: 41%;
        top: 96px;
    }

    tr td button.btn {
        padding: 3px !important;
    }
</style>
<?php $__env->startPush('header'); ?>
    <?php if(old('account_name') || isset($invoice->invoiceItems)): ?>
        <meta name="clear-invoice-html" content="clean">
    <?php endif; ?>
    <meta name="invoice-total" content="<?php echo e(old('total', $invoice->total ?? 0)); ?>">
    <meta name="invoice-grand-total" content="<?php echo e(old('grand_total', $invoice->grand_total ?? 0)); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-gray-800"><?php echo app('translator')->get('Add Invoice'); ?></h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> <?php echo app('translator')->get('Back to List'); ?>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light border-bottom">
                    <h5 class="card-title mb-0 font-weight-bold"><?php echo app('translator')->get('Invoice Information'); ?></h5>
                </div>
                <div class="card-body p-4">
                    <form class="form-material form-horizontal bg-custom" action="<?php echo e(route('invoices.store')); ?>"
                        method="POST" data-parsley-validate>
                        <?php echo csrf_field(); ?>
                        <div class="row col-12 p-0 m-0">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="user_id"><?php echo app('translator')->get('Patient'); ?></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                        </div>
                                        <select name="user_id"
                                            class="form-control select2 <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                                            id="user_id" data-parsley-required="true"
                                            data-parsley-required-message="<?php echo app('translator')->get('Please select patient'); ?>"
                                            <?php echo e(isset($patientTreatmentPlan) ? 'disabled' : ''); ?>>
                                            <option value="Select Patient" disabled
                                                <?php echo e(old('user_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : null) == null ? 'selected' : ''); ?>>
                                                <?php echo e(isset($patientTreatmentPlan) ? '' : 'Select Patient'); ?>

                                            </option>
                                            <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($patient->id); ?>"
                                                    <?php if(old('user_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : '') == $patient->id): ?> selected <?php endif; ?>>
                                                    <?php echo e(($patient->name ?? '') . ' - ' . ($patient->patientDetails->mrn_number ?? '')); ?>


                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if(isset($patientTreatmentPlan)): ?>
                                            <input type="hidden" name="user_id"
                                                value="<?php echo e($patientTreatmentPlan->patient_id); ?>">
                                            <input type="hidden" name="patient_treatment_plan_id"
                                                value="<?php echo e($patientTreatmentPlan->id); ?>">
                                        <?php endif; ?>
                                        <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="doctor_id"><?php echo app('translator')->get('Doctor'); ?></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                        </div>
                                        <select name="doctor_id"
                                            class="form-control select2 <?php $__errorArgs = ['doctor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                                            id="doctor_id" data-parsley-required="true"
                                            data-parsley-required-message="<?php echo app('translator')->get('Please select doctor'); ?>"
                                            <?php echo e(isset($patientTreatmentPlan) ? 'disabled' : ''); ?>>
                                            <option value="Select Doctor" disabled
                                                <?php echo e(old('doctor_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->doctor_id : null) == null ? 'selected' : ''); ?>>
                                                <?php echo e(isset($patientTreatmentPlan) ? '' : 'Select Doctor'); ?>

                                            </option>
                                            <?php $__currentLoopData = $doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($doctor->id); ?>"
                                                    <?php if(old('doctor_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->doctor_id : '') == $doctor->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($doctor->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if(isset($patientTreatmentPlan)): ?>
                                            <input type="hidden" name="doctor_id"
                                                value="<?php echo e($patientTreatmentPlan->doctor_id); ?>">
                                        <?php endif; ?>
                                        <?php $__errorArgs = ['doctor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Invoice Date'); ?> <b class="ambitious-crimson">*</b></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" name="invoice_date" id="invoice_date"
                                            class="form-control flatpickr <?php $__errorArgs = ['invoice_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="<?php echo app('translator')->get('Invoice Date'); ?>"
                                            value="<?php echo e(old('invoice_date', date('Y-m-d'))); ?>" required
                                            data-parsley-required="true">
                                    </div>
                                    <?php $__errorArgs = ['invoice_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="hidden" id="commission_percentage" name="commission_percentage"
                                            value="<?php echo e(old('commission_percentage', isset($percentage) ? $percentage : '')); ?>"
                                            class="form-control <?php $__errorArgs = ['commission_percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="<?php echo app('translator')->get('0.0'); ?>"
                                            <?php echo e(isset($percentage) ? 'readonly' : 'required'); ?>>
                                        <?php $__errorArgs = ['commission_percentage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                                <th scope="col" class="custom-th-width-25"><?php echo app('translator')->get('Description'); ?></th>
                                                <th scope="col"><?php echo app('translator')->get('Quantity'); ?></th>
                                                <th scope="col" class="custom-th-width-15"><?php echo app('translator')->get('Price'); ?></th>
                                                <th scope="col" class="custom-th-width-15"><?php echo app('translator')->get('Sub Total'); ?></th>
                                                <th scope="col" class="custom-white-space">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoice-body">
                                            <?php if(isset($patientTreatmentPlanProcedures)): ?>
                                                <?php $__currentLoopData = $patientTreatmentPlanProcedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planProcedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td style="padding-bottom: 30px;">
                                                            <input type="hidden"
                                                                name="patient_treatment_plan_procedure_id[]"
                                                                value="<?php echo e($planProcedure->id); ?>">

                                                            <input type="hidden" name="account_name[]"
                                                                value="<?php echo e($accountHeader->name); ?>">

                                                            <select name="procedure_category_id[]"
                                                                class="form-control procedure_category_select" required>
                                                                <option value="">Select Procedure Category</option>
                                                                <?php $__currentLoopData = $procedureCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($singleCategory->id); ?>"
                                                                        <?php echo e($planProcedure->procedure && $planProcedure->procedure->ddprocedurecategory->id == $singleCategory->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($singleCategory->title); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="hidden" name="procedure_id_hidden[]"
                                                                value="<?php echo e($planProcedure->dd_procedure_id); ?>"
                                                                class="original_procedure_id">

                                                            <select name="procedure_id[]"
                                                                class="form-control procedure_select" required>
                                                                <option value="">Select Procedure</option>
                                                                <!-- Options will be loaded by JS -->
                                                            </select>

                                                            <input type="hidden" name="title[]" class="form-control"
                                                                value="<?php echo e($planProcedure->procedure->title ?? ''); ?>">
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="text" name="description[]"
                                                                class="form-control"
                                                                value="<?php echo e($planProcedure->procedure->description ?? ($planProcedure->procedure->title ?? '')); ?>" />
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="number" step="1" name="quantity[]"
                                                                class="form-control quantity" value="1" required
                                                                readonly>
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="number" step=".01" name="price[]"
                                                                class="form-control price"
                                                                value="<?php echo e($planProcedure->procedure->price ?? '0.00'); ?>"
                                                                readonly>
                                                        </td>

                                                        <td style="padding-bottom: 30px;">
                                                            <input type="number" step=".01" name="sub_total[]"
                                                                class="form-control sub_total"
                                                                placeholder="<?php echo app('translator')->get('Sub Total'); ?>" readonly>
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
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>


                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2" class="ambitious-right"><?php echo app('translator')->get('Total'); ?></td>
                                                <td colspan="2">
                                                    <input type="number" step=".01" name="total"
                                                        class="form-control total" value="<?php echo e(old('total', '0.00')); ?>"
                                                        placeholder="<?php echo app('translator')->get('Total'); ?>" readonly>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2" class="text-right"><?php echo app('translator')->get('Discount'); ?></td>
                                                <td class="text-right">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                        <input type="number" step="1" name="discount_percentage"
                                                            value="<?php echo e(old('discount_percentage', '0')); ?>"
                                                            class="form-control discount_percentage" placeholder="">
                                                    </div>
                                                </td>
                                                <td colspan="2">
                                                    <input type="number" step=".01" name="total_discount"
                                                        class="form-control discount"
                                                        value="<?php echo e(old('total_discount', '0.00')); ?>" readonly>
                                                </td>
                                                <!--
                                                    <td>
                                                        <input type="number" step=".01" name="total_discount"
                                                            class="form-control discount"
                                                            value="<?php echo e(old('total_discount', '0.00')); ?>"
                                                            placeholder="<?php echo app('translator')->get('Total Discount'); ?>">
                                                    </td>
                                                   <td colspan="2">
                                                        <input type="number" step=".01" name="total_discount" class="form-control discount"
                                                            value="<?php echo e(old('total_discount', '0.00')); ?>" placeholder="<?php echo app('translator')->get('Total Discount'); ?>">
                                                    </td>
                                                    -->

                                            </tr>

                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2" class="ambitious-right"><?php echo app('translator')->get('Grand Total'); ?></td>
                                                <td colspan="2">
                                                    <input type="number" step=".01" name="grand_total"
                                                        class="form-control grand_total"
                                                        value="<?php echo e(old('grand_total', '0.00')); ?>"
                                                        placeholder="<?php echo app('translator')->get('Grand Total'); ?>" readonly>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2" class="ambitious-right"><?php echo app('translator')->get('Paid'); ?></td>
                                                <td colspan="2">
                                                    <input type="number" step="1" name="paid"
                                                        class="form-control paid" value="<?php echo e(old('paid', '0')); ?>"
                                                        placeholder="<?php echo app('translator')->get('Paid'); ?>" readonly>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td colspan="2" class="ambitious-right"><?php echo app('translator')->get('Due'); ?></td>
                                                <td colspan="2">
                                                    <input type="number" step=".01" name="due"
                                                        class="form-control due" value="<?php echo e(old('due')); ?>"
                                                        placeholder="<?php echo app('translator')->get('Due'); ?>" readonly>
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
                                        <input type="submit" value="<?php echo e(__('Submit')); ?>" class="btn btn-primary" />
                                        <a href="<?php echo e(route('invoices.index')); ?>"
                                            class="btn btn-outline-secondary ml-2"><?php echo e(__('Cancel')); ?></a>
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
        var fetchCommissionUrl = "<?php echo e(route('fetch.commission')); ?>";
    </script>

    <script>
        var baseUrl = "<?php echo e(asset('')); ?>";
        var fetchCommissionUrl = "<?php echo e(route('fetch.commission')); ?>";

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
                    url: "<?php echo e(url('/getprocedurefromcategory')); ?>/" + categoryId,
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
                    url: "<?php echo e(url('/getproceduredescription')); ?>/" + procedureId,
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

<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer'); ?>
    <script src="<?php echo e(asset('assets/js/custom/invoice.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/invoices/autocreate.blade.php ENDPATH**/ ?>