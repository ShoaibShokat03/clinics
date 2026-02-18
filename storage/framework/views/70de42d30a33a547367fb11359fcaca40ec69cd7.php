<?php $__env->startSection('content'); ?>
<style>
    .custom-flash-message {
        position: fixed;
        top: 10px;
        right: 10px;
        padding: 10px 20px;
        border-radius: 5px;
        color: #fff;
        font-size: 14px;
        z-index: 9999;
        display: none;
    }

    .custom-flash-message.alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .custom-flash-message.alert-success {
        background-color: #d4edda;
        color: #155724;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('Add Appointment'); ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('patient-appointments.index')); ?>" class="btn btn-outline-primary btn-sm">
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
                        <h3 class="card-title font-weight-bold ml-1"><?php echo app('translator')->get('Appointment Details'); ?></h3>
                    </div>

                    <div class="col-12 p-2" id="doctor_availability"></div>

                    <div class="card-body">
                        <form id="scheduleForm" action="<?php echo e(route('patient-appointments.store')); ?>" method="POST" enctype="multipart/form-data" data-parsley-validate>
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_id" class="font-weight-bold"><?php echo app('translator')->get('Select Patient'); ?> <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                            </div>
                                            <select name="user_id" class="form-control select2 <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="user_id" required data-parsley-required="true" data-parsley-required-message="Please select patient.">
                                                <option value="">-- <?php echo app('translator')->get('Select'); ?> --</option>
                                                <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($patient->id); ?>" <?php echo e((isset($selectedPatientId) && $selectedPatientId == $patient->id) || old('user_id') == $patient->id ? 'selected' : ''); ?>>
                                                    <?php echo e($patient->name); ?> - <?php echo e($patient->patientDetails->mrn_number ?? 'N/A'); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#quickAddPatientModal" title="<?php echo app('translator')->get('Quick Add Patient'); ?>">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="doctor_id" class="font-weight-bold"><?php echo app('translator')->get('Select Doctor'); ?> <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                            </div>
                                            <select name="doctor_id" class="form-control select2 <?php $__errorArgs = ['doctor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="doctor_id" required data-parsley-required="true" data-parsley-required-message="Please select doctor.">
                                                <option value="">-- <?php echo app('translator')->get('Select'); ?> --</option>
                                                <?php $__currentLoopData = $doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($doctor->id); ?>" <?php echo e(old('doctor_id') == $doctor->id ? 'selected' : ''); ?>>
                                                    <?php echo e($doctor->name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <?php $__errorArgs = ['doctor_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="appointment_date" class="font-weight-bold"><?php echo app('translator')->get('Appointment Date'); ?> <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                            </div>
                                            <input type="date" name="appointment_date" id="appointment_date" class="form-control <?php $__errorArgs = ['appointment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="<?php echo app('translator')->get('Appointment Date'); ?>" value="<?php echo e(old('appointment_date')); ?>" required data-parsley-required="true">
                                        </div>
                                        <?php $__errorArgs = ['appointment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_time" class="font-weight-bold"><?php echo app('translator')->get('Start Time'); ?> <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <select name="start_time" class="form-control" id="start_time" required>
                                                <option value="">-- <?php echo app('translator')->get('Select Start Time'); ?> --</option>
                                                <?php for($time = strtotime('00:00'); $time <= strtotime('23:59'); $time=strtotime('+15 minutes', $time)): ?>
                                                    <option value="<?php echo e(date('H:i', $time)); ?>"><?php echo e(date('h:i A', $time)); ?></option>
                                                    <?php endfor; ?>
                                            </select>
                                        </div>
                                        <?php $__errorArgs = ['start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="end_time" class="font-weight-bold"><?php echo app('translator')->get('End Time'); ?> <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <select name="end_time" class="form-control" id="end_time" required>
                                                <option value="">-- <?php echo app('translator')->get('Select End Time'); ?> --</option>
                                                <?php for($time = strtotime('00:00'); $time <= strtotime('23:59'); $time=strtotime('+15 minutes', $time)): ?>
                                                    <option value="<?php echo e(date('H:i', $time)); ?>"><?php echo e(date('h:i A', $time)); ?></option>
                                                    <?php endfor; ?>
                                            </select>
                                        </div>
                                        <?php $__errorArgs = ['end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="problem" class="font-weight-bold"><?php echo app('translator')->get('Problem'); ?></label>
                                        <textarea name="problem" id="problem" class="form-control <?php $__errorArgs = ['problem'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="4" placeholder="<?php echo app('translator')->get('Describe the problem...'); ?>"><?php echo e(old('problem')); ?></textarea>
                                        <?php $__errorArgs = ['problem'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right mt-3">
                                    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Submit'); ?></button>
                                    <a href="<?php echo e(route('patient-appointments.index')); ?>" class="btn btn-secondary ml-2"><?php echo app('translator')->get('Cancel'); ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="quickAddPatientModal" tabindex="-1" role="dialog" aria-labelledby="quickAddPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="quickAddPatientModalLabel"><?php echo app('translator')->get('Quick Add Patient'); ?></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="quickAddPatientForm">
                <div class="modal-body">
                    <div id="quickAddErrors" class="alert alert-danger d-none"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_name"><?php echo app('translator')->get('Name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="quick_name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_phone"><?php echo app('translator')->get('Phone'); ?> <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="quick_phone" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_email"><?php echo app('translator')->get('Email'); ?> <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="quick_email" name="email" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="quick_no_email"> <small class="ml-1"><?php echo app('translator')->get('No Email'); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_gender"><?php echo app('translator')->get('Gender'); ?></label>
                                <select class="form-control" id="quick_gender" name="gender">
                                    <option value="">-- <?php echo app('translator')->get('Select'); ?> --</option>
                                    <option value="male"><?php echo app('translator')->get('Male'); ?></option>
                                    <option value="female"><?php echo app('translator')->get('Female'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quick_cnic"><?php echo app('translator')->get('CNIC'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="quick_cnic" name="cnic" required>
                            </div>
                        </div>
                        <input type="hidden" name="password" value="12345678">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Save Patient'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // No Email Logic
        $('#quick_no_email').change(function() {
            var emailField = $('#quick_email');
            var phoneField = $('#quick_phone');
            if ($(this).is(':checked')) {
                var randomValue = Math.floor(Math.random() * 90000) + 10000;
                emailField.val('noemail' + phoneField.val() + randomValue + '@gmail.com');
                emailField.prop('readonly', true);
            } else {
                emailField.val('');
                emailField.prop('readonly', false);
            }
        });

        // AJAX Submission
        $('#quickAddPatientForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "<?php echo e(route('patient-details.store')); ?>",
                type: "POST",
                data: formData + "&_token=<?php echo e(csrf_token()); ?>",
                success: function(response) {
                    if (response.success) {
                        // Add new option to select2
                        var newOption = new Option(response.data.name + ' - ' + response.data.mrn, response.data.id, true, true);
                        $('#user_id').append(newOption).trigger('change');

                        // Close modal and reset form
                        $('#quickAddPatientModal').modal('hide');
                        $('#quickAddPatientForm')[0].reset();
                        $('#quickAddErrors').addClass('d-none');

                        // Show success message
                        if (typeof toastr !== 'undefined') {
                            toastr.success(response.message);
                        } else {
                            alert(response.message);
                        }
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<ul>';
                    if (errors) {
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                    } else {
                        errorHtml += '<li>' + xhr.statusText + '</li>';
                    }
                    errorHtml += '</ul>';
                    $('#quickAddErrors').html(errorHtml).removeClass('d-none');
                }
            });
        });
        // Time Restriction Logic
        var timeSelects = $('#start_time, #end_time');
        var dateInput = $('#appointment_date');

        function filterTimes() {
            var selectedDateVal = dateInput.val();
            if (!selectedDateVal) return;

            var selectedDate = new Date(selectedDateVal).toISOString().split('T')[0];
            var today = new Date().toISOString().split('T')[0];

            if (selectedDate === today) {
                var now = new Date();
                var currentHour = now.getHours();
                var currentMinutes = now.getMinutes();
                var currentTimeVal = (currentHour * 60) + currentMinutes;

                timeSelects.find('option').each(function() {
                    var val = $(this).val();
                    if (!val) return;

                    var parts = val.split(':');
                    var optionMinutes = (parseInt(parts[0]) * 60) + parseInt(parts[1]);

                    if (optionMinutes < currentTimeVal) {
                        $(this).prop('disabled', true).hide();
                    } else {
                        $(this).prop('disabled', false).show();
                    }
                });

                // Reset if selected is disabled
                timeSelects.each(function() {
                    var selectedOption = $(this).find('option:selected');
                    if (selectedOption.length && selectedOption.prop('disabled')) {
                        $(this).val('');
                    }
                });
            } else {
                timeSelects.find('option').prop('disabled', false).show();
            }
        }

        // Initialize Flatpickr manually
        $("#appointment_date").flatpickr({
            enableTime: false,
            minDate: "today",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                // Manually trigger change for other listeners if needed, or just call filter logic
                filterTimes();
            }
        });

        dateInput.on('change', filterTimes);
        // Also listen to flatpickr change if applicable, though 'change' usually triggers.
        // If flatpickr is instance, we might need hooks, but let's try standard change first.
        filterTimes();

    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer'); ?>
<script src="<?php echo e(asset('assets/js/custom/patient-appointment.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/patient-appointment/create.blade.php ENDPATH**/ ?>