<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Add New Plan'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo e(route('patient-treatment-plans.index')); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to List'); ?>
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
                            <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Create Treatment Plan'); ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('patient-treatment-plans.store')); ?>" method="POST"
                                data-parsley-validate>
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Patient'); ?> <b class="text-danger">*</b></label>
                                            <?php if(isset($examinationData)): ?>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-user-injured"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo e($examinationData->patient->name); ?>" readonly>
                                                </div>
                                                <input type="hidden" name="patient_id"
                                                    value="<?php echo e($examinationData->patient_id); ?>">
                                            <?php else: ?>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-user-injured"></i></span>
                                                    </div>
                                                    <select
                                                        class="form-control select2 <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="patient_id" name="patient_id" required
                                                        data-parsley-required="true">
                                                        <option value=""><?php echo app('translator')->get('Select Patient'); ?></option>
                                                        <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($patient->id); ?>"
                                                                <?php if(old('patient_id', isset($patientTreatmentPlan) ? $patientTreatmentPlan->patient_id : $selectedPatientId ?? '') ==
                                                                        $patient->id): ?> selected <?php endif; ?>>
                                                                <?php echo e(($patient->name ?? '') . ' - ' . ($patient->patientDetails->mrn_number ?? '')); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Examination'); ?></label>
                                            <?php if(isset($examinationData)): ?>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-plus-square"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo e($examinationData->examination_number ?? '-'); ?>" readonly>
                                                </div>
                                                <input type="hidden" name="examination_id"
                                                    value="<?php echo e($examinationData->id); ?>">
                                            <?php else: ?>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-plus-square"></i></span>
                                                    </div>
                                                    <select
                                                        class="form-control <?php $__errorArgs = ['examination_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="examination_id" name="examination_id">
                                                        <option value=""><?php echo app('translator')->get('Select Teeth Examination'); ?></option>
                                                    </select>
                                                    <?php $__errorArgs = ['examination_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Doctor'); ?> <b class="text-danger">*</b></label>
                                            <?php if(isset($examinationData)): ?>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo e($examinationData->doctor->name); ?>" readonly>
                                                </div>
                                                <input type="hidden" name="doctor_id"
                                                    value="<?php echo e($examinationData->doctor_id); ?>">
                                            <?php else: ?>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                                    </div>
                                                    <select class="form-control <?php $__errorArgs = ['doctor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="doctor_id" name="doctor_id" required
                                                        data-parsley-required="true">
                                                        <option value=""><?php echo app('translator')->get('Select Doctor'); ?></option>
                                                        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(isset($doctor->user->name)): ?>
                                                                <option value="<?php echo e($doctor->id); ?>"><?php echo e($doctor->user->name); ?>

                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <?php $__errorArgs = ['doctor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo app('translator')->get('Comments'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                                </div>
                                                <input type="text" name="comments" class="form-control"
                                                    placeholder="<?php echo app('translator')->get('Any internal notes or comments...'); ?>" value="<?php echo e(old('comments')); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12 text-right">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg px-5"><?php echo app('translator')->get('Submit'); ?></button>
                                        <a href="<?php echo e(route('patient-treatment-plans.index')); ?>"
                                            class="btn btn-outline-secondary btn-lg px-5 ml-2"><?php echo app('translator')->get('Cancel'); ?></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#patient_id').on('change', function() {
                var patientId = $(this).val();
                $('#examination_id').html('<option value=""><?php echo app('translator')->get('Loading...'); ?></option>');
                $.ajax({
                    url: '<?php echo e(route('fetch.procedures')); ?>',
                    type: 'GET',
                    data: {
                        patient_id: patientId
                    },
                    success: function(data) {
                        var procedures = data.procedures;
                        var options = '<option value=""><?php echo app('translator')->get('Select Examination'); ?></option>';
                        $.each(procedures, function(index, procedure) {
                            options += '<option value="' + procedure.id + '">' +
                                procedure.examination_number + '</option>';
                        });
                        $('#examination_id').html(options);
                    },
                    error: function() {
                        $('#examination_id').html(
                            '<option value=""><?php echo app('translator')->get('Error loading examinations'); ?></option>');
                    }
                });
            });

            $('#examination_id').on('change', function() {
                var examinationId = $(this).val();
                if (!examinationId) return;
                $.ajax({
                    url: '<?php echo e(route('fetch.teeth')); ?>',
                    type: 'GET',
                    data: {
                        examination_id: examinationId
                    },
                    success: function(data) {
                        var doctor = data.doctorDetails;
                        if (doctor) {
                            $('#doctor_id').val(doctor.id).trigger('change');
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/patient-treatment-plans/create.blade.php ENDPATH**/ ?>