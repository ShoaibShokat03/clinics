<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="site-url" content="<?php echo e(url('/')); ?>">


    <title>
        <?php echo e($ApplicationSetting->item_short_name); ?>

        <?php if(isset($title) && !empty($title)): ?>
        <?php echo e(" | ".$title); ?>

        <?php endif; ?>
    </title>
    <?php echo $__env->make('thirdparty.css_back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('one_page_css'); ?>

    <link href="<?php echo e(asset('assets/css/fullcalendar.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/mycustom.css')); ?>" rel="stylesheet">

    <!-- Unified Design System - Must be loaded last for proper cascading -->
    <link href="<?php echo e(asset('assets/css/dental-design-system.css')); ?>" rel="stylesheet">

    <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom/layout.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom/fullcalendar.min.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('header'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php echo $__env->make('thirdparty.js_back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('one_page_js'); ?>
    <?php echo $__env->make('thirdparty.js_back_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('footer'); ?>
    <script src="<?php echo e(URL::asset('assets\js\parsely.min.js')); ?>"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const requiredFields = document.querySelectorAll("[required]");
            requiredFields.forEach(field => {
                const formGroup = field.closest(".form-group");
                if (formGroup) {
                    const lable = formGroup.querySelector("label");
                    if (lable) {
                        lable.classList.add("required");
                        // add requried text as inner html wiht previous
                        lable.innerHTML = lable.innerHTML + " <span class='text-danger' style='font-size:9px;'>" + "Required" + "</span>";
                    }
                }
            });
        });
    </script>
</body>

</html><?php /**PATH E:\dental\dental-main\resources\views/layouts/layout.blade.php ENDPATH**/ ?>