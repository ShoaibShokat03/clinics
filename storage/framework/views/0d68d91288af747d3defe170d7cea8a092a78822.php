

<?php $__env->startSection('content'); ?>
<style>
    /* Restore standard table and layout styles */
    .table td,
    .table th {
        padding: 0.5rem 0.6rem !important;
        border: 1px solid #000 !important;
        vertical-align: middle;
    }

    .table th {
        font-size: 14px;
        font-weight: bold;
        background-color: #d3d3d3;
        color: #000;
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

        #prescription-container {
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
                <h1 class="m-0 text-dark"><?php echo app('translator')->get('Prescription View'); ?></h1>
            </div>
            <div class="col-sm-6 text-right">
                <button class="btn btn-outline-secondary btn-sm mr-1" type="button" data-toggle="collapse"
                    data-target="#printSettings" aria-expanded="false">
                    <i class="fas fa-cog"></i> <?php echo app('translator')->get('Print Settings'); ?>
                </button>
                <a href="<?php echo e(route('prescriptions.index')); ?>" class="btn btn-outline-primary btn-sm">
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
                                        <?php echo e(($pageSettings['show_header'] ?? true) ? 'checked' : ''); ?>>
                                    <label class="custom-control-label font-weight-normal" for="showHeader"><?php echo app('translator')->get('Show'); ?></label>
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
                        $showHeader = isset($pageSettings['show_header']) ? ($pageSettings['show_header'] === true || $pageSettings['show_header'] === 'true' || $pageSettings['show_header'] === 1 || $pageSettings['show_header'] === '1') : true;
                        $marginTop = $pageSettings['margin_top'] ?? 0;
                        $marginLeft = $pageSettings['margin_left'] ?? 0;
                        ?>
                        <div class="prescription" id="prescription-container" style="padding-top: <?php echo e($marginTop); ?>mm !important; padding-left: <?php echo e($marginLeft); ?>mm !important;">
                            <div id="companyInfoBox" class="clinic-header <?php echo e($showHeader ? '' : 'd-none'); ?>">
                                <div class="clinic-logo-box">
                                    <?php if(isset($applicationSettings[0]['logo']) && !empty($applicationSettings[0]['logo'])): ?>
                                    <img src="<?php echo e(asset('public/'.$applicationSettings[0]['logo'])); ?>" alt="Logo" class="clinic-logo">
                                    <?php else: ?>
                                    <div class="p-3 bg-light rounded text-center" style="width: 80px; height: 80px; border: 2px dashed #ccc;">
                                        <i class="fas fa-hospital fa-2x text-muted mt-2"></i>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="clinic-info">
                                    <h4><?php echo e($applicationSettings[0]['item_name'] ?? 'Company Name'); ?></h4>
                                    <p><?php echo e($applicationSettings[0]['company_address'] ?? ''); ?></p>
                                    <p><?php echo e($applicationSettings[0]['email'] ?? ''); ?></p>
                                    <p><?php echo e($applicationSettings[0]['contact'] ?? ''); ?></p>
                                </div>
                            </div>

                            <table class="info-table">
                                <tr>
                                    <td><strong><?php echo app('translator')->get('Patient'); ?>:</strong> <?php echo e($prescription->user->name); ?></td>
                                    <td><strong><?php echo app('translator')->get('MRN#'); ?>:</strong> <?php echo e($prescription->user->patientDetails->mrn_number ?? ''); ?></td>
                                    <td><strong><?php echo app('translator')->get('Date'); ?>:</strong> <?php echo e(date('d M Y', strtotime($prescription->prescription_date))); ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo app('translator')->get('Doctor'); ?>:</strong> <?php echo e($prescription->doctor->name ?? 'N/A'); ?></td>
                                    <td><strong><?php echo app('translator')->get('Prescription#'); ?>:</strong> <?php echo e(str_pad($prescription->id, 4, '0', STR_PAD_LEFT)); ?></td>
                                    <td><strong><?php echo app('translator')->get('Gender'); ?>:</strong> <?php echo e($prescription->user->gender ?? ''); ?></td>
                                </tr>
                            </table>

                            <h5 class="font-weight-bold mt-4 mb-3"><?php echo app('translator')->get('Medicines'); ?></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('Medicine Name'); ?></th>
                                        <th><?php echo app('translator')->get('Type'); ?></th>
                                        <th><?php echo app('translator')->get('Instruction'); ?></th>
                                        <th><?php echo app('translator')->get('Duration'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $prescription->patientmedicineitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="text-align: left;"><?php echo e($item->ddmedicine->name ?? '-'); ?></td>
                                        <td><?php echo e($item->ddmedicinetype->name ?? '-'); ?></td>
                                        <td><?php echo e($item->instruction ?? '-'); ?></td>
                                        <td>
                                            <?php
                                            $parts = [];
                                            if ($item->days) $parts[] = $item->days . ' Days';
                                            if ($item->weeks) $parts[] = $item->weeks . ' Weeks';
                                            if ($item->months) $parts[] = $item->months . ' Months';
                                            echo !empty($parts) ? implode(' / ', $parts) : '-';
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php if($prescription->note): ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6 class="font-weight-bold"><?php echo app('translator')->get('Note'); ?>:</h6>
                                    <div class="p-2 border" style="min-height: 50px;">
                                        <?php echo e($prescription->note); ?>

                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="signature-box">
                                <div class="signature-line">
                                    <strong><?php echo app('translator')->get('Signature'); ?></strong>
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
            e.stopPropagation();
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
            $('#prescription-container').css('margin-top', val + 'mm');
        });

        $('#marginLeft').on('input change', function() {
            const val = $(this).val() || 0;
            $('#prescription-container').css('margin-left', val + 'mm');
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
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get("Saving..."); ?>');

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
                    page_name: "prescription_show",
                    settings: settings
                }),
                success: function(response) {
                    btn.html('<i class="fas fa-check"></i> <?php echo app('translator')->get("Saved"); ?>');
                    setTimeout(() => {
                        btn.prop('disabled', false).html(originalText);
                    }, 2000);
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html('<i class="fas fa-exclamation-triangle"></i> <?php echo app('translator')->get("Error"); ?>');
                }
            });
        });

        // Ensure live settings are applied on load
        $('#prescription-container').css({
            'margin-top': '<?php echo e($marginTop); ?>mm',
            'margin-left': '<?php echo e($marginLeft); ?>mm',
            'padding': '20px'
        });
        $('#print-area *').css('font-size', '<?php echo e($pageSettings["font_size"] ?? 14); ?>px');
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/prescriptions/show.blade.php ENDPATH**/ ?>