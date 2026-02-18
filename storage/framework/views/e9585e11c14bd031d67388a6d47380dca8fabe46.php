<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Edit Patient'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">

                    <div class="btn-group">
                        <a href="<?php echo e(route('patient-details.create')); ?>" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Patient'); ?>
                        </a>
                        <a href="<?php echo e(route('patient-details.index')); ?>" class="btn btn-outline-primary btn-sm ml-1">
                            <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to List'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="record_id" value="<?php echo e($patientDetail->id); ?>">
    <input type="hidden" id="table_name" value="patient">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h3 class="card-title font-weight-bold">Edit Patient (<?php echo e($patientDetail->name); ?>) </h3>
                        </div>
                        <div class="card-body">
                            <form id="departmentForm" class="form-material form-horizontal"
                                action="<?php echo e(route('patient-details.update', $patientDetail)); ?>" method="POST"
                                enctype="multipart/form-data" data-parsley-validate>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

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
                                                    value="<?php echo e(old('name', $patientDetail->name)); ?>"
                                                    class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo app('translator')->get('Name'); ?>" required data-parsley-required="true"
                                                    data-parsley-pattern="^[a-zA-Z\s]+$"
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
                                            <label for="phone"><?php echo app('translator')->get('Phone'); ?><b
                                                    class="ambitious-crimson">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" id="phone" name="phone"
                                                    value="<?php echo e(old('phone', $patientDetail->phone)); ?>"
                                                    class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo app('translator')->get('Phone'); ?>" required
                                                    data-parsley-required-message="Please enter phone no">
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
                                            <label for="email"><?php echo app('translator')->get('Email'); ?> <b
                                                    class="ambitious-crimson">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                </div>
                                                <input type="email" id="email" name="email"
                                                    value="<?php echo e(old('email', $patientDetail->email)); ?>"
                                                    class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="<?php echo app('translator')->get('Email'); ?>" required
                                                    data-parsley-required-message="Please enter valid email">
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
                                                    class="form-control select2 <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="gender">
                                                    <option value="" disabled
                                                        <?php if(old('gender', $patientDetail->gender) == null): ?> selected <?php endif; ?>>
                                                        <?php echo app('translator')->get('Select Gender'); ?>
                                                    </option>
                                                    <option value="male"
                                                        <?php if(old('gender', $patientDetail->gender) == 'male'): ?> selected <?php endif; ?>>
                                                        <?php echo app('translator')->get('Male'); ?>
                                                    </option>
                                                    <option value="female"
                                                        <?php if(old('gender', $patientDetail->gender) == 'female'): ?> selected <?php endif; ?>>
                                                        <?php echo app('translator')->get('Female'); ?>
                                                    </option>
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
                                                    class="form-control <?php $__errorArgs = ['blood_group'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="blood_group">
                                                    <option value="" disabled
                                                        <?php if(old('blood_group', $patientDetail->blood_group) == null): ?> selected <?php endif; ?>>
                                                        Select Blood Group
                                                    </option>
                                                    <?php $__currentLoopData = $bloodGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bloodGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($bloodGroup->id); ?>"
                                                            <?php if(old('blood_group', $patientDetail->blood_group) == $bloodGroup->id): ?> selected <?php endif; ?>>
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
                                                    value="<?php echo e(old('date_of_birth', isset($patientDetail->date_of_birth) ? \Carbon\Carbon::parse($patientDetail->date_of_birth)->format('Y-m-d') : '')); ?>"
                                                    max="<?php echo e(date('Y-m-d')); ?>">
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
                                            <label for="marital_status"><?php echo app('translator')->get('Marital Status'); ?> <b
                                                    class="ambitious-crimson">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                </div>
                                                <select name="marital_status"
                                                    class="form-control select2 <?php $__errorArgs = ['marital_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="marital_status">
                                                    <option value="" disabled
                                                        <?php if(old('marital_status', $patientDetail->patientDetails->marital_status ?? ' ') == null): ?> selected <?php endif; ?>>
                                                        <?php echo app('translator')->get('Select Marital Status'); ?>
                                                    </option>
                                                    <?php $__currentLoopData = $maritalStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maritalStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($maritalStatus->id); ?>"
                                                            <?php if(old('marital_status', $patientDetail->patientDetails->marital_status ?? ' ') == $maritalStatus->id): ?> selected <?php endif; ?>>
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
                                            <label for="cnic"><?php echo app('translator')->get(' CNIC / Passport'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                </div>
                                                <input type="text" id="cnic" name="cnic"
                                                    value="<?php echo e(old('cnic', $patientDetail->patientDetails->cnic ?? ' ')); ?>"
                                                    class="form-control" placeholder="<?php echo app('translator')->get('CNIC'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="display:none;">
                                        <div class="form-group">
                                            <label for="credit_balance"><?php echo app('translator')->get('Credit_balance'); ?></label>
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
                                                    value="<?php echo e(old('credit_balance', $patientDetail->patientDetails->credit_balance ?? ' ')); ?>"
                                                    placeholder="<?php echo app('translator')->get('Credit_balance'); ?>" />
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
                                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                                </div>
                                                <select
                                                    class="form-control select2 ambitious-form-loading <?php $__errorArgs = ['insurance_provider_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="insurance_provider_id" id="insurance_provider_id">
                                                    <option value=""
                                                        <?php if(is_null(old('insurance_provider_id', $patientDetail->patientDetails->insurance_provider_id ?? null))): ?> selected <?php endif; ?>>
                                                        <?php echo app('translator')->get('Select Provider'); ?>
                                                    </option>

                                                    <?php $__currentLoopData = $insuranceProviders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insuranceProvider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($insuranceProvider->id); ?>"
                                                            <?php if(old('insurance_provider_id', optional($patientDetail->patientDetails)->insurance_provider_id) ==
                                                                    $insuranceProvider->id): ?> selected <?php endif; ?>>
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
                                                    class="form-control <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('area', $patientDetail->patientDetails->area ?? ' ')); ?>"
                                                    placeholder="<?php echo app('translator')->get('Area'); ?>" />
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
                                                    class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('city', $patientDetail->patientDetails->city ?? ' ')); ?>"
                                                    placeholder="<?php echo app('translator')->get('City'); ?>" />
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
                                                    class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    rows="1" value="<?php echo e(old('address', $patientDetail->address)); ?>"
                                                    placeholder="<?php echo app('translator')->get('address'); ?>" />
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status"><?php echo app('translator')->get('Status'); ?> <b
                                                    class="ambitious-crimson">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                                </div>
                                                <select
                                                    class="form-control select2 ambitious-form-loading <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    required name="status" id="status">
                                                    <option value="" disabled
                                                        <?php if(old('status', $patientDetail->status) == null): ?> selected <?php endif; ?>>
                                                        <?php echo app('translator')->get('Select Status'); ?>
                                                    </option>
                                                    <option value="1"
                                                        <?php if(old('status', $patientDetail->status) == '1'): ?> selected <?php endif; ?>>
                                                        <?php echo app('translator')->get('Active'); ?>
                                                    </option>
                                                    <option value="0"
                                                        <?php if(old('status', $patientDetail->status) == '0'): ?> selected <?php endif; ?>>
                                                        <?php echo app('translator')->get('Inactive'); ?>
                                                    </option>
                                                </select>
                                                <?php $__errorArgs = ['status'];
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
                                            <label for="other_details"><?php echo app('translator')->get('Other Details'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                </div>
                                                <textarea name="other_details" id="other_details" class="form-control <?php $__errorArgs = ['other_details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    rows="1" placeholder="<?php echo app('translator')->get('other_details'); ?>"><?php echo e(old('other_details', $patientDetail->patientDetails->other_details ?? ' ')); ?></textarea>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="enquirysource"><?php echo app('translator')->get('Where did you hear about us?'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heartbeat"></i></span>
                                                </div>
                                                <select name="enquirysource"
                                                    class="form-control select2 <?php $__errorArgs = ['enquiry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="enquirysource">
                                                    <option value="" disabled> Select Source </option>
                                                    <?php $__currentLoopData = $enquirysource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($enquiry->id); ?>"
                                                            <?php if(old('enquirysource', $patientDetail->patientDetails->enquirysource ?? ' ') == $enquiry->id): ?> selected <?php endif; ?>>
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
                                        <button type="submit" class="btn btn-primary btn-lg"><?php echo app('translator')->get('Update'); ?></button>
                                        <a href="<?php echo e(route('patient-details.index')); ?>"
                                            class="btn btn-outline-secondary btn-lg ml-1"><?php echo app('translator')->get('Cancel'); ?></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">Upload Profile Picture</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input id="profile_picture" name="profile_picture" type="file"
                                data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2048K" />
                            <p><?php echo e(__('Max Size: 2048kb, Allowed Format: png, jpg, jpeg')); ?></p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered custom-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('Profile Picture'); ?></th>
                                            <th><?php echo app('translator')->get('Uploaded By'); ?></th>
                                            <th><?php echo app('translator')->get('Upload Date'); ?></th>
                                            <th><?php echo app('translator')->get('Action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="profilePictureTableBody" class="fileTableBody"></tbody>
                                </table>
                            </div>
                            <?php $__errorArgs = ['profile_picture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error ambitious-red">
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

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">Upload CNIC</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input id="cnic_file" name="cnic_file[]" type="file" multiple
                                data-allowed-file-extensions="png jpg jpeg pdf" data-max-file-size="2048K" />
                            <p><?php echo e(__('Max Size: 2048kb, Allowed Format: png, jpg, jpeg, pdf')); ?></p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('File Name'); ?></th>
                                            <th><?php echo app('translator')->get('Uploaded By'); ?></th>
                                            <th><?php echo app('translator')->get('Upload Date'); ?></th>
                                            <th><?php echo app('translator')->get('Action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="cnicFileTableBody" class="fileTableBody"></tbody>
                                    <!-- CNIC files will be loaded here via AJAX -->
                                </table>
                            </div>
                            <?php $__errorArgs = ['cnic_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error ambitious-red">
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


            <div
                class="card shadow-sm border-0 <?php echo e(isset($patientDetail->patientDetails) && $patientDetail->patientDetails->insurance_provider_id !== null ? 'd-block' : 'd-none'); ?>">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">Upload Insurance Documents</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input id="insurance_card" name="insurance_card[]" type="file" multiple
                                data-allowed-file-extensions="png jpg jpeg pdf" data-max-file-size="2048K" />
                            <p><?php echo e(__('Max Size: 2048kb, Allowed Format: png, jpg, jpeg, pdf')); ?></p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('File Name'); ?></th>
                                            <th><?php echo app('translator')->get('Uploaded By'); ?></th>
                                            <th><?php echo app('translator')->get('Upload Date'); ?></th>
                                            <th><?php echo app('translator')->get('Action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="insuranceCardTableBody" class="fileTableBody"></tbody>
                                    <!-- Insurance files will be loaded here via AJAX -->
                                </table>
                            </div>
                            <div class="form-check <?php echo e($insuranceFiles > 0 ? 'd-block' : 'd-none'); ?>">
                                <input class="form-check-input" style="position: static; margin-top:1px;" type="checkbox"
                                    value="yes" id="insuranceVerifiedCheckbox"
                                    <?php echo e(isset($patientDetail->patientDetails->insurance_verified) == 'yes' ? 'checked' : ''); ?>>
                                <label class="form-check-label">
                                    <?php echo e(__('Insurance Verified')); ?>

                                </label>
                            </div>
                            <?php $__errorArgs = ['insurance_card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error ambitious-red">
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


            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">Upload Other Documents</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input id="other_files" name="other_files[]" type="file" multiple
                                data-allowed-file-extensions="png jpg jpeg pdf xml txt doc docx mp4"
                                data-max-file-size="2048K" />
                            <p><?php echo e(__('Max Size: 2048kb, Allowed Format: png, jpg, jpeg, pdf, xml, txt, doc, docx, mp4')); ?>

                            </p>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('File Name'); ?></th>
                                            <th><?php echo app('translator')->get('Uploaded By'); ?></th>
                                            <th><?php echo app('translator')->get('Upload Date'); ?></th>
                                            <th><?php echo app('translator')->get('Action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="otherFilesTableBody" class="fileTableBody"></tbody>
                                    <!-- Other files will be loaded here via AJAX -->
                                </table>
                            </div>
                            <?php $__errorArgs = ['other_files'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error ambitious-red">
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

            <?php
                $statusMapping = [
                    1 => 'Single',
                    2 => 'Married',
                    3 => 'Divorced',
                    // Add other statuses if needed
                ];
            ?>
            <?php
        if ($logs) {
        ?>
            <div class="container mt-2">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['userlog-read'])): ?>
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h3 class="card-title font-weight-bold">User Logs</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>User</th>
                                            <th>Action</th>
                                            <th>Table</th>
                                            <th>Column</th>
                                            <th>Old Value</th>
                                            <th>New Value</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($log->user->name); ?></td>
                                                <td><?php echo e($log->action); ?></td>
                                                <td><?php echo e($log->table_name); ?></td>
                                                <td><?php echo e($log->field_name); ?></td>
                                                <td>
                                                    <?php if($log->field_name === 'marital_status'): ?>
                                                        <?php echo e($statusMapping[$log->old_value] ?? $log->old_value); ?>

                                                    <?php else: ?>
                                                        <?php echo e($log->old_value); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($log->field_name === 'marital_status'): ?>
                                                        <?php echo e($statusMapping[$log->new_value] ?? $log->new_value); ?>

                                                    <?php else: ?>
                                                        <?php echo e($log->new_value); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($log->created_at); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php } ?>
        </div>
    </div>



    <script>
        var getFilesUrl = "<?php echo e(route('get-files', $patientDetail->id)); ?>";
        var uploadFilesUrl = "<?php echo e(route('upload-file')); ?>";
        var deleteFilesUrl = "<?php echo e(route('delete-file')); ?>";
        var baseUrl = '<?php echo e(asset('')); ?>';
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const insuranceVerifiedCheckbox = document.getElementById('insuranceVerifiedCheckbox');

            insuranceVerifiedCheckbox.addEventListener('change', function() {
                const insurance_verified = this.checked ? 'yes' : 'no';
                $.ajax({
                    url: '<?php echo e(route('updateInsuranceVerified', $patientDetail->id)); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        insurance_verified: insurance_verified
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Insurance status updated successfully.');
                        } else {
                            alert('Failed to update insurance status.');
                        }
                    },
                    error: function(xhr) {
                        alert('Error occurred while updating insurance status: ' + xhr
                            .responseJSON.message);
                    }
                });
            });
        });

        function updateCheckboxVisibility() {
            const tableBody = $('#insuranceCardTableBody');
            const checkboxContainer = $('.form-check');


            // Check if the table body has any rows
            if (tableBody.find('tr').length > 0) {
                checkboxContainer.show();
            }
        }
        $(document).ready(function() {
            // Attach change event to file input
            $('#insurance_card').on('change', function() {
                // Set a timeout to call updateCheckboxVisibility after 500ms
                setTimeout(function() {
                    console.log("Before Uploading File at " + new Date().toLocaleString());
                    updateCheckboxVisibility();
                    console.log("After Uploading File at " + new Date().toLocaleString());
                }, 3000);
            });

            // Initial call to set the checkbox visibility on page load
            updateCheckboxVisibility();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/patient-detail/edit.blade.php ENDPATH**/ ?>