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
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #e5e5e5;
        }

        .clinic-header h4 {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }

        .patient-info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .patient-info-table td {
            border: none !important;
            text-align: left !important;
            padding: 5px !important;
            font-size: 14px !important;
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

            #invoice-container {
                padding-top: {
                        {
                        $pageSettings['margin_top'] ?? 0
                    }
                }

                mm !important;

                padding-left: {
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

            #companyLogo,
            #clinicHeader {
                display: {
                        {
                        ($pageSettings['show_header'] ?? true) ? 'block': 'none'
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
                    <h1 class="m-0 text-dark"><?php echo app('translator')->get('Invoice View'); ?></h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-outline-secondary btn-sm mr-1" type="button" data-toggle="collapse"
                        data-target="#printSettings" aria-expanded="false">
                        <i class="fas fa-cog"></i> <?php echo app('translator')->get('Print Settings'); ?>
                    </button>
                    <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-outline-primary btn-sm">
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
                                $showHeader = isset($pageSettings['show_header'])
                                    ? $pageSettings['show_header'] === true ||
                                        $pageSettings['show_header'] === 'true' ||
                                        $pageSettings['show_header'] === 1 ||
                                        $pageSettings['show_header'] === '1'
                                    : true;
                                $marginTop = $pageSettings['margin_top'] ?? 0;
                                $marginLeft = $pageSettings['margin_left'] ?? 0;
                            ?>
                            <div class="invoice" id="invoice-container"
                                style="padding-top: <?php echo e($marginTop); ?>mm !important; padding-left: <?php echo e($marginLeft); ?>mm !important;">
                                <div id="clinicHeader" class="clinic-header <?php echo e($showHeader ? '' : 'd-none'); ?>">
                                    <h4><?php echo e($company->item_name ?? 'Company Name'); ?></h4>
                                    <p><?php echo e($company->company_address ?? ''); ?></p>
                                    <p><?php echo e($company->contact ?? ''); ?></p>
                                </div>

                                <table class="patient-info-table">
                                    <tr>
                                        <td><strong><?php echo app('translator')->get('Patient'); ?>:</strong> <?php echo e($invoice->user->name); ?></td>
                                        <td><strong><?php echo app('translator')->get('MRN#'); ?>:</strong>
                                            <?php echo e($invoice->user->patientDetails->mrn_number ?? ''); ?></td>
                                        <td><strong><?php echo app('translator')->get('Date'); ?>:</strong>
                                            <?php echo e(date('d M Y', strtotime($invoice->invoice_date))); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php echo app('translator')->get('Doctor'); ?>:</strong> <?php echo e($invoice->doctor->name ?? 'N/A'); ?></td>
                                        <td><strong><?php echo app('translator')->get('Invoice#'); ?>:</strong> <?php echo e($invoice->invoice_number); ?></td>
                                        <td><strong><?php echo app('translator')->get('Status'); ?>:</strong>
                                            <?php echo e($invoice->due == 0 ? 'Paid' : 'Unpaid'); ?></td>
                                    </tr>
                                </table>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('Description'); ?></th>
                                            <th><?php echo app('translator')->get('Price'); ?></th>
                                            <th><?php echo app('translator')->get('Quantity'); ?></th>
                                            <th><?php echo app('translator')->get('Total'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $invoice->invoiceItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td style="text-align: left;"><?php echo e($item->description); ?></td>
                                                <td><?php echo e(number_format($item->price, 2)); ?></td>
                                                <td><?php echo e($item->quantity); ?></td>
                                                <td><?php echo e(number_format($item->price * $item->quantity, 2)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" style="text-align: right;">
                                                <strong><?php echo app('translator')->get('Total'); ?></strong></td>
                                            <td><?php echo e(number_format($invoice->total, 2)); ?></td>
                                        </tr>
                                        <?php if($invoice->total_discount > 0): ?>
                                            <tr>
                                                <td colspan="3" style="text-align: right;">
                                                    <strong><?php echo app('translator')->get('Discount'); ?></strong></td>
                                                <td><?php echo e(number_format($invoice->total_discount, 2)); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="3" style="text-align: right;">
                                                <strong><?php echo app('translator')->get('Grand Total'); ?></strong></td>
                                            <td><?php echo e(number_format($invoice->grand_total, 2)); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align: right; color: green;">
                                                <strong><?php echo app('translator')->get('Paid'); ?></strong></td>
                                            <td style="color: green;"><?php echo e(number_format($invoice->paid, 2)); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align: right; color: red;">
                                                <strong><?php echo app('translator')->get('Due'); ?></strong></td>
                                            <td style="color: red;"><?php echo e(number_format($invoice->due, 2)); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
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
                $('#doPrint').on('click', function() {
                    window.print();
                });

                // Toggle Header Visibility
                $('#showHeader').change(function() {
                    if ($(this).is(':checked')) {
                        $('#clinicHeader').removeClass('d-none');
                    } else {
                        $('#clinicHeader').addClass('d-none');
                    }
                });

                // Adjust Margins
                $('#marginTop').on('input change', function() {
                    const val = $(this).val() || 0;
                    $('#invoice-container').css('padding-top', val + 'mm');
                });

                $('#marginLeft').on('input change', function() {
                    const val = $(this).val() || 0;
                    $('#invoice-container').css('padding-left', val + 'mm');
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
                            page_name: "invoice_show",
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
                $('#invoice-container').css({
                    'padding-top': '<?php echo e($marginTop); ?>mm',
                    'padding-left': '<?php echo e($marginLeft); ?>mm'
                });
                $('#print-area *').css('font-size', '<?php echo e($pageSettings['font_size'] ?? 14); ?>px');
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\dental\dental-main\resources\views/invoices/show.blade.php ENDPATH**/ ?>