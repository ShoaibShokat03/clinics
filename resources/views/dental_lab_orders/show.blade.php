@extends('layouts.layout')

@section('content')
    <style>
        /* --------------------------------------------------------- */
        /* Styles from create.blade.php for Form Layout Compatibility */
        /* --------------------------------------------------------- */
        .w-4 {
            width: 4%;
        }

        span {
            font-size: 12px;
        }

        /* Checkbox Styles */
        input[type="checkbox"] {
            cursor: default;
            /* Changed from pointer for Show view */
            width: 14px;
            height: 14px;
            margin-left: 4px;
            flex-shrink: 0;
        }

        /* Removed hover effect for disabled inputs */

        .row.justify-content-between {
            margin-top: 2px;
            margin-bottom: 2px;
            align-items: center;
        }

        /* Standardize section headings */
        .section-heading {
            font-size: 14px;
            font-weight: bold;
            height: fit-content;
            padding: 4px 1px;
            text-align: center;
            width: 100%;
            border-bottom: 1px solid black;
            background-color: #f8f9fa;
            margin-bottom: 0;
        }

        /* Standardize checkbox containers */
        .checkbox-container {
            padding: 4px 6px;
        }

        .checkbox-item {
            margin-bottom: 3px;
        }

        .checkbox-item .d-flex {
            min-height: 22px;
            align-items: center;
        }

        .checkbox-item p {
            margin: 0;
            font-weight: bold;
            font-size: 12px;
            flex: 1;
            line-height: 1.2;
        }

        /* Reduce spacing in form sections */
        .row.col-12.m-0.p-0 {
            margin-bottom: 4px !important;
        }

        .border.border-dark {
            padding: 0 !important;
        }

        /* Compact form controls */
        .form-control {
            padding: 5px 8px;
            font-size: 12px;
            height: 28px;
            line-height: 1.4;
            background-color: #fff !important;
            /* Force white background for read-only */
        }

        textarea.form-control {
            padding: 5px 8px;
            font-size: 12px;
        }

        /* Better alignment for form fields */
        .d-flex.align-items-center {
            min-height: 32px;
        }

        /* Reduce spacing in shade table */
        .table {
            margin-bottom: 0;
        }

        .table td {
            padding: 2px !important;
            font-size: 10px;
        }

        /* Compact section spacing */
        .col-6.m-0.p-0.h-100 {
            padding: 0 !important;
        }

        /* Compact shade input fields */
        input[type="text"].form-control.px-0 {
            padding: 1px 2px !important;
            font-size: 10px !important;
            height: 22px !important;
            line-height: 1.2;
        }

        /* Compact shade checkboxes */
        table.table-bordered td {
            padding: 2px !important;
            font-size: 10px;
            line-height: 1.2;
        }

        /* --------------------------------------------------------- */
        /* Original Show Page Styles (Header, Print Settings)        */
        /* --------------------------------------------------------- */
        .clinic-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            /* Reduced from 25px */
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
            margin-bottom: 15px;
            /* Reduced margin */
            background-color: #f8f9fa;
            border: 1px solid #dee2e6 !important;
            border-radius: 4px;
        }

        .info-table td {
            border: none !important;
            text-align: left !important;
            padding: 6px 10px !important;
            /* Slightly more compact */
            font-size: 13px !important;
            width: 33.33%;
        }

        /* Print Logic */
        #print-area * {
            font-size: {{ $pageSettings['font_size'] ?? 14 }}px;
        }

        @media print {
            @page {
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

            #lab-order-container {
                margin-top: {{ $pageSettings['margin_top'] ?? 0 }}mm !important;
                margin-left: {{ $pageSettings['margin_left'] ?? 0 }}mm !important;
                display: block !important;
                width: 100% !important;
            }

            #print-area * {
                font-size: {{ $pageSettings['font_size'] ?? 14 }}px !important;
            }

            #companyInfoBox {
                display: {{ $pageSettings['show_header'] ?? true ? 'flex' : 'none' }} !important;
            }

            /* Ensure inputs print correctly */
            input[type="checkbox"] {
                -webkit-appearance: none;
                appearance: none;
                background: #fff;
                border: 1px solid #000;
            }

            input[type="checkbox"]:checked {
                background: #000;
                position: relative;
            }

            input[type="checkbox"]:checked:after {
                content: '';
                position: absolute;
                left: 3px;
                top: 0px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }
        }
    </style>

    <section class="content-header no-print">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Dental Lab Order Details')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-outline-secondary btn-sm mr-1" type="button" data-toggle="collapse"
                        data-target="#printSettings" aria-expanded="false">
                        <i class="fas fa-cog"></i> @lang('Print Settings')
                    </button>
                    <a href="{{ route('dental_lab_orders.index') }}" class="btn btn-outline-primary btn-sm">
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
                                            value="{{ $pageSettings['font_size'] ?? 14 }}" placeholder="14">
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
                                            value="{{ $pageSettings['margin_top'] ?? 0 }}" placeholder="0">
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
                                            value="{{ $pageSettings['margin_left'] ?? 0 }}" placeholder="0">
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
                        <div id="print-area" class="card-body">
                            <!-- Removed p-5 to allow inner containers to handle padding if needed, or keep standard -->
                            @php
                                $showHeader = isset($pageSettings['show_header'])
                                    ? $pageSettings['show_header'] === true ||
                                        $pageSettings['show_header'] === 'true' ||
                                        $pageSettings['show_header'] === 1 ||
                                        $pageSettings['show_header'] === '1'
                                    : true;
                                $marginTop = $pageSettings['margin_top'] ?? 0;
                                $marginLeft = $pageSettings['margin_left'] ?? 0;
                            @endphp

                            <!-- Main Container: fixed width to match the form design from create.blade.php -->
                            <div id="lab-order-container"
                                style="padding-top: {{ $marginTop }}mm !important; padding-left: {{ $marginLeft }}mm !important; width: 700px; margin: auto;">

                                <!-- Header Info -->
                                <div id="companyInfoBox" class="clinic-header {{ $showHeader ? '' : 'd-none' }}">
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

                                <table class="info-table">
                                    <tr>
                                        <td><strong>@lang('Patient'):</strong>
                                            {{ $dentalLabOrder->patient->name ?? ($dentalLabOrder->patient->user->name ?? 'N/A') }}
                                        </td>
                                        <td><strong>@lang('MRN#'):</strong>
                                            {{ $dentalLabOrder->patient->patientDetails->mrn_number ?? ($dentalLabOrder->patient->mrn_number ?? '-') }}
                                        </td>
                                        <td><strong>@lang('Date'):</strong>
                                            {{ $dentalLabOrder->sending_date ? date('d M Y', strtotime($dentalLabOrder->sending_date)) : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>@lang('Doctor'):</strong>
                                            {{ $dentalLabOrder->doctor->user->name ?? 'N/A' }}</td>
                                        <td><strong>@lang('Lab'):</strong> {{ $dentalLabOrder->lab->title ?? 'N/A' }}
                                        </td>
                                        <td><strong>@lang('Return Date'):</strong>
                                            {{ $dentalLabOrder->returning_date ? date('d M Y', strtotime($dentalLabOrder->returning_date)) : '-' }}
                                        </td>
                                    </tr>
                                </table>
                                <!-- End Header / Info Section -->
                                <div class="row col-12 m-0 p-0 mt-1">
                                    <div class="col-6 m-0 p-0 border border-dark">
                                        <div class="section-heading">
                                            ZIRCONIA</div>
                                        <div class="col pl-0 checkbox-container">
                                            <div class="row m-0">
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>MONO</p>
                                                        @if ($dentalLabOrder->zirconia_mono == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Non Pre Veneers</p>
                                                        @if ($dentalLabOrder->zirconia_non_pre_veneers == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>LAYERED</p>
                                                        @if ($dentalLabOrder->zirconia_layered == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Veneers</p>
                                                        @if ($dentalLabOrder->zirconia_veneers == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Crown</p>
                                                        @if ($dentalLabOrder->zirconia_crown == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Bridges</p>
                                                        @if ($dentalLabOrder->zirconia_bridges == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 m-0 p-0 border border-dark border-left-0">
                                        <div class="col-12 p-0 m-0">
                                            <div class="row col-12 m-0 p-0 pt-0">
                                                <div class="section-heading">
                                                    SHADE</div>
                                                <div class="row col-12 p-1 m-0 justify-content-around">
                                                    <div class="col-4 m-0 p-0">
                                                        <table class="table" style="margin-bottom: 0;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-top: none; border-left: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_main_1 ?? '' }}
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-top: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_left_1_1 ?? '' }}
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center; min-width:22px !important; border: 1px dotted black; border-top: none; border-right: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_left_1_2 ?? '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-left: none;"
                                                                        class="p-0 text-center align-content-center">
                                                                        <span
                                                                            style="position:absolute;left:-17px;top:35px; font-size: 10px;"
                                                                            id="span_shade_left_1_3a">D</span><input
                                                                            type="text"
                                                                            style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                            class="form-control px-0" id="shade_left_1_3a"
                                                                            name="shade_left_1_3a"
                                                                            value="{{ $dentalLabOrder->shade_left_1_3a ?? '' }}"
                                                                            readonly>
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_left_1_3 ?? '' }}

                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center; min-width:22px !important; border: 1px dotted black; border-right: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_right_1_1 ?? '' }}

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; border-left: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_right_1_2 ?? '' }}
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; "
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_right_1_3 ?? '' }}
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center; min-width:22px !important; border: 1px dotted black; border-bottom: none; border-right: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_right_2_4 ?? '' }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-4 m-0 p-0">
                                                        <table class="table" style="margin-bottom: 0;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-top: none; border-left: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_main_2 ?? '' }}
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-top: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_left_2_1 ?? '' }}
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center;min-width:22px !important; border: 1px dotted black; border-top: none; border-right: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_left_2_2 ?? '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-left: none;"
                                                                        class="p-0 text-center align-content-center">
                                                                        <span id="span_shade_left_2_3a"
                                                                            style="position:absolute;left:-8px;top:35px; font-size: 10px;">M</span><input
                                                                            type="text"
                                                                            style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                            class="form-control px-0" id="shade_left_2_3a"
                                                                            name="shade_left_2_3a"
                                                                            value="{{ $dentalLabOrder->shade_left_2_3a ?? '' }}"
                                                                            readonly>
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_left_2_3 ?? '' }}

                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center;min-width:22px !important; border: 1px dotted black; border-right: none;"
                                                                        class="p-0 text-center align-content-center">
                                                                        <span id="span_shade_left_2_3b"
                                                                            style="position:absolute;right:-20px;top:35px; font-size: 10px;">D</span><input
                                                                            type="text"
                                                                            style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                            class="form-control px-0" id="shade_left_2_3b"
                                                                            name="shade_left_2_3b"
                                                                            value="{{ $dentalLabOrder->shade_left_2_3b ?? '' }}"
                                                                            readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; border-left: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_right_2_1 ?? '' }}
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; "
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_right_2_2 ?? '' }}
                                                                    </td>
                                                                    <td style="width: 22px; height:22px; text-align: center;min-width:22px !important; border: 1px dotted black; border-bottom: none; border-right: none;"
                                                                        class="p-0">
                                                                        {{ $dentalLabOrder->shade_right_2_3 ?? '' }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 m-0 p-2" style="position: relative; bottom: 8px;">
                                                <table class="table table-bordered border-dark" style="margin-bottom: 0;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                8
                                                                <input type="checkbox" name="shade_d_top_8"
                                                                    selected-color="" id="shade_d_top_8"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_top_8 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_top_8) ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                7
                                                                <input type="checkbox" name="shade_d_top_7"
                                                                    selected-color="" id="shade_d_top_7"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_top_7 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_top_7) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                6
                                                                <input type="checkbox" name="shade_d_top_6"
                                                                    selected-color="" id="shade_d_top_6"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_top_6 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_top_6) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                5
                                                                <input type="checkbox" name="shade_d_top_5"
                                                                    selected-color="" id="shade_d_top_5"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_top_5 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_top_5) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                4
                                                                <input type="checkbox" name="shade_d_top_4"
                                                                    selected-color="" id="shade_d_top_4"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_top_4 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_top_4) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                3
                                                                <input type="checkbox" name="shade_d_top_3"
                                                                    selected-color="" id="shade_d_top_3"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_top_3 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_top_3) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                2
                                                                <input type="checkbox" name="shade_d_top_2"
                                                                    selected-color="" id="shade_d_top_2"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_top_2 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_top_2) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                1
                                                                <input type="checkbox" name="shade_d_top_1"
                                                                    selected-color="" id="shade_d_top_1"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_top_1 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_top_1) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                1
                                                                <input type="checkbox" name="shade_d_bottom_1"
                                                                    selected-color="" id="shade_d_bottom_1"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_bottom_1 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_bottom_1) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                2
                                                                <input type="checkbox" name="shade_d_bottom_2"
                                                                    selected-color="" id="shade_d_bottom_2"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_bottom_2 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_bottom_2) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                3
                                                                <input type="checkbox" name="shade_d_bottom_3"
                                                                    selected-color="" id="shade_d_bottom_3"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_bottom_3 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_bottom_3) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                4
                                                                <input type="checkbox" name="shade_d_bottom_4"
                                                                    selected-color="" id="shade_d_bottom_4"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_bottom_4 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_bottom_4) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                5
                                                                <input type="checkbox" name="shade_d_bottom_5"
                                                                    selected-color="" id="shade_d_bottom_5"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_bottom_5 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_bottom_5) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                6
                                                                <input type="checkbox" name="shade_d_bottom_6"
                                                                    selected-color="" id="shade_d_bottom_6"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_bottom_6 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_bottom_6) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                7
                                                                <input type="checkbox" name="shade_d_bottom_7"
                                                                    selected-color="" id="shade_d_bottom_7"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_bottom_7 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_bottom_7) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 33px; min-width:0px;">8
                                                                <input type="checkbox" name="shade_d_bottom_8"
                                                                    selected-color="" id="shade_d_bottom_8"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_d_bottom_8 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_d_bottom_8) ? 'checked' : '' }}>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                8
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_top_8" id="shade_m_top_8"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_top_8 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_top_8) ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                7
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_top_7" id="shade_m_top_7"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_top_7 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_top_7) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                6
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_top_6" id="shade_m_top_6"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_top_6 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_top_6) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                5
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_top_5" id="shade_m_top_5"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_top_5 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_top_5) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                4
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_top_4" id="shade_m_top_4"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_top_4 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_top_4) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                3
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_top_3" id="shade_m_top_3"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_top_3 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_top_3) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                2
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_top_2" id="shade_m_top_2"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_top_2 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_top_2) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                1
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_top_1" id="shade_m_top_1"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_top_1 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_top_1) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                1
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_bottom_1" id="shade_m_bottom_1"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_bottom_1 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_bottom_1) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                2
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_bottom_2" id="shade_m_bottom_2"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_bottom_2 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_bottom_2) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                3
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_bottom_3" id="shade_m_bottom_3"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_bottom_3 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_bottom_3) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                4
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_bottom_4" id="shade_m_bottom_4"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_bottom_4 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_bottom_4) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                5
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_bottom_5" id="shade_m_bottom_5"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_bottom_5 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_bottom_5) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                6
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_bottom_6" id="shade_m_bottom_6"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_bottom_6 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_bottom_6) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                7
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_bottom_7" id="shade_m_bottom_7"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_bottom_7 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_bottom_7) ? 'checked' : '' }}>

                                                            </td>
                                                            <td class="p-0 text-center"
                                                                style="width: 33px; min-width:0px;">8
                                                                <input type="checkbox" selected-color=""
                                                                    name="shade_m_bottom_8" id="shade_m_bottom_8"
                                                                    style="padding: 0px; margin:0px; width: 12px; height: 12px;"
                                                                    data-saved-color="{{ $dentalLabOrder->shade_m_bottom_8 ?? '' }}"
                                                                    disabled
                                                                    {{ !empty($dentalLabOrder->shade_m_bottom_8) ? 'checked' : '' }}>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-12 m-0 p-0">
                                    <div class="col-6 m-0 p-0 border border-dark border-top-0">
                                        <div class="section-heading">
                                            E-MAX</div>
                                        <div class="col pl-0 checkbox-container">
                                            <div class="row m-0">
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>MILLED</p>
                                                        @if ($dentalLabOrder->e_max_milled == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Non Pre Veneers</p>
                                                        @if ($dentalLabOrder->e_max_non_pre_veneers == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>PRESSED</p>
                                                        @if ($dentalLabOrder->e_max_pressed == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Veneers</p>
                                                        @if ($dentalLabOrder->e_max_veneers == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Crown</p>
                                                        @if ($dentalLabOrder->e_max_crown == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Bridges</p>
                                                        @if ($dentalLabOrder->e_max_bridges == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 m-0 p-0 border border-dark border-left-0 border-top-0">
                                        <div class="section-heading">
                                            PEEK</div>
                                        <div class="col pl-0 checkbox-container">
                                            <div class="row m-0">
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Removable Partial Denture</p>
                                                        @if ($dentalLabOrder->peek_removable_partial_denture == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Fixed Prosthetic Framework</p>
                                                        @if ($dentalLabOrder->peek_fixed_prosthetic_framework == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Attachment Restorations</p>
                                                        @if ($dentalLabOrder->peek_attachment_restorations == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Screw</p>
                                                        @if ($dentalLabOrder->peek_screw == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Retained</p>
                                                        @if ($dentalLabOrder->peek_retained == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Implant</p>
                                                        @if ($dentalLabOrder->peek_implant == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Supported</p>
                                                        @if ($dentalLabOrder->peek_supported == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Superstructures</p>
                                                        @if ($dentalLabOrder->peek_superstructures == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 m-0 p-0 border border-dark border-top-0">
                                        <div class="section-heading">
                                            PFM</div>
                                        <div class="col pl-0 checkbox-container">
                                            <div class="row m-0">
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>PORCELAIN</p>
                                                        @if ($dentalLabOrder->pfm_porcelain == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Implant</p>
                                                        @if ($dentalLabOrder->pfm_implant == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>NON-PRES</p>
                                                        @if ($dentalLabOrder->pfm_non_pres == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Post & Core</p>
                                                        @if ($dentalLabOrder->pfm_post_and_core == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Crown</p>
                                                        @if ($dentalLabOrder->pfm_crown == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Bridges</p>
                                                        @if ($dentalLabOrder->pfm_bridges == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 m-0 p-0 border border-dark border-left-0 border-top-0">
                                        <div class="section-heading">
                                            REMOVEABLE PROSTHETICS</div>
                                        <div class="col pl-0 checkbox-container">
                                            <div class="row m-0">
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Diagnostic Wax-up</p>
                                                        @if ($dentalLabOrder->removable_diagnostic_wax_up == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Flexible</p>
                                                        @if ($dentalLabOrder->removable_flexible == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Hybrid Denture</p>
                                                        @if ($dentalLabOrder->removable_hybrid_denture == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col pl-0 checkbox-container">
                                            <div class="row m-0">
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Veneers</p>
                                                        @if ($dentalLabOrder->removable_veneers == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Tooth Addition</p>
                                                        @if ($dentalLabOrder->removable_tooth_addition == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Crown</p>
                                                        @if ($dentalLabOrder->removable_crown == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Over Denture</p>
                                                        @if ($dentalLabOrder->removable_over_denture == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Bridges</p>
                                                        @if ($dentalLabOrder->removable_bridges == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Relining hard/soft</p>
                                                        @if ($dentalLabOrder->removable_relining_hard_soft == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- Bottom row moved into Flow -->
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Screw</p>
                                                        @if ($dentalLabOrder->removable_screw == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Retained</p>
                                                        @if ($dentalLabOrder->removable_retained == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6 checkbox-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p>Implant</p>
                                                        @if ($dentalLabOrder->removable_implant == 1)
                                                            <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                style="font-size: 10px;"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-12 m-0 p-0">
                                        <div class="col-6 m-0 p-0 border border-dark border-top-0">
                                            <div class="section-heading">
                                                ITEMS SENDING</div>
                                            <div class="col pl-0 checkbox-container">
                                                <div class="row m-0">
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Imp</p>
                                                            @if ($dentalLabOrder->items_imp == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Bite</p>
                                                            @if ($dentalLabOrder->items_bite == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Partial</p>
                                                            @if ($dentalLabOrder->items_partial == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Photo</p>
                                                            @if ($dentalLabOrder->items_photo == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Digital Impression</p>
                                                            @if ($dentalLabOrder->items_digital_impression == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Study Models</p>
                                                            @if ($dentalLabOrder->items_study_models == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Shade Tab</p>
                                                            @if ($dentalLabOrder->items_shade_tab == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-12 checkbox-item d-flex align-items-center">
                                                        <p>Further</p>
                                                        <div class="d-flex align-items-center flex-grow-1 ml-2">
                                                            {{ $dentalLabOrder->items_furthers ?? '' }}
                                                            @if ($dentalLabOrder->items_further == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-6 m-0 p-0 border border-dark border-left-0 border-top-0">
                                            <div class="section-heading">
                                                REMOVEABLE APPLIANCE</div>
                                            <div class="col pl-0 checkbox-container">
                                                <div class="row m-0">
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Ortho</p>
                                                            @if ($dentalLabOrder->appliance_ortho == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Night Guard</p>
                                                            @if ($dentalLabOrder->appliance_night_guard == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Retainer</p>
                                                            @if ($dentalLabOrder->appliance_retainer == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Occlusal Splint</p>
                                                            @if ($dentalLabOrder->appliance_occlusal_splint == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Wire</p>
                                                            @if ($dentalLabOrder->appliance_wire == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Sheet Press Retainer</p>
                                                            @if ($dentalLabOrder->appliance_sheet_press_retainer == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Hyrax</p>
                                                            @if ($dentalLabOrder->appliance_hyrax == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Obturator</p>
                                                            @if ($dentalLabOrder->appliance_obturator == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>TPA</p>
                                                            @if ($dentalLabOrder->appliance_tpa == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 checkbox-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p>Space Maintainer</p>
                                                            @if ($dentalLabOrder->appliance_space_maintainer == 1)
                                                                <i class="fas fa-check shadow-sm bg-white rounded-circle p-1"
                                                                    style="font-size: 10px;"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2 p-0">
                                    <span style="font-size: 12px; font-weight: bold;">Further Instructions:</span>
                                    <div class="p-2 border rounded bg-white"
                                        style="width: 100%; min-height: 30px; font-size: 12px;">
                                        {{ $dentalLabOrder->further_instructions ?? 'N/A' }}</div>
                                </div>

                                <div class="col-12 mt-2 p-0">
                                    <span style="font-size: 12px; font-weight: bold;">Lab Details:</span>
                                    <div class="p-2 border rounded bg-white"
                                        style="width: 100%; min-height: 30px; font-size: 12px;">
                                        {{ $dentalLabOrder->instructions_from_lab ?? 'N/A' }}</div>
                                </div>

                            </div> <!-- End of #lab-order-container -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('footer')
            <script>
                document.addEventListener('DOMContentLoaded', function() {

                    // 3. Print Functionality
                    $(document).ready(function() {
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
                            $('#lab-order-container').css('margin-top', val + 'mm');
                        });

                        $('#marginLeft').on('input change', function() {
                            const val = $(this).val() || 0;
                            $('#lab-order-container').css('margin-left', val + 'mm');
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
                                font_size: $('#fontSize').val(),
                                page_name: "dental_lab_order_show"
                            };

                            $.ajax({
                                url: "{{ route('general.defaults') }}",
                                method: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    settings: settings
                                },
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
                    });
                });
            </script>
        @endpush
    @endsection
