<?php $__env->startSection('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('Prescription List'); ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prescription-create')): ?>
                <a href="<?php echo e(route('prescriptions.create')); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Prescription'); ?>
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
                        <h3 class="card-title font-weight-bold ml-1"><?php echo app('translator')->get('Filter Prescriptions'); ?></h3>
                        <div class="card-tools">
                            <button class="btn btn-outline-secondary btn-sm" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?>
                            </button>
                        </div>
                    </div>

                    <div id="filter" class="collapse <?php if(request('isFilterActive')): ?> show <?php endif; ?>">
                        <div class="card-body p-3 bg-light border-bottom">
                            <form action="" method="get" role="form" autocomplete="off">
                                <input type="hidden" name="isFilterActive" value="true">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Patient'); ?></label>
                                            <select name="user_id" class="form-control form-control-sm select2" id="user_id">
                                                <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($patient->id); ?>" <?php echo e((is_array(request('user_id')) ? '' : request('user_id')) == $patient->id ? 'selected' : ''); ?>>
                                                    <?php echo e($patient->name); ?> - <?php echo e($patient->patientDetails->mrn_number ?? ''); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Doctor'); ?></label>
                                            <select name="doctor_id" class="form-control form-control-sm select2" id="doctor_id">
                                                <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                <?php $__currentLoopData = $doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($doctor->id); ?>" <?php echo e((is_array(request('doctor_id')) ? '' : request('doctor_id')) == $doctor->id ? 'selected' : ''); ?>>
                                                    <?php echo e($doctor->name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Prescription Date'); ?></label>
                                            <input type="text" name="prescription_date" id="prescription_date" class="form-control form-control-sm flatpickr" placeholder="<?php echo app('translator')->get('Date'); ?>" value="<?php echo e(is_array(request('prescription_date')) ? '' : request('prescription_date')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Start Date'); ?></label>
                                            <input type="text" name="start_date" id="start_date" class="form-control form-control-sm flatpickr" placeholder="<?php echo app('translator')->get('Start'); ?>" value="<?php echo e(is_array(request('start_date')) ? '' : request('start_date')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('End Date'); ?></label>
                                            <input type="text" name="end_date" id="end_date" class="form-control form-control-sm flatpickr" placeholder="<?php echo app('translator')->get('End'); ?>" value="<?php echo e(is_array(request('end_date')) ? '' : request('end_date')); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-right mt-4">
                                        <button type="submit" class="btn btn-info btn-sm"><?php echo app('translator')->get('Submit'); ?></button>
                                        <?php if(request('isFilterActive')): ?>
                                        <a href="<?php echo e(route('prescriptions.index')); ?>" class="btn btn-secondary btn-sm ml-2"><?php echo app('translator')->get('Clear'); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0" id="laravel_datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Patient</th>
                                        <th><?php echo app('translator')->get('Date'); ?></th>
                                        <th data-orderable="false" class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="align-middle"><?php echo e($prescription->doctor->name ?? '-'); ?></td>
                                        <td class="align-middle"><?php echo e($prescription->user->name ?? '-'); ?></td>
                                        <td class="align-middle"><?php echo e(date($companySettings->date_format ?? 'Y-m-d', strtotime($prescription->prescription_date))); ?></td>
                                        <td class="align-middle text-right">
                                            <div class="btn-group">
                                                <a href="<?php echo e(route('prescriptions.show', $prescription)); ?>" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="<?php echo app('translator')->get('View'); ?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prescription-update')): ?>
                                                <a href="<?php echo e(route('prescriptions.edit', $prescription)); ?>?user_id=<?php echo e($prescription->user_id); ?>" class="btn btn-sm btn-outline-warning ml-1" data-toggle="tooltip" title="<?php echo app('translator')->get('Edit'); ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('prescription-delete')): ?>
                                                <a href="#" data-href="<?php echo e(route('prescriptions.destroy', $prescription)); ?>" class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal" data-target="#myModal" title="<?php echo app('translator')->get('Delete'); ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <?php echo e($prescriptions->withQueryString()->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer'); ?>
<?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/prescriptions/index.blade.php ENDPATH**/ ?>