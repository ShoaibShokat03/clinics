

<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>

<style>
    html,
    body {
        -webkit-text-size-adjust: 100%;
        font-family: Arial;
    }

    @media  screen and (-webkit-min-device-pixel-ratio: 3) {
        body {
            font-size: 12px;
        }
    }

    body {
        font-family: Arial, sans-serif;
    }

    .card {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 0 15px;
        margin: 5px 0;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .table td,
    .table th {
        padding: 0.5rem 0.6rem !important;
        border: 1px solid #000 !important;
        vertical-align: middle;
    }

    .table th {
        font-size: 10px;
        font-weight: bold;
        background-color: #d3d3d3;
        color: #000;
        text-align: center;
    }

    .table td {
        font-size: 10px;
        text-align: center;
    }

    .clinic-header {
        text-align: center;
        margin-bottom: 10px;
        border-bottom: 1px solid #e5e5e5;
    }

    .clinic-header h4 {
        font-size: 18px;
        font-weight: bold;
        margin: 0 0 2px 0;
    }

    .clinic-header p {
        font-size: 9px;
        margin: 0.5px 0;
    }

    .patient-info {
        margin-bottom: 8px;
    }

    .patient-info table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10px !important;
    }

    .patient-info td {
        padding: 3px 6px;
        vertical-align: top;
        width: 33.33%;
    }

    .patient-info td:last-child {
        text-align: right;
    }

    .patient-info td:nth-child(2) {
        text-align: center;
    }

    .patient-info strong {
        font-weight: bold;
        display: block;
    }

    .mt-custom {
        margin-top: 10px !important;
    }

    .ml-custom {
        margin-left: 12px !important;
    }

    table {
        border-collapse: collapse !important;
        border-spacing: 0 !important;
    }

    .service-table {
        width: 100%;
    }

    .gender {
        text-transform: capitalize;
    }

    .service-table th:nth-child(1),
    .service-table td:nth-child(1) {
        width: 40%;
        text-align: left;
        padding-left: 8px !important;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div id="print-area" class="card-body">
                <div class="row mt-custom">
                    <div class="col-12">
                        <div class="invoice">
                            <div class="clinic-header">
                                <h4 style="font-size: 12px;margin-bottom:10px;">
                                    <?php echo e($setting['general.company_name'] ?? 'Dental Clinic'); ?></h4>
                            </div>
                            <div class="patient-info">
                                <table>
                                    <tr>
                                        <td><strong>Patient</strong> <?php echo e($patient->name); ?></td>
                                        <td><strong>MRN#</strong> <?php echo e($patientDetail->mrn_number ?? ''); ?></td>
                                        <td class="gender"><strong>Gender</strong>
                                            <?php echo e($prescription->user->gender ?? ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date</strong>
                                            <?php echo e(date('d M Y', strtotime($prescription->prescription_date))); ?></td>
                                        <td><strong>Prescription#</strong>
                                            <?php echo e(str_pad($prescription->id, 4, '0', STR_PAD_LEFT)); ?></td>
                                        <td><strong>Doctor</strong> <?php echo e($doctor->name ?? 'N/A'); ?></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="row print-area ml-custom" style="margin-left:0 !important;">
                                <div class="col-12 table-responsive">
                                    <h5 style="font-size: 11px; font-weight: bold; margin-bottom: 5px;">Medicines</h5>
                                    <table class="table custom-table service-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Medicine Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Instruction</th>
                                                <th scope="col">Duration</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="text-align: left;">
                                                        <?php echo e($item->ddmedicine->name ?? '-'); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($item->ddmedicinetype->name ?? '-'); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e($item->instruction ?? '-'); ?>

                                                    </td>
                                                    <td>
                                                        <?php
                                                            $parts = [];
                                                            if ($item->days) {
                                                                $parts[] = $item->days . ' Days';
                                                            }
                                                            if ($item->weeks) {
                                                                $parts[] = $item->weeks . ' Weeks';
                                                            }
                                                            if ($item->months) {
                                                                $parts[] = $item->months . ' Months';
                                                            }
                                                            echo !empty($parts) ? implode(' / ', $parts) : '-';
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <?php if($prescription->note): ?>
                                <div class="row mt-custom ml-custom" style="margin-left: 0 !important;">
                                    <div class="col-12">
                                        <strong style="font-size: 10px;">Note:</strong>
                                        <p style="font-size: 10px; margin-top: 2px;"><?php echo e($prescription->note); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/prescriptionView/prescriptionView.blade.php ENDPATH**/ ?>