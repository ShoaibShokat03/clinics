<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>">
    <title><?php echo app('translator')->get('Log in'); ?> | <?php echo e($ApplicationSetting->item_name ?? 'Dental Clinic'); ?></title>

    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome-free/css/all.min.css')); ?>" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/adminlte.min.css')); ?>" />
    <!-- Design System -->
    <link href="<?php echo e(asset('assets/css/dental-design-system.css')); ?>" rel="stylesheet">

    <style>
        body.login-page {
            background-color: #f4f7f6;
            font-family: 'Inter', sans-serif
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            background: url(<?php echo e(asset('assets/images/login-back.jpg')); ?>) repeat;
        }

        .login-box {
            width: 400px;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            padding: 30px 20px 10px;
            background-color: #fff !important;
        }

        .login-logo {
            max-height: 50px;
            width: auto;
            margin-bottom: 15px;
        }

        .clinic-name {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .login-msg {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 0;
        }

        .card-body {
            padding: 30px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            color: #adb5bd;
        }

        .form-control {
            border-left: none;
            height: 44px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: none;
        }

        .form-control:focus+.input-group-append .input-group-text,
        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-login {
            height: 44px;
            font-weight: 600;
            letter-spacing: 0.5px;
            background-color: var(--primary-color);
            border: none;
            width: 100% !important;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .auth-footer {
            font-size: 13px;
        }

        .alert-compact {
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .identColor {
            color: var(--primary-color) !important;
        }

        .custom-control-label {
            cursor: pointer;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white text-center border-bottom-0">
                <?php if(!empty($ApplicationSetting) && !empty($ApplicationSetting->logo)): ?>
                    <img src="<?php echo e(asset('public/' . optional($ApplicationSetting)->logo)); ?>" alt="Logo"
                        class="login-logo">
                <?php endif; ?>
                <h2 class="clinic-name"><?php echo e($ApplicationSetting->item_name ?? 'Dental Clinic'); ?></h2>
            </div>

            <div class="card-body">
                <?php if($errors->has('error')): ?>
                    <div class="alert alert-danger alert-compact">
                        <i class="fas fa-exclamation-circle mr-2"></i> <?php echo e($errors->first('error')); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('login')); ?>" method="POST" data-parsley-validate id="login-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_method" value="POST">

                    <div class="form-group mb-3">
                        <label for="email"><?php echo app('translator')->get('Email Address'); ?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input id="email" type="email"
                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                value="<?php echo e(old('email')); ?>" placeholder="name@example.com" required
                                data-parsley-required="true" data-parsley-type="email"
                                data-parsley-required-message="<?php echo app('translator')->get('Email is required'); ?>" data-parsley-trigger="focusout">
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger small font-weight-bold mt-1 d-block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group mb-4">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input id="password" type="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                placeholder="••••••••" required data-parsley-required="true"
                                data-parsley-required-message="<?php echo app('translator')->get('Password is required'); ?>" data-parsley-trigger="focusout">
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger small font-weight-bold mt-1 d-block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4 auth-footer">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember"
                                <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="custom-control-label text-muted" for="remember"><?php echo app('translator')->get('Remember me'); ?></label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-login">
                        <?php echo app('translator')->get('Sign In'); ?>
                    </button>
                </form>
            </div>
        </div>
        <div class="text-center mt-4 text-muted small" style="display:none;">
            &copy; <?php echo e(date('Y')); ?> <?php echo e($ApplicationSetting->item_name ?? 'Dental Clinic'); ?>. <?php echo app('translator')->get('All rights reserved.'); ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/adminlte.min.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#login-form').parsley();
        });
    </script>
</body>

</html>
<?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/page/login.blade.php ENDPATH**/ ?>