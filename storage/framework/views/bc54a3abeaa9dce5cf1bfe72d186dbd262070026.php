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
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('Doctor List'); ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('doctor-detail-create')): ?>
                <a href="<?php echo e(route('doctor-details.create')); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Doctor'); ?>
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
                        <h3 class="card-title font-weight-bold ml-1"><?php echo app('translator')->get('Filter Doctors'); ?></h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-primary btn-sm" target="_blank"
                                href="<?php echo e(route('doctor-details.index')); ?>?export=1">
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
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Name'); ?></label>
                                            <input type="text" name="name" class="form-control form-control-sm"
                                                value="<?php echo e(request()->name); ?>" placeholder="<?php echo app('translator')->get('Name'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Email'); ?></label>
                                            <input type="text" name="email" class="form-control form-control-sm"
                                                value="<?php echo e(request()->email); ?>" placeholder="<?php echo app('translator')->get('Email'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Phone'); ?></label>
                                            <input type="text" name="phone" class="form-control form-control-sm"
                                                value="<?php echo e(request()->phone); ?>" placeholder="<?php echo app('translator')->get('Phone'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Status'); ?></label>
                                            <select name="status" class="form-control form-control-sm">
                                                <option value="">-- <?php echo app('translator')->get('Select'); ?> --</option>
                                                <option value="1" <?php echo e(request()->status == '1' ? 'selected' : ''); ?>><?php echo app('translator')->get('Active'); ?>
                                                </option>
                                                <option value="0" <?php echo e(request()->status == '0' ? 'selected' : ''); ?>><?php echo app('translator')->get('Inactive'); ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Start Date'); ?></label>
                                            <input type="text" name="start_date" id="start_date"
                                                class="form-control form-control-sm flatpickr" placeholder="<?php echo app('translator')->get('Start Date'); ?>"
                                                value="<?php echo e(old('start_date', request()->start_date)); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-right mt-4">
                                        <button type="submit" class="btn btn-info btn-sm"><?php echo app('translator')->get('Submit'); ?></button>
                                        <?php if(request('isFilterActive')): ?>
                                        <a href="<?php echo e(route('doctor-details.index')); ?>" class="btn btn-secondary btn-sm ml-2"><?php echo app('translator')->get('Clear'); ?></a>
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
                                        <!-- <th><?php echo app('translator')->get('Photo'); ?></th> -->
                                        <th><?php echo app('translator')->get('Name'); ?></th>
                                        <th><?php echo app('translator')->get('Email'); ?></th>
                                        <th><?php echo app('translator')->get('Phone'); ?></th>
                                        <th><?php echo app('translator')->get('Specialist'); ?></th>
                                        <th><?php echo app('translator')->get('Status'); ?></th>
                                        <th data-orderable="false"><?php echo app('translator')->get('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $doctorDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctorDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <!-- <td>
                                            <img src="<?php echo e($doctorDetail->user->photo_url); ?>" class="img-circle elevation-2" alt="User Image" height="40" width="40" style="object-fit: cover;">
                                        </td> -->
                                        <td><?php echo e($doctorDetail->user->name ?? '-'); ?></td>
                                        <td><?php echo e($doctorDetail->user->email ?? '-'); ?></td>
                                        <td><?php echo e($doctorDetail->user->phone ?? '-'); ?></td>
                                        <td><?php echo e($doctorDetail->specialist ?? '-'); ?></td>
                                        <td>
                                            <?php if($doctorDetail->user->status == 1): ?>
                                            <span class="badge badge-success"><?php echo app('translator')->get('Active'); ?></span>
                                            <?php else: ?>
                                            <span class="badge badge-danger"><?php echo app('translator')->get('Inactive'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('doctor-menu-read')): ?>
                                                <button type="button" class="btn btn-sm btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo app('translator')->get('Menu'); ?>">
                                                    <i class="fas fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="<?php echo e(route('doctor-schedules.createFromDoctorDetails', ['userid' => $doctorDetail->user->id])); ?>">
                                                        <?php echo app('translator')->get('Create New Schedule'); ?>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="<?php echo e(route('doctor-schedules.index', ['userid' => $doctorDetail->user->id])); ?>">
                                                        <?php echo app('translator')->get('View Schedules'); ?>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="<?php echo e(route('patient-appointments.index', ['userid' => $doctorDetail->user->id])); ?>">
                                                        <?php echo app('translator')->get('View Appointments'); ?>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="<?php echo e(route('exam-investigations.index', ['doctor_id' => $doctorDetail->id])); ?>">
                                                        <?php echo app('translator')->get('View Exam & Investigations'); ?>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="<?php echo e(route('prescriptions.index', ['doctor_id' => $doctorDetail->user->id])); ?>">
                                                        <?php echo app('translator')->get('View Prescriptions'); ?>
                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                                <a href="<?php echo e(route('doctor-schedules.bulk-edit', ['userid' => $doctorDetail->user->id])); ?>" class="btn btn-sm btn-outline-success ml-1" data-toggle="tooltip" title="<?php echo app('translator')->get('Manage Weekly Schedule'); ?>">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </a>
                                                <a href="<?php echo e(route('doctor-details.show', $doctorDetail)); ?>" class="btn btn-sm btn-outline-info ml-1" data-toggle="tooltip" title="<?php echo app('translator')->get('View'); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('doctor-detail-update')): ?>
                                                <a href="<?php echo e(route('doctor-details.edit', $doctorDetail)); ?>" class="btn btn-sm btn-outline-warning ml-1" data-toggle="tooltip" title="<?php echo app('translator')->get('Edit'); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('doctor-detail-delete')): ?>
                                                <a href="#" data-href="<?php echo e(route('doctor-details.destroy', $doctorDetail)); ?>" class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal" data-target="#myModal" title="<?php echo app('translator')->get('Delete'); ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white">
                            <?php echo e($doctorDetails->withQueryString()->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/doctor-detail/index.blade.php ENDPATH**/ ?>