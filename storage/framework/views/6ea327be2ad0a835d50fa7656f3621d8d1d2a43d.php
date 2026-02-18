
<?php $__env->startSection('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('Manage Weekly Schedule'); ?></h1>
                <p class="text-muted small"><?php echo app('translator')->get('Doctor'); ?>: <span class="font-weight-bold text-primary"><?php echo e($doctor->name); ?></span></p>
            </div>
            <div class="col-sm-6 text-right">
                <a href="<?php echo e(route('doctor-details.index')); ?>" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to Doctors'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<div class="content">
    <div class="container-fluid">
        <form action="<?php echo e(route('doctor-schedules.bulk-update')); ?>" method="POST" id="bulkScheduleForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="user_id" value="<?php echo e($doctor->id); ?>">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom">
                    <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Availability Settings'); ?></h3>
                    <div class="card-tools">
                        <button type="submit" class="btn btn-primary btn-sm px-4">
                            <i class="fas fa-save mr-1"></i> <?php echo app('translator')->get('Save All Changes'); ?>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 150px;"><?php echo app('translator')->get('Weekday'); ?></th>
                                    <th style="width: 120px;"><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Start Time'); ?></th>
                                    <th><?php echo app('translator')->get('End Time'); ?></th>
                                    <th style="width: 150px;"><?php echo app('translator')->get('Duration (Mins)'); ?></th>
                                    <th><?php echo app('translator')->get('Serial Type'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $schedule = $schedules->get($day);
                                $isEnabled = $schedule ? true : false;
                                ?>
                                <tr class="day-row <?php echo e($isEnabled ? 'bg-white' : 'bg-light text-muted'); ?>" id="row-<?php echo e($day); ?>">
                                    <td class="font-weight-bold"><?php echo e($day); ?></td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input toggle-day"
                                                id="switch-<?php echo e($day); ?>"
                                                name="schedules[<?php echo e($day); ?>][enabled]"
                                                value="1"
                                                <?php echo e($isEnabled ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="switch-<?php echo e($day); ?>"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="text" name="schedules[<?php echo e($day); ?>][start_time]"
                                                class="form-control flatpickr-pick-time schedule-input"
                                                value="<?php echo e($schedule->start_time ?? '09:00'); ?>"
                                                <?php echo e(!$isEnabled ? 'disabled' : ''); ?> required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="text" name="schedules[<?php echo e($day); ?>][end_time]"
                                                class="form-control flatpickr-pick-time schedule-input"
                                                value="<?php echo e($schedule->end_time ?? '17:00'); ?>"
                                                <?php echo e(!$isEnabled ? 'disabled' : ''); ?> required>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="schedules[<?php echo e($day); ?>][avg_appointment_duration]"
                                            class="form-control form-control-sm schedule-input"
                                            value="<?php echo e($schedule->avg_appointment_duration ?? 15); ?>"
                                            min="1" <?php echo e(!$isEnabled ? 'disabled' : ''); ?> required>
                                    </td>
                                    <td>
                                        <select name="schedules[<?php echo e($day); ?>][serial_type]"
                                            class="form-control form-control-sm schedule-input"
                                            <?php echo e(!$isEnabled ? 'disabled' : ''); ?>>
                                            <option value="Sequential" <?php echo e(($schedule->serial_type ?? '') == 'Sequential' ? 'selected' : ''); ?>><?php echo app('translator')->get('Sequential'); ?></option>
                                            <option value="Social" <?php echo e(($schedule->serial_type ?? '') == 'Social' ? 'selected' : ''); ?>><?php echo app('translator')->get('Social'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('footer'); ?>
<script>
    $(document).ready(function() {
        $('.toggle-day').on('change', function() {
            const row = $(this).closest('tr');
            const isEnabled = $(this).is(':checked');

            if (isEnabled) {
                row.removeClass('bg-light text-muted').addClass('bg-white');
                row.find('.schedule-input').prop('disabled', false);
            } else {
                row.removeClass('bg-white').addClass('bg-light text-muted');
                row.find('.schedule-input').prop('disabled', true);
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/doctor-schedule/bulk-edit.blade.php ENDPATH**/ ?>