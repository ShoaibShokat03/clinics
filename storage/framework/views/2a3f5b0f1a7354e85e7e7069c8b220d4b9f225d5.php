<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Patient List'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-detail-create')): ?>
                        <a href="<?php echo e(route('patient-details.create')); ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Patient'); ?>
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
                            <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Patient List'); ?></h3>
                            <div class="card-tools">
                                <a class="btn btn-success btn-sm" target="_blank"
                                    href="<?php echo e(route('patient-details.index')); ?>?export=1">
                                    <i class="fas fa-cloud-download-alt"></i> <?php echo app('translator')->get('Export'); ?>
                                </a>
                                <button class="btn btn-default btn-sm" data-toggle="collapse" href="#filter">
                                    <i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="min-height:60vh;">
                            <div id="filter" class="collapse <?php if(request()->isFilterActive): ?> show <?php endif; ?>">
                                <div class="card-body border mb-3">
                                    <form action="" method="get" role="form" autocomplete="off">
                                        <input type="hidden" name="isFilterActive" value="true">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Name'); ?></label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="<?php echo e(request()->name); ?>" placeholder="<?php echo app('translator')->get('Name'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('MRN Number'); ?></label>
                                                    <input type="text" name="mrn_number" class="form-control"
                                                        value="<?php echo e(request()->mrn_number); ?>" placeholder="<?php echo app('translator')->get('MRN Number'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Phone'); ?></label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="<?php echo e(request()->phone); ?>" placeholder="<?php echo app('translator')->get('Phone'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('City'); ?></label>
                                                    <input type="text" name="city" id="city" class="form-control"
                                                        placeholder="<?php echo app('translator')->get('city'); ?>"
                                                        value="<?php echo e(old('city', request()->city)); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Area'); ?></label>
                                                    <input type="text" name="area" id="area" class="form-control"
                                                        placeholder="<?php echo app('translator')->get('area'); ?>"
                                                        value="<?php echo e(old('area', request()->area)); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('Start Date'); ?></label>
                                                    <input type="text" name="start_date" id="start_date"
                                                        class="form-control flatpickr" placeholder="<?php echo app('translator')->get('Start Date'); ?>"
                                                        value="<?php echo e(old('start_date', request()->start_date)); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get('End Date'); ?></label>
                                                    <input type="text" name="end_date" id="end_date"
                                                        class="form-control flatpickr" placeholder="<?php echo app('translator')->get('End Date'); ?>"
                                                        value="<?php echo e(old('end_date', request()->end_date)); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3 align-self-end">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info"><?php echo app('translator')->get('Submit'); ?></button>
                                                    <?php if(request()->isFilterActive): ?>
                                                        <a href="<?php echo e(route('patient-details.index')); ?>"
                                                            class="btn btn-secondary"><?php echo app('translator')->get('Clear'); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive" style="overflow:visible !important">
                                <table class="table table-hover table-striped" id="laravel_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <!-- <th>Profile</th> -->
                                            <th><?php echo app('translator')->get('Name'); ?></th>
                                            <th style="min-width: 100px;"><?php echo app('translator')->get('MRN Number'); ?></th>
                                            <th><?php echo app('translator')->get('Phone'); ?></th>
                                            <th><?php echo app('translator')->get('Area'); ?></th>
                                            <th><?php echo app('translator')->get('City'); ?></th>
                                            <th class="text-right"><?php echo app('translator')->get('Actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $patientDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td style="display: none;">
                                                    <?php
                                                        $profilePic = $patientDetail->profilePicture;
                                                        if (is_array($profilePic)) {
                                                            $profilePic = reset($profilePic); // Take first item if array
                                                        }
                                                        // Ensure it is a valid string path
                                                        $profilePicUrl =
                                                            !empty($profilePic) && is_string($profilePic)
                                                                ? asset('storage/' . $profilePic)
                                                                : asset('assets/images/profile/male.png');
                                                    ?>
                                                    <img class="profile-user-img img-fluid img-circle"
                                                        src="<?php echo e($profilePicUrl); ?>" alt="Profile Picture"
                                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" />
                                                </td>
                                                <td>
                                                    <?php echo e($patientDetail->name); ?>

                                                    <?php if($patientDetail->patientDetails && $patientDetail->patientDetails->insurance_verified == 'yes'): ?>
                                                        <i class='fa fa-flag text-danger'
                                                            title='Patient with insurance'></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-light border"><?php echo e($patientDetail->patientDetails->mrn_number ?? '-'); ?></span>
                                                </td>
                                                <td><?php echo e($patientDetail->phone); ?></td>
                                                <td><?php echo e($patientDetail->patientDetails ? $patientDetail->patientDetails->area : '-'); ?>

                                                </td>
                                                <td><?php echo e($patientDetail->patientDetails ? $patientDetail->patientDetails->city : '-'); ?>

                                                </td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-info dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            <i class="fas fa-bars"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-appointment-create')): ?>
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('patient-appointments.createFromPatientDetails', ['userid' => $patientDetail->id])); ?>">
                                                                    <?php echo app('translator')->get('Create Appointment'); ?>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('invoices.create', ['userid' => $patientDetail->id])); ?>">
                                                                    <?php echo app('translator')->get('Create Invoice'); ?>
                                                                </a>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-treatment-plans-create')): ?>
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('patient-treatment-plans.create', ['patient_id' => $patientDetail->id])); ?>">
                                                                    <?php echo app('translator')->get('Treatment Plan'); ?>
                                                                </a>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('exam-investigations-create')): ?>
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('exam-investigations.create', ['patient_id' => $patientDetail->id])); ?>">
                                                                    <?php echo app('translator')->get('Exam & Diagnoses'); ?>
                                                                </a>
                                                            <?php endif; ?>
                                                            <div class="dropdown-divider"></div>
                                                            <?php if(
                                                                $patientDetail->patientMedicalHistories->isNotEmpty() ||
                                                                    $patientDetail->patientDentalHistories->isNotEmpty() ||
                                                                    $patientDetail->patientDrugHistories->isNotEmpty() ||
                                                                    $patientDetail->patientSocialHistories->isNotEmpty()): ?>
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('patient-details.history', $patientDetail->id)); ?>">
                                                                    <?php echo app('translator')->get('View History'); ?>
                                                                </a>
                                                            <?php endif; ?>

                                                            
                                                            <?php if($patientDetail->patientMedicalHistories->isNotEmpty()): ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-medical-histories-update')): ?>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('patient-medical-histories.edit', $patientDetail->patientMedicalHistories->first()->id)); ?>">
                                                                        <?php echo app('translator')->get('Edit Medical History'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-medical-histories-create')): ?>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('patient-medical-histories.create.from-patient', ['userid' => $patientDetail->id])); ?>">
                                                                        <?php echo app('translator')->get('Add Medical History'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            
                                                            <?php if($patientDetail->patientDentalHistories->isNotEmpty()): ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-dental-histories-update')): ?>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('patient-dental-histories.edit', $patientDetail->patientDentalHistories->first()->id)); ?>">
                                                                        <?php echo app('translator')->get('Edit Dental History'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-dental-histories-create')): ?>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('patient-dental-histories.create.from-patient', ['userid' => $patientDetail->id])); ?>">
                                                                        <?php echo app('translator')->get('Add Dental History'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            
                                                            <?php if($patientDetail->patientDrugHistories->isNotEmpty()): ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-drug-histories-update')): ?>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('patient-drug-histories.edit', $patientDetail->patientDrugHistories->first()->id)); ?>">
                                                                        <?php echo app('translator')->get('Edit Drug History'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-drug-histories-create')): ?>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('patient-drug-histories.create.from-patient', ['userid' => $patientDetail->id])); ?>">
                                                                        <?php echo app('translator')->get('Add Drug History'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            
                                                            <?php if($patientDetail->patientSocialHistories->isNotEmpty()): ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-social-histories-update')): ?>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('patient-social-histories.edit', $patientDetail->patientSocialHistories->first()->id)); ?>">
                                                                        <?php echo app('translator')->get('Edit Social History'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-social-histories-create')): ?>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('patient-social-histories.create.from-patient', ['userid' => $patientDetail->id])); ?>">
                                                                        <?php echo app('translator')->get('Add Social History'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <a href="<?php echo e(route('patient-details.show', $patientDetail)); ?>"
                                                            class="btn btn-sm btn-outline-info ml-1" data-toggle="tooltip"
                                                            title="<?php echo app('translator')->get('View'); ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-detail-update')): ?>
                                                            <a href="<?php echo e(route('patient-details.edit', $patientDetail)); ?>"
                                                                class="btn btn-sm btn-outline-warning ml-1"
                                                                data-toggle="tooltip" title="<?php echo app('translator')->get('Edit'); ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-detail-delete')): ?>
                                                            <a href="#"
                                                                data-href="<?php echo e(route('patient-details.destroy', $patientDetail)); ?>"
                                                                class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal"
                                                                data-target="#myModal" title="<?php echo app('translator')->get('Delete'); ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php echo e($patientDetails->withQueryString()->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Picture Modal -->
    <div id="profilePicModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPatientName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="profilePicModalImg" src="" alt="Profile Picture" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.profile-user-img').on('click', function() {
                var imgSrc = $(this).attr('src');
                var patientName = $(this).closest('tr').find('td:eq(1)').text().trim();

                $('#profilePicModalImg').attr('src', imgSrc);
                $('#modalPatientName').text(patientName);
                $('#profilePicModal').modal('show');
            });
        });
    </script>

    <?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 05-Feb-2026\resources\views/patient-detail/index.blade.php ENDPATH**/ ?>