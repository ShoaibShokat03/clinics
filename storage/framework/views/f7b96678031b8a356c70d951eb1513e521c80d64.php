<?php $__env->startSection('content'); ?>
<style>
    body {
        overscroll-x: hidden;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('Exam & Diagnosis List'); ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('exam-investigations-create')): ?>
                <a href="<?php echo e(route('exam-investigations.create')); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Exam & Diagnosis'); ?>
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
                        <h3 class="card-title font-weight-bold ml-1"><?php echo app('translator')->get('Filter Exam & Diagnosis'); ?></h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-primary btn-sm" target="_blank"
                                href="<?php echo e(route('exam-investigations.index')); ?>?export=1">
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
                                <div class="row align-items-end">
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Examination Number'); ?></label>
                                            <input type="text" name="examination_number" class="form-control form-control-sm"
                                                value="<?php echo e(request()->examination_number); ?>" placeholder="<?php echo app('translator')->get('Exm. #'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('MRN Number'); ?></label>
                                            <input type="text" name="mrn_number" class="form-control form-control-sm"
                                                value="<?php echo e(request()->mrn_number); ?>" placeholder="<?php echo app('translator')->get('MRN #'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Patient'); ?></label>
                                            <select name="patient_id" class="form-control form-control-sm select2">
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
                                    <div class="col-sm-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Doctor'); ?></label>
                                            <select name="doctor_id" class="form-control form-control-sm select2">
                                                <option value=""><?php echo app('translator')->get('Select Doctor'); ?></option>
                                                <?php $__currentLoopData = $doctors->sortBy(fn($doctors) => strtolower($doctors->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($doctor->id); ?>"
                                                    <?php echo e(request()->doctor_id == $doctor->id ? 'selected' : ''); ?>>
                                                    <?php echo e($doctor->name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <div class="form-group mb-2">
                                            <button type="submit" class="btn btn-info btn-sm"><?php echo app('translator')->get('Submit'); ?></button>
                                            <?php if(request()->isFilterActive): ?>
                                            <a href="<?php echo e(route('exam-investigations.index')); ?>"
                                                class="btn btn-secondary btn-sm ml-2"><?php echo app('translator')->get('Clear'); ?></a>
                                            <?php endif; ?>
                                        </div>
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
                                        <th class="pl-3"><?php echo app('translator')->get('Examination Number'); ?></th>
                                        <th><?php echo app('translator')->get('MRN Number'); ?></th>
                                        <th><?php echo app('translator')->get('Patient'); ?></th>
                                        <th><?php echo app('translator')->get('Doctor'); ?></th>
                                        <th><?php echo app('translator')->get('Date Created'); ?></th>
                                        <th data-orderable="false" class="text-right pr-3"><?php echo app('translator')->get('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $examInvestigations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $examInvestigation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="pl-3 font-weight-bold text-primary"><?php echo e($examInvestigation->examination_number); ?></td>
                                        <td><span class="badge badge-light border"><?php echo e($examInvestigation->patient->patientDetails->mrn_number ?? '-'); ?></span></td>
                                        <td><?php echo e($examInvestigation->patient->name ?? '-'); ?></td>
                                        <td><?php echo e($examInvestigation->doctor->name ?? '-'); ?></td>
                                        <td><?php echo e($examInvestigation->created_at->format('d-m-Y')); ?></td>
                                        <td class="text-right pr-3">
                                            <div class="btn-group">
                                                <a href="<?php echo e(route('exam-investigations.show', $examInvestigation)); ?>"
                                                    class="btn btn-sm btn-outline-info"
                                                    data-toggle="tooltip" title="<?php echo app('translator')->get('View'); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('exam-investigations-update')): ?>
                                                <a href="<?php echo e(route('exam-investigations.edit', $examInvestigation)); ?>"
                                                    class="btn btn-sm btn-outline-warning ml-1" data-toggle="tooltip"
                                                    title="<?php echo app('translator')->get('Edit'); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('exam-investigations-delete')): ?>
                                                <a href="#" data-href="<?php echo e(route('exam-investigations.destroy', $examInvestigation)); ?>"
                                                    class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal" data-target="#myModal"
                                                    title="<?php echo app('translator')->get('Delete'); ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted"><?php echo app('translator')->get('No records found'); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white">
                            <?php echo e($examInvestigations->withQueryString()->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/exam-investigation/index.blade.php ENDPATH**/ ?>