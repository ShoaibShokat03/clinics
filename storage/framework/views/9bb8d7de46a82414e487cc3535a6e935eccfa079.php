
<?php $__env->startSection('one_page_css'); ?>
    <link href="<?php echo e(asset('assets/css/teethv2.css')); ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<?php $__env->stopSection(); ?>

<style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 40px !important;
        height: 40px !important;
        filter: drop-shadow(0px 4px 8px #000000);
        border-radius: 50%;
        background-color: #ffffffe5;
        color: #000;
    }
</style>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <?php echo e(isset($examInvestigation) ? __('Edit Exam & Diagnosis') : __('Add New Exam & Diagnosis')); ?>

                    </h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo e(route('exam-investigations.index')); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-list"></i> <?php echo app('translator')->get('View All'); ?>
                    </a>
                    <?php if(isset($examInvestigation)): ?>
                        <a href="<?php echo e(route('exam-investigations.create')); ?>" class="btn btn-outline-success btn-sm ml-2">
                            <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add New'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-md text-primary mr-2"></i>
                        <?php echo app('translator')->get('Patient & Appointment Info'); ?>
                    </h3>
                </div>
                <div class="card-body">
                    <form id="patientForm"
                        action="<?php echo e(isset($examInvestigation) ? route('exam-investigations.update', $examInvestigation) : route('exam-investigations.store')); ?>"
                        method="POST" enctype="multipart/form-data" data-parsley-validate>
                        <?php echo csrf_field(); ?>
                        <?php if(isset($examInvestigation)): ?>
                            <?php echo method_field('PUT'); ?>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="patient_id"><?php echo app('translator')->get('Patient'); ?></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                        </div>
                                        <select name="patient_id"
                                            class="form-control select2 <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                                            id="patient_id" <?php echo e(isset($examInvestigation) ? 'disabled' : ''); ?>

                                            data-parsley-required="true"
                                            data-parsley-required-message="Please select patient.">
                                            <option value="" disabled
                                                <?php echo e(old('patient_id', isset($examInvestigation) ? $examInvestigation->patient_id : $selectedPatientId ?? null) == null ? 'selected' : ''); ?>>
                                                <?php echo e(isset($examInvestigation) ? '' : 'Select Patient'); ?>

                                            </option>
                                            <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($patient->id); ?>"
                                                    <?php if(old('patient_id', isset($examInvestigation) ? $examInvestigation->patient_id : $selectedPatientId ?? '') ==
                                                            $patient->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($patient->name); ?> -
                                                    <?php echo e($patient->patientDetails->mrn_number ?? ' '); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if(isset($examInvestigation)): ?>
                                            <input type="hidden" name="patient_id" id="patient_id"
                                                value="<?php echo e($examInvestigation->patient_id); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="patient_appointment_id"><?php echo app('translator')->get('Select Appointment'); ?></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                        </div>
                                        <?php if(isset($examInvestigation)): ?>
                                            <input type="text" class="form-control"
                                                value="<?php echo e($examInvestigation->PatientAppointment->appointment_number ?? ''); ?>"
                                                readonly>
                                            <input type="hidden" name="patient_appointment_id" id="patient_appointment_id"
                                                value="<?php echo e($examInvestigation->patient_appointment_id); ?>">
                                        <?php else: ?>
                                            <select name="patient_appointment_id"
                                                class="form-control select2 <?php $__errorArgs = ['patient_appointment_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                id="patient_appointment_id">
                                                <option value="" disabled selected>Select Appointment</option>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                    <?php $__errorArgs = ['patient_appointment_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="doctor_id"><?php echo app('translator')->get('Doctor'); ?></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                        </div>
                                        <?php if(isset($examInvestigation)): ?>
                                            <input type="text" class="form-control"
                                                value="<?php echo e($examInvestigation->doctor->name ?? ''); ?>" readonly>
                                            <input type="hidden" name="doctor_id" id="doctor_id"
                                                value="<?php echo e($examInvestigation->doctor_id); ?>">
                                        <?php else: ?>
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
                                                data-parsley-required-message="Please select doctor.">
                                                <option value="" disabled selected>Select Doctor</option>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                    <?php $__errorArgs = ['doctor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-md-6 align-self-end text-right">
                                <div class="form-group">
                                    <?php if(!isset($examInvestigation)): ?>
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-save mr-2"></i> <?php echo app('translator')->get('Create Examination'); ?>
                                        </button>
                                    <?php else: ?>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-lg dropdown-toggle px-5"
                                                data-toggle="dropdown">
                                                <i class="fas fa-clipboard-list mr-2"></i> <?php echo app('translator')->get('Treatment Plans'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <h6 class="dropdown-header"><?php echo app('translator')->get('Existing Plans'); ?></h6>
                                                <?php $__empty_1 = true; $__currentLoopData = $existingPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <a class="dropdown-item"
                                                        href="<?php echo e(route('patient-treatment-plans.show', $plan)); ?>">
                                                        <i class="fas fa-file-medical text-muted mr-2"></i>
                                                        <?php echo e($plan->treatment_plan_number); ?>

                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <a class="dropdown-item disabled"
                                                        href="#"><?php echo app('translator')->get('No Existing Plans'); ?></a>
                                                <?php endif; ?>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item font-weight-bold"
                                                    href="<?php echo e(route('patient-treatment-plans.create', ['examination_id' => $examInvestigation->id])); ?>">
                                                    <i class="fas fa-plus-circle text-success mr-2"></i> <?php echo app('translator')->get('Create New Plan'); ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php if(isset($examInvestigation)): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-comment-medical text-primary mr-2"></i>
                            <?php echo app('translator')->get('Chief Complaint History'); ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form id="chiefComplaintForm" class="p-2" method="POST" data-parsley-validate>
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-4">
                                <label for="chief_complaints" class="font-weight-bold mb-2"><?php echo app('translator')->get('Chief Complaint Details'); ?></label>
                                <textarea name="chief_complaints" class="form-control" id="chief_complaints" rows="3"
                                    placeholder="<?php echo app('translator')->get('Enter chief complaint here...'); ?>"><?php echo e($examInvestigation->chief_complaints); ?></textarea>
                            </div>

                            <input type="hidden" name="exam_investigation_id" id="examInvestigationId"
                                value="<?php echo e($examInvestigation->id); ?>">

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save mr-1"></i> <?php echo app('translator')->get('Update Complaint'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3">
                        <h3 class="card-title font-weight-bold text-primary">
                            <i class="fas fa-history mr-2"></i>
                            <?php echo e($patient_record->user->name ?? ''); ?>'s <?php echo app('translator')->get('Background History'); ?>
                        </h3>
                    </div>

                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-fill" id="historyTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" id="medical-tab" data-toggle="tab"
                                    href="#medical" role="tab">
                                    <i class="fas fa-notes-medical mr-1"></i> <?php echo app('translator')->get('Medical'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="drug-tab" data-toggle="tab" href="#drug"
                                    role="tab">
                                    <i class="fas fa-pills mr-1"></i> <?php echo app('translator')->get('Drug'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="social-tab" data-toggle="tab" href="#social"
                                    role="tab">
                                    <i class="fas fa-users mr-1"></i> <?php echo app('translator')->get('Social'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="dental-tab" data-toggle="tab" href="#dental"
                                    role="tab">
                                    <i class="fas fa-tooth mr-1"></i> <?php echo app('translator')->get('Dental'); ?>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content border-top-0 border p-4" id="historyTabContent">
                            
                            <div class="tab-pane fade show active" id="medical" role="tabpanel">
                                <h5 class="mb-4 text-muted"><i class="fas fa-notes-medical mr-2"></i> <?php echo app('translator')->get('Medical History'); ?>
                                </h5>
                                <div class="row">
                                    <?php $__empty_1 = true; $__currentLoopData = $medicalRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicalRecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="border rounded p-3 bg-light h-100">
                                                <p class="font-weight-bold text-primary mb-1">
                                                    <?php echo e($medicalRecord->ddMedicalHistory->title ?? ' '); ?></p>
                                                <p class="text-muted small mb-0"><?php echo e($medicalRecord->comments ?? '-'); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="col-12 text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                                            <p class="text-muted"><?php echo app('translator')->get('No medical history records found.'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="tab-pane fade" id="drug" role="tabpanel">
                                <h5 class="mb-4 text-muted"><i class="fas fa-pills mr-2"></i> <?php echo app('translator')->get('Drug History'); ?></h5>
                                <div class="row">
                                    <?php $__empty_1 = true; $__currentLoopData = $drugRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drugRecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="border rounded p-3 bg-light h-100">
                                                <p class="font-weight-bold text-success mb-1">
                                                    <?php echo e($drugRecord->ddDrugHistory->title ?? ' '); ?></p>
                                                <p class="text-muted small mb-0"><?php echo e($drugRecord->comments ?? '-'); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="col-12 text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                                            <p class="text-muted"><?php echo app('translator')->get('No drug history records found.'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="tab-pane fade" id="social" role="tabpanel">
                                <h5 class="mb-4 text-muted"><i class="fas fa-users mr-2"></i> <?php echo app('translator')->get('Social History'); ?></h5>
                                <div class="row">
                                    <?php $__empty_1 = true; $__currentLoopData = $socialRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialRecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="border rounded p-3 bg-light h-100">
                                                <p class="font-weight-bold text-warning mb-1">
                                                    <?php echo e($socialRecord->ddSocialHistory->title ?? ' '); ?></p>
                                                <p class="text-muted small mb-0"><?php echo e($socialRecord->comments ?? '-'); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="col-12 text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                                            <p class="text-muted"><?php echo app('translator')->get('No social history records found.'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="tab-pane fade" id="dental" role="tabpanel">
                                <h5 class="mb-4 text-muted"><i class="fas fa-tooth mr-2"></i> <?php echo app('translator')->get('Dental History'); ?></h5>
                                <div class="row">
                                    <?php $__empty_1 = true; $__currentLoopData = $dentalRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dentalRecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="border rounded p-3 bg-light h-100">
                                                <p class="font-weight-bold text-info mb-1">
                                                    <?php echo e($dentalRecord->ddDentalHistory->title ?? ' '); ?></p>
                                                <p class="text-muted small mb-0"><?php echo e($dentalRecord->comments ?? '-'); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="col-12 text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                                            <p class="text-muted"><?php echo app('translator')->get('No dental history records found.'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>



    <?php if(isset($examInvestigation)): ?>
        <?php
        $selectedIntraOrals = $examInvestigation->intraOralInvestigations;
        $selectedExtraOrals = $examInvestigation->extraOralInvestigations;
        $selectedSoftTissues = $examInvestigation->softTissuesInvestigations;
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-external-link-alt text-primary mr-2"></i>
                            <?php echo app('translator')->get('Extra Oral Examination'); ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form id="extraOral" class="p-2" method="POST" data-parsley-validate>
                            <?php echo csrf_field(); ?>
                            <?php if(isset($examInvestigation)): ?>
                                <input type="hidden" name="exam_investigation_id" value="<?php echo e($examInvestigation->id); ?>">
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table id="extra_oral_examination_table" class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0"><?php echo app('translator')->get('Extra Oral Options'); ?></th>
                                            <th class="border-0"><?php echo app('translator')->get('Comments / Findings'); ?></th>
                                            <th class="border-0 text-center" style="width: 120px;"><?php echo app('translator')->get('Actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $selectedExtraOrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $singleExtraOral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <select name="extra_oral[]" class="form-control select2">
                                                        <option value=""><?php echo app('translator')->get('Select Option'); ?></option>
                                                        <?php $__currentLoopData = $extraOrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extraOral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($extraOral->id); ?>"
                                                                <?php echo e($singleExtraOral->extra_oral_id == $extraOral->id ? 'selected' : ''); ?>>
                                                                <?php echo e($extraOral->extra_oral_name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea name="extra_oral_comments[]" class="form-control" rows="1" placeholder="<?php echo app('translator')->get('Add details...'); ?>"><?php echo e($singleExtraOral->comments); ?></textarea>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-success btn-sm m-add">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm m-remove"
                                                        <?php echo e($index == 0 ? 'disabled' : ''); ?>>
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td>
                                                    <select name="extra_oral[]" class="form-control select2">
                                                        <option value=""><?php echo app('translator')->get('Select Option'); ?></option>
                                                        <?php $__currentLoopData = $extraOrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extraOral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($extraOral->id); ?>">
                                                                <?php echo e($extraOral->extra_oral_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea name="extra_oral_comments[]" class="form-control" rows="1" placeholder="<?php echo app('translator')->get('Add details...'); ?>"></textarea>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-success btn-sm m-add">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm m-remove"
                                                        disabled>
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save mr-1"></i> <?php echo app('translator')->get('Update Extra Oral'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(isset($examInvestigation)): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-lips text-primary mr-2"></i>
                            <?php echo app('translator')->get('Soft Tissues Examination'); ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form id="softtissue" class="p-2" method="POST" data-parsley-validate>
                            <?php echo csrf_field(); ?>
                            <?php if(isset($examInvestigation)): ?>
                                <input type="hidden" name="exam_investigation_id" value="<?php echo e($examInvestigation->id); ?>">
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table id="soft_tissues_examination_table" class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0"><?php echo app('translator')->get('Soft Tissues Options'); ?></th>
                                            <th class="border-0"><?php echo app('translator')->get('Comments / Findings'); ?></th>
                                            <th class="border-0 text-center" style="width: 120px;"><?php echo app('translator')->get('Actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $selectedSoftTissues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $singleSoftTissue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td>
                                                    <select name="soft_tissues[]" class="form-control select2">
                                                        <option value=""><?php echo app('translator')->get('Select Option'); ?></option>
                                                        <?php $__currentLoopData = $softTissues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $softTissue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($softTissue->id); ?>"
                                                                <?php echo e($singleSoftTissue->soft_tissue_id == $softTissue->id ? 'selected' : ''); ?>>
                                                                <?php echo e($softTissue->soft_tissues_name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea name="soft_tissues_comments[]" class="form-control" rows="1" placeholder="<?php echo app('translator')->get('Add details...'); ?>"><?php echo e($singleSoftTissue->comments); ?></textarea>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-success btn-sm m-add">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm m-remove"
                                                        <?php echo e($index == 0 ? 'disabled' : ''); ?>>
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td>
                                                    <select name="soft_tissues[]" class="form-control select2">
                                                        <option value=""><?php echo app('translator')->get('Select Option'); ?></option>
                                                        <?php $__currentLoopData = $softTissues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $softTissue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($softTissue->id); ?>">
                                                                <?php echo e($softTissue->soft_tissues_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea name="soft_tissues_comments[]" class="form-control" rows="1" placeholder="<?php echo app('translator')->get('Add details...'); ?>"></textarea>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-success btn-sm m-add">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm m-remove"
                                                        disabled>
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save mr-1"></i> <?php echo app('translator')->get('Update Soft Tissues'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>









    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0"
                        style="display: <?php echo e(isset($examInvestigation) ? 'block' : 'none'); ?>;">
                        <div class="card-header bg-white p-3">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-tooth text-primary mr-2"></i>
                                <?php echo app('translator')->get('Dental Chart & Examination'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <h5 class="text-muted border-bottom pb-2 mb-3"><?php echo app('translator')->get('Controls'); ?></h5>

                                    <div class="p-3 border rounded bg-light">
                                        <div class="type-of-selection mb-3"
                                            style="display: <?php echo e(isset($examInvestigation) ? 'block' : 'none'); ?>;">
                                            <span class="font-weight-bold mr-3"><?php echo app('translator')->get('Selection Mode'); ?>:</span>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="option-single-selection" name="optradio"
                                                    value="single" class="custom-control-input" checked>
                                                <label class="custom-control-label"
                                                    for="option-single-selection"><?php echo app('translator')->get('Single Selection'); ?></label>
                                            </div>
                                        </div>

                                        <div class="exam-investigation-checkboxes d-flex flex-wrap">
                                            <span class="font-weight-bold mr-3 w-100 mb-2"><?php echo app('translator')->get('Jaw Type'); ?>:</span>
                                            <div class="custom-control custom-checkbox mr-4 mb-2">
                                                <input class="custom-control-input check-input-mixed" type="checkbox"
                                                    id="check-mixed" value="mixed"
                                                    <?php echo e(isset($examInvestigation) && $examInvestigation->jaw_type === 'mixed' ? 'checked' : ''); ?>

                                                    <?php echo e(($counter ?? 0) > 0 ? 'disabled' : ''); ?>>
                                                <label class="custom-control-label"
                                                    for="check-mixed"><?php echo app('translator')->get('Mixed'); ?></label>
                                            </div>
                                            <div class="custom-control custom-checkbox mr-4 mb-2">
                                                <input class="custom-control-input check-input-adult" type="checkbox"
                                                    id="check-adult" value="adult"
                                                    <?php echo e(isset($examInvestigation) && $examInvestigation->jaw_type === 'adult' ? 'checked' : ''); ?>

                                                    <?php echo e(($counter ?? 0) > 0 ? 'disabled' : ''); ?>>
                                                <label class="custom-control-label"
                                                    for="check-adult"><?php echo app('translator')->get('Adult'); ?></label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input class="custom-control-input check-input-children" type="checkbox"
                                                    id="check-children" value="children"
                                                    <?php echo e(isset($examInvestigation) && $examInvestigation->jaw_type === 'children' ? 'checked' : ''); ?>

                                                    <?php echo e(($counter ?? 0) > 0 ? 'disabled' : ''); ?>>
                                                <label class="custom-control-label"
                                                    for="check-children"><?php echo app('translator')->get('Children'); ?></label>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="button" class="btn btn-outline-warning btn-lg shadow-sm btn-block mt-3"
                                        id="selectAllTeethBtn">
                                        <i class="fas fa-tooth mr-2"></i> <?php echo app('translator')->get('Apply to All Teeth'); ?>
                                    </button>

                                </div>
                                <div class="col-md-7 border-left">
                                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                        <h5 class="text-muted mb-0"><?php echo app('translator')->get('Teeth Chart'); ?></h5>
                                    </div>
                                    <div class="Base area-single-selection"
                                        style="display: block; position: relative; min-height: 400px;">
                                        <div class="teeth-container">
                                            <div id="adult-teeth"
                                                style="<?php echo e(isset($examInvestigation) && $examInvestigation->jaw_type === 'children' ? 'display: none;' : ''); ?>">
                                                <div class="teeth teeth-11">
                                                    <span
                                                        style="position:absolute;
                                left:13px;
                                top:-22px;">
                                                        11
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/11.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-12">
                                                    <span
                                                        style="position:absolute;
                                left:0px;
                                top:-23px;">
                                                        12
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/12.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-13">
                                                    <span
                                                        style="position:absolute;
                                left:-12px;
                                top:-16px;">
                                                        13
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/13.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-14">
                                                    <span
                                                        style="position:absolute;
                                left:-20px;
                                top:-7px;">
                                                        14
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/14.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-15">
                                                    <span
                                                        style="position:absolute;
                                left:-23px;
                                top:-7px;">
                                                        15
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/15.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-16">
                                                    <span
                                                        style="position:absolute;
                                left:-25px;
                                top:7px;">
                                                        16
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/16.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-17">
                                                    <span
                                                        style="position:absolute;
                                left:-25px;
                                top:6px;">
                                                        17
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/17.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-18">
                                                    <span
                                                        style="position:absolute;
                                left:-27px;
                                top:6px;">
                                                        18
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/18.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-21">
                                                    <span
                                                        style="position:absolute;
                                left:20px;
                                top:-22px;">
                                                        21
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/21.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-22">
                                                    <span
                                                        style="position:absolute;
                                left:30px;
                                top:-23px;">
                                                        22
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/22.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-23">
                                                    <span
                                                        style="position:absolute;
                                left:42px;
                                top:-16px;">
                                                        23
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/23.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-24">
                                                    <span
                                                        style="position:absolute;
                                left:54px;
                                top:-7px;">
                                                        24
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/24.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-25">
                                                    <span
                                                        style="position:absolute;
                                left:54px;
                                top:-7px;">
                                                        25
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/25.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-26">
                                                    <span
                                                        style="position:absolute;
                                left:60px;
                                top:7px;">
                                                        26
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/26.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-27">
                                                    <span
                                                        style="position:absolute;
                                left:57px;
                                top:6px;">
                                                        27
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/27.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-28">
                                                    <span
                                                        style="position:absolute;
                                left:60px;
                                top:6px;">
                                                        28
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/28.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-31">
                                                    <span
                                                        style="position:absolute;
                                left:20px;
                                top:35px;">
                                                        31
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/31.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-32">
                                                    <span
                                                        style="position:absolute;
                                left:30px;
                                top:36px;">
                                                        32
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/32.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-33">
                                                    <span
                                                        style="position:absolute;
                                left:42px;
                                top:30px;">
                                                        33
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/33.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-34">
                                                    <span
                                                        style="position:absolute;
                                left:44px;
                                top:30px;">
                                                        34
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/34.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-35">
                                                    <span
                                                        style="position:absolute;
                                left:44px;
                                top:20px;">
                                                        35
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/35.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-36">
                                                    <span
                                                        style="position:absolute;
                                left:60px;
                                top:15px;">
                                                        36
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/36.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-37">
                                                    <span
                                                        style="position:absolute;
                                left:57px;
                                top:12px;">
                                                        37
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/37.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-38">
                                                    <span
                                                        style="position:absolute;
                                left:46px;
                                top:6px;">
                                                        38
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/38.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-41">
                                                    <span
                                                        style="position:absolute;
                                left:13px;
                                top:35px;">
                                                        41
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/41.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-42">
                                                    <span
                                                        style="position:absolute;
                                left:0px;
                                top:36px;">
                                                        42
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/42.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-43">
                                                    <span
                                                        style="position:absolute;
                                left:-14px;
                                top:30px;">
                                                        43
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/43.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-44">
                                                    <span
                                                        style="position:absolute;
                                left:-20px;
                                top:30px;">
                                                        44
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/44.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-45">
                                                    <span
                                                        style="position:absolute;
                                left:-23px;
                                top:20px;">
                                                        45
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/45.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-46">
                                                    <span
                                                        style="position:absolute;
                                left:-20px;
                                top:15px;">
                                                        46
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/46.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-47">
                                                    <span
                                                        style="position:absolute;
                                left:-25px;
                                top:12px;">
                                                        47
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/47.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-48">
                                                    <span
                                                        style="position:absolute;
                                left:-27px;
                                top:6px;">
                                                        48
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/48.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                            </div>
                                            <div id="children-teeth"
                                                style="<?php echo e(isset($examInvestigation) && $examInvestigation->jaw_type === 'adult' ? 'display: none;' : ''); ?>">
                                                <div class="teeth teeth-51">
                                                    <span
                                                        style="position:absolute;
                                left:7px;
                                top:-22px;">
                                                        51
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/51.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-52">
                                                    <span
                                                        style="position:absolute;
                                left:-2px;
                                top:-23px;">
                                                        52
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/52.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-53">
                                                    <span
                                                        style="position:absolute;
                                left:-14px;
                                top:-16px;">
                                                        53
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/53.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-54">
                                                    <span
                                                        style="position:absolute;
                                left:-19px;
                                top:-3px;">
                                                        54
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/54.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-55">
                                                    <span
                                                        style="position:absolute;
                                left:-20px;
                                top:0px;">
                                                        55
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/55.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-61">
                                                    <span
                                                        style="position:absolute;
                                left:10px;
                                top:-22px;">
                                                        61
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/61.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-62">
                                                    <span
                                                        style="position:absolute;
                                left:14px;
                                top:-23px;">
                                                        62
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/62.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-63">
                                                    <span
                                                        style="position:absolute;
                                left:25px;
                                top:-16px;">
                                                        63
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/63.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-64">
                                                    <span
                                                        style="position:absolute;
                                left:39px;
                                top:-3px;">
                                                        64
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/64.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-65">
                                                    <span
                                                        style="position:absolute;
                                left:39px;
                                top:0px;">
                                                        65
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/65.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-71">
                                                    <span
                                                        style="position:absolute;
                                left:7px;
                                top:25px;">
                                                        71
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/71.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-72">
                                                    <span
                                                        style="position:absolute;
                                left:13px;
                                top:32px;">
                                                        72
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/72.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-73">
                                                    <span
                                                        style="position:absolute;
                                left:30px;
                                top:27px;">
                                                        73
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/73.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-74">
                                                    <span
                                                        style="position:absolute;
                                left:36px;
                                top:10px;">
                                                        74
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/74.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-75">
                                                    <span
                                                        style="position:absolute;
                                left:37px;
                                top:5px;">
                                                        75
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/75.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-81">
                                                    <span
                                                        style="position:absolute;
                                left:7px;
                                top:25px;">
                                                        81
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/81.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-82">
                                                    <span
                                                        style="position:absolute;
                                left:-5px;
                                top:31px;">
                                                        82
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/82.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-83">
                                                    <span
                                                        style="position:absolute;
                                left:-14px;
                                top:27px;">
                                                        83
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/83.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-84">
                                                    <span
                                                        style="position:absolute;
                                left:-18px;
                                top:10px;">
                                                        84
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/84.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                                <div class="teeth teeth-85">
                                                    <span
                                                        style="position:absolute;
                                left:-20px;
                                top:5px;">
                                                        85
                                                    </span>
                                                    <img src="<?php echo e(asset('assets/images/teeth/85.png')); ?>"
                                                        class="simple-teeth" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal: Apply to All Teeth -->
            <div class="modal fade" id="applyAllTeethModal" tabindex="-1" aria-labelledby="applyAllTeethModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header bg-warning text-dark border-0">
                            <h5 class="modal-title font-weight-bold" id="applyAllTeethModalLabel">
                                <i class="fas fa-layer-group mr-2"></i> <?php echo app('translator')->get('Apply Findings to All Visible Teeth'); ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <form id="applyAllTeethForm">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="examination_id"
                                    value="<?php echo e(isset($examInvestigation) ? $examInvestigation->id : ''); ?>">
                                <input type="hidden" name="patient_id"
                                    value="<?php echo e(isset($examInvestigation) ? $examInvestigation->patient_id : ''); ?>">
                                <input type="hidden" name="doctor_id"
                                    value="<?php echo e(isset($examInvestigation) ? $examInvestigation->doctor_id : ''); ?>">

                                <div class="p-4">
                                    <div class="alert alert-warning border-0 shadow-sm mb-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-exclamation-triangle mr-3 fa-2x opacity-50"></i>
                                            <div>
                                                <h6 class="font-weight-bold mb-1"><?php echo app('translator')->get('Bulk Application Warning'); ?></h6>
                                                <p class="mb-0 small opacity-75"><?php echo app('translator')->get('Every visible tooth in the current jaw view (Adult, Children, or Mixed) will receive these findings. Existing findings for those teeth might be overwritten.'); ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header bg-light py-3 border-bottom-0">
                                            <h6 class="mb-0 font-weight-bold text-dark"><?php echo app('translator')->get('Common Findings to Apply'); ?></h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle" id="allTeethIssuesTable">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th class="border-0"><?php echo app('translator')->get('Findings'); ?></th>
                                                            <th class="border-0"><?php echo app('translator')->get('Investigations'); ?></th>
                                                            <th class="border-0"><?php echo app('translator')->get('Diagnosis'); ?></th>
                                                            <th class="border-0 text-center" style="width: 100px;">
                                                                <?php echo app('translator')->get('Actions'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="template-row">
                                                            <td>
                                                                <select name="tooth_issue[]"
                                                                    class="form-control select2 tooth_issue" required>
                                                                    <option value=""><?php echo app('translator')->get('Select Finding'); ?></option>
                                                                    <?php $__currentLoopData = $ddFindings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $finding): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($finding->name); ?>">
                                                                            <?php echo e($finding->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <textarea name="description[]" class="form-control" rows="1" placeholder="<?php echo app('translator')->get('Add details...'); ?>"></textarea>
                                                            </td>
                                                            <td>
                                                                <select name="diagnosis_id[]" class="form-control select2"
                                                                    required>
                                                                    <option value="" disabled selected>
                                                                        <?php echo app('translator')->get('Select Diagnosis'); ?></option>
                                                                    <?php $__currentLoopData = $ddDiagnosises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ddDiagnosis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($ddDiagnosis->id); ?>">
                                                                            <?php echo e($ddDiagnosis->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="btn-group">
                                                                    <button type="button"
                                                                        class="btn btn-outline-success btn-sm m-add">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-sm m-remove"
                                                                        disabled>
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer bg-light border-0">
                            <button type="button" class="btn btn-secondary px-4"
                                data-dismiss="modal"><?php echo app('translator')->get('Cancel'); ?></button>
                            <button type="button" class="btn btn-warning font-weight-bold px-4 shadow-sm"
                                id="submitAllTeethBtn">
                                <i class="fas fa-check-circle mr-1"></i> <?php echo app('translator')->get('Apply to All Teeth'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="hidden_patient_id"
                value="<?php echo e(isset($examInvestigation) ? $examInvestigation->patient_id : ''); ?>">
            <input type="hidden" id="hidden_doctor_id"
                value="<?php echo e(isset($examInvestigation) ? $examInvestigation->doctor_id : ''); ?>">
            <input type="hidden" id="hidden_examination_id"
                value="<?php echo e(isset($examInvestigation) ? $examInvestigation->id : ''); ?>">

            <?php if(isset($examInvestigation)): ?>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content border-0 shadow-lg">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">
                                    <i class="fas fa-tooth mr-2"></i> <?php echo app('translator')->get('Tooth Findings & Diagnosis'); ?>-<span
                                        id="modal_tooth_number_display"></span>
                                </h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-0">
                                <form id="toothIssueForm">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="doctor_id" value="<?php echo e($examInvestigation->doctor_id); ?>">
                                    <input type="hidden" name="patient_id"
                                        value="<?php echo e($examInvestigation->patient_id); ?>">
                                    <input type="hidden" id="examination_id_modal" name="examination_id"
                                        value="<?php echo e($examInvestigation->id); ?>">
                                    <input type="hidden" id="tooth_number" name="tooth_number" value="">
                                    <input type="hidden" name="record_id" id="record_id">
                                    <input type="hidden" id="table_name" value="patient">
                                    <input type="hidden" id="child_table" value="exam_investigations">

                                    <div class="p-4">
                                        <!-- Findings Section -->
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-header bg-light border-bottom-0 py-3">
                                                <h6 class="mb-0 font-weight-bold text-dark">
                                                    <i class="fas fa-search mr-2 text-primary"></i> <?php echo app('translator')->get('Findings, Investigations and Diagnosis'); ?>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="teeth_issues_modal" class="table table-hover align-middle">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="border-0"><?php echo app('translator')->get('Findings'); ?></th>
                                                                <th class="border-0"><?php echo app('translator')->get('Investigations'); ?></th>
                                                                <th class="border-0"><?php echo app('translator')->get('Diagnosis'); ?></th>
                                                                <th class="border-0 text-center" style="width: 100px;">
                                                                    <?php echo app('translator')->get('Actions'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <select name="tooth_issue[]"
                                                                        class="form-control select2 tooth_issue" required>
                                                                        <option value=""><?php echo app('translator')->get('Select Finding'); ?></option>
                                                                        <?php if(isset($ddFindings) && $ddFindings->count() > 0): ?>
                                                                            <?php $__currentLoopData = $ddFindings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $finding): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($finding->name); ?>">
                                                                                    <?php echo e($finding->name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <textarea name="description[]" class="form-control" rows="1" placeholder="<?php echo app('translator')->get('Add details...'); ?>"></textarea>
                                                                </td>
                                                                <td>
                                                                    <select name="diagnosis_id[]"
                                                                        class="form-control select2" required>
                                                                        <option value="" disabled selected>
                                                                            <?php echo app('translator')->get('Select Diagnosis'); ?></option>
                                                                        <?php $__currentLoopData = $ddDiagnosises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ddDiagnosis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($ddDiagnosis->id); ?>">
                                                                                <?php echo e($ddDiagnosis->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </td>
                                                                <td class="text-center">
                                                                    <div class="btn-group">
                                                                        <button type="button"
                                                                            class="btn btn-outline-success btn-sm m-add">
                                                                            <i class="fas fa-plus"></i>
                                                                        </button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-danger btn-sm m-remove"
                                                                            disabled>
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="text-right mt-3">
                                                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                                        <i class="fas fa-save mr-1"></i> <?php echo app('translator')->get('Save Findings'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Radiographs Section -->
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-light border-bottom-0 py-3">
                                                <h6 class="mb-0 font-weight-bold text-dark">
                                                    <i class="fas fa-file-medical-alt mr-2 text-primary"></i>
                                                    <?php echo app('translator')->get('Upload Radiographs / Attachments'); ?>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-4">
                                                    <div class="custom-file">
                                                        <input type="file" id="teeth_files" name="teeth_files[]"
                                                            class="custom-file-input" multiple
                                                            data-allowed-file-extensions="png jpg jpeg pdf"
                                                            data-max-file-size="2048K">
                                                        <label class="custom-file-label"
                                                            for="teeth_files"><?php echo app('translator')->get('Choose files to upload...'); ?></label>
                                                    </div>
                                                    <small class="form-text text-muted mt-2">
                                                        <i class="fas fa-info-circle mr-1"></i>
                                                        <?php echo e(__('Max Size: 2048kb. Allowed Formats: PNG, JPG, JPEG, PDF')); ?>

                                                    </small>
                                                </div>

                                                <div class="table-responsive"
                                                    style="max-height: 400px; overflow-y: auto;">
                                                    <div id="teethFileTableBody" class="w-100">
                                                        <!-- Grid items will be populated via AJAX here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary px-4 shadow-sm"
                                    data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    </div>


    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chiefComplaintElement = document.querySelector('#chief_complaints');
            // if (chiefComplaintElement && typeof ClassicEditor !== 'undefined') {
            //     ClassicEditor
            //         .create(chiefComplaintElement, {
            //             // Add empty config object to prevent undefined/null errors
            //         })
            //         .then(editor => {
            //             console.log('CKEditor initialized successfully');
            //         })
            //         .catch(error => {
            //             console.error('CKEditor initialization error:', error);
            //         });
            // }
        });
    </script>


    <!-- Modal for Image Slider -->
    <div class="modal fade" id="attachmentsModal" tabindex="-1" role="dialog" aria-labelledby="carouselModalLabel">
        <div class="modal-dialog modal-lg" role="document" style="padding-top: 2%;">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" style="font-weight:500;">Attached Images</span>
                    <button type="button" class="inner-close btn-info">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Carousel -->
                    <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators" id="carouselIndicators"></ol>
                        <div class="carousel-inner" id="carouselInner"></div>
                        <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        var getFilesUrl = "<?php echo e(isset($examInvestigation) ? route('get-files', $examInvestigation->id) : ''); ?>";
        var uploadFilesUrl = "<?php echo e(route('upload-file')); ?>";
        var deleteFilesUrl = "<?php echo e(route('delete-file')); ?>";
        var baseUrl = '<?php echo e(asset('')); ?>';
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const insuranceVerifiedCheckbox = document.getElementById('insuranceVerifiedCheckbox');

            if (insuranceVerifiedCheckbox) {
                insuranceVerifiedCheckbox.addEventListener('change', function() {
                    const insurance_verified = this.checked ? 'yes' : 'no';
                    $.ajax({
                        url: '<?php echo e(isset($examInvestigation) ? route('updateInsuranceVerified', $examInvestigation->id) : ''); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            insurance_verified: insurance_verified
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Insurance status updated successfully.');
                            } else {
                                alert('Failed to update insurance status.');
                            }
                        },
                        error: function(xhr) {
                            alert('Error occurred while updating insurance status: ' + (xhr
                                .responseJSON ? xhr.responseJSON.message :
                                'Unknown error'));
                        }
                    });
                });
            }
        });

        function updateCheckboxVisibility() {
            const tableBody = $('#insuranceCardTableBody');
            const checkboxContainer = $('.form-check');


            // Check if the table body has any rows
            if (tableBody.find('tr').length > 0) {
                checkboxContainer.show();
            }
        }
        $(document).ready(function() {
            // Attach change event to file input
            $('#insurance_card').on('change', function() {
                // Set a timeout to call updateCheckboxVisibility after 500ms
                setTimeout(function() {
                    console.log("Before Uploading File at " + new Date().toLocaleString());
                    updateCheckboxVisibility();
                    console.log("After Uploading File at " + new Date().toLocaleString());
                }, 3000);
            });

            // Initial call to set the checkbox visibility on page load
            updateCheckboxVisibility();
        });
    </script>



    <script>
        $(document).ready(function() {
            // Checkbox change event
            $('#intra_oral_check').on('change', function() {
                if ($(this).is(':checked')) {
                    //$('#intra_oral_id').attr('disabled', true);
                } else {
                    //$('#intra_oral_id').attr('disabled', false);
                }
            });

            // Submit form via AJAX
            $('#intraOral').on('submit', function(e) {
                e.preventDefault();

                // Validate required fields
                var isValid = true;
                $(this).find('select[name="intra_oral[]"]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('Please fill in all required fields');
                    // Re-enable button in case layout.js disabled it
                    $(this).find('button[type="submit"]').prop('disabled', false);
                    return;
                }

                var formData = $(this).serialize();
                var $form = $(this);
                // Fix: Select button element, not input
                var $submitButton = $form.find('button[type="submit"]');

                // Disable submit button while processing
                $submitButton.prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: '<?php echo e(URL::to('storeintraoraldata')); ?>',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Intra oral examination saved successfully');

                            // Reset form
                            $form[0].reset();

                            // Reset select fields
                            $form.find('select').val('').trigger('change');

                            // Remove any validation errors
                            $form.find('.is-invalid').removeClass('is-invalid');
                        } else {
                            alert(response.message || 'Error saving record');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error saving record. Please try again.');
                    },
                    complete: function() {
                        // Re-enable submit button
                        $submitButton.prop('disabled', false);
                    }
                });
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            // Checkbox change event

            $('#softtissue').on('submit', function(e) {
                e.preventDefault();

                // Validate required fields
                var isValid = true;
                $(this).find('select[name="soft_tissues[]"]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('Please fill in all required fields');
                    // Re-enable button in case layout.js disabled it
                    $(this).find('button[type="submit"]').prop('disabled', false);
                    return;
                }

                var formData = $(this).serialize();
                var $form = $(this);
                // Fix: Select button element, not input
                var $submitButton = $form.find('button[type="submit"]');

                // Disable submit button while processing
                $submitButton.prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: '<?php echo e(URL::to('storesofttissuedata')); ?>',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Soft tissue examination saved successfully');

                            // Reset form
                            $form[0].reset();

                            // Reset select fields
                            $form.find('select').val('').trigger('change');

                            // Remove any validation errors
                            $form.find('.is-invalid').removeClass('is-invalid');
                        } else {
                            alert(response.message || 'Error saving record');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error saving record. Please try again.');
                    },
                    complete: function() {
                        // Re-enable submit button
                        $submitButton.prop('disabled', false);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Checkbox change event


            // Submit form via AJAX
            $('#extraOral').on('submit', function(e) {
                e.preventDefault();

                // Validate required fields
                var isValid = true;
                $(this).find('select[name="extra_oral[]"]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('Please fill in all required fields');
                    $(this).find('button[type="submit"]').prop('disabled', false);
                    return;
                }

                var formData = $(this).serialize();
                var $form = $(this);
                // Fix: Select button element, not input
                var $submitButton = $form.find('button[type="submit"]');

                // Disable submit button while processing
                $submitButton.prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(URL::to('storeextraoraldata')); ?>",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Show success message
                            alert('Extra oral examination saved successfully');

                            // Reset form
                            $form[0].reset();

                            // Reset select fields
                            $form.find('select').val('').trigger('change');

                            // Remove any validation errors
                            $form.find('.is-invalid').removeClass('is-invalid');
                        } else {
                            alert(response.message || 'Error saving record');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error saving record. Please try again.');
                    },
                    complete: function() {
                        // Re-enable submit button
                        $submitButton.prop('disabled', false);
                    }
                });
            });

            // Handlers for Adding/Removing Rows in Examination Tables
            // Targets: Extra Oral, Soft Tissue, Intra Oral (assuming similar ID structure)
            var examTables =
                '#extra_oral_examination_table, #soft_tissues_examination_table, #intra_oral_examination_table';

            // Unbind any previous handlers to prevent duplicates, then bind new one
            $(document).off('click', '.m-add').on('click', '.m-add', function() {
                // Check if we are inside one of our target tables
                var $table = $(this).closest(examTables);
                // If not in our target tables (e.g. in the modal), let other handlers deal with it
                if ($table.length === 0) {
                    // However, the modal handler is scoped to #applyAllTeethModal, so it should be fine.
                    // But if there is a generic handler elsewhere, we want to be careful.
                    // If this event bubbles, we might want to check context.
                    // For now, let's assume if we are in a 'tr', we want to clone it IF it's not the modal.
                    if ($(this).closest('#applyAllTeethModal').length > 0) return;
                }

                var $tr = $(this).closest('tr');
                // Only proceed if we found a row
                if ($tr.length === 0) return;

                var $clone = $tr.clone();
                var $targetTable = $tr.closest('table');

                // Clear inputs
                $clone.find('textarea').val('');
                $clone.find('select').val('');

                // Fix Select2: Remove the container and re-initialize
                $clone.find('.select2-container').remove();
                $clone.find('.select2').removeClass('select2-hidden-accessible').removeAttr(
                    'data-select2-id').removeAttr('tabindex').removeAttr('aria-hidden');

                // Append
                $targetTable.find('tbody').append($clone);

                // Re-initialize Select2
                $clone.find('.select2').select2({
                    width: '100%'
                });

                // Enable remove buttons
                $targetTable.find('.m-remove').prop('disabled', false);
            });

            $(document).off('click', '.m-remove').on('click', '.m-remove', function() {
                if ($(this).closest('#applyAllTeethModal').length > 0) return;

                var $tr = $(this).closest('tr');
                var $table = $tr.closest('table');
                if ($table.find('tbody tr').length > 1) {
                    $tr.remove();
                    // If only one row remains, disable its remove button
                    if ($table.find('tbody tr').length === 1) {
                        $table.find('.m-remove').prop('disabled', true);
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#chiefComplaintForm').on('submit', function(e) {
                e.preventDefault(); // Prevent form submission

                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: '<?php echo e(URL::to('storechief')); ?>', // Use the correct URL for submission
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Record Successfully Saved');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error saving record. Please try again.');
                    }
                });
            });
        });
    </script>





    <script>
        var uploadFilesUrl = "<?php echo e(route('upload-file')); ?>";
        var deleteFilesUrl = "<?php echo e(route('delete-files')); ?>";
        console.log('This is Upload File Url', uploadFilesUrl);
        console.log("Delete File Url", deleteFilesUrl);
    </script>
    <script>
        // Initialize the carousel when the modal is shown
        $('#attachmentsModal').on('shown.bs.modal', function() {
            $('#imageCarousel').carousel({
                interval: 2000, // Set the interval between slides (in milliseconds)
                ride: 'carousel',
                cycle: true
            });
        });
    </script>

    <script>
        var baseUrl = '<?php echo e(asset('')); ?>';
        console.log("This is the Base Url: ", baseUrl)
        var selected_tooth_array = [];
        document.addEventListener('DOMContentLoaded', function() {

            const checkboxes = document.querySelectorAll('.exam-investigation-checkboxes input[type="checkbox"]');
            const adultTeethDiv = document.getElementById('adult-teeth');
            const childrenTeethDiv = document.getElementById('children-teeth');
            const examInvestigationIdElement = document.getElementById('examination_id');
            const examInvestigationId = examInvestigationIdElement ? examInvestigationIdElement.value : null;
            const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : '';

            window.disableCheckboxes = function() {
                checkboxes.forEach(cb => {
                    cb.disabled = true;
                });
            }
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        checkboxes.forEach(cb => {
                            if (cb !== this) {
                                cb.checked = false;
                            }
                        });
                        if (this.id === 'check-adult') {
                            adultTeethDiv.style.display = 'block';
                            childrenTeethDiv.style.display = 'none';
                        } else if (this.id === 'check-children') {
                            adultTeethDiv.style.display = 'none';
                            childrenTeethDiv.style.display = 'block';
                        } else {
                            adultTeethDiv.style.display = 'block';
                            childrenTeethDiv.style.display = 'block';
                        }
                        // disableCheckboxes();

                        $.ajax({
                            url: '<?php echo e(route('exam-investigations.updatejawtype')); ?>',
                            method: 'POST',
                            data: {
                                _token: csrfToken,
                                id: examInvestigationId,
                                jaw_type: this.value
                            },
                            success: function(response) {
                                console.log('Jaw type updated successfully');
                            },
                            error: function(xhr) {
                                console.error('Error updating jaw type:', xhr);
                            }
                        });

                        // disableCheckboxes();
                    }
                });
            });


            var examination_id = $('#hidden_examination_id').val();

            if (examination_id) { // Check if procedure_id is not null or empty
                $.ajax({
                    url: '<?php echo e(url('/patient-teeth-issues')); ?>/' + examination_id,
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        markSelectedTeeth(response)
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching teeth issues:', error);
                    }
                });
            } else {
                console.log('No Examination ID provided. Skipping AJAX call.');
            }

            document.querySelectorAll('input[name="optradio"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (this.value === 'single') {
                        document.querySelector('.area-bulk-selection').style.display = 'none';
                    } else if (this.value === 'bulk') {
                        document.querySelector('.area-bulk-selection').style.display = 'block';
                    }
                });
            });
        });

        $(document).ready(function() {
            window.escapeFileName = function(fileName) {
                return fileName.replace(/[ .\-()]/g, '_');
            };

            let tooth = document.querySelectorAll('.teeth');
            tooth.forEach(function(teeth) {
                teeth.addEventListener('click', function() {
                    let selectionType = document.querySelector('input[name="optradio"]:checked')
                        .value;
                    if (selectionType === 'single') {
                        handleSingleSelection(this);
                    } else {
                        handleBulkSelection(this);
                    }
                });
            });

            function handleSingleSelection(teethElement) {
                let teeth_number = getTeethNumber(teethElement.className);
                var doctorId = $('#doctor_id').val();
                var patientId = $('#patient_id').val();
                var Childtable = $('#child_table').val();

                // Set the teeth number in the modal input with specific ID
                $('#tooth_number').val(teeth_number);
                $('#exampleModal input[name="doctor_id"]').val(doctorId);
                $('#exampleModal input[name="patient_id"]').val(patientId);
                $('#exampleModal #record_id').val(patientId);

                // Use the reliable hidden input for examination ID
                var examinationId = $('#hidden_examination_id').val();

                // Also update the modal's hidden examination_id field for form submission
                $('#examination_id_modal').val(examinationId);

                $('#exampleModalLabel').text('Findings & Diagnosis for teeth ' + teeth_number);

                // Show the modal
                $('#exampleModal').modal('show');
                $.ajax({
                    url: '<?php echo e(url('/patient-teeth-issues')); ?>/' + examinationId + '/' + patientId + '/' +
                        teeth_number,
                    type: 'GET',
                    success: function(response) {
                        populateToothIssues(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching findings:', error);
                    }

                });
            }

            function handleBulkSelection(teethElement) {
                let teeth_number = getTeethNumber(teethElement.className);
                let img = teethElement.querySelector('img');
                if (img.classList.contains('simple-teeth')) {
                    img.classList.remove('simple-teeth');
                    img.classList.add('red-teeth');
                    selected_tooth_array.push(teeth_number)
                } else {
                    img.classList.remove('red-teeth');
                    img.classList.add('simple-teeth');
                    let teeth_index = selected_tooth_array.indexOf(teeth_number);
                    if (teeth_index !== -1) {
                        selected_tooth_array.splice(teeth_index, 1);
                    }
                }

                console.log(selected_tooth_array);
            }

            $('#teethForm').on('submit', function(event) {
                event.preventDefault();

                var issues = [];
                $('#teeth_issues tbody tr').each(function() {
                    var toothIssue = $(this).find('select[name="tooth_issue[]"]').val();
                    var diagnosisIds = $(this).find('select[name="diagnosis_id[]"]').val();
                    var description = $(this).find('textarea[name="description[]"]').val();
                    if (toothIssue) {
                        issues.push({
                            tooth_issue: toothIssue,
                            description: description,
                            diagnosis_id: diagnosisIds
                        });
                    }
                });


                var data = {
                    doctor_id: $('input[name="doctor_id"]').val(),
                    patient_id: $('input[name="patient_id"]').val(),
                    examination_id: $('#hidden_examination_id').val(),
                    teeth: selected_tooth_array,
                    issues: issues
                };

                $.ajax({
                    url: "<?php echo e(route('patient-teeths.store')); ?>",
                    type: 'POST',
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        if (response.success) {
                            alert('Teeth issues saved successfully!');
                            markSelectedTeeth(selected_tooth_array);

                            // Uncheck all checkboxes and reset selected teeth

                            // Reset the tooth issues table
                            $('#teeth_issues tbody tr').not(':first').remove();
                            $('#teeth_issues tbody tr:first').find(
                                'select[name="tooth_issue[]"]').val('');
                            $('#teeth_issues tbody tr:first').find(
                                'textarea[name="description[]"]').val('');

                        } else {
                            alert('Error saving teeth issues.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error saving teeth issues: ' + error);
                    }
                });
            });

            window.getTeethNumber = function(className) {
                let match = className.match(/\bteeth-(\d+)\b/);
                return match ? match[1] : null;
            }

            window.populateToothIssues = function(toothIssues) {
                const $tbody = $('#teeth_issues_modal tbody');
                $tbody.empty(); // Clear existing rows

                if (toothIssues.length === 0) {
                    // Add a default empty row if no issues found
                    const $templateRow = `
                        <tr>
                            <td>
                                <select name="tooth_issue[]" class="form-control select2 tooth_issue" required>
                                    <option value=""><?php echo app('translator')->get('Select Finding'); ?></option>
                                    <?php if(isset($ddFindings)): ?>
                                        <?php $__currentLoopData = $ddFindings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $finding): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($finding->name); ?>"><?php echo e($finding->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </td>
                            <td><textarea name="description[]" class="form-control" rows="1" placeholder="<?php echo app('translator')->get('Add details...'); ?>"></textarea></td>
                            <td>
                                <select name="diagnosis_id[]" class="form-control select2" required>
                                    <option value="" disabled selected><?php echo app('translator')->get('Select Diagnosis'); ?></option>
                                    <?php $__currentLoopData = $ddDiagnosises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ddDiagnosis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ddDiagnosis->id); ?>"><?php echo e($ddDiagnosis->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-success btn-sm m-add"><i class="fas fa-plus"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-sm m-remove" disabled><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>`;
                    $tbody.append($templateRow);
                    $tbody.find('.select2').select2({
                        width: '100%'
                    });
                    return;
                }

                toothIssues.forEach((issue, index) => {
                    const $row = $(`
                        <tr>
                            <td>
                                <select name="tooth_issue[]" class="form-control select2 tooth_issue" required>
                                    <option value=""><?php echo app('translator')->get('Select Finding'); ?></option>
                                    <?php if(isset($ddFindings)): ?>
                                        <?php $__currentLoopData = $ddFindings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $finding): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($finding->name); ?>"><?php echo e($finding->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </td>
                            <td><textarea name="description[]" class="form-control" rows="1">${issue.description || ''}</textarea></td>
                            <td>
                                <select name="diagnosis_id[]" class="form-control select2" required>
                                    <option value="" disabled><?php echo app('translator')->get('Select Diagnosis'); ?></option>
                                    <?php $__currentLoopData = $ddDiagnosises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ddDiagnosis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ddDiagnosis->id); ?>"><?php echo e($ddDiagnosis->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-success btn-sm m-add"><i class="fas fa-plus"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-sm m-remove"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    `);

                    $tbody.append($row);

                    // Set values
                    $row.find('select[name="tooth_issue[]"]').val(issue.tooth_issue);
                    $row.find('select[name="diagnosis_id[]"]').val(issue.diagnosis_id);

                    // Initialize Select2
                    $row.find('.select2').select2({
                        width: '100%'
                    });
                });

                // Disable remove button if only one row
                if ($tbody.find('tr').length === 1) {
                    $tbody.find('.m-remove').prop('disabled', true);
                }
            }

        });

        // function populateTeethFiles(response) {
        //     $('#teethFileDivBody').html('');
        //     if (response.files) {
        //         response.files.forEach(file => {
        //             var filePath = baseUrl + '/storage/uploads/patient/' + $('#record_id').val() +
        //                 '/exam_investigations/' + $('#examination_id').val() + '/' + $('#tooth_number').val() +
        //                 '/' + file.file_name;
        //             console.log("This is file Path", filePath);
        //             $('#teethFileDivBody').append(
        //                 `

    //                 <div id="file-row-${escapeFileName(file.file_name)}" class="card d-flex flex-column ml-4 justify-content-start" style="width:65px; height:75px; border:1px solid #00000036;">
    //             <div class="card-image d-flex flex-row justify-content-center"style="height:50px;">
    //                 <img src="${filePath}" style="height:inherit; width:90%;" alt="">
    //             </div>

    //           <div class="d-flex flex-row justify-content-between p-0">
    //            <span class="btn btn-info my-1 ml-1" style="width:16px !important; height:16px; font-size:10px;
    //            text-align:center; align-content:center; padding:0px;">
    //                 <a style="color:#fff" href="${filePath}" download><i class="fas fa-download"></i></a>
    //             </span>
    //             <span onclick="confirmDeleteTeethFile('${file.file_name}', 'teeth_files', '${$('#record_id').val()}', 'teethFileDivBody')" class="btn btn-danger my-1  mr-1"
    //             style="width:16px !important; height:16px; font-size:10px;
    //                 text-align:center; align-content:center; padding:0px;">
    //                 <i class="fas fa-trash-alt"style="color:#fff"></i>
    //             </span>
    //           </div>
    //         </div>
    //         `
        //             );
        //         });

        //         if (response.files.length === 0) {
        //             $('#teethFileDivBody').append('<div><div><?php echo app('translator')->get('No files found.'); ?></div></div>');
        //         }
        //     }
        // }
        function populateTeethFiles(response) {
            $('#teethFileTableBody').html('');

            // Check if we have files
            if (response.files && response.files.length > 0) {
                // Create a container for the grid if not already present or just use the existing one
                // Since the target is #teethFileTableBody (which was a tbody), we should ideally target a div instead.
                // However, based on the prompt, I will stick to the existing ID but treat it as a container for grid items.
                // Better approach: clear the container and append grid items.

                let gridHtml = '<div class="d-flex flex-wrap">';

                response.files.forEach(file => {
                    var filePath = baseUrl + file.file_name;
                    var escapedName = escapeFileName(file.file_name);

                    gridHtml += `
                        <div id="file-row-${escapedName}" class="card m-2 border shadow-sm" style="width: 100px;">
                            <div class="card-img-top text-center pt-2" style="height: 80px; overflow: hidden; cursor: pointer;" onclick="setEscapedFileName('${file.file_name}')">
                                <img src="${filePath}" alt="${file.file_name}" style="height: 100%; width: auto; max-width: 100%; object-fit: cover;">
                            </div>
                            <div class="d-flex justify-content-between" style="width:100%;padding:5px;aling-items:center;">
                                <a href="${filePath}" download class="btn btn-info btn-sm text-white mr-1 d-flex justify-content-center align-items-center" title="Download" style="width: 25px !important; height: 25px !important; padding: 0;">
                                    <i class="fas fa-download" style="font-size: 10px;"></i>
                                </a>
                                <button type="button" onclick="confirmDeleteTeethFile('${file.file_name}', 'teeth_files', '${$('#record_id').val()}', 'teethFileTableBody')" class="btn btn-danger btn-sm d-flex justify-content-center align-items-center" title="Delete" style="width: 25px !important; height: 25px !important; padding: 0;">
                                    <i class="fas fa-trash-alt" style="font-size: 10px;"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });

                gridHtml += '</div>';
                $('#teethFileTableBody').html(gridHtml);

                disableCheckboxes();
            } else {
                $('#teethFileTableBody').html('<div class="text-center w-100 p-3"><?php echo app('translator')->get('No files found.'); ?></div>');
            }
        }
        let escapedFileName = ''; // Define the variable to store the file name

        function setEscapedFileName(fileName) {
            escapedFileName = fileName;
            var examinationId = $('#hidden_examination_id').val();
            var teethNumber = $('#tooth_number').val();
            fetchImages(examinationId, teethNumber, escapedFileName);
        }

        $('#openSliderButton').on('click', function() {
            var examinationId = $('#hidden_examination_id').val();
            var teethNumber = $('#tooth_number').val();
            fetchImages(examinationId, teethNumber, escapedFileName);
        });

        function fetchImages(examinationId, teethNumber, escapedFileName) {
            $.ajax({
                url: '<?php echo e(route('get-teeth-files')); ?>',
                type: 'GET',
                data: {
                    examination_id: examinationId,
                    tooth_number: teethNumber
                },
                success: function(response) {
                    if (response.files && response.files.length > 0) {
                        populateImageSlider(response.files, escapedFileName);
                        $('#attachmentsModal').modal('show');
                    } else {
                        alert('No images found.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error fetching images: ' + error);
                }
            });
        }

        function populateImageSlider(files, escapedFileName) {
            var indicators = '';
            var innerItems = '';

            files.forEach((file, index) => {
                // file_name now contains the full path from public/, so use it directly
                var filePath = baseUrl + file.file_name;
                var isActive = file.file_name === escapedFileName ? 'active' : '';

                indicators += `<li data-target="#imageCarousel" data-slide-to="${index}" class="${isActive}"></li>`;

                innerItems += `
            <div class="carousel-item ${isActive}">
                <img src="${filePath}" alt="Image ${index + 1}" style="width:100%;height:350px"/>
            </div>`;
            });

            $('#carouselIndicators').html(indicators);
            $('#carouselInner').html(innerItems);
        }


        window.getFiles = function() {
            var examinationId = $('#hidden_examination_id').val();
            var teethNumber = $('#tooth_number').val();

            $.ajax({
                url: '<?php echo e(route('get-teeth-files')); ?>',
                type: 'GET',
                data: {
                    examination_id: examinationId,
                    tooth_number: teethNumber
                },
                success: function(response) {
                    populateTeethFiles(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching teeth files:', error);
                }
            });
        }

        // Initial fetch of teeth files when modal is opened (optional)

        $('#exampleModal').on('shown.bs.modal', function() {
            getFiles();
        });

        $('#exampleModal').on('hidden.bs.modal', function() {
            // Clone the first template row
            var newRow = $('#teeth_issues tbody tr:first').clone();

            // Reset values in the cloned row
            newRow.find('select[name="tooth_issue[]"]').val('');
            newRow.find('textarea[name="description[]"]').val('');
            newRow.find('.m-remove').prop('disabled', true); // Enable remove button

            // Replace existing content with the cloned and cleared row
            $('#teeth_issues tbody').html(newRow);
        });

        function markSelectedTeeth(toothNumbers) {
            if (!Array.isArray(toothNumbers)) {
                toothNumbers = [toothNumbers];
            }

            toothNumbers.forEach(function(toothNumber) {
                const toothElement = document.querySelector(`.teeth.teeth-${toothNumber}`);
                if (toothElement) {
                    const imgElement = toothElement.querySelector('img');
                    if (imgElement && imgElement.classList.contains('simple-teeth')) {
                        imgElement.classList.remove('simple-teeth');
                        imgElement.classList.add('red-teeth');
                    }
                    if (!selected_tooth_array.includes(toothNumber)) {
                        selected_tooth_array.push(toothNumber);
                    }
                }
            });
        }



        // Initially set the visibility of sections based on the selected radio button



        // Initialize select2 for the initial row

        // Disable remove button on initial row
        //$('.m-remove').prop('disabled', true);

        // Add button click event handler
        // Add button click event handler
        $(document).on('click', '.m-add', function() {
            // Clone the last row
            const newRow = $(this).closest('tr').clone();

            // Remove internal select2 container from the clone (it carries over broken events/ids)
            newRow.find('.select2-container').remove();

            // Reset the select elements to raw state
            newRow.find('select')
                .removeClass('select2-hidden-accessible')
                .removeAttr('data-select2-id')
                .removeAttr('aria-hidden')
                .removeAttr('tabindex')
                .val('')
                .css('display', 'block'); // reset display if hidden by select2

            // Clear other inputs
            newRow.find('input[type="text"], textarea').val('');

            // Enable remove button in the newly added row
            newRow.find('.m-remove').prop('disabled', false);

            // Append the new row to the table body
            $(this).closest('tbody').append(newRow);

            // Re-initialize select2 for the new row
            newRow.find('.select2').select2({
                width: '100%'
            });
        });

        // Remove button click event handler
        $(document).on('click', '.m-remove', function() {
            $(this).closest('tr').remove();

            // If only one row remains, disable the remove button in that row
            if ($('.m-remove').length === 1) {
                $('.m-remove').prop('disabled', true);
            }
        });

        $('#toothIssueForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Serialize form data
            var formData = $(this).serialize();

            console.log("toothIssueForm : " + toothIssueForm);
            //return 0;

            // AJAX request
            $.ajax({
                url: "<?php echo e(route('patient-teeths.store')); ?>", // Update with your route
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.data) {
                        console.log(response.data.tooth_number);
                        markSelectedTeeth(response.data.tooth_number);
                    }
                    var $form = $(this);
                    var $submitButton = $form.find('button[type="submit"]');
                    // Disable submit button while processing
                    document.querySelector("#toothIssueForm").querySelector("button[type='submit']")
                        .removeAttribute("disabled");
                    // Handle success response (optional)
                    console.log(response);
                    $('#exampleModal').modal('hide'); // Hide the modal after successful submission
                    disableCheckboxes();
                    // Optionally show a success message or redirect
                },
                error: function(xhr, status, error) {
                    // Handle error response (optional)
                    console.error(xhr.responseText);
                    // Optionally display an error message
                }
            });
        });

        $('#patient_id').on('change', function() {
            var patientId = $(this).val();
            if (patientId) {
                // Fetch Appointments for this patient
                $.ajax({
                    url: '<?php echo e(route('fetch.appointments')); ?>',
                    type: 'GET',
                    data: {
                        patient_id: patientId
                    },
                    success: function(data) {
                        var appointments = data.appointments;
                        var options =
                            '<option value="" disabled selected>Select Any Appointment</option>';
                        $.each(appointments, function(index, appointment) {
                            options += '<option value="' + appointment.id + '">' + appointment
                                .appointment_number + '</option>';
                        });
                        $('#patient_appointment_id').html(options).trigger('change');
                    },
                    error: function() {
                        console.error('Failed to fetch appointments');
                    }
                });

                // Fetch All Doctors (Initial list)
                $.ajax({
                    url: '<?php echo e(route('fetch.doctors')); ?>',
                    type: 'GET',
                    success: function(data) {
                        var doctors = data.doctors;
                        var options = '<option value="" disabled selected>Select Doctor</option>';
                        $.each(doctors, function(index, doctor) {
                            options += '<option value="' + doctor.id + '">' + doctor.name +
                                '</option>';
                        });
                        $('#doctor_id').html(options).trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch doctors:', error);
                        $('#doctor_id').html(
                                '<option value="" disabled selected>No doctors available</option>')
                            .trigger('change');
                    }
                });
            } else {
                $('#patient_appointment_id').html('<option value="" disabled selected>Select Appointment</option>')
                    .trigger('change');
                $('#doctor_id').html('<option value="" disabled selected>Select Doctor</option>').trigger('change');
            }
        });

        $('#patient_appointment_id').on('change', function() {
            var patientappointmentId = $(this).val();
            if (patientappointmentId) {
                $.ajax({
                    url: '<?php echo e(route('fetch.doctors')); ?>',
                    type: 'GET',
                    data: {
                        patient_appointment_id: patientappointmentId
                    },
                    success: function(data) {
                        var doctors = data.doctors;
                        var options = '';
                        $.each(doctors, function(index, doctor) {
                            options += '<option value="' + doctor.id + '">' + doctor.name +
                                '</option>';
                        });
                        $('#doctor_id').html(options).trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch doctors:', error);
                        $('#doctor_id').html(
                                '<option value="" disabled selected>No doctors available</option>')
                            .trigger('change');
                    }
                });
            }
        });



        window.confirmDeleteTeethFile = function(fileName, fileType, recordId, tableBodyId) {
            if (confirm('Are you sure you want to delete this file?')) {
                deleteTeethFile(fileName, fileType, recordId, 'patient', tableBodyId);
            }
        };



        window.deleteTeethFile = function(fileName, fileType, recordId, table_name, tableBodyId) {
            var teethNumber = $('#tooth_number').val();
            var examinationId = $('#hidden_examination_id').val();
            var child_table = $('#child_table').val();
            console.log('fileName: ' + fileName);
            console.log('fileType: ' + fileType);
            console.log('recordId: ' + recordId);
            console.log('table_name: ' + table_name);
            console.log('tableBodyId: ' + tableBodyId);
            console.log('teethNumber: ' + teethNumber);
            console.log('examinationId: ' + examinationId);
            console.log('child_table: ' + child_table);
            $.ajax({
                url: deleteFilesUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    fileName: fileName,
                    fileType: fileType,
                    recordId: recordId,
                    table_name: table_name,
                    teethNumber: teethNumber,
                    child_table: child_table,
                    examinationId: examinationId,
                },
                success: function(response) {
                    if (response.success) {
                        var escapedFileName = escapeFileName(fileName);
                        $(`#${tableBodyId}`).find(`#file-row-${escapedFileName}`).remove();
                        const fileElement = document.querySelector(`#file-row-${escapedFileName}`);
                        console.log('FileName: ' + fileElement);
                    } else {
                        alert('Error deleting file: ' + response.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error deleting file: ' + error);
                }
            });
        };

        // Inner Modal close issue
        $('.inner-close').click(function(teethElement) {
            $('#attachmentsModal').modal('hide');
            console.log("Inner Modal")
            var patientId = $('#patient_id').val();
            var tooth = $('#tooth_number').val();
            var examinationId = $('#hidden_examination_id').val();
            //   let teeth_number = getTeethNumber(teethElement.className);
            $.ajax({
                url: '<?php echo e(url('/patient-teeth-issues')); ?>/' + examinationId + '/' + patientId + '/' +
                    tooth,
                type: 'GET',
                success: function(response) {
                    window.setTimeout(function() {
                        populateToothIssues(response);
                    }, 200);

                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching tooth issues:', error);
                }

            });
        });
    </script>

    <!-- Fix for fullCalendar error-prevent initialization if calendar element doesn't exist -->
    <script>
        // Prevent fullCalendar errors by checking if element exists before initialization
        $(document).ready(function() {
            // Check if fullCalendar is being called on a non-existent element
            if (typeof $.fn.fullCalendar === 'function') {
                var originalFullCalendar = $.fn.fullCalendar;
                $.fn.fullCalendar = function(options) {
                    // Only initialize if the element exists and is the calendar element
                    if (this.length === 0) {
                        console.warn('fullCalendar: Element not found, skipping initialization');
                        return this;
                    }
                    // Check if it's trying to initialize on #calendar but element doesn't exist
                    if (this.is('#calendar') && $('#calendar').length === 0) {
                        console.warn(
                            'fullCalendar: #calendar element not found on this page, skipping initialization'
                        );
                        return this;
                    }
                    return originalFullCalendar.apply(this, arguments);
                };
            } else if (typeof $.fn.fullCalendar === 'undefined') {
                // If fullCalendar is not loaded, create a no-op function to prevent errors
                $.fn.fullCalendar = function() {
                    console.warn('fullCalendar: Library not loaded, suppressing error');
                    return this;
                };
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            /* --------------------------------------------------------------
               OPEN MODAL
               -------------------------------------------------------------- */
            $('#selectAllTeethBtn').on('click', function() {
                $('#applyAllTeethModal').modal('show');
            });

            //   // Cache the clean template row ONCE
            //     let $templateRow = null;

            //     // When modal opens: reset to single clean row
            //     $('#applyAllTeethModal').on('show.bs.modal', function () {
            //         const $tbody = $('#allTeethIssuesTable tbody');
            //         $tbody.empty(); // Clear any old rows

            //         // Clone fresh template and add one row
            //         if (!$templateRow) {
            //             $templateRow = $('#allTeethIssuesTable .template-row').clone();
            //             $templateRow.removeClass('template-row'); // optional: clean class
            //         }

            //         const $firstRow = $templateRow.clone();
            //         $firstRow.find('select, textarea').val(''); // ensure clean
            //         $firstRow.find('.m-remove').prop('disabled', true); // disable remove on first
            //         $tbody.append($firstRow);
            //     });

            // ADD ROW — ONLY ONE HANDLER
            $(document).off('click', '#applyAllTeethModal .m-add').on('click', '#applyAllTeethModal .m-add',
                function() {
                    const $newRow = $templateRow.clone();
                    $newRow.find('select, textarea').val('');
                    $newRow.find('.m-remove').prop('disabled', false);
                    $('#allTeethIssuesTable tbody').append($newRow);
                });

            // REMOVE ROW
            $(document).off('click', '#applyAllTeethModal .m-remove').on('click', '#applyAllTeethModal .m-remove',
                function() {
                    const $rows = $('#allTeethIssuesTable tbody tr');
                    if ($rows.length > 1) {
                        $(this).closest('tr').remove();
                        // Re-disable remove button if only one row left
                        if ($rows.length === 2) {
                            $('#allTeethIssuesTable tbody .m-remove').prop('disabled', true);
                        }
                    }
                });


            /* --------------------------------------------------------------
               SUBMIT – APPLY TO ALL VISIBLE TEETH
               -------------------------------------------------------------- */
            $('#submitAllTeethBtn').on('click', function() {
                const issues = [];
                let valid = true;

                $('#allTeethIssuesTable tbody tr').each(function() {
                    const $row = $(this);
                    const finding = $row.find('select[name="tooth_issue[]"]').val();
                    const desc = $row.find('textarea[name="description[]"]').val().trim();
                    const diagnosis = $row.find('select[name="diagnosis_id[]"]').val();

                    // require both finding + diagnosis (you can relax this if you want)
                    if (finding && diagnosis) {
                        issues.push({
                            tooth_issue: finding,
                            description: desc,
                            diagnosis_id: diagnosis
                        });
                    } else if (finding || diagnosis || desc) {
                        valid = false; // incomplete row
                    }
                });

                if (!valid) {
                    alert('Please complete every started row (Finding + Diagnosis) or remove it.');
                    return;
                }
                if (issues.length === 0) {
                    alert('Add at least one finding before applying.');
                    return;
                }

                /* ----- collect every visible tooth ----- */
                const visibleTeeth = [];
                $('#adult-teeth .teeth, #children-teeth .teeth').each(function() {
                    const m = $(this).attr('class').match(/teeth-(\d+)/);
                    if (m) visibleTeeth.push(m[1]);
                });

                if (visibleTeeth.length === 0) {
                    alert('Select a jaw type (Adult / Children / Mixed) first.');
                    return;
                }

                var examination_id = $('#examination_id').val();

                /* ----- BUILD PAYLOAD ----- */
                var payload = {
                    examination_id: $('#hidden_examination_id').val(),
                    patient_id: $('#patient_id').val(),
                    doctor_id: $('#doctor_id').val(),
                    teeth: visibleTeeth,
                    issues: issues
                };

                console.log('Sending bulk payload →', payload); // ← debug

                $.ajax({
                    url: "<?php echo e(route('patient-teeths.store')); ?>",
                    type: 'POST',
                    data: JSON.stringify(payload),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.success) {
                            alert('Findings applied to ' + visibleTeeth.length + ' teeth!');
                            $('#applyAllTeethModal').modal('hide');
                            markSelectedTeeth(visibleTeeth);
                            disableCheckboxes();
                        } else {
                            alert('Error: ' + (res.message || 'unknown'));
                        }
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Server error';
                        alert('Failed: ' + msg);
                        console.error(xhr.responseJSON);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/exam-investigation/edit.blade.php ENDPATH**/ ?>