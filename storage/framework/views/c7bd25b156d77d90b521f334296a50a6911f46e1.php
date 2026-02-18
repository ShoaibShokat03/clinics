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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Add Invoice'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to List'); ?>
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
                            <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Invoice Details'); ?></h3>
                        </div>
                        <div class="card-body">
                            <form class="form-material form-horizontal" action="<?php echo e(route('invoices.store')); ?>"
                                method="POST" data-parsley-validate>
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="user_id"
                                                class="font-weight-bold text-secondary text-uppercase small"><?php echo app('translator')->get('Patient'); ?></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-user-injured"></i></span>
                                                </div>
                                                <select name="user_id"
                                                    class="form-control select2 <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    required id="user_id" data-parsley-required="true"
                                                    data-parsley-required-message="<?php echo app('translator')->get('Please select patient'); ?>"
                                                    <?php echo e(isset($patientTreatmentPlan) ? 'disabled' : ''); ?>>
                                                    <option value="Select Patient" disabled
                                                        <?php echo e(old('user_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : $selectedPatientId ?? null) == null ? 'selected' : ''); ?>>
                                                        <?php echo e(isset($patientTreatmentPlan) ? '' : 'Select Patient'); ?>

                                                    </option>
                                                    <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($patient->id); ?>"
                                                            <?php if(old('user_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : $selectedPatientId ?? '') ==
                                                                    $patient->id): ?> selected <?php endif; ?>>
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
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="doctor_id"
                                                class="font-weight-bold text-secondary text-uppercase small"><?php echo app('translator')->get('Doctor'); ?></label>
                                            <div class="input-group">
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
unset($__errorArgs, $__bag); ?>"
                                                    required id="doctor_id" data-parsley-required="true"
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
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label
                                                class="font-weight-bold text-secondary text-uppercase small"><?php echo app('translator')->get('Invoice Date'); ?>
                                                <b class="text-danger">*</b></label>
                                            <div class="input-group">
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
                                    <div class="col-md-4 d-none">
                                        <div class="form-group mb-3">
                                            <div class="input-group">
                                                <input type="hidden" id="commission_percentage"
                                                    name="commission_percentage"
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
                                                        <th scope="col" class="custom-th-width-25"><?php echo app('translator')->get('Description'); ?>
                                                        </th>
                                                        <th scope="col"><?php echo app('translator')->get('Quantity'); ?></th>
                                                        <th scope="col" class="custom-th-width-15"><?php echo app('translator')->get('Price'); ?>
                                                        </th>
                                                        <th scope="col" class="custom-th-width-15"><?php echo app('translator')->get('Sub Total'); ?>
                                                        </th>
                                                        <th scope="col" class="custom-white-space">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="invoice-body">
                                                    <?php if(isset($patientTreatmentPlanProcedures)): ?>
                                                        <?php $__currentLoopData = $patientTreatmentPlanProcedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planProcedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td style="vertical-align: top;">
                                                                    <input type="hidden"
                                                                        name="patient_treatment_plan_procedure_id[]"
                                                                        value="<?php echo e($planProcedure->id); ?>">
                                                                    <input type="hidden" name="account_name[]"
                                                                        value="<?php echo e($accountHeader->name); ?>">

                                                                    <input type="text" name="title[]"
                                                                        class="form-control"
                                                                        value="<?php echo e($planProcedure->procedure->title); ?>"
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
                                                                        value="1" placeholder="<?php echo app('translator')->get('Quantity'); ?>"
                                                                        required readonly>
                                                                </td>
                                                                <td style="vertical-align: top;">
                                                                    <input type="number" step=".01" name="price[]"
                                                                        class="form-control price"
                                                                        value="<?php echo e($planProcedure->procedure->price); ?>"
                                                                        placeholder="<?php echo app('translator')->get('Price'); ?>" readonly>
                                                                </td>
                                                                <td style="vertical-align: top;">
                                                                    <input type="number" step=".01"
                                                                        name="sub_total[]" class="form-control sub_total"
                                                                        placeholder="<?php echo app('translator')->get('Sub Total'); ?>" readonly>
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
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <?php if(!isset($patientTreatmentPlanProcedures)): ?>
                                                        <tr>
                                                            <input type="hidden"
                                                                name="patient_treatment_plan_procedure_id[]"
                                                                value="">
                                                            <input type="hidden" name="account_name[]"
                                                                value="<?php echo e($accountHeader->name); ?>">
                                                            <td style="vertical-align: top;">
                                                                <select name="procedure_category_id[]"
                                                                    class="form-control  <?php $__errorArgs = ['procedure_category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                    id="procedure_category_id">
                                                                    <option value="" disabled selected>Select
                                                                        Procedure Category
                                                                    </option>
                                                                    <?php $__currentLoopData = $procedureCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($singleCategory->id); ?>">
                                                                            <?php echo e($singleCategory->title); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <select name="procedure_id[]"
                                                                    class="form-control  <?php $__errorArgs = ['procedure_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
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
                                                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                                                        <option value="<?php echo e($i); ?>">
                                                                            <?php echo e($i); ?></option>
                                                                    <?php endfor; ?>
                                                                </select>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <input type="number" step=".01" name="price[]"
                                                                    class="form-control err-message price"
                                                                    placeholder="<?php echo app('translator')->get('Price'); ?>" required
                                                                    data-parsley-required-message="Please enter price">
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <input type="number" step=".01" name="sub_total[]"
                                                                    class="form-control sub_total"
                                                                    placeholder="<?php echo app('translator')->get('Sub Total'); ?>" readonly>
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
                                                    <?php endif; ?>
                                                </tbody>
                                                <tbody>
                                                    <tr>
                                                        <td class="font-weight-bold text-right"><?php echo app('translator')->get('Total'); ?></td>
                                                        <td>
                                                            <input type="number" step=".01" name="total"
                                                                class="form-control total"
                                                                value="<?php echo e(old('total', '0.00')); ?>" readonly>
                                                        </td>
                                                        <td class="font-weight-bold text-right"><?php echo app('translator')->get('Discount'); ?> %</td>
                                                        <td colspan="2">
                                                            <input type="number" step=".01" min="0"
                                                                value="0" max="100" name="discount_percentage"
                                                                class="form-control discount_percentage" placeholder="%">
                                                        </td>
                                                        <td colspan="2">
                                                            <input type="number" step=".01" name="total_discount"
                                                                class="form-control discount"
                                                                value="<?php echo e(old('total_discount', '0.00')); ?>" readonly>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold text-right"><?php echo app('translator')->get('Grand Total'); ?></td>
                                                        <td>
                                                            <input type="number" step=".01" name="grand_total"
                                                                class="form-control grand_total"
                                                                value="<?php echo e(old('grand_total', '0.00')); ?>" readonly>
                                                        </td>
                                                        <td class="font-weight-bold text-right"><?php echo app('translator')->get('Paid'); ?></td>
                                                        <td colspan="2">
                                                            <input type="number" step="1" name="paid"
                                                                class="form-control paid" value="<?php echo e(old('paid', '0')); ?>"
                                                                readonly>
                                                        </td>
                                                        <td colspan="2">
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <span
                                                                    class="font-weight-bold text-right"><?php echo app('translator')->get('Due'); ?></span>
                                                                <span>&nbsp;</span>
                                                                <input type="number" step=".01" name="due"
                                                                    class="form-control due" value="<?php echo e(old('due')); ?>"
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
                                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Submit'); ?></button>
                                        <a href="<?php echo e(route('invoices.index')); ?>"
                                            class="btn btn-secondary ml-2"><?php echo app('translator')->get('Cancel'); ?></a>
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
        var fetchCommissionUrl = "<?php echo e(route('fetch.commission')); ?>";
    </script>

    <script>
        var baseUrl = "<?php echo e(asset('')); ?>";
        var fetchCommissionUrl = "<?php echo e(route('fetch.commission')); ?>";

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
                    url: "<?php echo e(url('/getprocedurefromcategory')); ?>/" + procedureCatId,
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
                    url: "<?php echo e(url('/getproceduredescription')); ?>/" + procedureId,
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

<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer'); ?>
    <script src="<?php echo e(asset('assets/js/custom/invoice.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/invoices/create.blade.php ENDPATH**/ ?>