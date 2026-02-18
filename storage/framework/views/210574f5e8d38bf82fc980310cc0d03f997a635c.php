

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

    .amount-words {
        font-size: 9px;
        font-style: italic;
        margin: 4px 0;
        text-align: right;
    }

    .summary-table {
        width: 30%;
        float: right;
        align-self: end;
    }

    .summary-table th,
    .summary-table td {
        border: none !important;
        padding: 3px 6px !important;
        font-size: 10px;
        background-color: #d3d3d35c !important;
    }

    .summary-table th {
        text-align: left;
        font-weight: bold;
    }

    .summary-table td {
        text-align: right;
    }

    .card-header {
        padding: 0.3rem 0.6rem;
    }

    .card-title {
        font-size: 0.6rem;
    }

    .card-tools .btn {
        font-size: 0.4rem;
        padding: 0.2rem 0.4rem;
    }

    hr {
        border-top: 1px solid #000;
        margin: 6px 0;
    }

    .invoice {
        max-width: 100%;
        margin: 0 auto;
        padding: 10px;
    }

    .service-table {
        width: 100%;
    }

    .gender {
        text-transform: capitalize;
    }

    .service-table th:nth-child(1),
    .service-table td:nth-child(1) {
        width: 50%;
        text-align: left;
        padding-left: 8px !important;
    }

    .service-table th:nth-child(2),
    .service-table td:nth-child(2),
    .service-table th:nth-child(3),
    .service-table td:nth-child(3),
    .service-table th:nth-child(4),
    .service-table td:nth-child(4),
    .service-table th:nth-child(5),
    .service-table td:nth-child(5) {
        width: 12.5%;
    }
</style>
<?php
function numberToWords($number)
{
    if (!is_numeric($number) || $number < 0) {
        return 'Invalid Amount';
    }

    $number = floor($number);
    if ($number == 0) {
        return 'Zero Rupees';
    }

    $ones = [
        0 => '',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
    ];
    $tens = [
        2 => 'Twenty',
        3 => 'Thirty',
        4 => 'Forty',
        5 => 'Fifty',
        6 => 'Sixty',
        7 => 'Seventy',
        8 => 'Eighty',
        9 => 'Ninety',
    ];
    $thousands = [
        0 => '',
        1 => 'Thousand',
        2 => 'Million',
        3 => 'Billion',
        4 => 'Trillion',
    ];

    $words = '';
    $group = 0;

    while ($number > 0) {
        $n = $number % 1000;
        if ($n != 0) {
            $temp = '';
            $hundreds = floor($n / 100);
            $n = $n % 100;

            if ($hundreds != 0) {
                $temp .= $ones[$hundreds] . ' Hundred';
                if ($n > 0) {
                    $temp .= ' and ';
                }
            }

            if ($n < 20) {
                $temp .= $ones[$n];
            } else {
                $temp .= $tens[floor($n / 10)];
                if ($n % 10 != 0) {
                    $temp .= ' ' . $ones[$n % 10];
                }
            }

            if ($temp != '') {
                $temp = trim($temp) . ' ' . $thousands[$group];
                $words = trim($temp) . ($words ? ' ' . $words : '');
            }
        }
        $number = floor($number / 1000);
        $group++;
    }

    return ucfirst(trim($words)) . ' Rupees';
}

$amountInWords = numberToWords($invoice->grand_total);
?>

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
                                <h4 style="font-size: 12px;margin-bottom:10px;"><?php echo e($ApplicationSetting->item_name ?? 'Company Name'); ?></h4>
                            </div>
                            <div class="patient-info">
                                <table>
                                    <tr>
                                        <td><strong>Patient</strong> <?php echo e($patient->name); ?></td>
                                        <td><strong>MRN#</strong> <?php echo e($patientDetail->mrn_number ?? ''); ?></td>
                                        <td class="gender"><strong>Gender</strong> <?php echo e($invoice->user->gender ?? ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date</strong> <?php echo e(date('d M Y', strtotime($invoice->invoice_date))); ?></td>
                                        <td><strong>Invoice#</strong> <?php echo e(str_pad($invoice->id, 6, '0', STR_PAD_LEFT)); ?></td>
                                        <td><strong>Doctor</strong> <?php echo e($doctor->name ?? 'N/A'); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Replace the service table section and remove the separate summary table -->
                            <div class="row print-area ml-custom" style="margin-left:0 !important;">
                                <div class="col-12 table-responsive">
                                    <table class="table custom-table service-table">
                                        <thead>
                                            <tr>
                                                <th scope="col"><?php echo app('translator')->get('Description'); ?></th>
                                                <th scope="col"><?php echo app('translator')->get('Rate'); ?></th>
                                                <th scope="col"><?php echo app('translator')->get('Qty'); ?></th>
                                                <th scope="col"><?php echo app('translator')->get('Total'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td style="text-align: left;">
                                                    <?php echo e($invoiceItem->description ?? ($invoiceItem->patienttreatmentplanprocedures->procedure->description ?? '-')); ?>

                                                </td>
                                                <td>
                                                    <?php echo e(number_format($invoiceItem->price, 0)); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($invoiceItem->quantity); ?>

                                                </td>
                                                <td>
                                                    <?php echo e(number_format($invoiceItem->price * $invoiceItem->quantity, 0)); ?>

                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <!-- Summary rows using single td with colspan -->
                                            <tr style="background-color: #d3d3d35c;">
                                                <td colspan="4" style="text-align: right;"><b><?php echo app('translator')->get('Sub Total'); ?>: <?php echo e(number_format($invoice->total, 0)); ?></b></td>
                                            </tr>
                                            <tr style="background-color: #d3d3d35c;">
                                                <td colspan="4" style="text-align: right;"><b><?php echo app('translator')->get('Grand Total'); ?>: <?php echo e(number_format($invoice->grand_total, 0)); ?></b></td>
                                            </tr>
                                            <tr style="background-color: #d3d3d35c;">
                                                <td colspan="4" style="text-align: right;"><b><?php echo app('translator')->get('Paid Amount'); ?>: <?php echo e(number_format($invoice->paid, 0)); ?></b></td>
                                            </tr>
                                            <?php if($invoice->due != 0): ?>
                                            <tr style="background-color: #d3d3d35c;">
                                                <td colspan="4" style="text-align: right;"><b><?php echo app('translator')->get('Balance Amount'); ?>: <?php echo e(number_format($invoice->due, 0)); ?></b></td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\dental\dental-main - 04-Feb-2026\resources\views/invoiceView/invoiceView.blade.php ENDPATH**/ ?>