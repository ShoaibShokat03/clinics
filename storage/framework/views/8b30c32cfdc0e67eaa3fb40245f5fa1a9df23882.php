<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e($ApplicationSetting->item_name); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <p class="my-0 font-weight-bold"><?php echo e(__('Are You Sure You Want To Delete This Data ???')); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <form class="btn-ok" action="" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger "><?php echo app('translator')->get('Delete'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /**PATH E:\dental\dental-main - 05-Feb-2026\resources\views/layouts/delete_modal.blade.php ENDPATH**/ ?>