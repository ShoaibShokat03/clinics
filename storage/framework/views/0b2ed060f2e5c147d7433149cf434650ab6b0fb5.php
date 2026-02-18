<script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>

<script>
    <?php if(Session::has('demo_error')): ?>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.error('<?php echo e(Session::get('demo_error')); ?>')
    <?php endif; ?>

    <?php if(Session::has('info')): ?>
        toastr.success('<?php echo e(Session::get('info')); ?>')
    <?php endif; ?>

    <?php if(Session::has('success')): ?>
        toastr.success('<?php echo e(Session::get('success')); ?>')
    <?php endif; ?>

    <?php if(Session::has('warning')): ?>
        toastr.warning('<?php echo e(Session::get('warning')); ?>')
    <?php endif; ?>

    <?php if(Session::has('error')): ?>
        toastr.error('<?php echo e(Session::get('error')); ?>')
    <?php endif; ?>

    <?php if(isset($errors)&&count($errors) > 0): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            toastr.error('<?php echo e($error); ?>')
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</script>
<?php /**PATH E:\dental\dental-main\resources\views/thirdparty/js_back_footer.blade.php ENDPATH**/ ?>