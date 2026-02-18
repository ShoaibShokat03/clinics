<?php $__env->startSection('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('Treatment Plans'); ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-treatment-plans-create')): ?>
                <a href="<?php echo e(route('patient-treatment-plans.create')); ?>" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add New Plan'); ?>
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
                        <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Treatment Plans'); ?></h3>
                        <div class="card-tools">
                            <a class="btn btn-success btn-sm" target="_blank"
                                href="<?php echo e(route('patient-treatment-plans.index')); ?>?export=1">
                                <i class="fas fa-cloud-download-alt"></i> <?php echo app('translator')->get('Export'); ?>
                            </a>
                            <button class="btn btn-default btn-sm" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="filter" class="collapse <?php if(request()->isFilterActive): ?> show <?php endif; ?>">
                            <div class="card-body border mb-3">
                                <form action="" method="get" role="form" autocomplete="off">
                                    <input type="hidden" name="isFilterActive" value="true">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo app('translator')->get('MRN Number'); ?></label>
                                                <input type="text" name="mrn_number" class="form-control"
                                                    value="<?php echo e(request()->mrn_number); ?>" placeholder="<?php echo app('translator')->get('MRN Number'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo app('translator')->get('Patient'); ?></label>
                                                <select name="patient_id" class="form-control select2">
                                                    <option value=""><?php echo app('translator')->get('Select Patient'); ?></option>
                                                    <?php $__currentLoopData = $patientsinfo->sortBy(fn($patient) => strtolower($patient->user->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($patient->user_id); ?>"
                                                        <?php echo e(request()->patient_id == $patient->user_id ? 'selected' : ''); ?>>
                                                        <?php echo e(($patient->user->name ?? '') . ' - ' . ($patient->mrn_number ?? '')); ?>

                                                    </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo app('translator')->get('Doctor'); ?></label>
                                                <select name="doctor_id" class="form-control select2">
                                                    <option value=""><?php echo app('translator')->get('Select Doctor'); ?></option>
                                                    <?php $__currentLoopData = $doctors->sortBy(fn($doctor) => strtolower($doctor->user->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($doctor->user->name)): ?>
                                                    <option value="<?php echo e($doctor->user_id); ?>"
                                                        <?php echo e(request()->doctor_id == $doctor->user_id ? 'selected' : ''); ?>>
                                                        <?php echo e($doctor->user->name); ?>

                                                    </option>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo app('translator')->get('Examination Number'); ?></label>
                                                <input type="text" name="examination_number" class="form-control"
                                                    value="<?php echo e(request()->examination_number); ?>"
                                                    placeholder="<?php echo app('translator')->get('Examination Number'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" class="btn btn-info btn-sm px-4"><?php echo app('translator')->get('Submit'); ?></button>
                                            <?php if(request()->isFilterActive): ?>
                                            <a href="<?php echo e(route('patient-treatment-plans.index')); ?>"
                                                class="btn btn-secondary btn-sm px-4"><?php echo app('translator')->get('Clear'); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="laravel_datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th><?php echo app('translator')->get("Treatment Plan's"); ?></th>
                                        <th style="text-wrap:nowrap;"><?php echo app('translator')->get("Examination No"); ?></th>
                                        <th><?php echo app('translator')->get("Patient's"); ?></th>
                                        <th><?php echo app('translator')->get("Doctor's"); ?></th>
                                        <th class="text-right"><?php echo app('translator')->get('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $patientTreatmentPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientTreatmentPlan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($patientTreatmentPlan->treatment_plan_number ?? '-'); ?></td>
                                        <td><?php echo e($patientTreatmentPlan->examinvestigation->examination_number ?? '-'); ?></td>
                                        <td><?php echo e($patientTreatmentPlan->patient->name ?? '-'); ?></td>
                                        <td><?php echo e($patientTreatmentPlan->doctor->name ?? '-'); ?></td>
                                        <td class="text-right">
                                            <a href="<?php echo e(route('patient-treatment-plans.show', $patientTreatmentPlan->id)); ?>"
                                                class="btn btn-sm btn-outline-info"
                                                data-toggle="tooltip" title="<?php echo app('translator')->get('View'); ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-treatment-plans-update')): ?>
                                            <a href="<?php echo e(route('patient-treatment-plans.edit', $patientTreatmentPlan->id)); ?>"
                                                class="btn btn-sm btn-outline-warning ml-1"
                                                data-toggle="tooltip" title="<?php echo app('translator')->get('Edit'); ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-treatment-plans-delete')): ?>
                                            <a href="#"
                                                data-href="<?php echo e(route('patient-treatment-plans.destroy', $patientTreatmentPlan)); ?>"
                                                class="btn btn-sm btn-outline-danger ml-1"
                                                data-toggle="modal" data-target="#myModal" title="<?php echo app('translator')->get('Delete'); ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <?php echo e($patientTreatmentPlans->withQueryString()->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/patient-treatment-plans/index.blade.php ENDPATH**/ ?>