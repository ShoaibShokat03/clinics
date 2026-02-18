<?php $__env->startSection('content'); ?>
    <style>
        /* Compact Layout Styling */
        .info-table {
            width: 100%;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6 !important;
            border-radius: 4px;
        }

        .info-table td {
            border: none !important;
            text-align: left !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            width: 33.33%;
        }

        .clinic-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 15px;
        }

        .clinic-logo-box {
            flex: 0 0 150px;
        }

        .clinic-logo {
            max-width: 100%;
            height: auto;
            max-height: 80px;
            object-fit: contain;
        }

        .clinic-info {
            text-align: right;
            flex: 1;
        }

        .clinic-info h4 {
            font-size: 24px;
            font-weight: 800;
            margin: 0 0 5px 0;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .clinic-info p {
            margin: 0;
            color: #555;
            line-height: 1.4;
            font-size: 13px;
        }

        .content-compact {
            font-size: 14px;
        }

        .content-compact label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        /* Print Logic */
        #print-area * {
            font-size: {
                    {
                    $pageSettings['font_size'] ?? 14
                }
            }

            px;
        }

        @media  print {
            @page  {
                margin: 0;
                size: auto;
            }

            body {
                background: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .no-print,
            .main-header,
            .main-sidebar,
            .content-header,
            .card-header,
            .btn,
            footer {
                display: none !important;
            }

            .content-wrapper,
            .card,
            .card-body {
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                box-shadow: none !important;
            }

            #appointment-container {
                margin-top: {
                        {
                        $pageSettings['margin_top'] ?? 0
                    }
                }

                mm !important;

                margin-left: {
                        {
                        $pageSettings['margin_left'] ?? 0
                    }
                }

                mm !important;
                display: block !important;
                width: 100% !important;
            }

            #companyInfoBox {
                display: {
                        {
                        ($pageSettings['show_header'] ?? true) ? 'flex': 'none'
                    }
                }

                !important;
            }
        }
    </style>

    <section class="content-header no-print">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Appointment View'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-outline-secondary btn-sm mr-1" type="button" data-toggle="collapse"
                        data-target="#printSettings" aria-expanded="false">
                        <i class="fas fa-cog"></i> <?php echo app('translator')->get('Print Settings'); ?>
                    </button>
                    <a href="<?php echo e(route('patient-appointments.index')); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to List'); ?>
                    </a>
                    <button id="doPrint" class="btn btn-secondary btn-sm ml-2">
                        <i class="fas fa-print"></i> <?php echo app('translator')->get('Print'); ?>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="row no-print">
        <div class="col-12">
            <div class="collapse mb-3 border rounded p-4 bg-light shadow-sm" id="printSettings">
                <div class="d-flex align-items-center mb-4">
                    <i class="fas fa-sliders-h text-primary mr-2"></i>
                    <h5 class="mb-0 font-weight-bold"><?php echo app('translator')->get('Customize Print Layout'); ?></h5>
                    <small class="text-muted ml-3">(<?php echo app('translator')->get('Changes apply to all users'); ?>)</small>
                </div>
                <div class="row align-items-end">
                    <div class="col-md-2">
                        <div class="form-group mb-0">
                            <label class="small text-muted font-weight-bold mb-2 d-block"><?php echo app('translator')->get('HEADER'); ?></label>
                            <div class="custom-control custom-switch custom-switch-lg">
                                <input type="checkbox" class="custom-control-input" id="showHeader"
                                    <?php echo e($pageSettings['show_header'] ?? true ? 'checked' : ''); ?>>
                                <label class="custom-control-label font-weight-normal"
                                    for="showHeader"><?php echo app('translator')->get('Show'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-0">
                            <label class="small text-muted font-weight-bold mb-2 d-block"><?php echo app('translator')->get('FONT SIZE (PX)'); ?></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                </div>
                                <input type="number" id="fontSize" class="form-control"
                                    value="<?php echo e($pageSettings['font_size'] ?? 14); ?>" placeholder="14">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label class="small text-muted font-weight-bold mb-2 d-block"><?php echo app('translator')->get('TOP MARGIN (MM)'); ?></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-arrows-alt-v"></i></span>
                                </div>
                                <input type="number" id="marginTop" class="form-control"
                                    value="<?php echo e($pageSettings['margin_top'] ?? 0); ?>" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label class="small text-muted font-weight-bold mb-2 d-block"><?php echo app('translator')->get('LEFT MARGIN (MM)'); ?></label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-arrows-alt-h"></i></span>
                                </div>
                                <input type="number" id="marginLeft" class="form-control"
                                    value="<?php echo e($pageSettings['margin_left'] ?? 0); ?>" placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-sm btn-block shadow-sm" id="saveSettings">
                            <i class="fas fa-save mr-1"></i> <?php echo app('translator')->get('Save'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div id="print-area" class="card-body">
                    <?php
                        $showHeaderSetting = isset($pageSettings['show_header'])
                            ? $pageSettings['show_header'] === true ||
                                $pageSettings['show_header'] === 'true' ||
                                $pageSettings['show_header'] === 1 ||
                                $pageSettings['show_header'] === '1'
                            : true;
                        $marginTop = $pageSettings['margin_top'] ?? 0;
                        $marginLeft = $pageSettings['margin_left'] ?? 0;
                    ?>
                    <div class="appointment-layout" id="appointment-container"
                        style="padding-top: <?php echo e($marginTop); ?>mm !important; padding-left: <?php echo e($marginLeft); ?>mm !important;">

                        <!-- clinic Header -->
                        <div id="companyInfoBox" class="clinic-header <?php echo e($showHeaderSetting ? '' : 'd-none'); ?>">
                            <div class="clinic-logo-box">
                                <?php if(isset($applicationSettings[0]['logo']) && !empty($applicationSettings[0]['logo'])): ?>
                                    <img src="<?php echo e(asset('public/' . $applicationSettings[0]['logo'])); ?>" alt="Logo"
                                        class="clinic-logo">
                                <?php else: ?>
                                    <div class="p-3 bg-light rounded text-center"
                                        style="width: 80px; height: 80px; border: 2px dashed #ccc;">
                                        <i class="fas fa-hospital fa-2x text-muted mt-2"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="clinic-info">
                                <h4><?php echo e($applicationSettings[0]['item_name'] ?? 'Clinic Name'); ?></h4>
                                <p><?php echo e($applicationSettings[0]['company_address'] ?? ''); ?></p>
                                <p><?php echo e($applicationSettings[0]['company_email'] ?? ''); ?></p>
                                <p><?php echo e($applicationSettings[0]['contact'] ?? ''); ?></p>
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            <h3 class="font-weight-bold" style="color: #2c3e50;"><?php echo app('translator')->get('APPOINTMENT DETAILS'); ?></h3>
                        </div>

                        <table class="info-table">
                            <tr>
                                <td><strong><?php echo app('translator')->get('Patient'); ?>:</strong>
                                    <?php echo e($patientAppointment->patient->name ?? '-'); ?></td>
                                <td><strong><?php echo app('translator')->get('MRN#'); ?>:</strong>
                                    <?php echo e($patientAppointment->patient->patientdetails->mrn_number ?? 'N/A'); ?></td>
                                <td><strong><?php echo app('translator')->get('Date'); ?>:</strong>
                                    <?php echo e(\Carbon\Carbon::parse($patientAppointment->appointment_date)->format('d F Y')); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><strong><?php echo app('translator')->get('Doctor'); ?>:</strong>
                                    <?php echo e($patientAppointment->doctor->name ?? '-'); ?></td>
                                <td><strong><?php echo app('translator')->get('Appointment#'); ?>:</strong>
                                    #<?php echo e($patientAppointment->appointment_number ?? '-'); ?></td>
                                <td><strong><?php echo app('translator')->get('Time'); ?>:</strong>
                                    <?php echo e(\Carbon\Carbon::parse($patientAppointment->start_time)->format('h:i A')); ?> -
                                    <?php echo e(\Carbon\Carbon::parse($patientAppointment->end_time)->format('h:i A')); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><strong><?php echo app('translator')->get('Phone'); ?>:</strong>
                                    <?php echo e($patientAppointment->patient->phone ?? '-'); ?></td>
                                <td><strong><?php echo app('translator')->get('Gender'); ?>:</strong>
                                    <?php echo e($patientAppointment->patient->gender ?? '-'); ?></td>
                                <td><strong><?php echo app('translator')->get('Age'); ?>:</strong>
                                    <?php echo e($patientAppointment->patient->age ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td><strong><?php echo app('translator')->get('Status'); ?>:</strong>
                                    <?php echo e($patientAppointment->appointmentstatus->name ?? '-'); ?></td>
                            </tr>
                        </table>

                        <?php if($patientAppointment->problem): ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6 class="font-weight-bold"><?php echo app('translator')->get('Problem / Description'); ?>:</h6>
                                    <div class="p-3 border rounded bg-light" style="min-height: 80px;">
                                        <?php echo e($patientAppointment->problem); ?></div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row mt-5 no-print">
                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label class="font-weight-bold text-secondary"><?php echo app('translator')->get('Change Status'); ?></label>
                                    <div class="d-flex align-items-center">
                                        <?php
                                            $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
                                            $currentStatus = $statuses->firstWhere(
                                                'id',
                                                $patientAppointment->appointment_status_id,
                                            );
                                            $isDisabled =
                                                isset($currentStatus) &&
                                                ($currentStatus->name == 'Processed' ||
                                                    ($currentStatus->name == 'Cancelled' &&
                                                        $patientAppointment->appointment_status_id !== old('status')) ||
                                                    $patientAppointment->appointment_date < $currentDate);
                                        ?>
                                        <select id="status" name="status" class="form-control form-control-sm"
                                            style="width: auto; min-width: 150px;"
                                            <?php if($isDisabled): ?> disabled <?php endif; ?>>
                                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($status->id); ?>"
                                                    <?php if($patientAppointment->appointment_status_id == $status->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($status->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div id="status-actions" class="d-none ml-2">
                                            <button id="confirm-status" class="btn btn-success btn-sm px-3 mr-1">
                                                <i class="fas fa-check"></i> <?php echo app('translator')->get('Update'); ?>
                                            </button>
                                            <button id="cancel-status" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logs -->
            <?php if($logs && $logs->count() > 0): ?>
                <div class="card shadow-sm border-0 mt-4 no-print">
                    <div class="card-header bg-white p-3 border-bottom-0">
                        <h3 class="card-title font-weight-bold ml-1"><?php echo app('translator')->get('User Logs'); ?></h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th><?php echo app('translator')->get('User'); ?></th>
                                        <th><?php echo app('translator')->get('Action'); ?></th>
                                        <th><?php echo app('translator')->get('Timestamp'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($log->user->name); ?></td>
                                            <td><?php echo e($log->action); ?></td>
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
    </div>

    <?php $__env->startPush('footer'); ?>
        <?php echo $__env->make('layouts.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script>
            $(document).ready(function() {
                var $statusSelect = $('#status');
                var $statusActions = $('#status-actions');
                var previousStatus = $statusSelect.val();

                $statusSelect.on('change', function() {
                    if ($(this).val() != previousStatus) {
                        $statusActions.removeClass('d-none').addClass('d-flex');
                    } else {
                        $statusActions.addClass('d-none').removeClass('d-flex');
                    }
                });

                $('#confirm-status').on('click', function() {
                    var statusId = $statusSelect.val();
                    var appointmentId = <?php echo json_encode($patientAppointment->id, 15, 512) ?>;
                    updateStatus(statusId, appointmentId);
                });

                $('#cancel-status').on('click', function() {
                    $statusSelect.val(previousStatus);
                    $statusActions.addClass('d-none').removeClass('d-flex');
                });

                function updateStatus(statusId, appointmentId) {
                    $statusSelect.prop('disabled', true);
                    $('#confirm-status, #cancel-status').prop('disabled', true);

                    toastr.info("<?php echo app('translator')->get('Updating status...'); ?>", "<?php echo app('translator')->get('Processing'); ?>", {
                        timeOut: 2000,
                        progressBar: true
                    });

                    $.ajax({
                        url: "<?php echo e(route('change.status')); ?>",
                        type: 'POST',
                        data: {
                            statusId: statusId,
                            appointmentId: appointmentId,
                            _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(response) {
                            toastr.success("<?php echo app('translator')->get('Status updated successfully'); ?>", "<?php echo app('translator')->get('Success'); ?>");
                            setTimeout(function() {
                                window.location.reload();
                            }, 500);
                        },
                        error: function(xhr) {
                            $statusSelect.prop('disabled', false);
                            $('#confirm-status, #cancel-status').prop('disabled', false);
                            console.error('Error:', xhr);
                            toastr.error("<?php echo app('translator')->get('Error updating status'); ?>", "<?php echo app('translator')->get('Error'); ?>");
                        }
                    });
                }

                $('#doPrint').on('click', function(e) {
                    e.preventDefault();
                    window.print();
                });

                // Toggle Header Visibility
                $('#showHeader').change(function() {
                    if ($(this).is(':checked')) {
                        $('#companyInfoBox').removeClass('d-none');
                    } else {
                        $('#companyInfoBox').addClass('d-none');
                    }
                });

                // Adjust Margins
                $('#marginTop').on('input change', function() {
                    const val = $(this).val() || 0;
                    $('#appointment-container').css('margin-top', val + 'mm');
                });

                $('#marginLeft').on('input change', function() {
                    const val = $(this).val() || 0;
                    $('#appointment-container').css('margin-left', val + 'mm');
                });

                // Adjust Font Size
                $('#fontSize').on('input change', function() {
                    const val = $(this).val() || 14;
                    $('#print-area *').css('font-size', val + 'px');
                });

                // Save Settings
                $('#saveSettings').click(function() {
                    const btn = $(this);
                    const originalText = btn.html();
                    btn.prop('disabled', true).html(
                        '<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get('Saving...'); ?>');

                    const settings = {
                        show_header: $('#showHeader').is(':checked'),
                        margin_top: $('#marginTop').val(),
                        margin_left: $('#marginLeft').val(),
                        font_size: $('#fontSize').val()
                    };

                    $.ajax({
                        url: "<?php echo e(route('page-settings.store')); ?>",
                        method: "POST",
                        contentType: 'application/json',
                        data: JSON.stringify({
                            _token: "<?php echo e(csrf_token()); ?>",
                            page_name: "appointment_show",
                            settings: settings
                        }),
                        success: function(response) {
                            btn.html('<i class="fas fa-check"></i> <?php echo app('translator')->get('Saved'); ?>');
                            setTimeout(() => {
                                btn.prop('disabled', false).html(originalText);
                            }, 2000);
                        },
                        error: function(xhr) {
                            btn.prop('disabled', false).html(
                                '<i class="fas fa-exclamation-triangle"></i> <?php echo app('translator')->get('Error'); ?>'
                            );
                        }
                    });
                });

                // Ensure live settings are applied on load
                $('#appointment-container').css({
                    'margin-top': '<?php echo e($pageSettings['margin_top'] ?? 0); ?>mm',
                    'margin-left': '<?php echo e($pageSettings['margin_left'] ?? 0); ?>mm',
                    'padding': '20px'
                });
                $('#print-area *').css('font-size', '<?php echo e($pageSettings['font_size'] ?? 14); ?>px');
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/patient-appointment/show.blade.php ENDPATH**/ ?>