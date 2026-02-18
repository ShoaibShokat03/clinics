<?php $__env->startPush('header'); ?>
    <?php if(old('account_name') || isset($invoice->invoiceItems)): ?>
        <meta name="clear-invoice-html" content="clean">
    <?php endif; ?>
    <meta name="invoice-total" content="<?php echo e(old('total', $invoice->total ?? 0)); ?>">
    <meta name="invoice-grand-total" content="<?php echo e(old('grand_total', $invoice->grand_total ?? 0)); ?>">
    <meta name="base-url" content="<?php echo e(config('app.url')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Edit Invoice'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to List'); ?>
                    </a>
                    <a href="<?php echo e(route('invoices.create')); ?>" class="btn btn-primary btn-sm ml-2">
                        <i class="fas fa-plus"></i> <?php echo app('translator')->get('New Invoice'); ?>
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
                            <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Invoice Details'); ?> <small
                                    class="text-muted ml-2">#<?php echo e($invoice->invoice_number); ?></small></h3>
                        </div>
                        <div class="card-body">
                            <form class="form-material form-horizontal" action="<?php echo e(route('invoices.update', $invoice)); ?>"
                                method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <?php
                                    $isPaid = $invoice->due == 0 && $invoice->paid == $invoice->grand_total;
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label
                                                class="font-weight-bold text-secondary text-uppercase small"><?php echo app('translator')->get('Patient'); ?></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-user-injured"></i></span>
                                                </div>
                                                <!-- Hidden input to store the actual value -->
                                                <input type="hidden" name="user_id" id="user_id"
                                                    value="<?php echo e(old('user_id', $invoice->user_id)); ?>">
                                                <select id="patient" class="form-control select2" disabled>
                                                    <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                    <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($patient->id); ?>"
                                                            <?php if($patient->id == old('user_id', $invoice->user_id)): ?> selected <?php endif; ?>>
                                                            <?php echo e(($patient->name ?? '') . ' - ' . ($patient->patientDetails->mrn_number ?? '')); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label
                                                class="font-weight-bold text-secondary text-uppercase small"><?php echo app('translator')->get('Doctor'); ?></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                                </div>
                                                <!-- Hidden input to store the actual value -->
                                                <input type="hidden" name="doctor_id" id="doctor_id"
                                                    value="<?php echo e(old('doctor_id', $invoice->doctor_id)); ?>">
                                                <select id="doctor" class="form-control select2" disabled>
                                                    <option value="">Select Doctor</option>
                                                    <?php $__currentLoopData = $doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($doctor->id); ?>"
                                                            <?php echo e(old('doctor_id', $invoice->doctor_id) == $doctor->id ? 'selected' : ''); ?>>
                                                            <?php echo e($doctor->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
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
                                                    value="<?php echo e(old('invoice_date', date('Y-m-d'), $invoice->invoice_date)); ?>"
                                                    required data-parsley-required="true">
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
                                                    value="<?php echo e(old('commission_percentage', $invoice->commission_percentage)); ?>"
                                                    class="form-control" placeholder="<?php echo app('translator')->get('0.0'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="t1" class="table table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="custom-th-width-20"><?php echo app('translator')->get('Category'); ?> <b
                                                                class="text-danger">*</b></th>
                                                        <th scope="col" class="custom-th-width-20"><?php echo app('translator')->get('Procedure (CPT)'); ?> <b
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
                                                    <?php $__currentLoopData = $invoice->invoiceItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr class="">
                                                            <td>
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
                                                                        Procedure Category</option>
                                                                    <?php $__currentLoopData = $procedureCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option
                                                                            <?php echo e($singleCategory->id == $invoiceItem->procedure_category_id ? 'selected' : ''); ?>

                                                                            value="<?php echo e($singleCategory->id); ?>">
                                                                            <?php echo e($singleCategory->title); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </td>

                                                            <td style="vertical-align: top;">
                                                                <?php if($invoiceItem->patient_treatment_plan_procedure_id): ?>
                                                                    <input type="hidden"
                                                                        name="patient_treatment_plan_procedure_id[]"
                                                                        value="<?php echo e($invoiceItem->patient_treatment_plan_procedure_id); ?>">

                                                                    <input type="hidden" name="account_name[]"
                                                                        value="<?php echo e($accountHeader->name ?? ''); ?>">

                                                                    <!-- IMPORTANT: Add this hidden field for pre-selection -->
                                                                    <input type="hidden" name="original_procedure_id[]"
                                                                        class="original_procedure_id"
                                                                        value="<?php echo e($invoiceItem->dd_procedure_id ?? ($invoiceItem->procedure_id ?? '')); ?>">

                                                                    <!-- Now use select instead of readonly text for consistency & dynamic loading -->
                                                                    <select name="procedure_id[]"
                                                                        class="form-control procedure_select" required>
                                                                        <option value="">Select Procedure</option>
                                                                        <!-- Options loaded by JS -->
                                                                    </select>

                                                                    <input type="hidden" name="title[]"
                                                                        class="form-control"
                                                                        value="<?php echo e($invoiceItem->procedure->title ?? ($invoiceItem->title ?? '')); ?>">
                                                                <?php else: ?>
                                                                    <!-- Your manual item logic remains -->
                                                                    <input type="hidden"
                                                                        name="patient_treatment_plan_procedure_id[]"
                                                                        value="">
                                                                    <input type="hidden" name="account_name[]"
                                                                        value="<?php echo e($accountHeader->name ?? ''); ?>">

                                                                    <input type="hidden" name="original_procedure_id[]"
                                                                        class="original_procedure_id"
                                                                        value="<?php echo e($invoiceItem->dd_procedure_id ?? ($invoiceItem->procedure_id ?? '')); ?>">

                                                                    <select name="procedure_id[]"
                                                                        class="form-control procedure_select" required>
                                                                        <option value="" selected>Select Procedure
                                                                        </option>
                                                                    </select>

                                                                    <input type="hidden" name="title[]"
                                                                        class="form-control"
                                                                        value="<?php echo e($invoiceItem->title); ?>" />
                                                                <?php endif; ?>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <input type="text" name="description[]"
                                                                    class="form-control"
                                                                    value="<?php echo e($invoiceItem->description); ?>">
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <select name="quantity[]" class="form-control quantity"
                                                                    required>
                                                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                                                        <option value="<?php echo e($i); ?>"
                                                                            <?php echo e(old('quantity.' . $loop->index, $invoiceItem->quantity) == $i ? 'selected' : ''); ?>>
                                                                            <?php echo e($i); ?>

                                                                        </option>
                                                                    <?php endfor; ?>
                                                                </select>

                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <input type="number" step=".01" name="price[]"
                                                                    class="form-control price"
                                                                    value="<?php echo e($invoiceItem->price); ?>"
                                                                    placeholder="<?php echo app('translator')->get('Price'); ?>" readonly>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <input type="number" step=".01" name="sub_total[]"
                                                                    class="form-control sub_total"
                                                                    value="<?php echo e($invoiceItem->total); ?>"
                                                                    placeholder="<?php echo app('translator')->get('Sub Total'); ?>" readonly>
                                                            </td>
                                                            <td style="vertical-align: top;">
                                                                <button title="<?php echo app('translator')->get('Add'); ?>" type="button"
                                                                    class="btn btn-outline-info btn-sm m-add <?php echo e($isPaid ? 'd-none' : ''); ?>">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                                <button title="<?php echo app('translator')->get('Delete'); ?>" type="button"
                                                                    class="btn btn-outline-danger btn-sm m-remove <?php echo e($isPaid ? 'd-none' : ''); ?>">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-right font-weight-bold"><?php echo app('translator')->get('Total'); ?></td>
                                                        <td>
                                                            <input type="number" step=".01" name="total"
                                                                class="form-control total"
                                                                value="<?php echo e(old('total', $invoice->total)); ?>"
                                                                placeholder="<?php echo app('translator')->get('Total'); ?>" readonly>
                                                        </td>
                                                        <td class="text-right font-weight-bold"><?php echo app('translator')->get('Discount'); ?> %</td>
                                                        <td colspan="3">
                                                            <div class="row">
                                                                <div class="col-6 pr-1">
                                                                    <div class="input-group">
                                                                        <input type="number" name="discount_percentage"
                                                                            class="form-control discount_percentage"
                                                                            value="<?php echo e(old('discount_percentage', $invoice->discount_percentage)); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 pl-1">
                                                                    <input type="number" step=".01" min="0"
                                                                        name="total_discount"
                                                                        class="form-control discount"
                                                                        value="<?php echo e(old('total_discount', $invoice->total_discount) ?? 0); ?>"
                                                                        placeholder="<?php echo app('translator')->get('Fixed Amount'); ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-right font-weight-bold"><?php echo app('translator')->get('Grand Total'); ?></td>
                                                        <td>
                                                            <input type="number" step=".01" name="grand_total"
                                                                class="form-control grand_total"
                                                                value="<?php echo e(old('grand_total', $invoice->grand_total)); ?>"
                                                                placeholder="<?php echo app('translator')->get('Grand Total'); ?>" readonly>
                                                        </td>
                                                        <td class="text-right font-weight-bold"><?php echo app('translator')->get('Paid'); ?></td>
                                                        <td colspan="2">
                                                            <input type="number" step=".01" name="paid"
                                                                id="paid" class="form-control paid" style=""
                                                                value="<?php echo e(old('paid', $invoice->paid)); ?>"
                                                                placeholder="<?php echo app('translator')->get('Paid'); ?>" readonly>
                                                        </td>
                                                        <td colspan="2">
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <span
                                                                    class="font-weight-bold text-right"><?php echo app('translator')->get('Due'); ?></span>
                                                                <span>&nbsp;</span>
                                                                <input type="number" step=".01" name="due"
                                                                    id="due" class="form-control due"
                                                                    value="<?php echo e(old('due', $invoice->due)); ?>"
                                                                    placeholder="<?php echo app('translator')->get('Due'); ?>" readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-right mt-3 mb-4 px-5">
                                <button type="submit" class="btn btn-primary"
                                    <?php echo e($isPaid ? 'disabled' : ''); ?>><?php echo app('translator')->get('Update'); ?></button>
                                <a href="<?php echo e(route('invoices.index')); ?>"
                                    class="btn btn-secondary ml-2"><?php echo app('translator')->get('Cancel'); ?></a>
                            </div>
                        </div>
                        </form>

                        <?php if(isset($invoice->user->patientDetails->insurance)): ?>
                            <div class="alert alert-info mt-4 border-0 shadow-sm">
                                <h5 class="font-weight-bold">
                                    <i class="fas fa-shield-alt mr-2 text-primary"></i>
                                    <?php echo e($invoice->user->name); ?> <?php echo app('translator')->get('has insurance with'); ?>
                                    <?php echo e($invoice->user->patientDetails->insurance->name); ?>

                                </h5>
                                <p class="mb-2 small text-muted">
                                    (<?php echo app('translator')->get('Discount'); ?>:
                                    <?php echo e($invoice->user->patientDetails->insurance->discount_percentage); ?>%,
                                    <?php echo app('translator')->get('Co-pay'); ?>: <?php echo e($invoice->user->patientDetails->insurance->co_percentage); ?>%)
                                </p>
                                <hr class="my-2">
                                <?php
                                    $insuranceDiscount = round(
                                        $invoice->total *
                                            ($invoice->user->patientDetails->insurance->discount_percentage / 100),
                                    );
                                    $totalMinDiscount = $invoice->total - $insuranceDiscount;
                                    $cashAmount = round(
                                        $invoice->total *
                                            ($invoice->user->patientDetails->insurance->co_percentage / 100),
                                    );
                                    $receivableFromCorporateClient = round($totalMinDiscount - $cashAmount);
                                ?>
                                <div class="row text-center">
                                    <div class="col-md-3 border-right">
                                        <label
                                            class="text-secondary small text-uppercase font-weight-bold d-block"><?php echo app('translator')->get('Total Amount'); ?></label>
                                        <span class="h6 font-weight-bold"
                                            id="payment_suggestion_total_amount"><?php echo e(number_format($invoice->total, 2)); ?></span>
                                    </div>
                                    <div class="col-md-3 border-right">
                                        <label
                                            class="text-secondary small text-uppercase font-weight-bold d-block"><?php echo app('translator')->get('Cash'); ?>
                                            (<?php echo e($invoice->user->patientDetails->insurance->co_percentage); ?>%)</label>
                                        <span class="h6 font-weight-bold text-success"
                                            id="payment_suggestion_cash"><?php echo e(number_format($cashAmount, 2)); ?></span>
                                    </div>
                                    <div class="col-md-3 border-right">
                                        <label
                                            class="text-secondary small text-uppercase font-weight-bold d-block"><?php echo app('translator')->get('Discount'); ?>
                                            %
                                            (<?php echo e($invoice->user->patientDetails->insurance->discount_percentage); ?>%)</label>
                                        <span class="h6 font-weight-bold text-info"
                                            id="payment_suggestion_discount"><?php echo e(number_format($insuranceDiscount, 2)); ?></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label
                                            class="text-secondary small text-uppercase font-weight-bold d-block"><?php echo app('translator')->get('Receivable from Corporate'); ?></label>
                                        <span class="h6 font-weight-bold text-danger"
                                            id="payment_suggestion_corporate_client"><?php echo e(number_format($receivableFromCorporateClient, 2)); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div class="card shadow-sm border-0 mt-4 <?php echo e($totalPaidAmount < $grandTotal ? 'd-block' : 'd-none'); ?>"
                        id="invoice-payment-form">
                        <div class="card-header bg-light border-bottom">
                            <h4 class="card-title font-weight-bold"><?php echo app('translator')->get('Add Payment'); ?></h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo e($invoice->id); ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small"
                                            for="payment_type"><?php echo app('translator')->get('Payment Type'); ?></label>
                                        <select name="payment_type" id="payment_type" class="form-control select2">
                                            <option value=""><?php echo app('translator')->get('Select'); ?></option>
                                            <option value="cash"><?php echo app('translator')->get('Cash'); ?></option>
                                            <option value="card"><?php echo app('translator')->get('Card'); ?></option>
                                            <option value="bank"><?php echo app('translator')->get('Bank Transfer'); ?></option>
                                            <option value="insurance"><?php echo app('translator')->get('Insurance'); ?></option>
                                            <!-- Add other payment types as needed -->
                                        </select>
                                    </div>
                                </div>
                                <div id="insuranceSection" style="display: none;" class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small"
                                            for="payment_insurance_name"><?php echo app('translator')->get('Insurance Name'); ?></label>
                                        <input type="text" id="payment_insurance_name" class="form-control" readonly>
                                        <input type="hidden" name="payment_insurance_id" id="payment_insurance_id">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small"
                                            for="paid_amount"><?php echo app('translator')->get('Paid Amount'); ?></label>
                                        <input type="number" step=".01" name="paid_amount" id="paid_amount"
                                            class="form-control" placeholder="<?php echo app('translator')->get('Paid Amount'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label
                                            class="font-weight-bold text-secondary text-uppercase small"><?php echo app('translator')->get('Payment Date'); ?>
                                            <b class="text-danger">*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="datetime" name="payment_date" id="payment_date"
                                                class="form-control flatpickr <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                placeholder="<?php echo app('translator')->get('Payment Date'); ?>"
                                                value="<?php echo e(old('payment_date', date('Y-m-d'), $invoice->payment_date)); ?>"
                                                required data-parsley-required="true">

                                        </div>
                                        <?php $__errorArgs = ['payment_date'];
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
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold text-secondary text-uppercase small"
                                            for="comments"><?php echo app('translator')->get('Comments'); ?></label>
                                        <textarea name="comments" id="comments" class="form-control" rows="2" placeholder="<?php echo app('translator')->get('Comments'); ?>"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-info toLoad-btn-custom"
                                        id="save-invoice-payment"><?php echo app('translator')->get('Save Payment'); ?></button>
                                    <button class="btn btn-info d-none loader-btn-custom" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden ">Loading...</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm border-0 mt-4">
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Invoice Payments'); ?></h3>
                        </div>

                        <div class="p-4">
                            <div class="alert alert-success mt-3 "
                                style="<?php echo e($totalPaidAmount == $grandTotal ? 'display:block' : 'display:none'); ?>"
                                id="success-payment-custom">
                                All payments have been made for this invoice.
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0" id="laravel_datatable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-top-0"><?php echo app('translator')->get('Invoice Number'); ?></th>
                                            <th class="border-top-0"><?php echo app('translator')->get('Amount Paid'); ?></th>
                                            <th class="border-top-0"><?php echo app('translator')->get('Payment Mode'); ?></th>
                                            <th class="border-top-0"><?php echo app('translator')->get('Insurance'); ?></th>
                                            <th class="border-top-0"><?php echo app('translator')->get('Payment Date'); ?></th>
                                            <th class="border-top-0"><?php echo app('translator')->get('Created Date'); ?></th>
                                            <th class="border-top-0"><?php echo app('translator')->get('Comments'); ?></th>
                                            <th class="border-top-0"><?php echo app('translator')->get('Actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $invoicePayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoicePayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr data-payment-id="<?php echo e($invoicePayment->id); ?>">
                                                <td><?php echo e($invoicePayment->invoice_id); ?></td>
                                                <td><?php echo e($invoicePayment->paid_amount); ?></td>
                                                <td><?php echo e($invoicePayment->payment_type); ?></td>
                                                <td><?php echo e(isset($invoicePayment->insurance_id) ? $invoicePayment->insurance_id : '-'); ?>

                                                </td>
                                                <td><?php echo e($invoicePayment->payment_date); ?></td>
                                                <td><?php echo e($invoicePayment->created_at); ?></td>
                                                <td><?php echo e($invoicePayment->comments); ?></td>
                                                <td>
                                                    <button class="btn btn-outline-danger btn-sm delete-payment"
                                                        data-id="<?php echo e($invoicePayment->id); ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>




    <?php $__env->startPush('footer'); ?>
        <script src="<?php echo e(asset('assets/js/custom/invoice.js')); ?>"></script>
        <script>
            var remainingBalanceUrl = "<?php echo e(route('invoice.remainingBalance', ['invoice' => ':invoice'])); ?>";
        </script>
        <script>
            var baseUrl = "<?php echo e(url('/')); ?>/";

            $(document).ready(function() {

                // Load Procedures when Category changes
                $(document).on("change", 'select[name="procedure_category_id[]"]', function() {
                    const $row = $(this).closest("tr");
                    const catId = $(this).val();
                    const $procSelect = $row.find('select[name="procedure_id[]"]');
                    const originalProcedureId = $row.find('.original_procedure_id').val() || '';

                    $procSelect.html('<option value="" disabled selected>Loading...</option>');

                    if (!catId) {
                        $procSelect.html('<option value="" disabled selected>Select Procedure</option>');
                        $row.find('.price, .sub_total').val('0.00');
                        recalculateAll();
                        return;
                    }

                    $.ajax({
                        url: baseUrl + "getprocedurefromcategory/" + catId,
                        type: "GET",
                        success: function(data) {
                            $procSelect.empty().append(
                                '<option value="" disabled selected>Select Procedure</option>');
                            $.each(data, function(key, value) {
                                const isSelected = (value.id == originalProcedureId) ?
                                    'selected' : '';
                                const displayText = value.procedure_code || 'Procedure ' +
                                    value.id;
                                $procSelect.append(
                                    `<option value="${value.id}" ${isSelected}>${displayText}</option>`
                                );
                            });

                            if (originalProcedureId) {
                                $procSelect.val(originalProcedureId).trigger('change');
                            }
                        },
                        error: function() {
                            alert('Failed to load procedures.');
                            $procSelect.html('<option value="" disabled selected>Error</option>');
                        }
                    });
                });

                // Load Procedure Details
                $(document).on("change", 'select[name="procedure_id[]"]', function() {
                    const $row = $(this).closest("tr");
                    const procId = $(this).val();

                    $row.find('input[name="title[]"]').val('');
                    $row.find('input[name="description[]"]').val('');
                    $row.find('input[name="price[]"]').val('0.00');
                    $row.find('.sub_total').val('0.00');

                    if (!procId) {
                        recalculateAll();
                        return;
                    }

                    $.ajax({
                        url: baseUrl + "getproceduredescription/" + procId,
                        type: "GET",
                        success: function(data) {
                            if (data && data.procedure) {
                                $row.find('input[name="title[]"]').val(data.procedure.title || '');
                                $row.find('input[name="description[]"]').val(data.procedure
                                    .description || '');
                                $row.find('input[name="price[]"]').val(data.procedure.price ||
                                    '0.00');
                                recalculateAll();
                            }
                        },
                        error: function() {
                            alert('Failed to load procedure details.');
                        }
                    });
                });

                // Full Recalculation
                function recalculateAll(e) {
                    let total = 0;
                    $('#t1 tbody tr').each(function() {
                        const $row = $(this);
                        const quantity = parseFloat($row.find('.quantity').val()) || 0;
                        const price = parseFloat($row.find('.price').val()) || 0;
                        const subtotal = quantity * price;
                        $row.find('.sub_total').val(subtotal.toFixed(2));
                        total += subtotal;
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

                        // Preserve existing discount amount on load if percentage is missing
                        let currentDiscountAmount = parseFloat($('.discount').val()) || 0;
                        if (discountPercent === 0 && currentDiscountAmount > 0) {
                            discountAmount = currentDiscountAmount;
                            if (total > 0) {
                                discountPercent = (discountAmount / total) * 100;
                                $('.discount_percentage').val(discountPercent.toFixed(2));
                            }
                        } else {
                            discountAmount = (total * discountPercent) / 100;
                        }

                        $('.discount').val(discountAmount.toFixed(2));
                    }

                    const grandTotal = total - discountAmount;
                    $('.grand_total').val(grandTotal.toFixed(2));

                    const paid = parseFloat($('.paid').val()) || 0;
                    $('.due').val((grandTotal - paid).toFixed(2));
                }

                // Event Listeners
                $(document).on('input change keyup', '.quantity, .price, .discount_percentage, .discount',
                    recalculateAll);

                $(document).on('click', '.m-add, .m-remove', function() {
                    setTimeout(recalculateAll, 50);
                });

                // CRITICAL: Initialize ALL pre-filled categories in edit mode
                $('select[name="procedure_category_id[]"]').each(function() {
                    if ($(this).val()) {
                        $(this).trigger('change'); // This is what was missing!
                    }
                });

                // Initial calculation
                recalculateAll();

                // ========================
                // Your Payment & Insurance Logic (unchanged)
                // ========================
                fetchPaidAmount();

                var userInsuranceProviderId = "<?php echo e($invoice->user->patientDetails->insurance->id ?? ''); ?>";
                var userInsuranceProviderName = "<?php echo e($invoice->user->patientDetails->insurance->name ?? ''); ?>";
                var insuranceVerified = "<?php echo e($invoice->user->patientDetails->insurance_verified ?? ''); ?>";

                if (!userInsuranceProviderId || insuranceVerified.toLowerCase() !== 'yes') {
                    $('#payment_type option[value="insurance"]').remove();
                }

                $('#payment_type').change(function() {
                    var selectedPaymentType = $(this).val();
                    if (selectedPaymentType === 'insurance') {
                        $('#insuranceSection').show();
                        selectUserInsuranceProvider();
                    } else {
                        $('#insuranceSection').hide();
                        $('#payment_insurance_name').val('');
                        $('#payment_insurance_id').val('');
                    }
                }).trigger('change');

                document.getElementById('save-invoice-payment').addEventListener('click', function() {
                    const invoiceId = document.getElementById('invoice_id').value;
                    const paidAmount = parseFloat(document.getElementById('paid_amount').value || 0);

                    $.ajax({
                        url: remainingBalanceUrl.replace(':invoice', invoiceId),
                        method: 'GET',
                        success: function(data) {
                            const remainingBalance = data.remaining_balance;
                            if (paidAmount > remainingBalance) {
                                alert('Paid amount exceeds remaining balance.');
                            } else {
                                saveInvoicePayment();
                            }
                        },
                        error: function() {
                            console.error('Error fetching remaining balance');
                        }
                    });
                });

                function saveInvoicePayment() {
                    var invoice_id = "<?php echo e($invoice->id); ?>";
                    var insurance_id = $('#payment_insurance_id').val() || null;
                    var paid_amount = $('#paid_amount').val();
                    var payment_type = $('#payment_type').val();
                    var comments = $('#comments').val();
                    var payment_date = $('#payment_date').val();

                    const loadBtn = document.querySelector('.toLoad-btn-custom');
                    const loaderBtn = document.querySelector('.loader-btn-custom');

                    if (!loadBtn || !loaderBtn) return;

                    loadBtn.classList.add('d-none');
                    loaderBtn.classList.remove('d-none');
                    loaderBtn.style.display = 'inline-block';
                    loaderBtn.disabled = true;

                    $.ajax({
                        url: "<?php echo e(route('invoice-payments.store')); ?>",
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            invoice_id: invoice_id,
                            insurance_id: insurance_id,
                            paid_amount: paid_amount,
                            payment_type: payment_type,
                            comments: comments,
                            payment_date: payment_date
                        },
                        success: function(response) {
                            if (!response || !response.invoicePayment) {
                                alert('Invalid response.');
                                return;
                            }
                            var data = response.invoicePayment;
                            var invoice = response.invoice || {};

                            var newRow = `
                    <tr data-payment-id="${data.id}">
                        <td>${data.invoice_id}</td>
                        <td>${data.paid_amount}</td>
                        <td>${data.payment_type || ''}</td>
                        <td>${data.insurance_id ? data.insurance_id : '-'}</td>
                        <td>${data.payment_date}</td>
                        <td>${data.created_at}</td>
                        <td>${data.comments || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-payment" data-id="${data.id}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>`;

                            $('#laravel_datatable tbody').append(newRow);

                            $('#payment_insurance_name, #payment_insurance_id, #paid_amount, #comments')
                                .val('');

                            // Reset payment_date to today instead of clearing it
                            const today = new Date().toISOString().split('T')[0];
                            $('#payment_date').val(today);

                            $('#payment_type').val('').trigger('change');

                            if ($('#total-paid').length) $('#total-paid').text((invoice.paid || 0).toFixed(
                                2));
                            if ($('#remaining-due').length) $('#remaining-due').text((invoice.due || 0)
                                .toFixed(2));

                            alert('Payment saved successfully.');
                            fetchPaidAmount();
                        },
                        error: function(xhr) {
                            let msg = 'Error saving payment.';
                            if (xhr.responseJSON?.error) msg = xhr.responseJSON.error;
                            else if (xhr.responseJSON?.message) msg = xhr.responseJSON.message;
                            alert(msg);
                        },
                        complete: function() {
                            loaderBtn.classList.add('d-none');
                            loadBtn.classList.remove('d-none');
                            loadBtn.disabled = false;
                        }
                    });
                }

                function fetchPaidAmount() {
                    const invoiceId = "<?php echo e($invoice->id); ?>";
                    fetch(`<?php echo e(route('invoices.fetchPaidAmount', $invoice->id)); ?>`)
                        .then(response => response.json())
                        .then(data => {
                            $('#paid').val(data.paid_amount);
                            $('#due').val(data.due_amount);

                            if (data.due_amount == 0 || data.paid_amount > 0) {
                                // $('.discount_percentage').prop('readonly', true);
                                // $('.discount').prop('readonly', true);
                                // Add other readonly fields if needed
                            }

                            const paymentForm = document.querySelector("#invoice-payment-form");
                            const successMessage = document.querySelector("#success-payment-custom");
                            if (data.due_amount == 0 && data.paid_amount > 0) {
                                if (successMessage) successMessage.style.display = "block";
                                if (paymentForm) paymentForm.style.display = "none";
                            }
                        })
                        .catch(error => console.error('Error fetching paid amount:', error));
                }

                function selectUserInsuranceProvider() {
                    if (userInsuranceProviderId) {
                        $('#payment_insurance_id').val(userInsuranceProviderId);
                        $('#payment_insurance_name').val(userInsuranceProviderName);
                    }
                }

            });
        </script>
        <script>
            // Delete Payment
            $(document).on('click', '.delete-payment', function() {
                const paymentId = $(this).data('id');
                const $row = $(this).closest('tr');

                if (!confirm('Are you sure you want to delete this payment? This action cannot be undone.')) {
                    return;
                }

                $.ajax({
                    url: "<?php echo e(route('invoice-payments.destroy', '')); ?>/" +
                        paymentId, // Assuming named route invoice-payments.destroy
                    method: 'POST',
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        $row.remove();
                        alert('Payment deleted successfully.');
                        fetchPaidAmount(); // Refresh paid/due amounts and lock fields if needed
                    },
                    error: function(xhr) {
                        let msg = 'Error deleting payment.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg += ' ' + xhr.responseJSON.message;
                        }
                        alert(msg);
                    }
                });
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/invoices/edit.blade.php ENDPATH**/ ?>