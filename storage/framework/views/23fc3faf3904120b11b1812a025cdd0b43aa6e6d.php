<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Patient Info'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="<?php echo e(route('patient-details.index')); ?>" class="btn btn-outline-primary btn-sm">
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
            <!-- Patient Info Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white p-3 border-bottom-0 d-flex align-items-center">
                            <div class="d-flex gap-3 align-items-center flex-grow-1">
                                <div class="padding:5px;">
                                    <img class="profile-user-img img-fluid img-circle" src="<?php echo e(asset($profilePicture)); ?>"
                                        alt="" style="width: 80px; height: 80px;" />
                                </div>
                                <span>&nbsp;</span>
                                <h3 class="card-title font-weight-bold m-0"><?php echo app('translator')->get('Patient Info'); ?> - <?php echo e($patientDetail->name); ?>

                                </h3>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('patient-detail-update')): ?>
                                <div>
                                    <a href="<?php echo e(route('patient-details.edit', $patientDetail)); ?>"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-edit"></i> <?php echo app('translator')->get('Edit'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="name"><?php echo app('translator')->get('Name'); ?></label>
                                        <p><?php echo e($patientDetail->name); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="mrn"><?php echo app('translator')->get('MRN Number'); ?></label>
                                        <p><?php echo optional($patientDetail->patientDetails)->mrn_number ?? ' '; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="email"><?php echo app('translator')->get('Email'); ?></label>
                                        <p><?php echo e($patientDetail->email); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="phone"><?php echo app('translator')->get('Phone'); ?></label>
                                        <p><?php echo e($patientDetail->phone); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="gender"><?php echo app('translator')->get('Gender'); ?></label>
                                        <p><?php echo e(ucfirst($patientDetail->gender)); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="cnic"><?php echo app('translator')->get('CNIC'); ?></label>
                                        <p><?php echo $patientDetail->patientDetails->cnic ?? ' '; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="blood_group"><?php echo app('translator')->get('Blood Group'); ?></label>
                                        <p><?php echo e($patientDetail->ddbloodgroup->name ?? ' '); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="date_of_birth"><?php echo app('translator')->get('Date of Birth'); ?></label>
                                        <p><?php echo e($patientDetail->date_of_birth ? \Carbon\Carbon::parse($patientDetail->date_of_birth)->format('d-M-Y') : '-'); ?>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="age"><?php echo app('translator')->get('Age'); ?></label>
                                        <p><?php echo e($patientDetail->age ? $patientDetail->age : '-'); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="marital_status"><?php echo app('translator')->get('Marital Status'); ?></label>
                                        <p><?php echo $patientDetail->patientDetails->maritalStatus->name ?? '-'; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="credit_balance"><?php echo app('translator')->get('Credit Balance'); ?></label>
                                        <p><?php echo $patientDetail->patientDetails->credit_balance ?? ' '; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="insurance_provider"><?php echo app('translator')->get('Insurance Company'); ?></label>
                                        <p><?php echo $patientDetail->patientDetails->insurance->name ?? ' '; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="status"><?php echo app('translator')->get('Status'); ?></label>
                                        <p>
                                            <?php if($patientDetail->status == 1): ?>
                                                <span class="badge badge-success"><?php echo app('translator')->get('Active'); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-danger"><?php echo app('translator')->get('Inactive'); ?></span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="area"><?php echo app('translator')->get('Area'); ?></label>
                                        <p><?php echo $patientDetail->patientDetails->area ?? ' '; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="city"><?php echo app('translator')->get('City'); ?></label>
                                        <p><?php echo $patientDetail->patientDetails->city ?? ' '; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="address"><?php echo app('translator')->get('Address'); ?></label>
                                        <p><?php echo e($patientDetail->address); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="row">
                <div class="col-12">

                    <!-- Profile Picture Card -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h3 class="card-title font-weight-bold">Profile Pictures</h3>
                        </div>
                        <div class="card-body">
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
                                    <tbody id="profilePictureTableBody" class="fileTableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Insurance Card -->
                    <div class="card shadow-sm border-0"
                        <?php if(isset($patientDetail->patientDetails) && $patientDetail->patientDetails->insurance_provider_id !== null): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h3 class="card-title font-weight-bold">Upload Insurance Documents</h3>
                        </div>
                        <div class="card-body">
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
                                </table>
                            </div>
                            <div class="form-check mt-2"
                                <?php if($insuranceFiles > 0): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
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

            <!-- Patient History -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold"><?php echo e($patientDetail->name); ?>'s history</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Medical History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Drug History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab"
                                aria-controls="messages" aria-selected="false">Social History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                                aria-controls="settings" aria-selected="false">Dental History</a>
                        </li>
                    </ul>

                    <div class="tab-content pt-3" id="myTabContent">
                        <!-- Medical History -->
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <h4 class="font-weight-bold mb-3"><?php echo app('translator')->get('Medical History of'); ?> <?php echo e($patientDetail->name); ?></h4>
                            <div class="row">
                                <?php $__currentLoopData = $patientMedicalHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-xl-3 col-md-4 p-3 border rounded bg-light mr-3 mb-3">
                                        <label
                                            class="font-weight-bold"><?php echo e($item->ddMedicalHistory->title ?? ' '); ?></label>
                                        <p class="m-0"><?php echo e($item->comments); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="card shadow-sm border-0 mt-3">
                                <div class="card-header bg-white p-3 border-bottom-0">
                                    <h3 class="card-title font-weight-bold">Medical Documents</h3>
                                </div>
                                <div class="card-body">
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
                                            <tbody id="medicalHistoryTableBody" class="fileTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Drug History -->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h4 class="font-weight-bold mb-3"><?php echo app('translator')->get('Drug History of'); ?> <?php echo e($patientDetail->name); ?></h4>
                            <div class="row">
                                <?php $__currentLoopData = $patientDrugHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-xl-3 col-md-4 p-3 border rounded bg-light mr-3 mb-3">
                                        <label class="font-weight-bold"><?php echo e($item->ddDrugHistory->title); ?></label>
                                        <p class="m-0"><?php echo e($item->comments); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="card shadow-sm border-0 mt-3">
                                <div class="card-header bg-white p-3 border-bottom-0">
                                    <h3 class="card-title font-weight-bold">Drug Documents</h3>
                                </div>
                                <div class="card-body">
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
                                            <tbody id="drugHistoryTableBody" class="fileTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Social History -->
                        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                            <h4 class="font-weight-bold mb-3"><?php echo app('translator')->get('Social History of'); ?> <?php echo e($patientDetail->name); ?></h4>
                            <div class="row">
                                <?php $__currentLoopData = $patientSocialHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-xl-3 col-md-4 p-3 border rounded bg-light mr-3 mb-3">
                                        <label class="font-weight-bold"><?php echo e($item->ddSocialHistory->title ?? '-'); ?></label>
                                        <p class="m-0"><?php echo e($item->comments); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="card shadow-sm border-0 mt-3">
                                <div class="card-header bg-white p-3 border-bottom-0">
                                    <h3 class="card-title font-weight-bold">Social Documents</h3>
                                </div>
                                <div class="card-body">
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
                                            <tbody id="socialHistoryTableBody" class="fileTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Dental History -->
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                            <h4 class="font-weight-bold mb-3"><?php echo app('translator')->get('Dental History of'); ?> <?php echo e($patientDetail->name); ?></h4>
                            <div class="row">
                                <?php $__currentLoopData = $patientDentalHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-xl-3 col-md-4 p-3 border rounded bg-light mr-3 mb-3">
                                        <label class="font-weight-bold"><?php echo e($item->ddDentalHistory->title ?? '-'); ?></label>
                                        <p class="m-0"><?php echo e($item->comments); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="card shadow-sm border-0 mt-3">
                                <div class="card-header bg-white p-3 border-bottom-0">
                                    <h3 class="card-title font-weight-bold">Dental Documents</h3>
                                </div>
                                <div class="card-body">
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
                                            <tbody id="dentalHistoryTableBody" class="fileTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Modules -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">Related Modules</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="relatedTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="appointments-tab" data-toggle="tab" href="#tab-appointments"
                                role="tab" aria-controls="appointments" aria-selected="true">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="exam-investigations-tab" data-toggle="tab"
                                href="#tab-exam-investigations" role="tab" aria-controls="exam-investigations"
                                aria-selected="false">Exam & Investigations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="treatment-plans-tab" data-toggle="tab" href="#tab-treatment-plans"
                                role="tab" aria-controls="treatment-plans" aria-selected="false">Treatment Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#tab-prescriptions"
                                role="tab" aria-controls="prescriptions" aria-selected="false">Prescriptions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="invoices-tab" data-toggle="tab" href="#tab-invoices" role="tab"
                                aria-controls="invoices" aria-selected="false">Invoices</a>
                        </li>
                    </ul>

                    <div class="tab-content pt-3" id="relatedTabsContent">
                        <!-- Appointments -->
                        <div class="tab-pane fade show active" id="tab-appointments" role="tabpanel"
                            aria-labelledby="appointments-tab">
                            <h4 class="font-weight-bold mb-3">Appointments</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="appointments_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('Appointment Number'); ?></th>
                                            <th><?php echo app('translator')->get('Doctor'); ?></th>
                                            <th><?php echo app('translator')->get('Status'); ?></th>
                                            <th><?php echo app('translator')->get('Problem'); ?></th>
                                            <th><?php echo app('translator')->get('Start Time'); ?></th>
                                            <th><?php echo app('translator')->get('End Time'); ?></th>
                                            <th><?php echo app('translator')->get('Dated'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $patientAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientAppointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('patient-appointments.show', $patientAppointment->id)); ?>"
                                                        class="text-decoration-underline">
                                                        <?php echo e($patientAppointment->appointment_number); ?>

                                                    </a>
                                                </td>
                                                <td><?php echo e($patientAppointment->doctor->name); ?></td>
                                                <td><?php echo e(isset($patientAppointment->appointmentstatus->name) ? $patientAppointment->appointmentstatus->name : '-'); ?>

                                                </td>
                                                <td><?php echo e(isset($patientAppointment->problem) ? $patientAppointment->problem : '-'); ?>

                                                </td>
                                                <td><?php echo e($patientAppointment->start_time); ?></td>
                                                <td><?php echo e($patientAppointment->end_time); ?></td>
                                                <td><?php echo e($patientAppointment->appointment_date); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Exam Investigations -->
                        <div class="tab-pane fade" id="tab-exam-investigations" role="tabpanel"
                            aria-labelledby="exam-investigations-tab">
                            <h4 class="font-weight-bold mb-3">Exam Investigations</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="exam_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('Examination Number'); ?></th>
                                            <th><?php echo app('translator')->get('Appointment Number'); ?></th>
                                            <th><?php echo app('translator')->get('Doctor'); ?></th>
                                            <th><?php echo app('translator')->get('Comments'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $examInvestigations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $examInvestigation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('exam-investigations.show', $examInvestigation->id)); ?>"
                                                        class="text-decoration-underline">
                                                        <?php echo e($examInvestigation->examination_number); ?></a>
                                                </td>
                                                <td><?php echo e(isset($examInvestigation->PatientAppointment->appointment_number) ? $examInvestigation->PatientAppointment->appointment_number : '-'); ?>

                                                </td>
                                                <td><?php echo e(isset($examInvestigation->doctor->name) ? $examInvestigation->doctor->name : '-'); ?>

                                                </td>
                                                <td><?php echo e(isset($examInvestigation->comments) ? $examInvestigation->comments : '-'); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Treatment Plans -->
                        <div class="tab-pane fade" id="tab-treatment-plans" role="tabpanel"
                            aria-labelledby="treatment-plans-tab">
                            <h4 class="font-weight-bold mb-3">Treatment Plans</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="treatment_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('Treatment Plan Number'); ?></th>
                                            <th><?php echo app('translator')->get('Examination Number'); ?></th>
                                            <th><?php echo app('translator')->get('Doctor'); ?></th>
                                            <th><?php echo app('translator')->get('Comments'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $patientTreatmentPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patientTreatmentPlan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('patient-treatment-plans.show', $patientTreatmentPlan->id)); ?>"
                                                        class="text-decoration-underline">
                                                        <?php echo e($patientTreatmentPlan->treatment_plan_number); ?></a>
                                                </td>
                                                <td><?php echo e(isset($patientTreatmentPlan->examinvestigation->examination_number) ? $patientTreatmentPlan->examinvestigation->examination_number : '-'); ?>

                                                </td>
                                                <td><?php echo e(isset($patientTreatmentPlan->doctor->name) ? $patientTreatmentPlan->doctor->name : '-'); ?>

                                                </td>
                                                <td><?php echo e(isset($patientTreatmentPlan->comments) ? $patientTreatmentPlan->comments : '-'); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Prescriptions -->
                        <div class="tab-pane fade" id="tab-prescriptions" role="tabpanel"
                            aria-labelledby="prescriptions-tab">
                            <h4 class="font-weight-bold mb-3">Prescriptions</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="prescriptions_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('Prescription Number'); ?></th>
                                            <th><?php echo app('translator')->get('Examination Number'); ?></th>
                                            <th><?php echo app('translator')->get('Doctor'); ?></th>
                                            <th><?php echo app('translator')->get('Notes'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(isset($prescription->prescription_number) ? $prescription->prescription_number : '-'); ?>

                                                </td>
                                                <td>
                                                    <?php if(isset($prescription->examinvestigations->examination_number)): ?>
                                                        <a href="<?php echo e(url('/prescriptions/' . $prescription->id)); ?>"
                                                            class="text-decoration-underline">
                                                            <?php echo e($prescription->examinvestigations->examination_number); ?>

                                                        </a>
                                                    <?php else: ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(isset($prescription->doctor->name) ? $prescription->doctor->name : '-'); ?>

                                                </td>
                                                <td><?php echo e(isset($prescription->note) ? $prescription->note : '-'); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Invoices -->
                        <div class="tab-pane fade" id="tab-invoices" role="tabpanel" aria-labelledby="invoices-tab">
                            <h4 class="font-weight-bold mb-3">Invoices</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="invoices_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th><?php echo app('translator')->get('Invoice Number'); ?></th>
                                            <th><?php echo app('translator')->get('Doctor Name'); ?></th>
                                            <th><?php echo app('translator')->get('Insurance'); ?></th>
                                            <th><?php echo app('translator')->get('Treatment Plan'); ?></th>
                                            <th><?php echo app('translator')->get('Total'); ?></th>
                                            <th><?php echo app('translator')->get('Paid'); ?></th>
                                            <th><?php echo app('translator')->get('Due'); ?></th>
                                            <th><?php echo app('translator')->get('Dated'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('invoices.show', $invoice->id)); ?>"
                                                        class="text-decoration-underline">
                                                        <?php echo e($invoice->invoice_number); ?></a>
                                                </td>
                                                <td><?php echo e(isset($invoice->patienttreatmentplan->doctor->name) ? $invoice->patienttreatmentplan->doctor->name : '-'); ?>

                                                </td>
                                                <td><?php echo e(isset($invoice->insurance->name) ? $invoice->insurance->name : '-'); ?>

                                                </td>
                                                <td><?php echo e(isset($invoice->patienttreatmentplan->treatment_plan_number) ? $invoice->patienttreatmentplan->treatment_plan_number : '-'); ?>

                                                </td>
                                                <td><?php echo e(isset($invoice->grand_total) ? $invoice->grand_total : '-'); ?></td>
                                                <td><?php echo e($invoice->paid); ?></td>
                                                <td><?php echo e($invoice->due); ?></td>
                                                <td><?php echo e($invoice->created_at); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CNIC Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">CNIC</h3>
                </div>
                <div class="card-body">
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


            <!-- Other Documents Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">Other Documents</h3>
                </div>
                <div class="card-body">
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

    <?php $__env->startPush('footer'); ?>
        <script>
            var getFilesUrl = "<?php echo e(route('get-files', $patientDetail->id)); ?>";
            var uploadFilesUrl = "<?php echo e(route('upload-file')); ?>";
            var deleteFilesUrl = "<?php echo e(route('delete-file')); ?>";
            var baseUrl = '<?php echo e(asset('')); ?>';
        </script>
    <?php $__env->stopPush(); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const insuranceVerifiedCheckbox = document.getElementById('insuranceVerifiedCheckbox');

            if (insuranceVerifiedCheckbox) {
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
            }
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/patient-detail/show.blade.php ENDPATH**/ ?>