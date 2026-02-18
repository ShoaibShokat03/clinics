<?php $__env->startSection('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('Doctor Info'); ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('doctor-details.index')); ?>" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to List'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3 border-bottom-0 d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Doctor Details'); ?></h3>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('doctor-detail-update')): ?>
                        <a href="<?php echo e(route('doctor-details.edit', $doctorDetail)); ?>" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit"></i> <?php echo app('translator')->get('Edit'); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                <img src="<?php echo e($doctorDetail->user->photo_url); ?>" class="img-fluid rounded-circle shadow-sm border" alt="User Image" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Name'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo e($doctorDetail->user->name ?? '-'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Email'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo e($doctorDetail->user->email ?? '-'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Phone'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo e($doctorDetail->user->phone ?? '-'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Address'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo e($doctorDetail->user->address ?? '-'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Specialist'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo e($doctorDetail->specialist); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Designation'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo e($doctorDetail->designation); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Gender'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo e(ucfirst($doctorDetail->user->gender ?? '-')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Blood Group'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo e($doctorDetail->user->ddbloodgroup->name ?? ' '); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Date of Birth'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo e($doctorDetail->user->date_of_birth ? \Carbon\Carbon::parse($doctorDetail->user->date_of_birth)->format('d-M-Y') : '-'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Status'); ?></label>
                                    <p class="mb-0">
                                        <?php if($doctorDetail->user->status == 1): ?>
                                        <span class="badge badge-success"><?php echo app('translator')->get('Active'); ?></span>
                                        <?php else: ?>
                                        <span class="badge badge-danger"><?php echo app('translator')->get('Inactive'); ?></span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label class="text-secondary small font-weight-bold mb-0"><?php echo app('translator')->get('Biography'); ?></label>
                                    <p class="font-weight-normal mb-0"><?php echo $doctorDetail->doctor_biography; ?></p>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs" id="doctorDetailTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab" aria-controls="appointments" aria-selected="true"><?php echo app('translator')->get('Appointments'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="treatment-plans-tab" data-toggle="tab" href="#treatment-plans" role="tab" aria-controls="treatment-plans" aria-selected="false"><?php echo app('translator')->get('Treatment Plans'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="investigations-tab" data-toggle="tab" href="#investigations" role="tab" aria-controls="investigations" aria-selected="false"><?php echo app('translator')->get('Exam & Investigations'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions" role="tab" aria-controls="prescriptions" aria-selected="false"><?php echo app('translator')->get('Prescriptions'); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content p-3 border border-top-0" id="doctorDetailTabContent">
                            <div class="tab-pane fade show active" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('Appointment No'); ?></th>
                                                <th><?php echo app('translator')->get('Patient Name'); ?></th>
                                                <th><?php echo app('translator')->get('Date'); ?></th>
                                                <th><?php echo app('translator')->get('Time'); ?></th>
                                                <th><?php echo app('translator')->get('Status'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $patientAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($appointment->appointment_number); ?></td>
                                                <td><?php echo e($appointment->user->name ?? '-'); ?></td>
                                                <td><?php echo e($appointment->appointment_date); ?></td>
                                                <td><?php echo e($appointment->start_time); ?> - <?php echo e($appointment->end_time); ?></td>
                                                <td>
                                                    <?php if($appointment->status == 1): ?>
                                                    <span class="badge badge-info"><?php echo app('translator')->get('Active'); ?></span>
                                                    <?php elseif($appointment->status == 2): ?>
                                                    <span class="badge badge-success"><?php echo app('translator')->get('Completed'); ?></span>
                                                    <?php elseif($appointment->status == 3): ?>
                                                    <span class="badge badge-danger"><?php echo app('translator')->get('Cancelled'); ?></span>
                                                    <?php else: ?>
                                                    <span class="badge badge-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="treatment-plans" role="tabpanel" aria-labelledby="treatment-plans-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('Plan No'); ?></th>
                                                <th><?php echo app('translator')->get('Patient Name'); ?></th>
                                                <th><?php echo app('translator')->get('Comments'); ?></th>
                                                <th><?php echo app('translator')->get('Status'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $patientTreatmentPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($plan->treatment_plan_number); ?></td>
                                                <td><?php echo e($plan->patient->name ?? '-'); ?></td>
                                                <td><?php echo e($plan->comments); ?></td>
                                                <td>
                                                    <?php if($plan->status == 1): ?>
                                                    <span class="badge badge-success"><?php echo app('translator')->get('Completed'); ?></span>
                                                    <?php else: ?>
                                                    <span class="badge badge-warning"><?php echo app('translator')->get('Pending'); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="investigations" role="tabpanel" aria-labelledby="investigations-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('Exam No'); ?></th>
                                                <th><?php echo app('translator')->get('Patient Name'); ?></th>
                                                <th><?php echo app('translator')->get('Date'); ?></th>
                                                <th><?php echo app('translator')->get('Chief Complaint'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $examInvestigations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investigation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($investigation->examination_number); ?></td>
                                                <td><?php echo e($investigation->patient->name ?? '-'); ?></td>
                                                <td><?php echo e($investigation->created_at->format('Y-m-d')); ?></td>
                                                <td><?php echo e(Str::limit($investigation->chief_complaints, 50)); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="prescriptions" role="tabpanel" aria-labelledby="prescriptions-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('Prescription No'); ?></th>
                                                <th><?php echo app('translator')->get('Patient Name'); ?></th>
                                                <th><?php echo app('translator')->get('Date'); ?></th>
                                                <th><?php echo app('translator')->get('Action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($prescription->prs_number); ?></td>
                                                <td><?php echo e($prescription->user->name ?? '-'); ?></td>
                                                <td><?php echo e($prescription->created_at->format('Y-m-d')); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('prescriptions.show', $prescription->id)); ?>" class="btn btn-sm btn-outline-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
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
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/doctor-detail/show.blade.php ENDPATH**/ ?>