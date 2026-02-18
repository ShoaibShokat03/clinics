<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Doctor Schedule'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button type="button" id="bulk_delete" class="btn btn-danger btn-sm d-none">
                        <i class="fas fa-trash"></i> <?php echo app('translator')->get('Delete Selected'); ?>
                    </button>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('doctor-schedule-create')): ?>
                        <!-- <a href="<?php echo e(route('doctor-schedules.create')); ?>" class="btn btn-primary btn-sm ml-2">
                                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Schedule'); ?>
                                </a> -->
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
                            <h3 class="card-title font-weight-bold ml-1"><?php echo app('translator')->get('Filter Schedules'); ?></h3>
                            <div class="card-tools">
                                <a class="btn btn-outline-primary btn-sm" target="_blank"
                                    href="<?php echo e(route('doctor-schedules.index')); ?>?export=1">
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
                                        <div class="col-sm-4">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Doctor'); ?></label>
                                                <select name="user_id" class="form-control form-control-sm select2"
                                                    id="user_id">
                                                    <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                    <?php $__currentLoopData = $doctors->sortBy(fn($doctor) => strtolower(optional($doctor->user)->name)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(!is_null(optional($doctor->user)->name)): ?>
                                                            <option value="<?php echo e($doctor->user->id); ?>"
                                                                <?php echo e(old('user_id', request()->user_id) == $doctor->user->id ? 'selected' : ''); ?>>
                                                                <?php echo e(optional($doctor->user)->name); ?>

                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Week Day'); ?></label>
                                                <select name="weekday" class="form-control form-control-sm select2">
                                                    <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                    <?php $__currentLoopData = config('constant.weekdays'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($day); ?>"
                                                            <?php echo e(request()->weekday == $day ? 'selected' : ''); ?>>
                                                            <?php echo app('translator')->get($day); ?>
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-right mt-4">
                                            <button type="submit" class="btn btn-info btn-sm"><?php echo app('translator')->get('Submit'); ?></button>
                                            <?php if(request()->isFilterActive): ?>
                                                <a href="<?php echo e(route('doctor-schedules.index')); ?>"
                                                    class="btn btn-secondary btn-sm ml-2"><?php echo app('translator')->get('Clear'); ?></a>
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
                                            <th style="width: 40px;" class="align-middle">
                                                <div class="custom-control custom-checkbox text-center">
                                                    <input type="checkbox" class="custom-control-input" id="check_all">
                                                    <label class="custom-control-label" for="check_all"></label>
                                                </div>
                                            </th>
                                            <th><?php echo app('translator')->get('Doctor Name'); ?></th>
                                            <th><?php echo app('translator')->get('Weekday'); ?></th>
                                            <th><?php echo app('translator')->get('Start Time'); ?></th>
                                            <th><?php echo app('translator')->get('End Time'); ?></th>
                                            <th><?php echo app('translator')->get('Status'); ?></th>
                                            <th data-orderable="false"><?php echo app('translator')->get('Actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $doctorSchedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctorSchedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="custom-control custom-checkbox text-center">
                                                        <input type="checkbox"
                                                            class="custom-control-input schedule_checkbox"
                                                            id="check-<?php echo e($doctorSchedule->id); ?>"
                                                            value="<?php echo e($doctorSchedule->id); ?>">
                                                        <label class="custom-control-label"
                                                            for="check-<?php echo e($doctorSchedule->id); ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="align-middle"><?php echo e($doctorSchedule->user->name ?? '-'); ?></td>
                                                <td class="align-middle"><?php echo e($doctorSchedule->weekday); ?></td>
                                                <td class="align-middle"><?php echo e($doctorSchedule->start_time); ?></td>
                                                <td class="align-middle"><?php echo e($doctorSchedule->end_time); ?></td>
                                                <td class="align-middle">
                                                    <?php if($doctorSchedule->status == '1'): ?>
                                                        <span class="badge badge-success"><?php echo app('translator')->get('Active'); ?></span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger"><?php echo app('translator')->get('Inactive'); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-right align-middle">
                                                    <div class="btn-group">
                                                        <a href="<?php echo e(route('doctor-schedules.show', $doctorSchedule)); ?>"
                                                            class="btn btn-sm btn-outline-info" data-toggle="tooltip"
                                                            title="<?php echo app('translator')->get('View'); ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('doctor-schedule-update')): ?>
                                                            <a href="<?php echo e(route('doctor-schedules.edit', $doctorSchedule)); ?>"
                                                                class="btn btn-sm btn-outline-warning ml-1"
                                                                data-toggle="tooltip" title="<?php echo app('translator')->get('Edit'); ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('doctor-schedule-delete')): ?>
                                                            <a href="#"
                                                                data-href="<?php echo e(route('doctor-schedules.destroy', $doctorSchedule)); ?>"
                                                                class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal"
                                                                data-target="#myModal" title="<?php echo app('translator')->get('Delete'); ?>">
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
                                <?php echo e($doctorSchedules->withQueryString()->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php $__env->startPush('footer'); ?>
        <script>
            $(document).ready(function() {
                // Check All functionality
                $('#check_all').on('click', function() {
                    $('.schedule_checkbox').prop('checked', $(this).prop('checked'));
                    toggleBulkDeleteBtn();
                });

                // Individual checkbox change
                $('.schedule_checkbox').on('change', function() {
                    if ($('.schedule_checkbox:checked').length == $('.schedule_checkbox').length) {
                        $('#check_all').prop('checked', true);
                    } else {
                        $('#check_all').prop('checked', false);
                    }
                    toggleBulkDeleteBtn();
                });

                function toggleBulkDeleteBtn() {
                    if ($('.schedule_checkbox:checked').length > 0) {
                        $('#bulk_delete').removeClass('d-none');
                    } else {
                        $('#bulk_delete').addClass('d-none');
                    }
                }

                // Bulk Delete click
                $('#bulk_delete').on('click', function() {
                    var selectedIds = [];
                    $('.schedule_checkbox:checked').each(function() {
                        selectedIds.push($(this).val());
                    });

                    if (selectedIds.length > 0) {
                        Swal.fire({
                            title: "<?php echo app('translator')->get('Are you sure?'); ?>",
                            text: "<?php echo app('translator')->get('You will not be able to revert this!'); ?>",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: "<?php echo app('translator')->get('Yes, delete them!'); ?>",
                            cancelButtonText: "<?php echo app('translator')->get('Cancel'); ?>"
                        }).then((result) => {
                            if (result.isConfirmed || result.value) {
                                $.ajax({
                                    url: "<?php echo e(url('')); ?>/<?php echo e(request()->segment(1)); ?>/doctor-schedules/bulk-delete",
                                    type: 'POST',
                                    data: {
                                        ids: selectedIds,
                                        _token: "<?php echo e(csrf_token()); ?>"
                                    },
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            Swal.fire({
                                                title: "<?php echo app('translator')->get('Deleted!'); ?>",
                                                text: response.message,
                                                icon: 'success'
                                            }).then(() => {
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire(
                                                "<?php echo app('translator')->get('Error!'); ?>",
                                                response.message,
                                                'error'
                                            );
                                        }
                                    },
                                    error: function() {
                                        Swal.fire(
                                            "<?php echo app('translator')->get('Error!'); ?>",
                                            "<?php echo app('translator')->get('Something went wrong. Please try again.'); ?>",
                                            'error'
                                        );
                                    }
                                });
                            }
                        });
                    }
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/doctor-schedule/index.blade.php ENDPATH**/ ?>