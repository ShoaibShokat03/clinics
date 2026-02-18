@extends('layouts.layout')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
        }

        .table td,
        .table th {
            padding: 0.5rem 0.6rem !important;
            border: 1px solid #000 !important;
            vertical-align: middle;
            font-size: 14px;
        }

        .table th {
            background-color: #d3d3d3;
            color: #000;
            text-align: left;
            font-weight: bold;
        }

        .table tfoot td {
            border: none !important;
            vertical-align: middle;
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

        .patient-info-table {
            width: 100%;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6 !important;
            border-radius: 4px;
        }

        .patient-info-table td {
            border: none !important;
            text-align: left !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
            width: 33.33%;
        }

        .invoice-box {
            width: 100%;
            background: #fff;
            padding: 0;
        }

        /* Dynamic Font Size */
        #print-area * {
            font-size: {
                    {
                    $pageSettings['font_size'] ?? 14
                }
            }

            px;
        }

        @media print {
            @page {
                margin: 0;
                size: auto;
            }

            body {
                background: white !important;
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

            .invoice-box {
                box-shadow: none !important;
                margin: 0 !important;
                width: 100% !important;
                padding: 0 !important;
            }

            #invoice-container {
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
            }

            #print-area * {
                font-size: {
                        {
                        $pageSettings['font_size'] ?? 14
                    }
                }

                px !important;
            }

            #clinicHeader {
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
                    <h1 class="m-0 text-dark">@lang('Invoice Preview')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-outline-secondary btn-sm mr-1" type="button" data-toggle="collapse"
                        data-target="#printSettings" aria-expanded="false">
                        <i class="fas fa-cog"></i> @lang('Print Settings')
                    </button>
                    <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> @lang('Back to List')
                    </a>
                    <button id="doPrint" class="btn btn-secondary btn-sm ml-2">
                        <i class="fas fa-print"></i> @lang('Print')
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
                            <h5 class="mb-0 font-weight-bold">@lang('Customize Print Layout')</h5>
                            <small class="text-muted ml-3">(@lang('Changes apply to all users'))</small>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-2">
                                <div class="form-group mb-0">
                                    <label class="small text-muted font-weight-bold mb-2 d-block">@lang('HEADER')</label>
                                    <div class="custom-control custom-switch custom-switch-lg">
                                        <input type="checkbox" class="custom-control-input" id="showHeader"
                                            {{ $pageSettings['show_header'] ?? true ? 'checked' : '' }}>
                                        <label class="custom-control-label font-weight-normal"
                                            for="showHeader">@lang('Show')</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-0">
                                    <label class="small text-muted font-weight-bold mb-2 d-block">@lang('FONT SIZE (PX)')</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="number" id="fontSize" class="form-control"
                                            value="{{ $pageSettings['font_size'] ?? 14 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label class="small text-muted font-weight-bold mb-2 d-block">@lang('TOP MARGIN (MM)')</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrows-alt-v"></i></span>
                                        </div>
                                        <input type="number" id="marginTop" class="form-control"
                                            value="{{ $pageSettings['margin_top'] ?? 0 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label class="small text-muted font-weight-bold mb-2 d-block">@lang('LEFT MARGIN (MM)')</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrows-alt-h"></i></span>
                                        </div>
                                        <input type="number" id="marginLeft" class="form-control"
                                            value="{{ $pageSettings['margin_left'] ?? 0 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-sm btn-block shadow-sm" id="saveSettings">
                                    <i class="fas fa-save mr-1"></i> @lang('Save')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="invoice-box card-body" id="print-area">
                            @php
                                $marginTop = $pageSettings['margin_top'] ?? 0;
                                $marginLeft = $pageSettings['margin_left'] ?? 0;
                                $showHeader = isset($pageSettings['show_header'])
                                    ? $pageSettings['show_header'] === true ||
                                        $pageSettings['show_header'] === 'true' ||
                                        $pageSettings['show_header'] === 1 ||
                                        $pageSettings['show_header'] === '1'
                                    : true;
                            @endphp
                            <div id="invoice-container"
                                style="margin-top: {{ $marginTop }}mm; margin-left: {{ $marginLeft }}mm; padding: 20px;">
                                <div id="clinicHeader" class="clinic-header {{ $showHeader ? '' : 'd-none' }}">
                                    <div class="clinic-logo-box">
                                        @if (isset($applicationSettings[0]['logo']) && !empty($applicationSettings[0]['logo']))
                                            <img src="{{ asset('public/' . $applicationSettings[0]['logo']) }}"
                                                alt="Logo" class="clinic-logo">
                                        @else
                                            <div class="p-3 bg-light rounded text-center"
                                                style="width: 80px; height: 80px; border: 2px dashed #ccc;">
                                                <i class="fas fa-hospital fa-2x text-muted mt-2"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="clinic-info">
                                        <h4>{{ $applicationSettings[0]['item_name'] ?? 'Company Name' }}</h4>
                                        <p>{{ $applicationSettings[0]['company_address'] ?? '' }}</p>
                                        <p>{{ $applicationSettings[0]['email'] ?? '' }}</p>
                                        <p>{{ $applicationSettings[0]['contact'] ?? '' }}</p>
                                    </div>
                                </div>

                                <table class="patient-info-table">
                                    <tr>
                                        <td><strong>@lang('Patient'):</strong> {{ $patient->name }}</td>
                                        <td><strong>@lang('MRN#'):</strong> {{ $patientDetail->mrn_number ?? '' }}
                                        </td>
                                        <td><strong>@lang('Date'):</strong>
                                            {{ date('d M Y', strtotime($invoice->invoice_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>@lang('Doctor'):</strong> {{ $doctor->name ?? 'N/A' }}</td>
                                        <td><strong>@lang('Invoice#'):</strong> {{ $invoice->invoice_number }}</td>
                                        <td><strong>@lang('Status'):</strong>
                                            {{ $invoice->due == 0 ? 'Paid' : 'Unpaid' }}</td>
                                    </tr>
                                </table>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('Description')</th>
                                            <th>@lang('Rate')</th>
                                            <th>@lang('Qty')</th>
                                            <th>@lang('Total')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice->invoiceItems as $item)
                                            <tr>
                                                <td style="text-align: left;">{{ $item->description }}</td>
                                                <td>{{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="mb-1"><strong>@lang('Sub Total') :</strong>
                                                {{ number_format($invoice->total, 2) }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-1"><strong>@lang('Grand Total') :</strong>
                                                {{ number_format($invoice->grand_total, 2) }}</p>
                                        </div>
                                    </div>

                                    @if ($invoice->total_discount > 0)
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="mb-1"><strong>@lang('Discount') :</strong>
                                                    {{ number_format($invoice->total_discount, 2) }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-6">
                                            <p class="mb-1"><strong>@lang('Paid') :</strong>
                                                {{ number_format($invoice->paid, 2) }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-1"><strong>@lang('Due') :</strong>
                                                {{ number_format($invoice->due, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('footer')
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
                            $('#clinicHeader').removeClass('d-none');
                        } else {
                            $('#clinicHeader').addClass('d-none');
                        }
                    });

                    // Adjust Margins
                    $('#marginTop').on('input change', function() {
                        const val = $(this).val() || 0;
                        $('#invoice-container').css('margin-top', val + 'mm');
                    });

                    $('#marginLeft').on('input change', function() {
                        const val = $(this).val() || 0;
                        $('#invoice-container').css('margin-left', val + 'mm');
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
                            '<i class="fas fa-spinner fa-spin"></i> @lang('Saving...')');

                        const settings = {
                            show_header: $('#showHeader').is(':checked'),
                            margin_top: $('#marginTop').val(),
                            margin_left: $('#marginLeft').val(),
                            font_size: $('#fontSize').val()
                        };

                        $.ajax({
                            url: "{{ route('page-settings.store') }}",
                            method: "POST",
                            contentType: 'application/json',
                            data: JSON.stringify({
                                _token: "{{ csrf_token() }}",
                                page_name: "invoice_show",
                                settings: settings
                            }),
                            success: function(response) {
                                btn.html('<i class="fas fa-check"></i> @lang('Saved')');
                                setTimeout(() => {
                                    btn.prop('disabled', false).html(originalText);
                                }, 2000);
                            },
                            error: function(xhr) {
                                btn.prop('disabled', false).html(
                                    '<i class="fas fa-exclamation-triangle"></i> @lang('Error')'
                                );
                            }
                        });
                    });

                    // Ensure live settings are applied on load
                    $('#invoice-container').css({
                        'margin-top': '{{ $marginTop }}mm',
                        'margin-left': '{{ $marginLeft }}mm',
                        'padding': '20px'
                    });
                    $('#print-area *').css('font-size', '{{ $pageSettings['font_size'] ?? 14 }}px');
                });
            </script>
        @endpush
    @endsection
