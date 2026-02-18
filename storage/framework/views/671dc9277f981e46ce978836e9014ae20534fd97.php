<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Console - Login</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dental-design-system.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: var(--bg-gray);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .login-card {
            background: var(--bg-white);
            padding: 3rem;
            /* Spacing XXL */
            border-radius: var(--radius-lg);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 450px;
            border: 1px solid var(--border-color);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            display: block;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-medium);
            background-color: #fff;
            /* Force white background */
            box-sizing: border-box;
            /* Ensure padding doesn't overflow width */
        }

        .btn-block {
            width: 100% !important;
            /* Override dental-design-system.css */
            display: block;
            padding: 0.75rem;
            font-size: 1rem;
            margin-top: 1rem;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title"><i class="fas fa-code"></i> Dev Console</h1>
            <p class="text-muted">Enter credentials to access</p>
        </div>

        <?php if(session('error')): ?>
        <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
            <i class="fas fa-exclamation-circle mr-2"></i> <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('dev.login.submit')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                Login <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>
    </div>

</body>

</html><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/dev/login.blade.php ENDPATH**/ ?>