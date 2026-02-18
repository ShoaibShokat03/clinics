<?php $__env->startSection('content'); ?>
<style>
    body {
        overscroll-x: hidden;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('Inventory List'); ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventory-create')): ?>
                <a href="<?php echo e(route('inventories.create')); ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Inventory'); ?>
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
                        <h3 class="card-title font-weight-bold ml-1"><?php echo app('translator')->get('Filter Inventory'); ?></h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-primary btn-sm" target="_blank"
                                href="<?php echo e(route('inventories.index')); ?>?export=1">
                                <i class="fas fa-cloud-download-alt"></i> <?php echo app('translator')->get('Export'); ?>
                            </a>
                            <button class="btn btn-outline-secondary btn-sm ml-2" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?>
                            </button>
                        </div>
                    </div>

                    <div id="filter" class="collapse <?php if(request()->has('isFilterActive')): ?> show <?php endif; ?>">
                        <div class="card-body p-3 bg-light border-bottom">
                            <form action="<?php echo e(route('inventories.index')); ?>" method="get" role="form" autocomplete="off">
                                <input type="hidden" name="isFilterActive" value="true">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Item'); ?></label>
                                            <select name="item_id" class="form-control form-control-sm select2">
                                                <option value=""><?php echo app('translator')->get('Select Item'); ?></option>
                                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->id); ?>"
                                                    <?php echo e(request()->input('item_id') == $item->id ? 'selected' : ''); ?>>
                                                    <?php echo e($item->title); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Category'); ?></label>
                                            <select name="category_id" class="form-control form-control-sm select2">
                                                <option value=""><?php echo app('translator')->get('Select Category'); ?></option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>"
                                                    <?php echo e(request()->input('category_id') == $category->id ? 'selected' : ''); ?>>
                                                    <?php echo e($category->title); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('SubCategory'); ?></label>
                                            <select name="subcategory_id" class="form-control form-control-sm select2">
                                                <option value=""><?php echo app('translator')->get('Select SubCategory'); ?></option>
                                                <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($subcategory->id); ?>"
                                                    <?php echo e(request()->input('subcategory_id') == $subcategory->id ? 'selected' : ''); ?>>
                                                    <?php echo e($subcategory->title); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Start Date'); ?></label>
                                            <input type="text" name="start_date" id="start_date"
                                                class="form-control form-control-sm flatpickr" placeholder="<?php echo app('translator')->get('Start Date'); ?>"
                                                value="<?php echo e(old('start_date', request()->start_date)); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('End Date'); ?></label>
                                            <input type="text" name="end_date" id="end_date"
                                                class="form-control form-control-sm flatpickr" placeholder="<?php echo app('translator')->get('End Date'); ?>"
                                                value="<?php echo e(old('end_date', request()->end_date)); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-1 text-right mt-4">
                                        <button type="submit" class="btn btn-info btn-sm"><?php echo app('translator')->get('Submit'); ?></button>
                                        <?php if(request()->has('isFilterActive')): ?>
                                        <a href="<?php echo e(route('inventories.index')); ?>"
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
                                        <th><?php echo app('translator')->get('Item'); ?></th>
                                        <th><?php echo app('translator')->get('Category'); ?></th>
                                        <th><?php echo app('translator')->get('SubCategory'); ?></th>
                                        <th class="text-center"><?php echo app('translator')->get('Unit Price'); ?></th>
                                        <th class="text-center"><?php echo app('translator')->get('Total Qty'); ?></th>
                                        <th class="text-center"><?php echo app('translator')->get('Consumed'); ?></th>
                                        <th class="text-center"><?php echo app('translator')->get('Available'); ?></th>
                                        <th data-orderable="false" class="text-right"><?php echo app('translator')->get('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="font-weight-bold text-primary"><?php echo e($inventory->item->title ?? '-'); ?></td>
                                        <td><?php echo e($inventory->category->title ?? '-'); ?></td>
                                        <td><?php echo e($inventory->subcategory->title ?? '-'); ?></td>
                                        <td class="text-center font-weight-bold"><?php echo e($inventory->unitprice); ?></td>
                                        <td class="text-center">
                                            <span class="badge badge-info"><?php echo e($inventory->quantity); ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-warning"><?php echo e($inventory->consumed_quantity); ?></span>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            $available = max(0, $inventory->quantity - $inventory->consumed_quantity);
                                            $badgeClass = $available > 5 ? 'badge-success' : ($available > 0 ? 'badge-warning' : 'badge-danger');
                                            ?>
                                            <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($available); ?></span>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="<?php echo e(route('inventories.show', $inventory)); ?>"
                                                    class="btn btn-sm btn-outline-info"
                                                    data-toggle="tooltip" title="<?php echo app('translator')->get('View'); ?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventory-update')): ?>
                                                <a href="#" data-id="<?php echo e($inventory->id); ?>"
                                                    data-item="<?php echo e($inventory->item->title ?? '-'); ?>"
                                                    data-category="<?php echo e($inventory->category->title ?? '-'); ?>"
                                                    data-subcategory="<?php echo e($inventory->subcategory->title ?? '-'); ?>"
                                                    data-quantity="<?php echo e(max(0, $inventory->quantity - $inventory->consumed_quantity)); ?>"
                                                    class="btn btn-sm btn-outline-success ml-1 consume-btn"
                                                    data-toggle="tooltip" title="<?php echo app('translator')->get('Consume'); ?>">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('inventory-delete')): ?>
                                                <a href="#" data-href="<?php echo e(route('inventories.destroy', $inventory)); ?>"
                                                    class="btn btn-sm btn-outline-danger ml-1"
                                                    data-toggle="modal" data-target="#myModal" title="<?php echo app('translator')->get('Delete'); ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <?php echo e($inventories->withQueryString()->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="consumeModal" tabindex="-1" role="dialog" aria-labelledby="consumeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="consumeModalLabel"><?php echo app('translator')->get('Consume Inventory'); ?></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="consumeForm" method="POST" action="<?php echo e(route('inventories.consume')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="inventory_id" id="inventory_id">
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Item'); ?></label>
                            <input type="text" id="item_title" class="form-control bg-light" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Category'); ?></label>
                            <input type="text" id="category" class="form-control bg-light" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-secondary small font-weight-bold"><?php echo app('translator')->get('SubCategory'); ?></label>
                            <input type="text" id="subcategory" class="form-control bg-light" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="text-secondary small font-weight-bold text-success"><?php echo app('translator')->get('Available Quantity'); ?></label>
                            <input type="number" id="available_quantity" class="form-control bg-light font-weight-bold text-success border-success" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-secondary small font-weight-bold text-primary"><?php echo app('translator')->get('Quantity to Consume'); ?></label>
                            <input type="number" name="quantity" id="consume_quantity" class="form-control border-primary" required min="1">
                        </div>
                    </div>
                    <div id="consume-error" class="text-danger small mt-n2 mb-2" style="display: none;">
                        <?php echo app('translator')->get('Quantity cannot be greater than the available inventory.'); ?>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check mr-1"></i> <?php echo app('translator')->get('Consume'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.consume-btn').on('click', function(e) {
            e.preventDefault();

            var inventoryId = $(this).data('id');
            var item = $(this).data('item');
            var category = $(this).data('category');
            var subcategory = $(this).data('subcategory');
            var quantity = $(this).data('quantity');

            // Populate the modal fields
            $('#inventory_id').val(inventoryId);
            $('#item_title').val(item);
            $('#category').val(category);
            $('#subcategory').val(subcategory);
            $('#available_quantity').val(quantity);
            $('#consume_quantity').attr('max', quantity);
            $('#consume-error').hide();
            $('#consume_quantity').removeClass('is-invalid');

            // Show the modal
            $('#consumeModal').modal('show');
        });

        $('#consumeForm').on('submit', function(e) {
            var quantity = parseInt($('#consume_quantity').val());
            var maxQuantity = parseInt($('#consume_quantity').attr('max'));

            if (quantity > maxQuantity) {
                e.preventDefault();
                $('#consume_quantity').addClass('is-invalid');
                $('#consume-error').show();
            } else {
                $('#consume_quantity').removeClass('is-invalid');
                $('#consume-error').hide();
            }
        });
    });
</script>

<?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/inventory/index.blade.php ENDPATH**/ ?>