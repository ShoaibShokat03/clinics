

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('All Notifications'); ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <div class="bulk-actions d-inline-block" style="display: none;">
                    <button type="button" class="btn btn-primary btn-sm mx-1" id="bulkMarkRead">
                        <i class="fas fa-check"></i> <?php echo app('translator')->get('Mark Selected as Read'); ?>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm mx-1" id="bulkDelete">
                        <i class="fas fa-trash"></i> <?php echo app('translator')->get('Delete Selected'); ?>
                    </button>
                </div>
                <form action="<?php echo e(route('notifications.readAll')); ?>" method="POST" style="display: inline;" class="all-read-form">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-check-double"></i> <?php echo app('translator')->get('Mark All as Read'); ?>
                    </button>
                </form>
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
                        <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Notification List'); ?></h3>
                        <div class="card-tools">
                            <button class="btn btn-default btn-sm" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="filter" class="collapse <?php if(request()->status || request()->from_date || request()->to_date): ?> show <?php endif; ?>">
                            <div class="card-body border mb-3">
                                <form action="<?php echo e(route('notifications.index')); ?>" method="get" role="form" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small font-weight-bold"><?php echo app('translator')->get('Status'); ?></label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value=""><?php echo app('translator')->get('All Status'); ?></option>
                                                    <option value="new" <?php echo e(request('status') == 'new' ? 'selected' : ''); ?>><?php echo app('translator')->get('New / Unread'); ?></option>
                                                    <option value="read" <?php echo e(request('status') == 'read' ? 'selected' : ''); ?>><?php echo app('translator')->get('Read'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small font-weight-bold"><?php echo app('translator')->get('From Date'); ?></label>
                                                <input type="date" name="from_date" id="from_date" class="form-control" value="<?php echo e(request('from_date')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small font-weight-bold"><?php echo app('translator')->get('To Date'); ?></label>
                                                <input type="date" name="to_date" id="to_date" class="form-control" value="<?php echo e(request('to_date')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3 align-self-end">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info"><?php echo app('translator')->get('Submit'); ?></button>
                                                <?php if(request()->status || request()->from_date || request()->to_date): ?>
                                                <a href="<?php echo e(route('notifications.index')); ?>"
                                                    class="btn btn-secondary"><?php echo app('translator')->get('Clear'); ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="custom-control custom-checkbox mb-3 ml-2">
                                <input type="checkbox" class="custom-control-input" id="selectAll">
                                <label class="custom-control-label font-weight-bold" for="selectAll"><?php echo app('translator')->get('Select All'); ?></label>
                            </div>
                            <div class="list-group list-group-flush">
                                <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="list-group-item list-group-item-action d-flex align-items-center py-3 <?php echo e($notification->status == 'new' ? 'bg-light' : ''); ?>" data-notification-id="<?php echo e($notification->id); ?>">
                                    <div class="custom-control custom-checkbox mr-3">
                                        <input type="checkbox" class="custom-control-input notification-checkbox" id="check-<?php echo e($notification->id); ?>" value="<?php echo e($notification->id); ?>">
                                        <label class="custom-control-label" for="check-<?php echo e($notification->id); ?>"></label>
                                    </div>
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="rounded-circle bg-<?php echo e($notification->status == 'new' ? 'primary' : 'secondary'); ?> d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; opacity: <?php echo e($notification->status == 'new' ? '1' : '0.6'); ?>;">
                                            <i class="fas fa-<?php echo e($notification->status == 'new' ? 'bell' : 'bell-slash'); ?> text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between align-items-start">
                                            <h6 class="mb-1 <?php echo e($notification->status == 'new' ? 'font-weight-bold' : 'text-muted'); ?>">
                                                <a href="<?php echo e(url($notification->url)); ?>" class="text-<?php echo e($notification->status == 'new' ? 'dark' : 'muted'); ?> notification-item-link" data-id="<?php echo e($notification->id); ?>">
                                                    <?php echo e($notification->text); ?>

                                                </a>
                                            </h6>
                                            <small class="text-muted"><?php echo e($notification->created_at->diffForHumans()); ?></small>
                                        </div>
                                        <p class="mb-0 text-xs text-muted">
                                            <?php echo e($notification->created_at->format('d M Y, h:i A')); ?>

                                            <?php if($notification->status == 'read'): ?>
                                            <span class="ml-2 text-success"><i class="fas fa-check"></i> <?php echo app('translator')->get('Read'); ?></span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="ml-3">
                                        <?php if($notification->status == 'new'): ?>
                                        <span class="badge badge-primary"><?php echo app('translator')->get('New'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                    <p class="text-muted"><?php echo app('translator')->get('No notifications found.'); ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php if($notifications->hasPages()): ?>
                    <div class="card-footer bg-white border-top">
                        <?php echo e($notifications->links()); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer'); ?>
<script>
    $(document).ready(function() {
        // Select all checkbox
        $('#selectAll').on('change', function() {
            $('.notification-checkbox').prop('checked', $(this).prop('checked'));
            toggleBulkActions();
        });

        // Individual checkbox change
        $('.notification-checkbox').on('change', function() {
            if (!$(this).prop('checked')) {
                $('#selectAll').prop('checked', false);
            } else if ($('.notification-checkbox:checked').length === $('.notification-checkbox').length) {
                $('#selectAll').prop('checked', true);
            }
            toggleBulkActions();
        });

        function toggleBulkActions() {
            const checkedCount = $('.notification-checkbox:checked').length;
            if (checkedCount > 0) {
                $('.bulk-actions').fadeIn();
                $('.all-read-form').hide();
            } else {
                $('.bulk-actions').fadeOut();
                $('.all-read-form').show();
            }
        }

        // Bulk Mark as Read
        $('#bulkMarkRead').on('click', function() {
            const ids = $('.notification-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (ids.length > 0) {
                $.post("<?php echo e(route('notifications.bulkMarkAsRead')); ?>", {
                    _token: "<?php echo e(csrf_token()); ?>",
                    ids: ids
                }).done(function() {
                    location.reload();
                });
            }
        });

        // Bulk Delete
        $('#bulkDelete').on('click', function() {
            if (confirm("<?php echo app('translator')->get('Are you sure you want to delete selected notifications?'); ?>")) {
                const ids = $('.notification-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (ids.length > 0) {
                    $.post("<?php echo e(route('notifications.bulkDelete')); ?>", {
                        _token: "<?php echo e(csrf_token()); ?>",
                        ids: ids
                    }).done(function() {
                        location.reload();
                    });
                }
            }
        });

        $('.notification-item-link').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const url = $(this).attr('href');

            $.post("<?php echo e(route('notifications.markAsRead')); ?>", {
                _token: "<?php echo e(csrf_token()); ?>",
                id: id
            }).always(function() {
                window.location.href = url;
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/notifications/index.blade.php ENDPATH**/ ?>