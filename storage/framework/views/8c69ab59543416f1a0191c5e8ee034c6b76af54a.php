<?php $__env->startSection('one_page_js'); ?>
    <script src="<?php echo e(asset('assets/js/quill.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('one_page_css'); ?>
    <link href="<?php echo e(asset('assets/css/quill.snow.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__('Application Configuration')); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3><?php echo e(__('Application Configuration')); ?></h3>
                </div>
                <div class="card-body">
                    <form class="form-material form-horizontal bg-custom" action="<?php echo e(route('apsetting.update')); ?>"
                        method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row col-12 m-0 p-0">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4><?php echo e(__('Application Name')); ?> <b class="ambitious-crimson">*</b></h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chess-king"></i></span>
                                        </div>
                                        <input
                                            class="form-control ambitious-form-loading <?php $__errorArgs = ['item_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="item_name" id="item_name" type="text" required
                                            placeholder="<?php echo e(__('Type Your Item Name Here')); ?>"
                                            value="<?php echo e(old('item_name', $data->item_name)); ?>">
                                        <?php $__errorArgs = ['item_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-none">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4><?php echo e(__('Item Short Name')); ?> <b class="ambitious-crimson">*</b></h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chess-pawn"></i></span>
                                        </div>
                                        <input
                                            class="form-control ambitious-form-loading <?php $__errorArgs = ['item_short_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="item_short_name" id="item_short_name" type="text"
                                            placeholder="<?php echo e(__('Type Your Item Short Name Here')); ?>"
                                            value="<?php echo e(old('item_short_name', $data->item_short_name)); ?>" required>
                                        <?php $__errorArgs = ['item_short_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4><?php echo e(__('Contact')); ?> <b class="ambitious-crimson">*</b></h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input
                                            class="form-control ambitious-form-loading <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="contact" id="contact" type="text"
                                            placeholder="<?php echo e(__('Type Your contact')); ?>"
                                            value="<?php echo e(old('contact', $data->contact)); ?>" required>
                                        <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 d-none">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4><?php echo e(__('Company Name')); ?> <b class="ambitious-crimson">*</b></h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-building"></i></span>
                                        </div>
                                        <input
                                            class="form-control ambitious-form-loading <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="company_name" id="company_name" type="text"
                                            placeholder="<?php echo e(__('Type Your Company Name Here')); ?>"
                                            value="<?php echo e(old('company_name', $data->company_name)); ?>" required>
                                        <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4><?php echo e(__('Company Email')); ?> <b class="ambitious-crimson">*</b></h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input
                                            class="form-control ambitious-form-loading <?php $__errorArgs = ['company_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="company_email" id="company_email" type="text"
                                            placeholder="<?php echo e(__('Type Your Comapny Email Here')); ?>"
                                            value="<?php echo e(old('company_email', $data->company_email)); ?>" required>
                                        <?php $__errorArgs = ['company_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-md-12 col-form-label">
                                    <h4><?php echo e(__('Company Address')); ?> <b class="ambitious-crimson">*</b></h4>
                                </label>
                                <div class="col-md-12">

                                    <textarea class="form-control" rows="2" name="address" id="address"><?php echo e(old('address', $data->company_address)); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row col-12 m-0 p-0 d-none">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4><?php echo e(__('Deafult Language')); ?> <b class="ambitious-crimson">*</b></h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-language"></i></span>
                                        </div>
                                        <select
                                            class="form-control ambitious-form-loading <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="language" id="language">
                                            <?php
                                                $defaultLang = env('LOCALE_LANG', 'en');
                                            ?>
                                            <?php $__currentLoopData = $getLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>"
                                                    <?php echo e(old('language', $defaultLang) == $key ? 'selected' : ''); ?>>
                                                    <?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-form-label">
                                        <h4><?php echo e(__('Time Zone')); ?> <b class="ambitious-crimson">*</b></h4>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hourglass-start"></i></span>
                                        </div>
                                        <select
                                            class="form-control ambitious-form-loading <?php $__errorArgs = ['time_zone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            name="time_zone" id="time_zone">
                                            <?php $__currentLoopData = $timezone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>"
                                                    <?php echo e(old('time_zone', $data->time_zone) == $key ? 'selected' : ''); ?>>
                                                    <?php echo e($value); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['time_zone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($message); ?>

                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <label class="col-md-12 col-form-label">
                                    <h4><?php echo e(__('Logo')); ?></h4>
                                </label>
                                <div class="col-md-12">

                                    <input id="logo" class="dropify" name="logo" value="<?php echo e(old('logo')); ?>"
                                        type="file" data-allowed-file-extensions="png jpg jpeg webp"
                                        data-max-file-size="2024K" />
                                    <p><?php echo e(__('Max Size: 2MB, Allowed Format: png, jpg, jpeg, webp')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-12 col-form-label">
                                    <h4><?php echo e(__('Favicon')); ?></h4>
                                </label>
                                <div class="col-md-12">

                                    <input id="favicon" class="dropify" name="favicon" value="<?php echo e(old('favicon')); ?>"
                                        type="file" data-allowed-file-extensions="png jpg jpeg webp"
                                        data-max-file-size="500K" />
                                    <p><?php echo e(__('Max Size: 2MB, Allowed Format: png, jpg, jpeg, webp')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-8">
                                <input type="submit" value="<?php echo e(__('Submit')); ?>"
                                    class="btn btn-outline btn-info btn-lg" />
                                <a href="<?php echo e(route('dashboard')); ?>"
                                    class="btn btn-outline btn-warning btn-lg"><?php echo e(__('Cancel')); ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemNameInput = document.getElementById('item_name');
            const shortNameInput = document.getElementById('item_short_name');
            const companyNameInput = document.getElementById('company_name');

            if (itemNameInput) {
                itemNameInput.addEventListener('input', function() {
                    if (shortNameInput) shortNameInput.value = this.value;
                    if (companyNameInput) companyNameInput.value = this.value;
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/admin/application_setting.blade.php ENDPATH**/ ?>