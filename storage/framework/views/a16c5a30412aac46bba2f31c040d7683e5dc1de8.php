<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Invoice List'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('invoice-create')): ?>
                        <a href="<?php echo e(route('invoices.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Invoice'); ?>
                        </a>
                    <?php endif; ?>
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
                            <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Filter Invoices'); ?></h3>
                            <div class="card-tools">
                                <a class="btn btn-outline-primary btn-sm" target="_blank"
                                    href="<?php echo e(route('invoices.index')); ?>?export=1">
                                    <i class="fas fa-cloud-download-alt"></i> <?php echo app('translator')->get('Export'); ?>
                                </a>
                                <button class="btn btn-outline-secondary btn-sm ml-2" data-toggle="collapse" href="#filter">
                                    <i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?>
                                </button>
                            </div>
                        </div>

                        <div id="filter" class="collapse <?php if(request()->isFilterActive): ?> show <?php endif; ?>">
                            <div class="card-body p-3 bg-light border-bottom">
                                <form action="" method="get" role="form" autocomplete="off">
                                    <input type="hidden" name="isFilterActive" value="true">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Patient'); ?></label>
                                                <select name="user_id" class="form-control form-control-sm select2"
                                                    id="user_id">
                                                    <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                    <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($patient->id); ?>"
                                                            <?php echo e(old('user_id', request()->user_id) == $patient->id ? 'selected' : ''); ?>>
                                                            <?php echo e($patient->name); ?> -
                                                            <?php echo e($patient->patientDetails->mrn_number ?? ''); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Doctor'); ?></label>
                                                <select name="doctor_id" class="form-control form-control-sm select2"
                                                    id="doctor_id">
                                                    <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                    <?php $__currentLoopData = $doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($doctor->id); ?>"
                                                            <?php echo e(old('doctor_id', request()->doctor_id) == $doctor->id ? 'selected' : ''); ?>>
                                                            <?php echo e($doctor->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Invoice Number'); ?></label>
                                                <input type="text" name="invoice_number" id="invoice_number"
                                                    class="form-control form-control-sm" placeholder="<?php echo app('translator')->get('Invoice Number'); ?>"
                                                    value="<?php echo e(old('invoice_number', request()->invoice_number)); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Invoice Date'); ?></label>
                                                <input type="text" name="invoice_date" id="invoice_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="<?php echo app('translator')->get('Invoice Date'); ?>"
                                                    value="<?php echo e(old('invoice_date', request()->invoice_date)); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Start Date'); ?></label>
                                                <input type="text" name="start_date" id="start_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="<?php echo app('translator')->get('Start Date'); ?>"
                                                    value="<?php echo e(old('start_date', request()->start_date)); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('End Date'); ?></label>
                                                <input type="text" name="end_date" id="end_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="<?php echo app('translator')->get('End Date'); ?>"
                                                    value="<?php echo e(old('end_date', request()->end_date)); ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Payment Status'); ?></label>
                                                <select name="paid" class="form-control form-control-sm select2"
                                                    id="paid">
                                                    <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                    <option value="partial"
                                                        <?php echo e(old('paid', request()->paid) == 'partial' ? 'selected' : ''); ?>>
                                                        <?php echo app('translator')->get('Partial'); ?></option>
                                                    <option value="complete"
                                                        <?php echo e(old('paid', request()->paid) == 'complete' ? 'selected' : ''); ?>>
                                                        <?php echo app('translator')->get('Complete'); ?></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 text-right mt-4">
                                            <button type="submit" class="btn btn-info btn-sm"><?php echo app('translator')->get('Submit'); ?></button>
                                            <?php if(request()->isFilterActive): ?>
                                                <a href="<?php echo e(route('invoices.index')); ?>"
                                                    class="btn btn-secondary btn-sm ml-2"><?php echo app('translator')->get('Clear'); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-hover table-striped" id="laravel_datatable">
                                <thead class="bg-light">
                                    <tr>

                                        <th><?php echo app('translator')->get('Invoice #'); ?></th>
                                        <th><?php echo app('translator')->get('Patient'); ?></th>
                                        <th><?php echo app('translator')->get('Doctor'); ?></th>
                                        <th><?php echo app('translator')->get('Date'); ?></th>
                                        <th>Total</th>
                                        <th>Discount</th>
                                        <th>After Discount</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th><?php echo app('translator')->get('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php
                                            $insurance = '';
                                            if ($invoice->checkInsurance()) {
                                                $insurance = "<i class='fa fa-flag text-danger' title='Invoice with insurance'></i>";
                                            }
                                            ?>
                                            <td><span style="text-wrap:nowrap;"><?php echo e($invoice->invoice_number ?? '-'); ?>

                                                    <?= $insurance ?></span></td>
                                            <td><?php echo e($invoice->user->name ?? '-'); ?></td>
                                            <td>
                                                <?php echo e($invoice->doctor->name ?? ($invoice->patienttreatmentplan->doctor->name ?? '-')); ?>

                                            </td>
                                            <td> <?php echo e(date($companySettings->date_format ?? 'Y-m-d', strtotime($invoice->invoice_date))); ?>

                                            </td>
                                            <td><?php echo e(number_format($invoice->total)); ?></td>
                                            <td><?php echo e(number_format($invoice->total_discount)); ?></td>
                                            <td><?php echo e(number_format($invoice->grand_total)); ?></td>
                                            <td><?php echo e(number_format($invoice->paid)); ?></td>
                                            <td><?php echo e(number_format($invoice->due)); ?></td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <a href="<?php echo e(route('invoices.invoiceTemplate', $invoice)); ?>"
                                                        class="btn btn-sm btn-outline-info ml-1" data-toggle="tooltip"
                                                        title="<?php echo app('translator')->get('View'); ?>"><i class="fas fa-eye"></i></a>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('invoice-update')): ?>
                                                        <a href="<?php echo e(route('invoices.edit', $invoice)); ?>"
                                                            class="btn btn-sm btn-outline-warning ml-1" data-toggle="tooltip"
                                                            title="<?php echo app('translator')->get('Edit'); ?>"><i class="fas fa-edit"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('invoice-delete')): ?>
                                                        <a href="#"
                                                            data-href="<?php echo e(route('invoices.destroy', $invoice->id)); ?>"
                                                            class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal"
                                                            data-target="#myModal" title="<?php echo app('translator')->get('Delete'); ?>"><i
                                                                class="fa fa-trash"></i></a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4"><?php echo app('translator')->get('Total'); ?></th>
                                        <th><?php echo e(number_format($total)); ?></th>
                                        <th><?php echo e(number_format($totalTotalDiscount)); ?></th>
                                        <th><?php echo e(number_format($totalGrandTotal)); ?></th>
                                        <th><?php echo e(number_format($totalPaid)); ?></th>
                                        <th><?php echo e(number_format($totalDue)); ?></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="mt-3">
                                <?php echo e($invoices->withQueryString()->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/invoices/index.blade.php ENDPATH**/ ?>