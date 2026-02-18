<?php $__env->startSection('content'); ?>
    <style>
        .email-label {
            display: inline-block;
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .input-group {
            position: relative;
        }

        .email-checkbox {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Add Patient'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo e(route('patient-details.index')); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to List'); ?>
                    </a>
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
                            <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Create Patient'); ?></h3>
                        </div>
                        <div class="card-body">
                            <form id="patientForm" class="form-material form-horizontal"
                                action="<?php echo e(route('patient-details.store')); ?>" method="POST" enctype="multipart/form-data"
                                data-parsley-validate>
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name"><?php echo app('translator')->get('Name'); ?> <b
                                                    class="ambitious-crimson">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                                </div>
                                                <input type="text" id="name" name="name"
                                                    value="<?php echo e(old('name')); ?>"
                                                    class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo app('translator')->get('John Doe'); ?>" required data-parsley-required="true"
                                                    data-parsley-required-message="<?php echo app('translator')->get(" Please enter patient's name"); ?>">
                                                <?php $__errorArgs = ['name'];
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
                                            <label for="phone"><?php echo app('translator')->get('Phone'); ?> <b
                                                    class="ambitious-crimson">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="number" id="phone" name="phone"
                                                    value="<?php echo e(old('phone')); ?>"
                                                    class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo app('translator')->get('03375544887'); ?>" required data-parsley-required="true"
                                                    data-parsley-required-message="<?php echo app('translator')->get('Phone is required'); ?>"
                                                    data-parsley-type="number"
                                                    data-parsley-type-message="<?php echo app('translator')->get('Invalid phone number'); ?>">
                                                <?php $__errorArgs = ['phone'];
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
                                            <label for="email" class="email-label">
                                                <?php echo app('translator')->get('Email'); ?> <b class="ambitious-crimson">*</b>
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                </div>
                                                <input type="email" id="email" name="email" required
                                                    value="<?php echo e(old('email')); ?>"
                                                    class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo app('translator')->get('example@gmail.com'); ?>" data-parsley-required="true"
                                                    data-parsley-required-message="<?php echo app('translator')->get('Email is required'); ?>"
                                                    data-parsley-type="email"
                                                    data-parsley-type-message="<?php echo app('translator')->get('Invalid email address'); ?>">
                                                <input style="position: absolute;top: -19px;right: 10px;" type="checkbox"
                                                    class="form-check-input email-checkbox" id="noEmailCheckbox">
                                                <label style="position: absolute;top: -30px;right: 30px;"
                                                    class="form-check-label"
                                                    for="noEmailCheckbox"><?php echo app('translator')->get('No Email'); ?></label>
                                                <?php $__errorArgs = ['email'];
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
                                            <label for="gender"><?php echo app('translator')->get('Gender'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                                </div>
                                                <select name="gender"
                                                    class="form-control <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="gender" data-parsley-required="true"
                                                    data-parsley-required-message="<?php echo app('translator')->get('Gender is required'); ?>">
                                                    <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                    <option value="male" <?php echo e(old('gender') === 'male' ? 'selected' : ''); ?>>
                                                        <?php echo app('translator')->get('Male'); ?>
                                                    </option>
                                                    <option value="female"
                                                        <?php echo e(old('gender') === 'female' ? 'selected' : ''); ?>>
                                                        <?php echo app('translator')->get('Female'); ?></option>
                                                </select>
                                                <?php $__errorArgs = ['gender'];
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
                                            <label for="blood_group"><?php echo app('translator')->get('Blood Group'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heartbeat"></i></span>
                                                </div>
                                                <select name="blood_group"
                                                    class="form-control select2 <?php $__errorArgs = ['blood_group'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="blood_group">
                                                    <option value="" <?php echo e(old('blood_group') ? '' : 'selected'); ?>>
                                                        Select Blood Group</option>
                                                    <?php $__currentLoopData = $bloodGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bloodGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($bloodGroup->id); ?>"
                                                            <?php echo e(old('blood_group') == $bloodGroup->id ? 'selected' : ''); ?>>
                                                            <?php echo e($bloodGroup->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['blood_group'];
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
                                            <label for="date_of_birth"><?php echo app('translator')->get('Date of Birth'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-birthday-cake"></i></span>
                                                </div>
                                                <input type="date" name="date_of_birth" id="date_of_birth"
                                                    class="form-control <?php $__errorArgs = ['date_of_birth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('date_of_birth')); ?>" max="<?php echo e(date('Y-m-d')); ?>">
                                                <?php $__errorArgs = ['date_of_birth'];
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
                                            <label for="marital_status"><?php echo app('translator')->get('Marital Status'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                </div>
                                                <select
                                                    class="form-control select2 ambitious-form-loading <?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="marital_status" id="marital_status">
                                                    <option value="" <?php echo e(old('marital_status') ? '' : 'selected'); ?>>
                                                        Select
                                                    </option>
                                                    <?php $__currentLoopData = $maritalStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maritalStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($maritalStatus->id); ?>"
                                                            <?php echo e(old('marital_status') == $maritalStatus->id ? 'selected' : ''); ?>>
                                                            <?php echo e($maritalStatus->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['marital_status'];
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
                                            <label for="cnic"><?php echo app('translator')->get('CNIC / Passport'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                </div>
                                                <input type="text" id="cnic" name="cnic" class="form-control"
                                                    value="<?php echo e(old('cnic')); ?>" placeholder="<?php echo app('translator')->get('11111-1111111-1'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="display: none;">
                                        <div class="form-group">
                                            <label for="credit_balance"><?php echo app('translator')->get('Credit Balance'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rs.</span>
                                                </div>
                                                <input type="number" name="credit_balance" id="credit_balance"
                                                    class="form-control <?php $__errorArgs = ['credit_balance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('credit_balance')); ?>" placeholder="<?php echo app('translator')->get('15000'); ?>">
                                                <?php $__errorArgs = ['credit_balance'];
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
                                            <label for="insurance_provider_id"><?php echo app('translator')->get('Insurance Provider'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-shield-alt"></i></span>
                                                </div>
                                                <select
                                                    class="select2-custom form-control select2 ambitious-form-loading <?php $__errorArgs = ['insurance_provider_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="insurance_provider_id" id="insurance_provider_id">
                                                    <option value=""
                                                        <?php echo e(old('insurance_provider_id') ? '' : ' selected'); ?>>
                                                        Select Provider</option>
                                                    <?php $__currentLoopData = $insuranceProviders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insuranceProvider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($insuranceProvider->id); ?>"
                                                            <?php echo e(old('insurance_provider_id') == $insuranceProvider->id ? 'selected' : ''); ?>>
                                                            <?php echo e($insuranceProvider->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['insurance_provider_id'];
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
                                            <label for="area"><?php echo app('translator')->get('Area'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fa fa-solid fa-map-marker"></i></span>
                                                </div>
                                                <input type="text" name="area" id="area"
                                                    value="<?php echo e(old('area')); ?>"
                                                    class="form-control <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    rows="1" placeholder="<?php echo app('translator')->get('i8 Markaz'); ?>"
                                                    <?php echo e(old('area')); ?> />
                                                <?php $__errorArgs = ['area'];
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
                                            <label for="city"><?php echo app('translator')->get('City'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fa fa-solid fa-map-marker"></i></span>
                                                </div>
                                                <input type="text" name="city" id="city"
                                                    value="<?php echo e(old('city')); ?>"
                                                    class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    rows="1" placeholder="<?php echo app('translator')->get('Islamabad'); ?>"
                                                    <?php echo e(old('city')); ?> />
                                                <?php $__errorArgs = ['city'];
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
                                            <label for="address"><?php echo app('translator')->get('Address'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fa fa-solid fa-map-marker"></i></span>
                                                </div>
                                                <input type="text" name="address" id="address"
                                                    value="<?php echo e(old('address')); ?>"
                                                    class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    rows="1" placeholder="<?php echo app('translator')->get('House 35, Street 66, i8 markaz, Islamabad'); ?>"
                                                    <?php echo e(old('address')); ?> />
                                                <?php $__errorArgs = ['address'];
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
                                    <input type="hidden" id="password" name="password" value="12345678" required>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="other_details">Other Details</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                </div>
                                                <textarea rows="1" type="text" id="other-details" name="other_details" value="<?php echo e(old('other_details')); ?>"
                                                    class="form-control" placeholder="Additional details..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="enquirysource"><?php echo app('translator')->get('Where did you hear about us?'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heartbeat"></i></span>
                                                </div>
                                                <select name="enquirysource"
                                                    class="form-control select2 <?php $__errorArgs = ['enquirysource'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="enquirysource">
                                                    <option value="" disabled
                                                        <?php echo e(old('enquirysource') ? '' : 'selected'); ?>>
                                                        Select Source</option>
                                                    <?php $__currentLoopData = $enquirysource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($enquiry->id); ?>"
                                                            <?php echo e(old('enquirysource') == $enquiry->id ? 'selected' : ''); ?>>
                                                            <?php echo e($enquiry->source_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['enquirysource'];
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

                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg"><?php echo app('translator')->get('Submit'); ?></button>
                                        <a href="<?php echo e(route('patient-details.index')); ?>"
                                            class="btn btn-outline-secondary btn-lg ml-1"><?php echo app('translator')->get('Cancel'); ?></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('noEmailCheckbox').addEventListener('change', function() {
                var emailField = document.getElementById('email');
                var phoneField = document.getElementById('phone');

                if (this.checked) {

                    var characters = '123456789';
                    var randomValue = '';

                    for (var i = 0; i < 5; i++) {
                        var randomIndex = Math.floor(Math.random() * characters.length);
                        randomValue += characters[randomIndex];
                    }


                    emailField.value = 'noemail' + phoneField.value + randomValue + '@gmail.com';
                    emailField.setAttribute('readonly', true);
                } else {
                    emailField.value = '';
                    emailField.removeAttribute('readonly');
                }
            });
        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/patient-detail/create.blade.php ENDPATH**/ ?>