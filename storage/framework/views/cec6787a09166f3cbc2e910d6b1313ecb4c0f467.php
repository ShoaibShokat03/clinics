<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Edit Treatment Plan'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo e(route('patient-treatment-plans.index')); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to List'); ?>
                    </a>
                    <?php if($patientTreatmentPlan->examination_id): ?>
                        <a href="<?php echo e(route('exam-investigations.show', $patientTreatmentPlan->examination_id)); ?>"
                            class="btn btn-outline-info btn-sm ml-2">
                            <i class="fas fa-eye"></i> <?php echo app('translator')->get('View Exam'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <style>
        .btn-group .btn-print {
            margin-right: 10px;
        }
    </style>

    <div class="content">
        <div class="container-fluid">
            <div class="row treatment-plan-row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h3 class="card-title font-weight-bold"><?php echo app('translator')->get('Treatment Plan'); ?> -
                                <?php echo e($patientTreatmentPlan->treatment_plan_number); ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('patient-treatment-plans.update', $patientTreatmentPlan)); ?>"
                                method="POST">
                                <?php echo method_field('PUT'); ?>
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="demo_value" id="demo_value"
                                    value=<?php echo e($patientTreatmentPlan->examination_id); ?>>
                                <input type="hidden" name="treatment_plan_id" id="treatment_plan_id"
                                    value=<?php echo e($patientTreatmentPlan->id); ?>>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient"><?php echo app('translator')->get('Select Patient'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-user-injured"></i></span>
                                                </div>
                                                <select name="patient_disabled" id="patient" class="form-control select2"
                                                    disabled>
                                                    <option value="" disabled>Select Procedure</option>
                                                    <?php $__currentLoopData = $patients->sortBy(fn($patient) => strtolower($patient->name ?? '')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($patient->id); ?>"
                                                            <?php echo e($patientTreatmentPlan->patient_id == $patient->id ? 'selected' : ''); ?>>
                                                            <?php echo e($patient->name); ?> -
                                                            <?php echo e($patient->patientDetails->mrn_number ?? ' '); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="patient_id"
                                                value="<?php echo e($patientTreatmentPlan->patient_id); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="examination"><?php echo app('translator')->get('Teeth Examination Number'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-plus-square"></i></span>
                                                </div>

                                                <select name="examination_disabled" id="examination"
                                                    class="form-control select2" disabled>
                                                    <option value="" selected>Select Procedure</option>
                                                    <?php $__currentLoopData = $teethProcedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($procedure->id); ?>"
                                                            <?php echo e($patientTreatmentPlan->examination_id == $procedure->id ? 'selected' : ''); ?>>
                                                            <?php echo e($procedure->examination_number); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="examination_id"
                                                value="<?php echo e($patientTreatmentPlan->examination_id); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="doctor"><?php echo app('translator')->get('Select Doctor'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <select name="doctor_disabled" id="doctor" class="form-control select2"
                                                    disabled>
                                                    <option value="" disabled>Select Doctor</option>
                                                    <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($doctor->user && !is_null($doctor->user->name)): ?>
                                                            <option value="<?php echo e($doctor->user_id); ?>"
                                                                <?php echo e($patientTreatmentPlan->doctor_id == $doctor->user_id ? 'selected' : ''); ?>>
                                                                <?php echo e($doctor->user->name ?? ''); ?>

                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="doctor_id"
                                                value="<?php echo e($patientTreatmentPlan->doctor_id); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="comments"><?php echo app('translator')->get('Comments'); ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                                </div>
                                                <input type="text" name="comments" class="form-control" id="comments"
                                                    value="<?php echo e($patientTreatmentPlan->comments); ?>"
                                                    placeholder="<?php echo app('translator')->get('Comments'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4 align-items-center">
                                    <div class="col-md-5">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg px-5"><?php echo app('translator')->get('Update'); ?></button>
                                        <a href="<?php echo e(route('patient-treatment-plans.index')); ?>"
                                            class="btn btn-outline-secondary btn-lg px-5 ml-2"><?php echo app('translator')->get('Cancel'); ?></a>
                                    </div>
                                    <div class="col-md-7 text-md-right">
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('patient-treatment-plans.show', ['patient_treatment_plan' => $patientTreatmentPlan->id, 'print' => 'all'])); ?>"
                                                id="print-all-plan" class="btn btn-outline-secondary btn-sm"
                                                style="<?php echo e($hasPlanProcedures ? '' : 'display:none;'); ?>">
                                                <i class="fas fa-print"></i> <?php echo app('translator')->get('Print All Plan'); ?>
                                            </a>

                                            <a href="<?php echo e(route('patient-treatment-plans.show', ['patient_treatment_plan' => $patientTreatmentPlan->id, 'print' => 'ready'])); ?>"
                                                id="print-ready-to-procedure"
                                                class="btn btn-outline-secondary btn-sm ml-2"
                                                style="<?php echo e($hasReadyToStartProcedures ? '' : 'display:none;'); ?>">
                                                <i class="fas fa-print"></i> <?php echo app('translator')->get('Print Ready to Procedure'); ?>
                                            </a>

                                            <a href="#" id="generate-invoice"
                                                class="btn btn-outline-success btn-sm ml-2"
                                                style="<?php echo e($showGenerateInvoiceButton ? '' : 'display:none;'); ?>">
                                                <i class="fas fa-file-invoice"></i> <?php echo app('translator')->get('Generate Invoice'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php $__currentLoopData = $teeth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tooth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row tooth-row-<?php echo e($tooth->tooth_number); ?>">
            <div class="col-12">
                <div class="card shadow-none overflow-hidden mb-3" style="border: 1px solid #0066CC;"
                    data-tooth-number="<?php echo e($tooth->tooth_number); ?>">
                    <div class="card-header bg-light py-2 d-flex align-items-center"
                        style="border-bottom: 1px solid #0066CC;">
                        <img src="<?php echo e(asset('assets/images/teeth/' . $tooth->tooth_number . '.png')); ?>"
                            onerror="this.style.display='none'"
                            style="max-height: 25px; max-width: 25px; object-fit: contain; margin-right: 10px;">
                        <h3 class="card-title mb-0 font-weight-bold text-primary" style="font-size: 1rem;">
                            <?php echo app('translator')->get('Tooth'); ?> <?php echo e($tooth->tooth_number); ?></h3>
                    </div>

                    <div class="card-body">
                        <div class="tooth-issues bg-custom p-2 mb-2">
                            <?php $__currentLoopData = $tooth->toothIssues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="alert alert-light" style="display: inline-block; margin-right: 30px;">
                                    <h5 style="font-size:11px; font-weight:bold;"><?php echo e($issue->tooth_issue); ?>

                                        <?php echo e($issue->diagnosis ? ', ' . $issue->diagnosis->name : ''); ?> </h5>
                                    <p style="font-size:11px;"><?php echo e($issue->description); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover border tooth-treatment">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="border">Procedure Category</th>
                                        <th class="border">Procedure</th>
                                        <th class="border">Cost</th>
                                        <th class="border">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($patientTreatmentPlanProcedures->where('tooth_number', $tooth->tooth_number)->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $patientTreatmentPlanProcedures->where('tooth_number', $tooth->tooth_number); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planProcedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $isDisabled = $invoiceItems
                                                    ->where('patient_treatment_plan_procedure_id', $planProcedure->id)
                                                    ->isNotEmpty();
                                            ?>

                                            <tr class="treatment-plan-inner-row" data-id="<?php echo e($planProcedure->id); ?>">
                                                <td class="border col-xl-3 p-1">
                                                    <select required name="procedure_category[]"
                                                        class="form-control form-control-sm choose-treatment-category"
                                                        <?php echo e($isDisabled || $planProcedure->is_procedure_started == 'yes' ? 'disabled' : ''); ?>>
                                                        <option value="" disabled selected>Category</option>
                                                        <?php $__currentLoopData = $procedureCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedureCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($procedureCategory->id); ?>"
                                                                <?php echo e($planProcedure->procedure->dd_procedure_id == $procedureCategory->id ? 'selected' : ''); ?>>
                                                                <?php echo e($procedureCategory->title); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td class="border col-xl-3 p-1">
                                                    <select required name="procedure[]"
                                                        class="form-control form-control-sm choose-treatment-plan"
                                                        <?php echo e($isDisabled || $planProcedure->is_procedure_started == 'yes' ? 'disabled' : ''); ?>>
                                                        <option value="" disabled selected>Procedure</option>
                                                        <?php $__currentLoopData = $procedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($procedure->id); ?>"
                                                                <?php echo e($planProcedure->dd_procedure_id == $procedure->id ? 'selected' : ''); ?>>
                                                                <?php echo e($procedure->title); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td class="border p-1 col-xl-1 text-center"
                                                    style="vertical-align: middle;">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span
                                                            class="cost font-weight-bold mr-2"><?php echo e($planProcedure->procedure->price); ?></span>
                                                        <input type="checkbox" class="showPriceCheckbox"
                                                            data-id="<?php echo e($planProcedure->id); ?>"
                                                            <?php echo e($planProcedure->show_price ? 'checked' : ''); ?>>
                                                    </div>
                                                </td>
                                                <td class="border p-1 col-xl-5">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex flex-column mr-2">
                                                            <div class="form-check form-check-inline mb-0">
                                                                <input class="form-check-input check-input"
                                                                    type="checkbox"
                                                                    <?php echo e($planProcedure->ready_to_start == 'yes' ? 'checked' : ''); ?>

                                                                    <?php echo e($isDisabled || $planProcedure->ready_to_start == 'yes' ? 'disabled' : ''); ?>>
                                                                <label class="form-check-label small">Add</label>
                                                            </div>
                                                            <div class="form-check form-check-inline mb-0"
                                                                style="<?php echo e($planProcedure->ready_to_start == 'yes' ? '' : 'display:none;'); ?>">
                                                                <input class="form-check-input check-input-start"
                                                                    type="checkbox"
                                                                    <?php echo e($planProcedure->is_procedure_started == 'yes' ? 'checked' : ''); ?>

                                                                    <?php echo e($isDisabled || $planProcedure->is_procedure_started == 'yes' ? 'disabled' : ''); ?>>
                                                                <label class="form-check-label small">Start</label>
                                                            </div>
                                                            <div class="form-check form-check-inline mb-0"
                                                                style="<?php echo e($planProcedure->is_procedure_started == 'yes' ? '' : 'display:none;'); ?>">
                                                                <input class="form-check-input check-input-finished"
                                                                    type="checkbox"
                                                                    <?php echo e($planProcedure->is_procedure_finished == 'yes' ? 'checked' : ''); ?>

                                                                    <?php echo e($isDisabled || $planProcedure->is_procedure_finished == 'yes' ? 'disabled' : ''); ?>>
                                                                <label class="form-check-label small">Finish</label>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center action-buttons-container">
                                                            
                                                            <button type="button"
                                                                class="btn btn-sm btn-primary py-0 px-2 mr-1"
                                                                style="width: fit-content !important;" data-toggle="modal"
                                                                data-target="#declineModal_<?php echo e($tooth->tooth_number); ?>"
                                                                data-procedure-id="<?php echo e($planProcedure->id); ?>"
                                                                title="Add Notes">Add Notes</button>

                                                            <?php
                                                                $patientNotesCount = \App\Models\TreatmentPlanNotes::where(
                                                                    'patient_treatment_plan_id',
                                                                    $patientTreatmentPlan->id,
                                                                )
                                                                    ->where(
                                                                        'patient_treatment_plan_procedure_id',
                                                                        $planProcedure->id,
                                                                    )
                                                                    ->where('tooth_number', $tooth->tooth_number)
                                                                    ->count();
                                                            ?>
                                                            <?php if($patientNotesCount > 0): ?>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-secondary show-notes-btn py-0 px-2 mr-1"
                                                                    style="width: fit-content !important;"
                                                                    data-toggle="modal"
                                                                    data-target="#showModal<?php echo e($tooth->tooth_number); ?>"
                                                                    data-patient-plan-id="<?php echo e($patientTreatmentPlan->id); ?>"
                                                                    data-procedure-id="<?php echo e($planProcedure->id); ?>"
                                                                    title="Show Notes">Show Notes</button>
                                                            <?php endif; ?>

                                                            
                                                            <div class="modal fade model_add_notes"
                                                                id="declineModal_<?php echo e($tooth->tooth_number); ?>"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="declineModalLabel_<?php echo e($tooth->tooth_number); ?>"
                                                                aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="declineModalLabel_<?php echo e($tooth->tooth_number); ?>">
                                                                                Add notes for tooth
                                                                                <?php echo e($tooth->tooth_number); ?></h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close"><span
                                                                                    aria-hidden="true">×</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form method="POST"
                                                                                id="notesForm_<?php echo e($tooth->tooth_number); ?>"
                                                                                class="p-4 rounded bg-light submit_notes_form">
                                                                                <?php echo csrf_field(); ?>
                                                                                <div class="form-group mb-3">
                                                                                    <label
                                                                                        for="treatment_notes_<?php echo e($tooth->tooth_number); ?>"
                                                                                        class="form-label fw-bold">Write
                                                                                        notes for tooth
                                                                                        <?php echo e($tooth->tooth_number); ?> <i
                                                                                            class="bi bi-pencil-square ms-2"></i></label>
                                                                                    <textarea name="username" id="treatment_notes_<?php echo e($tooth->tooth_number); ?>" class="form-control" rows="4"
                                                                                        placeholder="Add notes here..."></textarea>
                                                                                </div>
                                                                                <input type="hidden"
                                                                                    name="patient_treatment_plan_id"
                                                                                    value="<?php echo e($patientTreatmentPlan->id); ?>">
                                                                                <input type="hidden" name="tooth_number"
                                                                                    value="<?php echo e($tooth->tooth_number); ?>">
                                                                                <input type="hidden"
                                                                                    name="plan_procedure_id"
                                                                                    class="procedure-id-input"
                                                                                    value="">
                                                                                <button type="submit" style="width: fit-content !important;"
                                                                                    class="btn btn-primary d-flex align-items-center justify-content-center"><i
                                                                                        class="bi bi-send me-2"></i>
                                                                                    Submit</button>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer"><button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal" style="width: fit-content !important;">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal fade show_treatment_notes"
                                                                id="showModal<?php echo e($tooth->tooth_number); ?>" tabindex="-1"
                                                                role="dialog" aria-labelledby="showModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="showModalLabel">
                                                                                Treatment plan
                                                                                notes for tooth
                                                                                <?php echo e($tooth->tooth_number); ?></h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close"><span
                                                                                    aria-hidden="true">×</span></button>
                                                                        </div>
                                                                        <div class="modal-body"
                                                                            style="height: 400px;overflow-y:scroll;">
                                                                            <table class="table notes-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">#</th>
                                                                                        <th scope="col">Notes</th>
                                                                                        <th scope="col">Notes Date
                                                                                            & Time</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="notes-data"></tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            

                                                            <button type="button"
                                                                class="btn btn-sm btn-success m-save py-0 px-2 mr-1"
                                                                <?php echo e($isDisabled ? 'disabled' : ''); ?>><i
                                                                    class="fas fa-save"></i></button>
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger m-remove py-0 px-2 mr-1"
                                                                <?php echo e($isDisabled ? 'disabled' : ''); ?>><i
                                                                    class="fas fa-trash"></i></button>
                                                            <button type="button"
                                                                class="btn btn-sm btn-info m-add py-0 px-2"><i
                                                                    class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr class="treatment-plan-inner-row" data-id="new-row">
                                            <td class="border col-xl-3 p-1">
                                                <select required name="procedure_category[]"
                                                    class="form-control form-control-sm choose-treatment-category">
                                                    <option value="" disabled selected>Category</option>
                                                    <?php $__currentLoopData = $procedureCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedureCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($procedureCategory->id); ?>">
                                                            <?php echo e($procedureCategory->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td class="border col-xl-3 p-1">
                                                <select required name="procedure[]"
                                                    class="form-control form-control-sm choose-treatment-plan">
                                                    <option value="" disabled selected>Procedure</option>
                                                    <!-- Options will be loaded dynamically via JavaScript -->
                                                </select>
                                            </td>
                                            <td class="border p-1 col-xl-1 text-center" style="vertical-align: middle;">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <span class="cost font-weight-bold mr-2"></span>
                                                    <input type="checkbox" class="showPriceCheckbox" value="1">
                                                </div>
                                            </td>
                                            <td class="border p-1 col-xl-5">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex flex-column mr-2">
                                                        <div class="form-check form-check-inline mb-0">
                                                            <input class="form-check-input check-input" type="checkbox">
                                                            <label class="form-check-label small">Add</label>
                                                        </div>
                                                        <div class="form-check form-check-inline mb-0"
                                                            style="display: none;">
                                                            <input class="form-check-input check-input-start"
                                                                type="checkbox">
                                                            <label class="form-check-label small">Start</label>
                                                        </div>
                                                        <div class="form-check form-check-inline mb-0"
                                                            style="display: none;">
                                                            <input class="form-check-input check-input-finished"
                                                                type="checkbox">
                                                            <label class="form-check-label small">Finish</label>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center action-buttons-container">
                                                        <button type="button"
                                                            class="btn btn-sm btn-success m-save py-0 px-2 mr-1"><i
                                                                class="fas fa-save"></i></button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger m-remove py-0 px-2 mr-1"
                                                            disabled><i class="fas fa-trash"></i></button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-info m-add py-0 px-2"><i
                                                                class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="row tooth-row d-none">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info d-flex align-items-center">
                    <img src="<?php echo e(asset('assets/images/teeth/18.png')); ?>" onerror="this.style.display='none'"
                        style="max-height: 30px; max-width: 30px; object-fit: contain; margin-right: 10px;">
                    <h3 class="card-title mb-0">Treatment Plan For All Teeth</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover border tooth-treatment" id="all-teeth-table">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="border">Procedure Category</th>
                                    <th class="border">Procedure</th>
                                    <th class="border">Cost</th>
                                    <th class="border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $allTeethProcedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planProcedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $isDisabled = $invoiceItems
                                            ->where('patient_treatment_plan_procedure_id', $planProcedure->id)
                                            ->isNotEmpty();
                                    ?>
                                    <tr class="treatment-plan-inner-row" data-id="<?php echo e($planProcedure->id); ?>">
                                        <td class="border col-xl-3 p-1">
                                            <select required name="procedure_category[]"
                                                class="form-control form-control-sm choose-treatment-category"
                                                <?php echo e($isDisabled || $planProcedure->is_procedure_started == 'yes' ? 'disabled' : ''); ?>>
                                                <option value="" disabled selected>Category</option>
                                                <?php $__currentLoopData = $procedureCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedureCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($procedureCategory->id); ?>"
                                                        <?php echo e($planProcedure->procedure->dd_procedure_id == $procedureCategory->id ? 'selected' : ''); ?>>
                                                        <?php echo e($procedureCategory->title); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                        <td class="border col-xl-3 p-1">
                                            <select required name="procedure[]"
                                                class="form-control form-control-sm choose-treatment-plan"
                                                <?php echo e($isDisabled || $planProcedure->is_procedure_started == 'yes' ? 'disabled' : ''); ?>>
                                                <option value="" disabled selected>Procedure</option>
                                                <?php $__currentLoopData = $procedures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($procedure->id); ?>"
                                                        <?php echo e($planProcedure->dd_procedure_id == $procedure->id ? 'selected' : ''); ?>>
                                                        <?php echo e($procedure->title); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                        <td class="border p-1 col-xl-1 text-center" style="vertical-align: middle;">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span
                                                    class="cost font-weight-bold mr-2"><?php echo e($planProcedure->procedure->price); ?></span>
                                                <input type="checkbox" class="showPriceCheckbox"
                                                    data-id="<?php echo e($planProcedure->id); ?>"
                                                    <?php echo e($planProcedure->show_price ? 'checked' : ''); ?>>
                                            </div>
                                        </td>
                                        <td class="border p-1 col-xl-5">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex flex-column mr-2">
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input check-input" type="checkbox"
                                                            <?php echo e($planProcedure->ready_to_start == 'yes' ? 'checked' : ''); ?>

                                                            <?php echo e($isDisabled || $planProcedure->ready_to_start == 'yes' ? 'disabled' : ''); ?>>
                                                        <label class="form-check-label small">Add</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input check-input-start" type="checkbox"
                                                            <?php echo e($planProcedure->is_procedure_started == 'yes' ? 'checked' : ''); ?>

                                                            <?php echo e($isDisabled || $planProcedure->is_procedure_started == 'yes' ? 'disabled' : ''); ?>>
                                                        <label class="form-check-label small">Start</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-0"
                                                        style="<?php echo e($planProcedure->is_procedure_started == 'yes' ? '' : 'display:none;'); ?>">
                                                        <input class="form-check-input check-input-finished"
                                                            type="checkbox"
                                                            <?php echo e($planProcedure->is_procedure_finished == 'yes' ? 'checked' : ''); ?>

                                                            <?php echo e($isDisabled || $planProcedure->is_procedure_finished == 'yes' ? 'disabled' : ''); ?>>
                                                        <label class="form-check-label small">Finish</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center action-buttons-container">
                                                    
                                                    <button type="button" class="btn btn-sm btn-primary py-0 px-2 mr-1"
                                                        style="width: fit-content !important;" data-toggle="modal"
                                                        data-target="#declineModal_null"
                                                        data-procedure-id="<?php echo e($planProcedure->id); ?>"
                                                        title="Add Notes">Add Notes</button>

                                                    <?php
                                                        $patientNotesCount = \App\Models\TreatmentPlanNotes::where(
                                                            'patient_treatment_plan_id',
                                                            $patientTreatmentPlan->id,
                                                        )
                                                            ->where(
                                                                'patient_treatment_plan_procedure_id',
                                                                $planProcedure->id,
                                                            )
                                                            ->where(function ($query) {
                                                                $query
                                                                    ->whereNull('tooth_number')
                                                                    ->orWhere('tooth_number', '');
                                                            })
                                                            ->count();
                                                    ?>
                                                    <?php if($patientNotesCount > 0): ?>
                                                        <button type="button"
                                                            class="btn btn-sm btn-secondary show-notes-btn py-0 px-2 mr-1"
                                                            style="width: fit-content !important;" data-toggle="modal"
                                                            data-target="#showModal_null"
                                                            data-patient-plan-id="<?php echo e($patientTreatmentPlan->id); ?>"
                                                            data-procedure-id="<?php echo e($planProcedure->id); ?>"
                                                            title="Show Notes">Show Notes</button>
                                                    <?php endif; ?>

                                                    
                                                    <div class="modal fade model_add_notes" id="declineModal_null"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="declineModalLabel_null" aria-hidden="true"
                                                        style="display: none;">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="declineModalLabel_null">
                                                                        Add notes for All
                                                                        Teeth</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close"><span
                                                                            aria-hidden="true">×</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" id="notesForm_null"
                                                                        class="p-4 rounded bg-light submit_notes_form">
                                                                        <?php echo csrf_field(); ?>
                                                                        <div class="form-group mb-3">
                                                                            <label for="treatment_notes_null"
                                                                                class="form-label fw-bold">Write notes
                                                                                <i
                                                                                    class="bi bi-pencil-square ms-2"></i></label>
                                                                            <textarea name="username" id="treatment_notes_null" class="form-control" rows="4"
                                                                                placeholder="Add notes here..."></textarea>
                                                                        </div>
                                                                        <input type="hidden"
                                                                            name="patient_treatment_plan_id"
                                                                            value="<?php echo e($patientTreatmentPlan->id); ?>">
                                                                        <input type="hidden" name="tooth_number"
                                                                            value="">
                                                                        <input type="hidden" name="plan_procedure_id"
                                                                            class="procedure-id-input" value="">
                                                                        <button type="submit"
                                                                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center"><i
                                                                                class="bi bi-send me-2"></i>
                                                                            Submit</button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer"><button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade show_treatment_notes" id="showModal_null"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="showModalLabel_null" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="showModalLabel_null">
                                                                        Treatment plan notes
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close"><span
                                                                            aria-hidden="true">×</span></button>
                                                                </div>
                                                                <div class="modal-body"
                                                                    style="height: 400px;overflow-y:scroll;">
                                                                    <table class="table notes-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Notes</th>
                                                                                <th scope="col">Notes Date & Time
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="notes-data"></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button"
                                                        class="btn btn-sm btn-success m-save py-0 px-2 mr-1"
                                                        <?php echo e($isDisabled ? 'disabled' : ''); ?>><i
                                                            class="fas fa-save"></i></button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger m-remove py-0 px-2 mr-1"
                                                        <?php echo e($isDisabled ? 'disabled' : ''); ?>><i
                                                            class="fas fa-trash"></i></button>
                                                    <button type="button" class="btn btn-sm btn-info m-add py-0 px-2"><i
                                                            class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- Option to add a new row if no procedures exist -->
                                <?php if($allTeethProcedures->isEmpty()): ?>
                                    <tr class="treatment-plan-inner-row" data-id="new-row">
                                        <td class="border col-xl-3 p-1">
                                            <select required name="procedure_category[]"
                                                class="form-control form-control-sm choose-treatment-category">
                                                <option value="" disabled selected>Category</option>
                                                <?php $__currentLoopData = $procedureCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $procedureCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($procedureCategory->id); ?>">
                                                        <?php echo e($procedureCategory->title); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                        <td class="border col-xl-3 p-1">
                                            <select required name="procedure[]"
                                                class="form-control form-control-sm choose-treatment-plan">
                                                <option value="" disabled selected>Procedure</option>
                                                <!-- Add options dynamically via JavaScript if needed -->
                                            </select>
                                        </td>
                                        <td class="border p-1 col-xl-1 text-center" style="vertical-align: middle;">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="cost font-weight-bold mr-2"></span>
                                                <input type="checkbox" class="showPriceCheckbox" value="1">
                                            </div>
                                        </td>
                                        <td class="border p-1 col-xl-5">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex flex-column mr-2">
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input check-input" type="checkbox">
                                                        <label class="form-check-label small">Add</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input check-input-start" type="checkbox"
                                                            style="display: none;">
                                                        <label class="form-check-label small"
                                                            style="display: none;">Start</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input check-input-finished"
                                                            type="checkbox" style="display: none;">
                                                        <label class="form-check-label small"
                                                            style="display: none;">Finish</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <button type="button"
                                                        class="btn btn-sm btn-success m-save py-0 px-2 mr-1"><i
                                                            class="fas fa-save"></i></button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger m-remove py-0 px-2 mr-1" disabled><i
                                                            class="fas fa-trash"></i></button>
                                                    <button type="button" class="btn btn-sm btn-info m-add py-0 px-2"><i
                                                            class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

        });
    </script>



    <script>
        // $(document).ready(function() {
        //     // Initially show or hide the buttons based on the checkbox state
        //     if ($('#startProcedureCheckbox').is(':checked')) {
        //         $('#notesButtons').removeClass('d-none');
        //     }

        //     // Toggle visibility on checkbox change
        //     $('#startProcedureCheckbox').on('change', function() {
        //         if ($(this).is(':checked')) {
        //             $('#notesButtons').removeClass('d-none');
        //         } else {
        //             $('#notesButtons').addClass('d-none');
        //         }
        //     });
        // });
    </script>


    <script>
        $(document).ready(function() {
            $('.container-fluid').on('change', '.choose-treatment-category', function() {
                var procedureCategory = $(this).val();
                // alert(procedureCategory)
                var $currentRow = $(this).closest('.treatment-plan-inner-row'); // Find the closest row

                // Perform AJAX request
                $.ajax({
                    url: '<?php echo e(route('fetch.procedure')); ?>',
                    type: 'GET',
                    data: {
                        procedure_category: procedureCategory
                    },
                    success: function(data) {
                        var ddprocedures = data.ddprocedures;
                        var options =
                            '<option value="" disabled selected>Select Any Procedure</option>';

                        // Build options for the select in the current row
                        $.each(ddprocedures, function(index, ddprocedure) {
                            options += '<option value="' + ddprocedure.id + '">' +
                                ddprocedure.title + '</option>';
                        });

                        // Update the select element in the current row
                        $currentRow.find('.choose-treatment-plan').html(options);
                    },
                    error: function() {
                        alert('Failed to fetch procedures. Please try again.');
                    }
                });
            });

            $('.container-fluid').on('change', '.choose-treatment-plan', function() {
                var treatmentPlanId = $(this).val();
                var $currentRow = $(this).closest('.treatment-plan-inner-row'); // Find the closest row

                // Perform AJAX request to get price and description
                $.ajax({
                    url: '<?php echo e(route('fetch.treatmentDetails')); ?>',
                    type: 'GET',
                    data: {
                        treatment_plan_id: treatmentPlanId
                    },
                    success: function(data) {
                        console.log(data); // Log the response data for debugging

                        if (data.treatmentPlan) {
                            var treatmentPlan = data.treatmentPlan;

                            // Debugging to ensure correct data and correct field selection
                            console.log('Cost:', treatmentPlan.price);
                            console.log('description:', treatmentPlan.description);

                            // Update the cost input and any other relevant fields in the current row
                            $currentRow.find('span.cost').text(treatmentPlan.price);
                        } else {
                            console.error('treatmentPlan not found in response:', data);
                        }
                    },
                    error: function() {
                        alert('Failed to fetch treatment details. Please try again.');
                    }
                });
            });

            // update checkbox ajax

            $('.container-fluid').on('change', '#showPriceCheckbox', function() {
                var isChecked = $(this).is(':checked') ? 1 : 0;
                // alert(isChecked);
                var recordId = $(this).data('id');

                $.ajax({
                    url: '<?php echo e(route('updateShowPrice')); ?>',
                    method: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: recordId,
                        show_price: isChecked
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Update successful!');
                        } else {
                            alert('Update failed!');
                        }
                    },
                    error: function() {
                        alert('An error occurred.');
                    }
                });
            });

            // update checkbox ajax

            // $('.card').on("click", ".m-add", function () {
            $(document).on("click", ".m-add", function() {
                var $row = $(this).closest('.treatment-plan-inner-row');
                let rowTreatmentPlan = $row.closest(".table.tooth-treatment").find("tbody tr:first")
                    .clone();

                // Clear all values and states
                rowTreatmentPlan.find('select').val('');
                rowTreatmentPlan.find('.cost').text('');
                rowTreatmentPlan.find('input[type="checkbox"]').prop('checked', false);
                rowTreatmentPlan.find('input[type="checkbox"]').prop('disabled', false);
                rowTreatmentPlan.find('select').prop('disabled', false);
                rowTreatmentPlan.find('button').prop('disabled', false);
                rowTreatmentPlan.find('input[type="hidden"]').val('');

                // Hide procedure checkboxes initially
                rowTreatmentPlan.find('.check-input').parent().show();
                rowTreatmentPlan.find('.check-input-start').parent().hide();
                rowTreatmentPlan.find('.check-input-finished').parent().hide();

                // Remove all modal-related elements and buttons
                rowTreatmentPlan.find('#notesButtons').remove();
                rowTreatmentPlan.find('.show_treatment_notes').remove();
                rowTreatmentPlan.find('.model_add_notes').remove();
                rowTreatmentPlan.find('[data-toggle="modal"]').remove();

                // Create new row and append it
                $row.closest(".table.tooth-treatment").find("tbody").append(
                    '<tr class="treatment-plan-inner-row">' + rowTreatmentPlan.html() + '</tr>'
                );

                // Clear values in the new row
                let $newRow = $row.closest(".table.tooth-treatment").find("tbody tr:last");
                $newRow.find('select').val('');
                $newRow.find('.cost').text('');
                $newRow.find('input[type="checkbox"]').prop('checked', false);

                // Enable delete buttons for all rows if there are multiple rows
                var $tbody = $row.closest(".table.tooth-treatment").find("tbody");
                if ($tbody.find("tr").length > 1) {
                    $tbody.find("tr").each(function() {
                        // Only enable if it's not explicitly disabled by server (checked via having a data-id that isn't 'new-row' implied logic, 
                        // but simpler: just enable 'new-row' ones or ones that were disabled solely due to being single)
                        // Actually, for now, let's enable all .m-remove that are disabled, 
                        // BUT ideally we should respect $isDisabled. 
                        // Since $isDisabled is rendered by PHP, client-side we can check if it's a 'new-row' OR if we want to risk enabling locked ones.
                        // Safe bet: Enable remove button for rows that are 'new-row' OR if we can determine they aren't locked.
                        // Given the user request "why first row delete button is also disabled", they are likely in the "new-row" scenario.

                        var $tr = $(this);
                        // If it's a new row, always enable
                        if ($tr.data('id') === 'new-row' || !$tr.data('id')) {
                            $tr.find('.m-remove').prop('disabled', false);
                        }
                    });
                }
            });

            $(document).on("click", ".m-save", function() {
                var $row = $(this).closest('.treatment-plan-inner-row');
                var dataId = $row.data('id') ?? ''; // Get the data-id attribute
                console.log('Data ID:', dataId); // Log the data-id for debugging
                var procedureCategory = $row.find('.choose-treatment-category').val();
                var procedure = $row.find('.choose-treatment-plan').val();
                var proceduerID = $row.find('#cproceduerID').val();
                var ready_to_start = $row.find('.check-input').is(':checked') ? 'yes' : 'no';
                var is_procedure_started = $row.find('.check-input-start').is(':checked') ? 'yes' : 'no';
                var is_procedure_finished = $row.find('.check-input-finished').is(':checked') ? 'yes' :
                    'no';
                var toothNumber = $row.closest('.card').data('tooth-number');
                var treatmentPlanId = $('input[name="treatment_plan_id"]').val();
                var allTeeth = $row.closest('table').attr('id') === 'all-teeth-table' ? 'yes' : 'no';
                if (allTeeth == 'yes') {
                    toothNumber = null;
                }
                if (!procedureCategory || !procedure) {
                    alert('Either Category Or Procedure is not selected!');
                    return;
                }
                // console.log($row);

                $.ajax({
                    url: '<?php echo e(route('patient-treatment-plan-procedures.store')); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        treatment_plan_id: treatmentPlanId,
                        data_id: dataId,
                        tooth_number: toothNumber,
                        procedure: procedure,
                        proceduerID: proceduerID,
                        ready_to_start: ready_to_start,
                        is_procedure_started: is_procedure_started,
                        is_procedure_finished: is_procedure_finished,
                        all_teeth: allTeeth
                    },
                    success: function(response) {
                        console.log(response.planProcedure.id); // Log the new procedure ID

                        // Update the row's data-id attribute with the new ID

                        // Handle the response, update the UI accordingly
                        updateRowUI($row, response.planProcedure);

                        if (false) { // Code moved to updateRowUI
                            // dataId == response.planProcedure.id || dataId == 'new-row' || !dataId
                            // If the row is new or being updated, set the data-id attribute

                            // Always add/update notes button for saved record
                            if (true) {


                                // Remove any existing "Add Notes" button for this procedure
                                $row.find('.action-buttons-container').find(
                                    'button[data-procedure-id="' + response.planProcedure
                                    .id + '"]').remove();

                                // Create a new "Add Notes" button with the correct data
                                var notesButton = `
                            <button type="button" class="btn btn-sm btn-primary py-0 px-2 mr-1"
                                style="width: fit-content !important;"
                                data-toggle="modal"
                                data-target="#declineModal_${toothNumber}"
                                data-procedure-id="${response.planProcedure.id}" title="Add Notes">
                                Add Notes
                            </button>`;

                                // Append the button to the correct column
                                var $notesButtonsDiv = $row.find('.action-buttons-container')
                                    .first();
                                if ($notesButtonsDiv.length === 0) {
                                    $row.find('.treatment-plan-edit-action-tab-list').append(
                                        '<div class="col-6 action-buttons-container" id="notesButtons"></div>'
                                    );
                                    $notesButtonsDiv = $row.find('.action-buttons-container')
                                        .first();
                                }
                                $notesButtonsDiv.prepend(notesButton);

                                // Check if the modal exists; if not, dynamically create it
                                if (!document.querySelector(`#declineModal_${toothNumber}`)) {
                                    var modalHtml = `
                                <div class="modal fade model_add_notes" id="declineModal_${toothNumber}" tabindex="-1"
                                    role="dialog" aria-labelledby="declineModalLabel_${toothNumber}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="declineModalLabel_${toothNumber}">Add notes for tooth ${toothNumber}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" id="notesForm_${toothNumber}" class="p-4 rounded bg-light submit_notes_form">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="form-group mb-3">
                                                        <label for="treatment_notes_${toothNumber}" class="form-label fw-bold">Write notes for tooth ${toothNumber}
                                                            <i class="bi bi-pencil-square ms-2"></i>
                                                        </label>
                                                        <textarea name="username" id="treatment_notes_${toothNumber}" class="form-control" rows="4"
                                                            placeholder="Add notes here..."></textarea>
                                                    </div>
                                                    <input type="hidden" name="patient_treatment_plan_id" value="<?php echo e($patientTreatmentPlan->id); ?>">
                                                    <input type="hidden" name="tooth_number" value="${toothNumber}">
                                                    <input type="hidden" name="plan_procedure_id" class="procedure-id-input" value="">
                                                    <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-send me-2"></i> Submit
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                    $('body').append(modalHtml);
                                }

                                // else {
                                //     var showNotesButton = `
                            //         <button style="width:107px !important;" type="button"
                            //             class="btn btn-sm btn-secondary show-notes-btn"
                            //             data-toggle="modal"
                            //             data-target="#showModal${toothNumber}"
                            //             data-procedure-id="${procedureId}"
                            //             data-patient-plan-id="${patientPlanId}">
                            //             Show Notes
                            //         </button>`;

                                //         $notesButtonsDiv.append(showNotesButton);
                            }
                        }

                        alert('Record saved successfully.');
                        response = {}; // Make response empty
                    },
                    error: function(xhr, status, error) {
                        var response = JSON.parse(xhr.responseText);
                        if (xhr.status === 403) {
                            alert(response.message);
                        } else {
                            alert('Failed to save the record! Please try again.');
                        }
                    }
                });
            });

            function updateRowUI($row, planProcedure) {
                var $checkInput = $row.find('.check-input');
                var $checkInputStart = $row.find('.check-input-start');
                var $checkInputFinished = $row.find('.check-input-finished');
                var $dropdowns = $row.find('.choose-treatment-category, .choose-treatment-plan');
                var $saveButton = $row.find('.m-save');
                var $deleteButton = $row.find('.m-remove');

                // Update the data-id attribute with the new planProcedure ID
                $row.attr('data-id', planProcedure.id);

                // Reset all elements initially
                $checkInput.prop('checked', false).prop('disabled', false);
                $checkInputStart.prop('checked', false).prop('disabled', false);
                $checkInputFinished.prop('checked', false).prop('disabled', false);
                $dropdowns.prop('disabled', false);
                $saveButton.prop('disabled', false);
                $deleteButton.prop('disabled', false);
                $('#print-all-plan').css('display', 'block');

                // Logic for "Add Notes" Button
                if (planProcedure.id) {
                    // Remove any existing "Add Notes" button for this procedure to avoid duplicates
                    $row.find('.action-buttons-container').find('button[data-procedure-id="' + planProcedure.id +
                        '"]').remove();

                    var toothNumber = $row.closest('.card').data('tooth-number') ||
                        'null'; // Handle 'null' for all-teeth

                    // Create a new "Add Notes" button
                    var notesButton = `
                        <button type="button" class="btn btn-sm btn-primary py-0 px-2 mr-1"
                            style="width: fit-content !important;"
                            data-toggle="modal"
                            data-target="#declineModal_${toothNumber}"
                            data-procedure-id="${planProcedure.id}" title="Add Notes">
                            Add Notes
                        </button>`;

                    // Append the button to the correct column
                    var $notesButtonsDiv = $row.find('.action-buttons-container').first();
                    if ($notesButtonsDiv.length === 0) {
                        $row.find('.treatment-plan-edit-action-tab-list').append(
                            '<div class="col-6 action-buttons-container" id="notesButtons"></div>'
                        );
                        $notesButtonsDiv = $row.find('.action-buttons-container').first();
                    }
                    $notesButtonsDiv.prepend(notesButton);

                    // Check if the modal exists; if not, dynamically create it
                    if (!document.querySelector(`#declineModal_${toothNumber}`)) {
                        var modalHtml = `
                                <div class="modal fade model_add_notes" id="declineModal_${toothNumber}" tabindex="-1"
                                    role="dialog" aria-labelledby="declineModalLabel_${toothNumber}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="declineModalLabel_${toothNumber}">Add notes for tooth ${toothNumber == 'null' ? 'All' : toothNumber}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" id="notesForm_${toothNumber}" class="p-4 rounded bg-light submit_notes_form">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="form-group mb-3">
                                                        <label for="treatment_notes_${toothNumber}" class="form-label fw-bold">Write notes <i class="bi bi-pencil-square ms-2"></i></label>
                                                        <textarea name="username" id="treatment_notes_${toothNumber}" class="form-control" rows="4" placeholder="Add notes here..."></textarea>
                                                    </div>
                                                    <input type="hidden" name="patient_treatment_plan_id" value="<?php echo e($patientTreatmentPlan->id); ?>">
                                                    <input type="hidden" name="tooth_number" value="${toothNumber == 'null' ? '' : toothNumber}">
                                                    <input type="hidden" name="plan_procedure_id" class="procedure-id-input" value="">
                                                    <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-send me-2"></i> Submit
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        $('body').append(modalHtml);
                    }
                }


                // Show or hide checkboxes based on `planProcedure` data
                if (planProcedure.ready_to_start === 'yes') {
                    $checkInput.prop('checked', true).prop('disabled', true);
                    $checkInputStart.closest('div').show(); // Show "Start Procedure" if ready to start
                    $('#print-ready-to-procedure').css('display', 'block');
                    if (planProcedure.is_procedure_started === 'yes') {
                        $checkInputStart.prop('checked', true).prop('disabled', true);
                        $dropdowns.prop('disabled', true);

                        $checkInputFinished.closest('div').show(); // Show "Procedure Finished" if procedure started
                        if (planProcedure.is_procedure_finished === 'yes') {
                            $checkInputFinished.prop('checked', true).prop('disabled', true);
                            $saveButton.prop('disabled', true);
                            $deleteButton.prop('disabled', true);
                            $('#generate-invoice').css('display', 'block');

                        } else {
                            $checkInputFinished.prop('checked', false).prop('disabled', false);
                        }
                    } else {
                        $checkInputStart.prop('checked', false).prop('disabled', false);
                        $checkInputFinished.closest('div').hide();
                    }
                } else {
                    $checkInput.prop('checked', false).prop('disabled', false);
                    $checkInputStart.closest('div').hide();
                    $checkInputFinished.closest('div').hide();
                }
            }



            $(document).on("click", ".m-remove", function() {
                if (!confirm("Are you sure you want to delete this?")) {
                    return;
                }
                var $row = $(this).closest('.treatment-plan-inner-row');
                var $tbody = $row.closest('tbody');
                var planProcedureId = $row.attr('data-id'); // Get planProcedure ID from data attribute

                if (planProcedureId === 'new-row' || !planProcedureId) {
                    // If it's a new row (not saved yet), just remove it from the DOM
                    $row.remove();

                    // If only one row remains and it's a 'new-row', disable its delete button
                    if ($tbody.find('tr').length === 1) {
                        var $lastRow = $tbody.find('tr');
                        if ($lastRow.data('id') === 'new-row' || !$lastRow.data('id')) {
                            $lastRow.find('.m-remove').prop('disabled', true);
                        }
                    }
                    return;
                }

                if ($tbody.find('tr').length == 1 && $tbody.find('tr').attr('data-id') != 'new-row') {
                    // alert('You can\'t delete this record!');
                    // return 0;
                }

                $.ajax({
                    url: '<?php echo e(url('patient-treatment-plan-procedures')); ?>/' + planProcedureId,
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        _method: 'DELETE',
                    },
                    success: function(response) {
                        alert('Deleted successfully.');
                        $row.remove();
                        // If only one row remains and it's a 'new-row', disable its delete button (unlikely case for saved records but possible if mixed)
                        if ($tbody.find('tr').length === 1) {
                            var $lastRow = $tbody.find('tr');
                            if ($lastRow.data('id') === 'new-row' || !$lastRow.data('id')) {
                                $lastRow.find('.m-remove').prop('disabled', true);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 403) {
                            alert(
                                'Record cannot be deleted as it is associated with an invoice item.'
                            );
                        } else if (xhr.status === 404) {
                            alert('Record not found!');
                        } else {
                            alert('Failed to delete the record! Please try again.');
                        }
                    }
                });
            });

            $('#generate-invoice').click(function(e) {
                e.preventDefault();
                var treatmentPlanId = $('[name="treatment_plan_id"]').val();
                var url = "<?php echo e(route('auto-invoices.create')); ?>";
                url += "?treatment_plan_id=" + treatmentPlanId;
                window.location.href = url;
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            // Use a class selector to target all forms with the class 'submit_notes_form'
            $(document).off('submit', '.submit_notes_form').on('submit', '.submit_notes_form', function(e) {
                e.preventDefault();

                var $form = $(this);
                var $submitButton = $form.find('button[type="submit"]');

                // Disable the submit button while processing
                $submitButton.prop('disabled', true);

                var formData = $form.serialize(); // Serialize the form data

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(url('treatmentnotes')); ?>",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log("Server response:",
                            response); // Log the entire response for debugging

                        if (response.success) {
                            $('#declineModal_' + response.tooth_number).modal(
                                'hide'); // Hide the modal
                            alert('Form submitted successfully!');
                            $form[0].reset(); // Reset the form

                            // Dynamically show the "Show Notes" button
                            var procedureId = response
                                .procedure_id; // Get the procedure ID from the response
                            var patientPlanId = response
                                .patient_treatment_plan_id; // Get the patient plan ID from the response
                            var toothNumber = response
                                .tooth_number; // Get the tooth number from the response

                            if (!procedureId) {
                                console.error(
                                    "Procedure ID is undefined. Check the server response.");
                                return;
                            }

                            var $row = $(`[data-procedure-id="${procedureId}"]`).closest(
                                '.treatment-plan-inner-row');

                            // Debugging: Log the row to ensure it's being targeted correctly
                            console.log("Targeted row for procedure ID:", procedureId, $row);

                            // Check if the "Show Notes" button already exists
                            if ($row.find(`.show-notes-btn[data-procedure-id="${procedureId}"]`)
                                .length === 0) {
                                var showNotesButton = `
                                <button style="width: fit-content !important;" type="button"
                                    class="btn btn-sm btn-secondary show-notes-btn"
                                    data-toggle="modal"
                                    data-target="#showModal${toothNumber}"
                                    data-procedure-id="${procedureId}"
                                    data-patient-plan-id="${patientPlanId}">
                                    Show Notes
                                </button>`;

                                // Append the "Show Notes" button
                                $row.find(
                                    '.treatment-plan-edit-action-tab-list .col-6:nth-child(2)'
                                ).append(showNotesButton);
                                // Create the show notes modal if it doesn't exist
                                if ($('#showModal' + toothNumber).length === 0) {
                                    var showModalHtml = `
                        <div class="modal fade show_treatment_notes" id="showModal${toothNumber}"
                            data-procedure-id="${procedureId}" tabindex="-1"
                            aria-labelledby="showModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="showModalLabel">
                                            Treatment plan notes for tooth ${toothNumber}</h5>
                                        <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="height: 400px;overflow-y:scroll;">
                                        <table class="table notes-table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Notes</th>
                                                    <th scope="col">Notes Date & Time</th>
                                                </tr>
                                            </thead>
                                            <tbody class="notes-data">
                                                <!-- Notes will be loaded here via AJAX -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                                    $('body').append(showModalHtml);
                                }
                                // Debugging: Log after appending the button
                                console.log("Show Notes button appended for procedure ID:",
                                    procedureId);
                            } else {
                                console.log(
                                    "Show Notes button already exists for procedure ID:",
                                    procedureId);
                            }
                        } else {
                            alert('Failed to submit the form.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    },
                    complete: function() {
                        // Re-enable the submit button whether the request succeeded or failed
                        $submitButton.prop('disabled', false);
                    }
                });
            });

            // Use event delegation to handle dynamically added "Show Notes" buttons
            $(document).on('click', '.show-notes-btn', function(e) {
                e.preventDefault(); // Prevent default behavior if needed
                console.log('Show Notes button clicked. No additional AJAX triggered.');
                // Add any additional logic here if required
            });
        });

        $(document).on('show.bs.modal', '.show_treatment_notes', function(e) {
            var toothNumber = $(this).attr('id').replace('showModal', '');
            // Ensure we're only showing notes for the current tooth
            $(this).find('tbody tr.treatment-plan-inner-row').remove();

        });


        // Use event delegation to handle dynamically added "Add Notes" buttons
        $(document).on('click', '.btn-primary[data-toggle="modal"]', function() {
            var procedureId = $(this).data('procedure-id'); // Get the procedure ID from the button
            console.log('Button clicked ' + procedureId);

            var modalId = $(this).data('target'); // Get the target modal ID
            var modal = $(modalId); // Select the modal

            if (modal.length) {
                var input = modal.find('input[name="plan_procedure_id"]'); // Find the hidden input in the modal
                if (input.length) {
                    input.val(procedureId); // Set the procedure ID in the hidden input
                }
            }
        });

        $(document).ready(function() {
            // Use event delegation to handle dynamically added "Show Notes" buttons
            $(document).on('click', '.show-notes-btn', function(e) {
                e.preventDefault(); // Prevent default behavior

                var procedureId = $(this).data('procedure-id');
                var procedurePlanId = $(this).data('patient-plan-id');
                var modalId = $(this).data('target');
                var $modal = $(modalId);

                // Clear existing notes in the modal
                $modal.find('.notes-data').empty();

                // Fetch notes via AJAX
                $.ajax({
                    url: '<?php echo e(route('treatment.notes')); ?>',
                    type: 'GET',
                    data: {
                        procedure_id: procedureId,
                        procedure_plan_id: procedurePlanId
                    },
                    success: function(response) {
                        var tbody = $modal.find('.notes-data');
                        var counter = 1;

                        // Populate notes in the modal
                        response.notes.forEach(function(note) {
                            var row = `<tr>
                        <td>${counter++}</td>
                        <td>${note.username}</td>
                        <td>${note.datetime}</td>
                    </tr>`;
                            tbody.append(row);
                        });

                        if (response.notes.length === 0) {
                            tbody.append(
                                '<tr><td colspan="3" class="text-center">No notes found</td></tr>'
                            );
                        }

                        // Show the modal after data is loaded
                        $modal.modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching notes:', error);
                        $modal.find('.notes-data').html(
                            '<tr><td colspan="3" class="text-center">Error loading notes</td></tr>'
                        );
                        $modal.modal('show'); // Show the modal even if there's an error
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 05-Feb-2026\resources\views/patient-treatment-plans/edit.blade.php ENDPATH**/ ?>