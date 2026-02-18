<?php $__env->startSection('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark"><?php echo app('translator')->get('Add Medical History'); ?></h3>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('patient-medical-histories.index')); ?>" class="btn btn-outline-info btn-sm">
                    <i class="fas fa-eye"></i> <?php echo app('translator')->get('View All'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<div class="content">
    <div class="container-fluid">
        <form id="medicalhistoryForm" action="<?php echo e(route('patient-medical-histories.store')); ?>" method="POST" data-parsley-validate>
            <?php echo csrf_field(); ?>

            <!-- Patient & Doctor Selection Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-2"><?php echo app('translator')->get('Select Patient'); ?> <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-user-injured text-muted"></i></span>
                                    </div>
                                    <select name="patient" class="form-control select2 <?php $__errorArgs = ['patient'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required data-parsley-errors-container="#patient-errors">
                                        <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                        <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($p->id); ?>" <?php echo e((isset($selectedPatientId) && $selectedPatientId == $p->id) || old('patient') == $p->id ? 'selected' : ''); ?>>
                                            <?php echo e($p->name); ?> - <?php echo e($p->patientDetails->mrn_number ?? '#' . $p->id); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div id="patient-errors"></div>
                                <?php $__errorArgs = ['patient'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <?php if(auth()->user()->hasRole('Doctor')): ?>
                            <input type="hidden" name="doctor" value="<?php echo e(auth()->user()->id); ?>" />
                            <?php else: ?>
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-2"><?php echo app('translator')->get('Select Doctor'); ?> <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-user-md text-muted"></i></span>
                                    </div>
                                    <select name="doctor" class="form-control select2 <?php $__errorArgs = ['doctor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required data-parsley-errors-container="#doctor-errors">
                                        <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                        <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($d->id); ?>" <?php echo e(old('doctor') == $d->id ? 'selected' : ''); ?>><?php echo e($d->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div id="doctor-errors"></div>
                                <?php $__errorArgs = ['doctor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Selection Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white p-3 border-bottom">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-notes-medical mr-2 text-primary"></i>
                        <?php echo app('translator')->get('Medical History Details'); ?>
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <?php $__currentLoopData = $ddMedicalHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="history-item-card p-3 border rounded h-100">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input history-checkbox"
                                        id="title_<?php echo e($item->id); ?>"
                                        name="medical_histories[<?php echo e($item->id); ?>][checked]">
                                    <label class="custom-control-label font-weight-bold" for="title_<?php echo e($item->id); ?>">
                                        <?php echo e($item->title); ?>

                                    </label>
                                </div>
                                <div class="form-group mb-0 history-comment-group" style="display:none;">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-comment-dots text-muted"></i></span>
                                        </div>
                                        <input type="text" class="form-control border-left-0"
                                            id="details_<?php echo e($item->id); ?>"
                                            name="medical_histories[<?php echo e($item->id); ?>][comments]"
                                            placeholder="<?php echo app('translator')->get('Add details...'); ?>"
                                            disabled>
                                    </div>
                                    <input type="hidden" value="<?php echo e($item->id); ?>" name="medical_histories[<?php echo e($item->id); ?>][title_id]">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mt-4 pt-3 border-top text-right">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                            <i class="fas fa-save mr-2"></i><?php echo app('translator')->get('Save History'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .history-item-card {
        border-left: 4px solid #dee2e6 !important;
        transition: all 0.2s;
    }

    .history-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .history-item-card.active {
        border-left-color: var(--primary-color) !important;
        background-color: #f9fbfd;
    }

    .font-weight-600 {
        font-weight: 600;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle comment inputs based on checkbox
        $('.history-checkbox').on('change', function() {
            const card = $(this).closest('.history-item-card');
            const commentGroup = card.find('.history-comment-group');
            const input = commentGroup.find('input');

            if ($(this).is(':checked')) {
                card.addClass('active');
                commentGroup.slideDown(200);
                input.prop('disabled', false);
                input.focus();
            } else {
                card.removeClass('active');
                commentGroup.slideUp(200);
                input.prop('disabled', true);
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/patient-medical-histories/create.blade.php ENDPATH**/ ?>