<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-medical-histories-create')): ?>
                        <h3>
                            <a href="<?php echo e(route('patient-medical-histories.create')); ?>" class="btn btn-outline btn-info">+
                                <?php echo app('translator')->get('Add Patient Medical History'); ?>
                            </a>
                        </h3>
                    <?php endif; ?>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('Dashboard'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo app('translator')->get('Patient Medical List'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title"><?php echo app('translator')->get('Patient Medical History List'); ?></h3>
                    <div class="card-tools">
                        <a class="btn btn-primary float-right" target="_blank"
                            href="<?php echo e(route('patient-medical-histories.index')); ?>?export=1">
                            <i class="fas fa-cloud-download-alt"></i> <?php echo app('translator')->get('Export'); ?>
                        </a>
                        <button class="btn btn-default" data-toggle="collapse" href="#filter">
                            <i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div id="filter" class="collapse <?php if(request()->isFilterActive): ?> show <?php endif; ?>">
                        <div class="card-body border">
                            <form action="" method="get" role="form" autocomplete="off">
                                <input type="hidden" name="isFilterActive" value="true">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('MRN Number'); ?></label>
                                            <input type="text" name="mrn_number" class="form-control"
                                                value="<?php echo e(request()->mrn_number); ?>" placeholder="<?php echo app('translator')->get('MRN Number'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                        <label><?php echo app('translator')->get('Patient'); ?></label>
                                            <select name="user_id" class="form-control select2" id="user_id">
                                                <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                <?php $__currentLoopData = $patientsinfo->sortBy(fn($patient) => strtolower($patient->user->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <?php if(!is_null(optional($patient->user)->name)): ?>
                                                    <option value="<?php echo e($patient->user_id); ?>" <?php echo e(old('user_id', request()->user_id) == $patient->user_id ? 'selected' : ''); ?>><?php echo e(($patient->user->name ?? '') . ' - ' . ($patient->mrn_number ?? '')); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <!-- <input type="text" name="name" class="form-control"
                                                value="<?php echo e(request()->name); ?>" placeholder="<?php echo app('translator')->get('Patient Name'); ?>"> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Doctor'); ?></label>
                                            <select name="doctor_id" class="form-control select2" id="doctor_id">
                                                <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                <?php $__currentLoopData = $doctors->sortBy(fn($doctor) => strtolower(optional($doctor->user)->name)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!is_null(optional($doctor->user)->name)): ?>
                                                        <option value="<?php echo e($doctor->user->id); ?>" <?php echo e(old('doctor_id', request()->doctor_id) == $doctor->user->id ? 'selected' : ''); ?>><?php echo e(optional($doctor->user)->name); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 align-content-center">
                                        <button type="submit" class="btn btn-info mt-4"><?php echo app('translator')->get('Submit'); ?></button>
                                        <?php if(request()->isFilterActive): ?>
                                            <a href="<?php echo e(route('patient-medical-histories.index')); ?>"
                                                class="btn btn-secondary mt-4"><?php echo app('translator')->get('Clear'); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped" id="laravel_datatable">
                        <thead>
                            <tr>
                                <th style="text-wrap:nowrap; min-width:110px;"><?php echo app('translator')->get('MRN Number'); ?></th>
                                <th><?php echo app('translator')->get('Patient Name'); ?></th>
                                <th><?php echo app('translator')->get('Doctor Name'); ?></th>
                                <th><?php echo app('translator')->get('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <span>
                                            <?php echo e($patient->patientDetails->mrn_number ?? ' '); ?>

                                        </span>
                                    </td>

                                    <td><?php echo e($patient->name); ?></td>
                                    <td>
                                        <?php if($patient->patientMedicalHistories->isNotEmpty()): ?>
                                            <?php echo e($patient->patientMedicalHistories->first()->doctor->name ?? 'N/A'); ?>

                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <td class="responsive-width">
                                        <?php if($patient->patientMedicalHistories->isNotEmpty()): ?>
                                            <a href="<?php echo e(route('patient-medical-histories.show', $patient->patientMedicalHistories->first())); ?>"
                                                class="responsive-width-item btn btn-info btn-outline btn-circle btn-lg"
                                                data-toggle="tooltip" title="<?php echo app('translator')->get('Show'); ?>">
                                                <i class="fa fa-eye ambitious-padding-btn"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if($patient->patientMedicalHistories->isNotEmpty()): ?>
                                            <a href="<?php echo e(route('patient-medical-histories.edit', $patient->patientMedicalHistories->first())); ?>"
                                                class="responsive-width-item btn btn-info btn-outline btn-circle btn-lg"
                                                data-toggle="tooltip" title="<?php echo app('translator')->get('Edit'); ?>">
                                                <i class="fa fa-edit ambitious-padding-btn"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($patients->withQueryString()->links()); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/patient-medical-histories/index.blade.php ENDPATH**/ ?>