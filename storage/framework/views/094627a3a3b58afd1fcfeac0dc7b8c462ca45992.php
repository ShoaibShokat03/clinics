<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark"><?php echo app('translator')->get('Edit Dental History'); ?></h3>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo e(route('patient-details.history', $patient->id)); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to History'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="container-fluid">
            <input type="hidden" id="record_id" value="<?php echo e($patient->id); ?>">
            <input type="hidden" id="table_name" value="patient">
            <!-- Dental History Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white p-3 border-bottom">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-tooth mr-2 text-primary"></i>
                        <?php echo app('translator')->get('Dental History for'); ?> <?php echo e($patient->name); ?>

                    </h3>
                </div>
                <div class="card-body p-4">
                    <form id="dentalhistoryForm" action="<?php echo e(route('patient-dental-histories.update', $patient->id)); ?>"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <input type="hidden" name="patient" value="<?php echo e($patient->id); ?>">
                        <input type="hidden" name="doctor" value="<?php echo e($patientDentalHistories[0]->doctor_id); ?>">

                        <div class="row">
                            <?php $__currentLoopData = $ddDentalHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $historyRecord = $patientDentalHistories
                                        ->where('dd_dental_history_id', $item->id)
                                        ->first();
                                    $isChecked = !empty($historyRecord);
                                ?>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div
                                        class="history-item-card p-3 border rounded h-100 <?php echo e($isChecked ? 'border-primary bg-light' : ''); ?>">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input history-checkbox"
                                                id="title_<?php echo e($item->id); ?>"
                                                name="dental_histories[<?php echo e($item->id); ?>][checked]"
                                                <?php echo e($isChecked ? 'checked' : ''); ?>>
                                            <label class="custom-control-label font-weight-bold"
                                                for="title_<?php echo e($item->id); ?>">
                                                <?php echo e($item->title); ?>

                                            </label>
                                        </div>
                                        <div class="form-group mb-0 history-comment-group"
                                            style="<?php echo e($isChecked ? '' : 'display:none;'); ?>">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-white border-right-0"><i
                                                            class="fas fa-comment-dots text-muted"></i></span>
                                                </div>
                                                <input type="text" class="form-control border-left-0"
                                                    id="details_<?php echo e($item->id); ?>"
                                                    name="dental_histories[<?php echo e($item->id); ?>][comments]"
                                                    placeholder="<?php echo app('translator')->get('Add details...'); ?>"
                                                    value="<?php echo e($historyRecord->comments ?? ''); ?>"
                                                    <?php echo e($isChecked ? '' : 'disabled'); ?>>
                                            </div>
                                            <input type="hidden" value="<?php echo e($item->id); ?>"
                                                name="dental_histories[<?php echo e($item->id); ?>][title_id]">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="mt-4 pt-3 border-top text-right">
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="fas fa-save mr-2"></i><?php echo app('translator')->get('Save Changes'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Documents Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white p-3 border-bottom">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-file-upload mr-2 text-info"></i>
                        <?php echo app('translator')->get('Dental Documents'); ?>
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="upload-area mb-4">
                        <label class="font-weight-bold mb-2"><?php echo app('translator')->get('Upload Files'); ?></label>
                        <input id="dental_history" name="dental_history[]" type="file" multiple
                            data-allowed-file-extensions="png jpg jpeg pdf xml txt doc docx mp4"
                            data-max-file-size="2048K" />
                        <p class="text-muted small mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            <?php echo app('translator')->get('Max Size: 2048kb. Allowed Formats: PNG, JPG, JPEG, PDF, XML, TXT, DOC, DOCX, MP4'); ?>
                        </p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover border">
                            <thead class="bg-light">
                                <tr>
                                    <th><?php echo app('translator')->get('File Name'); ?></th>
                                    <th><?php echo app('translator')->get('Uploaded By'); ?></th>
                                    <th><?php echo app('translator')->get('Upload Date'); ?></th>
                                    <th class="text-right"><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody id="dentalHistoryTableBody" class="fileTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Logs Section -->
            <?php if($logs): ?>
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3 border-bottom d-flex align-items-center justify-content-between"
                        data-toggle="collapse" data-target="#logsCollapse" style="cursor:pointer;">
                        <h3 class="card-title font-weight-bold m-0">
                            <i class="fas fa-history mr-2 text-muted"></i><?php echo app('translator')->get('Activity Logs'); ?>
                        </h3>
                        <i class="fas fa-chevron-down text-muted"></i>
                    </div>
                    <div id="logsCollapse" class="collapse">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('User'); ?></th>
                                            <th><?php echo app('translator')->get('Action'); ?></th>
                                            <th><?php echo app('translator')->get('Field'); ?></th>
                                            <th><?php echo app('translator')->get('Old Value'); ?></th>
                                            <th><?php echo app('translator')->get('New Value'); ?></th>
                                            <th><?php echo app('translator')->get('Timestamp'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="font-weight-500"><?php echo e($log->user->name); ?></td>
                                                <td><span
                                                        class="badge badge-soft-<?php echo e($log->action == 'created' ? 'success' : 'info'); ?>"><?php echo e($log->action); ?></span>
                                                </td>
                                                <td><code><?php echo e($log->field_name); ?></code></td>
                                                <td><small class="text-muted"><?php echo e($log->old_value); ?></small></td>
                                                <td><small class="text-dark"><?php echo e($log->new_value); ?></small></td>
                                                <td class="small"><?php echo e($log->created_at); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .history-item-card {
            border-left: 4px solid #dee2e6 !important;
            transition: all 0.2s;
        }

        .history-item-card.border-primary {
            border-left-color: var(--primary-color) !important;
        }

        .history-item-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .badge-soft-success {
            background: #e6f7ef;
            color: #1e7e34;
        }

        .badge-soft-info {
            background: #e7f3ff;
            color: #004085;
        }
    </style>

    <script>
        var getFilesUrl = "<?php echo e(route('get-files', $patient->id)); ?>";
        var uploadFilesUrl = "<?php echo e(route('upload-file')); ?>";
        var deleteFilesUrl = "<?php echo e(route('delete-file')); ?>";
        var baseUrl = "<?php echo e(asset('')); ?>";

        document.addEventListener('DOMContentLoaded', function() {
            // Toggle comment inputs based on checkbox
            $('.history-checkbox').on('change', function() {
                const card = $(this).closest('.history-item-card');
                const commentGroup = card.find('.history-comment-group');
                const input = commentGroup.find('input');

                if ($(this).is(':checked')) {
                    card.addClass('border-primary bg-light');
                    commentGroup.slideDown(200);
                    input.prop('disabled', false);
                } else {
                    card.removeClass('border-primary bg-light');
                    commentGroup.slideUp(200);
                    input.prop('disabled', true);
                }
            });

            // Trigger change on all checkboxes to set initial state correctly
            $('.history-checkbox').trigger('change');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/patient-dental-histories/edit.blade.php ENDPATH**/ ?>