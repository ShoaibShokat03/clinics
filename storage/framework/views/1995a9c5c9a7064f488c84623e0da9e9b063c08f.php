<?php $__env->startSection('content'); ?>
    <style>
        /* Synchronized standard table and layout styles */
        .table td,
        .table th {
            padding: 0.5rem 0.6rem !important;
            border: 1px solid #dee2e6 !important;
            vertical-align: middle;
        }

        .table th {
            font-size: 14px;
            font-weight: bold;
            background-color: #f8f9fa;
            color: #333;
            text-align: center;
        }

        .table td {
            font-size: 14px;
            text-align: center;
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
            font-size: 26px;
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
        }

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

        .signature-box {
            margin-top: 60px;
            text-align: right;
            padding-right: 30px;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 220px;
            display: inline-block;
            padding-top: 5px;
            text-align: center;
            font-weight: bold;
        }

        .finding-pill {
            background: #fdfdfd;
            border-left: 4px solid #007bff;
            padding: 12px 15px;
            border-radius: 0 8px 8px 0;
            border-top: 1px solid #eee;
            border-right: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .image-thumb {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dee2e6;
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

            .no-print {
                display: none !important;
            }

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

            #exam-container {
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
                padding: 20px;
            }

            #print-area * {
                font-size: {
                        {
                        $pageSettings['font_size'] ?? 14
                    }
                }

                px !important;
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
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Examination Details'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-outline-secondary btn-sm mr-1" type="button" data-toggle="collapse"
                        data-target="#printSettings">
                        <i class="fas fa-cog"></i> <?php echo app('translator')->get('Print Settings'); ?>
                    </button>
                    <a href="<?php echo e(route('exam-investigations.index')); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('Back to List'); ?>
                    </a>
                    <button id="doPrint" class="btn btn-secondary btn-sm ml-2">
                        <i class="fas fa-print"></i> <?php echo app('translator')->get('Print'); ?>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="container-fluid">
            <!-- Print Settings Collapse -->
            <div class="row no-print">
                <div class="col-12">
                    <div class="collapse mb-3 border rounded p-4 bg-light shadow-sm" id="printSettings">
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-sliders-h text-primary mr-2"></i>
                            <h5 class="mb-0 font-weight-bold"><?php echo app('translator')->get('Customize Print Layout'); ?></h5>
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
                                    <input type="number" id="fontSize" class="form-control form-control-sm"
                                        value="<?php echo e($pageSettings['font_size'] ?? 14); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label class="small text-muted font-weight-bold mb-2 d-block"><?php echo app('translator')->get('TOP MARGIN (MM)'); ?></label>
                                    <input type="number" id="marginTop" class="form-control form-control-sm"
                                        value="<?php echo e($pageSettings['margin_top'] ?? 0); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label class="small text-muted font-weight-bold mb-2 d-block"><?php echo app('translator')->get('LEFT MARGIN (MM)'); ?></label>
                                    <input type="number" id="marginLeft" class="form-control form-control-sm"
                                        value="<?php echo e($pageSettings['margin_left'] ?? 0); ?>">
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
                                $showHeader = isset($pageSettings['show_header'])
                                    ? $pageSettings['show_header'] === true ||
                                        $pageSettings['show_header'] === 'true' ||
                                        $pageSettings['show_header'] === 1 ||
                                        $pageSettings['show_header'] === '1'
                                    : true;
                                $marginTop = $pageSettings['margin_top'] ?? 0;
                                $marginLeft = $pageSettings['margin_left'] ?? 0;
                            ?>
                            <div class="exam-report" id="exam-container"
                                style="padding-top: <?php echo e($marginTop); ?>mm !important; padding-left: <?php echo e($marginLeft); ?>mm !important;">
                                <!-- Header -->
                                <div id="companyInfoBox" class="clinic-header <?php echo e($showHeader ? '' : 'd-none'); ?>">
                                    <div class="clinic-logo-box">
                                        <?php if(isset($applicationSettings[0]['logo']) && !empty($applicationSettings[0]['logo'])): ?>
                                            <img src="<?php echo e(asset('public/' . $applicationSettings[0]['logo'])); ?>" alt="Logo"
                                                class="clinic-logo">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/images/logo.png')); ?>" class="clinic-logo"
                                                alt="Logo">
                                        <?php endif; ?>
                                    </div>
                                    <div class="clinic-info">
                                        <h4><?php echo e($applicationSettings[0]['item_name'] ?? $company->name); ?></h4>
                                        <p><?php echo e($applicationSettings[0]['company_address'] ?? $company->address); ?></p>
                                        <p><?php echo e($applicationSettings[0]['email'] ?? $company->email); ?></p>
                                        <p><?php echo e($applicationSettings[0]['contact'] ?? $company->phone); ?></p>
                                    </div>
                                </div>

                                <div class="text-center mb-4">
                                    <h3 class="font-weight-bold text-primary"><?php echo app('translator')->get('EXAMINATION REPORT'); ?></h3>
                                    <p class="text-muted">#<?php echo e($examInvestigation->examination_number); ?></p>
                                </div>

                                <!-- Patient Info Table -->
                                <table class="info-table">
                                    <tr>
                                        <td><strong><?php echo app('translator')->get('Patient'); ?>:</strong> <?php echo e($examInvestigation->patient->name); ?>

                                        </td>
                                        <td><strong><?php echo app('translator')->get('MRN#'); ?>:</strong>
                                            <?php echo e($examInvestigation->patient->patientDetails->mrn_number ?? ''); ?></td>
                                        <td><strong><?php echo app('translator')->get('Date'); ?>:</strong>
                                            <?php echo e($examInvestigation->created_at->format('d M Y')); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php echo app('translator')->get('Doctor'); ?>:</strong> Dr. <?php echo e($examInvestigation->doctor->name); ?>

                                        </td>
                                        <td><strong><?php echo app('translator')->get('Age / Gender'); ?>:</strong>
                                            <?php echo e($examInvestigation->patient->age ?? 'N/A'); ?> Y /
                                            <?php echo e($examInvestigation->patient->gender ?? ''); ?></td>
                                        <td><strong><?php echo app('translator')->get('Appt#'); ?>:</strong>
                                            <?php echo e($examInvestigation->PatientAppointment->appointment_number ?? '-'); ?></td>
                                    </tr>
                                </table>

                                <!-- Main Content -->
                                <div class="mt-4">
                                    <h5 class="font-weight-bold mb-2 border-bottom pb-1"><?php echo app('translator')->get('Chief Complaint'); ?></h5>
                                    <div class="p-2 mb-4 bg-light rounded">
                                        <?php echo $examInvestigation->chief_complaints ?: '<span class="text-muted">No complaints recorded.</span>'; ?>

                                    </div>

                                    <?php if(count($groupedTeeth) > 0): ?>
                                        <h5 class="font-weight-bold mb-3 border-bottom pb-1"><?php echo app('translator')->get('Dental Findings & Issues'); ?></h5>
                                        <?php $__currentLoopData = $groupedTeeth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issueGroup => $teethGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="card mb-3 border rounded shadow-none">
                                                <div class="card-header bg-light py-2">
                                                    <h6 class="mb-0 font-weight-bold">
                                                        <?php echo app('translator')->get('Tooth'); ?>
                                                        <?php echo e($teethGroup->pluck('tooth_number')->join(', ')); ?>

                                                    </h6>
                                                </div>
                                                <div class="card-body p-3">
                                                    <?php $__currentLoopData = $teethGroup->first()->toothIssues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="finding-pill mb-2 shadow-none">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong><?php echo app('translator')->get('Findings'); ?>:</strong>
                                                                    <?php echo e($issue->tooth_issue); ?>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong><?php echo app('translator')->get('Diagnosis'); ?>:</strong> <span
                                                                        class="text-success"><?php echo e($issue->diagnosis->name ?? 'N/A'); ?></span>
                                                                </div>
                                                            </div>
                                                            <?php if($issue->description): ?>
                                                                <div class="mt-1 small text-muted">
                                                                    <strong><?php echo app('translator')->get('Notes'); ?>:</strong>
                                                                    <?php echo e($issue->description); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <!-- Radiographs -->
                                                    <?php
                                                        $toothFiles = $files->filter(
                                                            fn($f) => $teethGroup
                                                                ->pluck('tooth_number')
                                                                ->contains($f['child_record_id']),
                                                        );
                                                    ?>
                                                    <?php if($toothFiles->count() > 0): ?>
                                                        <div class="mt-2 d-flex flex-wrap gap-2 tooth-files">
                                                            <?php $__currentLoopData = $toothFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <a href="<?php echo e(asset($file['file_name'])); ?>" target="_blank"
                                                                    class="mr-2 mb-2">
                                                                    <img src="<?php echo e(asset($file['file_name'])); ?>"
                                                                        class="image-thumb" alt="Radiograph">
                                                                </a>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <?php if(
                                        $examInvestigation->extraOralInvestigations->count() > 0 ||
                                            $examInvestigation->softTissuesInvestigations->count() > 0): ?>
                                        <div class="row mt-4">
                                            <?php if($examInvestigation->extraOralInvestigations->count() > 0): ?>
                                                <div class="col-6">
                                                    <h5 class="font-weight-bold border-bottom pb-1"><?php echo app('translator')->get('Extra Oral'); ?></h5>
                                                    <?php $__currentLoopData = $examInvestigation->extraOralInvestigations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ext): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="small mb-1">
                                                            <strong><?php echo e($ext->extraOral->extra_oral_name ?? ''); ?>:</strong>
                                                            <?php echo e($ext->comments); ?></div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($examInvestigation->softTissuesInvestigations->count() > 0): ?>
                                                <div class="col-6">
                                                    <h5 class="font-weight-bold border-bottom pb-1"><?php echo app('translator')->get('Soft Tissues'); ?></h5>
                                                    <?php $__currentLoopData = $examInvestigation->softTissuesInvestigations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $soft): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="small mb-1">
                                                            <strong><?php echo e($soft->softTissue->soft_tissues_name ?? ''); ?>:</strong>
                                                            <?php echo e($soft->comments); ?></div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Footer Signatures -->
                                <div class="signature-box"
                                    style="display: flex; justify-content: space-between; align-items: flex-end;">
                                    <div style="text-align: center;">
                                        <div class="signature-line"><?php echo app('translator')->get('Patient Signature'); ?></div>
                                    </div>
                                    <div style="text-align: center;">
                                        <div class="signature-line"><?php echo app('translator')->get('Doctor Signature'); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('footer'); ?>
        <script>
            $(document).ready(function() {
                $('#doPrint').on('click', function(e) {
                    e.preventDefault();
                    window.print();
                });

                $('#showHeader').change(function() {
                    if ($(this).is(':checked')) {
                        $('#companyInfoBox').removeClass('d-none');
                    } else {
                        $('#companyInfoBox').addClass('d-none');
                    }
                });

                $('#marginTop').on('input change', function() {
                    $('#exam-container').css('margin-top', ($(this).val() || 0) + 'mm');
                });

                $('#marginLeft').on('input change', function() {
                    $('#exam-container').css('margin-left', ($(this).val() || 0) + 'mm');
                });

                $('#fontSize').on('input change', function() {
                    $('#print-area *').css('font-size', ($(this).val() || 14) + 'px');
                });

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
                            page_name: "exam_investigation_show",
                            settings: settings
                        }),
                        success: function() {
                            btn.html('<i class="fas fa-check"></i> <?php echo app('translator')->get('Saved'); ?>');
                            setTimeout(() => {
                                btn.prop('disabled', false).html(originalText);
                            }, 2000);
                        },
                        error: function() {
                            btn.prop('disabled', false).html(
                                '<i class="fas fa-exclamation-triangle"></i> <?php echo app('translator')->get('Error'); ?>'
                                );
                        }
                    });
                });

                // Initialize settings
                $('#exam-container').css({
                    'margin-top': '<?php echo e($marginTop); ?>mm',
                    'margin-left': '<?php echo e($marginLeft); ?>mm',
                    'padding': '20px'
                });
                $('#print-area *').css('font-size', '<?php echo e($pageSettings['font_size'] ?? 14); ?>px');
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/exam-investigation/show.blade.php ENDPATH**/ ?>