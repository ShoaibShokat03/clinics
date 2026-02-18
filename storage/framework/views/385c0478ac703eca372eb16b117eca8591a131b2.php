<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Patient Appointment'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-appointment-create')): ?>
                        <a href="<?php echo e(route('patient-appointments.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> <?php echo app('translator')->get('Add Appointment'); ?>
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
                            <h3 class="card-title font-weight-bold ml-1"><?php echo app('translator')->get('Filter Appointments'); ?></h3>
                            <div class="card-tools">
                                <?php if(request()->has('today_appointments')): ?>
                                    <a href="<?php echo e(route('patient-appointments.index')); ?>"
                                        class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-calendar-day"></i> <?php echo app('translator')->get('All Appointments'); ?>
                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('patient-appointments.index')); ?>?today_appointments=1"
                                    class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-calendar-day"></i> <?php echo app('translator')->get('Today Appointments'); ?>
                                </a>
                                <a class="btn btn-outline-primary btn-sm ml-2" target="_blank"
                                    href="<?php echo e(route('patient-appointments.index')); ?>?export=1">
                                    <i class="fas fa-cloud-download-alt"></i> <?php echo app('translator')->get('Export'); ?>
                                </a>
                                <button class="btn btn-outline-secondary btn-sm ml-2" data-toggle="collapse" href="#filter">
                                    <i class="fas fa-filter"></i> <?php echo app('translator')->get('Filter'); ?>
                                </button>
                            </div>
                        </div>

                        <div id="filter" class="collapse <?php if(request('isFilterActive')): ?> show <?php endif; ?>">
                            <div class="card-body p-3 bg-light border-bottom">
                                <form action="" method="get" role="form" autocomplete="off">
                                    <input type="hidden" name="isFilterActive" value="true">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Patient'); ?></label>
                                                <select name="user_id" class="form-control form-control-sm select2"
                                                    id="user_id">
                                                    <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                    <?php $__currentLoopData = $patientinfo->sortBy(fn($patient) => strtolower($patient->user->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($patient->user_id); ?>"
                                                            <?php echo e((is_array(request('user_id')) ? '' : request('user_id')) == $patient->user_id ? 'selected' : ''); ?>>
                                                            <?php echo e(($patient->user->name ?? '') . ' - ' . ($patient->mrn_number ?? '')); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if(!auth()->user()->hasRole('Doctor')): ?>
                                            <div class="col-sm-2">
                                                <div class="form-group mb-2">
                                                    <label
                                                        class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Doctor'); ?></label>
                                                    <select name="doctor_id" class="form-control form-control-sm select2"
                                                        id="doctor_id">
                                                        <option value="">--<?php echo app('translator')->get('Select'); ?>--</option>
                                                        <?php $__currentLoopData = $doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($doctor->id); ?>"
                                                                <?php echo e((is_array(request('doctor_id')) ? '' : request('doctor_id')) == $doctor->id ? 'selected' : ''); ?>>
                                                                <?php echo e($doctor->name ?? '-'); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-sm-2">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Appointment Date'); ?></label>
                                                <input type="text" name="appointment_date" id="appointment_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="<?php echo app('translator')->get('Date'); ?>"
                                                    value="<?php echo e(is_array(request('appointment_date')) ? '' : request('appointment_date')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('Start Date'); ?></label>
                                                <input type="text" name="start_date" id="start_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="<?php echo app('translator')->get('Start'); ?>"
                                                    value="<?php echo e(is_array(request('start_date')) ? '' : request('start_date')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold"><?php echo app('translator')->get('End Date'); ?></label>
                                                <input type="text" name="end_date" id="end_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="<?php echo app('translator')->get('End'); ?>"
                                                    value="<?php echo e(is_array(request('end_date')) ? '' : request('end_date')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-right mt-4">
                                            <button type="submit" class="btn btn-info btn-sm"><?php echo app('translator')->get('Submit'); ?></button>
                                            <?php if(request('isFilterActive')): ?>
                                                <a href="<?php echo e(route('patient-appointments.index')); ?>"
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
                                            <th style="white-space:nowrap;">Apt No</th>
                                            <th>Doctor</th>
                                            <th>Patient</th>
                                            <th>MRN</th>
                                            <th>Apt Date</th>
                                            <th>Apt Time</th>
                                            <th>Status</th>
                                            <th>Reminder</th>
                                            <th data-orderable="false" class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $patientAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientAppointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="align-middle border-right">
                                                    <?php echo e($patientAppointment->appointment_number); ?></td>
                                                <td class="align-middle"><?php echo e($patientAppointment->doctor->name ?? '-'); ?>

                                                </td>
                                                <td class="align-middle"><?php echo e($patientAppointment->patient->name ?? '-'); ?>

                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="badge badge-light border"><?php echo e($patientAppointment->patient->patientDetails->mrn_number ?? '-'); ?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <?php echo e(date(is_object($companySettings) ? $companySettings->date_format ?? 'Y-m-d' : $companySettings['date_format'] ?? 'Y-m-d', strtotime($patientAppointment->appointment_date))); ?>

                                                </td>
                                                <td class="align-middle">
                                                    <?php echo e(\Carbon\Carbon::parse($patientAppointment->start_time)->format('h:i A') . ' - ' . \Carbon\Carbon::parse($patientAppointment->end_time)->format('h:i A')); ?>

                                                </td>
                                                <td class="align-middle">
                                                    <?php if(isset($patientAppointment->appointmentstatus->id)): ?>
                                                        <?php
                                                            $statusId = $patientAppointment->appointmentstatus->id;
                                                            $statusName =
                                                                $patientAppointment->appointmentstatus->name ?? '-';
                                                        ?>
                                                        <?php if($statusId == 1): ?>
                                                            <span class="badge badge-primary"><?php echo e($statusName); ?></span>
                                                        <?php elseif($statusId == 2): ?>
                                                            <span class="badge badge-warning"><?php echo e($statusName); ?></span>
                                                        <?php elseif($statusId == 3): ?>
                                                            <span class="badge badge-success"><?php echo e($statusName); ?></span>
                                                        <?php elseif($statusId == 4): ?>
                                                            <span class="badge badge-danger"><?php echo e($statusName); ?></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary"><?php echo e($statusName); ?></span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?php
                                                        $clinicName = isset($ApplicationSetting)
                                                            ? $ApplicationSetting->item_name
                                                            : '-';

                                                        // 1. Current Date aur Time
                                                        $currentDateTime = \Carbon\Carbon::now();

                                                        // 2. Date aur Time ko merge kar ke parse karein
                                                        // Hum 'appointment_date' aur 'start_time' dono ko combine kar rahe hain
                                                        $fullAppointmentPath =
                                                            $patientAppointment->appointment_date .
                                                            ' ' .
                                                            $patientAppointment->start_time;
                                                        $appointmentDateTime = \Carbon\Carbon::parse(
                                                            $fullAppointmentPath,
                                                        );

                                                        $rawPhone = $patientAppointment->patient->phone ?? null;
                                                        $phone = $rawPhone
                                                            ? preg_replace('/\D+/', '', $rawPhone)
                                                            : null;
                                                        $waUrl = null;

                                                        if (
                                                            $phone &&
                                                            strlen($phone) === 11 &&
                                                            substr($phone, 0, 1) === '0'
                                                        ) {
                                                            $phone = '92' . substr($phone, 1);
                                                            $patientName = $patientAppointment->patient->name ?? '';
                                                            $doctorName = $patientAppointment->doctor->name ?? '';

                                                            $formattedDate = $appointmentDateTime->format('d-M-Y');
                                                            $formattedTime = $appointmentDateTime->format('h:i A');

                                                            $message = "Hi *{$patientName}*, Your appointment *{$patientAppointment->appointment_number}* with *{$doctorName}* is scheduled on *{$formattedDate}* at *{$formattedTime}*. Please arrive on time. *{$clinicName}*. Thank you!";
                                                            $message = urlencode($message);
                                                            $waUrl = "https://wa.me/{$phone}?text={$message}";
                                                        }
                                                    ?>

                                                    
                                                    <?php if($currentDateTime->lessThanOrEqualTo($appointmentDateTime)): ?>
                                                        <?php if($waUrl): ?>
                                                            <a class="btn btn-sm btn-outline-success btn-send-reminder"
                                                                style="width:fit-content !important;gap:5px;"
                                                                href="<?php echo e($waUrl); ?>" target="_blank"
                                                                rel="noopener" data-id="<?php echo e($patientAppointment->id); ?>">
                                                                <i class="fab fa-whatsapp"></i> Send
                                                            </a>
                                                        <?php else: ?>
                                                            <small class="text-muted">-</small>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <small class="text-muted">Past Appointment</small>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="align-middle text-right">
                                                    <div class="btn-group">
                                                        <a href="<?php echo e(route('patient-appointments.show', $patientAppointment->id)); ?>"
                                                            class="btn btn-sm btn-outline-info" data-toggle="tooltip"
                                                            title="<?php echo app('translator')->get('View'); ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-appointments-update')): ?>
                                                            <a href="<?php echo e(route('patient-appointments.edit', $patientAppointment)); ?>"
                                                                class="btn btn-sm btn-outline-warning ml-1"
                                                                data-toggle="tooltip" title="<?php echo app('translator')->get('Edit'); ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-appointment-delete')): ?>
                                                            <a href="#"
                                                                data-href="<?php echo e(route('patient-appointments.destroy', $patientAppointment)); ?>"
                                                                class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal"
                                                                data-target="#myModal" title="<?php echo app('translator')->get('Delete'); ?>">
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
                        <div class="card-footer bg-white border-top-0">
                            <?php echo e($patientAppointments->withQueryString()->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer'); ?>
    <?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/patient-appointment/index.blade.php ENDPATH**/ ?>