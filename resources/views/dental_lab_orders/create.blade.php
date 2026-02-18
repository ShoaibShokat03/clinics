@extends('layouts.layout')

@section('content')
    <style>
        .w-4 {
            width: 4%;
        }

        span {
            font-size: 12px;
        }

        input[type="checkbox"] {
            cursor: pointer;
            width: 14px;
            height: 14px;
            margin-left: 4px;
            flex-shrink: 0;
        }

        input[type="checkbox"]:hover {
            transform: scale(1.15);
            transition: all 0.2s ease;
        }

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
        }

        select.form-control {
            padding: 4px 6px;
            height: 28px;
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
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">@lang('Add Dental Lab Order')</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('dental_lab_orders.index') }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-eye"></i> @lang('View Orders')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-5">
                            <div class="px-3 p-1" id="do-not-change">
                                <section class="my-0 pb-1"
                                    style="font-size: 12px; width: 700px; margin: auto; overflow: hidden;">
                                    {{-- <div class="row col-12 m-0 p-0 text-center">
                                        <h3 style="font-style: italic; font-weight: bold; width: 100%;">
                                            @if (isset($ApplicationSetting) && !is_null($ApplicationSetting->item_name))
                                                {{ $ApplicationSetting->item_name }}
                                            @else
                                                INNOVATIVE DENTAL LAB
                                            @endif
                                        </h3>
                                    </div> --}}

                                    <form id="dentalLabOrderForm" class="form-material form-horizontal bg-custom"
                                        action="{{ route('dental_lab_orders.store') }}" method="POST"
                                        enctype="multipart/form-data" data-parsley-validate>
                                        @csrf
                                        <div class="row col-12 m-0 p-3 mt-1">
                                            <div class="row m-0 p-2 w-100">
                                                <div class="col-6 m-0 my-1 p-0 d-flex align-items-center">
                                                    <span
                                                        style="font-size: 12px; font-weight: bold; min-width: 100px;">Doctor
                                                        Name:</span>
                                                    <div style="flex: 1; padding-inline: 8px;">
                                                        <select class="form-control select2" name="doctor_id">
                                                            <option value="" disabled selected>Select Doctor</option>
                                                            @foreach ($doctors as $doctor)
                                                                @if ($doctor->user && $doctor->user->name)
                                                                    <option value="{{ $doctor->id }}">
                                                                        {{ $doctor->user->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6 m-0 my-1 p-0 d-flex align-items-center">
                                                    <span
                                                        style="font-size: 12px; font-weight: bold; min-width: 100px;">Patient
                                                        Name:</span>
                                                    <div style="flex: 1; padding-inline: 8px;">
                                                        <select class="form-control select2" name="patient_id">
                                                            <option value="" disabled selected>Select Patient</option>
                                                            @foreach ($patients->sortBy(fn($p) => strtolower($p->user->name ?? '')) as $p)
                                                                <option value="{{ $p->id }}">
                                                                    {{ ($p->user->name ?? '') . ' - ' . ($p->mrn_number ?? '') }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6 m-0 my-1 p-0 d-flex align-items-center">
                                                    <span style="font-size: 12px; font-weight: bold; min-width: 100px;">Lab
                                                        Name:</span>
                                                    <div style="flex: 1; padding-inline: 8px;">
                                                        <select class="form-control" id="lab_id" name="lab_id">
                                                            <option value="" disabled selected>Select Laboratoris
                                                            </option>
                                                            @foreach ($labs as $lab)
                                                                <option value="{{ $lab->id }}"
                                                                    data-name="{{ $lab->title ?? '' }}"
                                                                    data-address="{{ $lab->address ?? '' }}"
                                                                    data-phone="{{ $lab->phone_no ?? '' }}">
                                                                    {{ $lab->title ?? ' ' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6 m-0 my-1 p-0 d-flex align-items-center">
                                                    <span
                                                        style="font-size: 12px; font-weight: bold; min-width: 100px;">Sending
                                                        Date:</span>
                                                    <div style="flex: 1; padding-inline: 8px;">
                                                        <input type="date" name="sending_date" class="form-control"
                                                            id="sending_date">
                                                    </div>
                                                </div>

                                                <div class="col-6 m-0 my-1 p-0 d-flex align-items-center">
                                                    <span
                                                        style="font-size: 12px; font-weight: bold; min-width: 100px;">Returning
                                                        Date:</span>
                                                    <div style="flex: 1; padding-inline: 8px;">
                                                        <input type="date" name="returning_date" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6 m-0 my-1 p-0 d-flex align-items-center">
                                                    <span
                                                        style="font-size: 12px; font-weight: bold; min-width: 100px;">Time:</span>
                                                    <div style="flex: 1; padding-inline: 8px;">
                                                        <input type="time" name="time" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-12 m-0 p-0 mt-1">
                                            <div class="col-6 m-0 p-0 border border-dark">
                                                <div class="section-heading">
                                                    ZIRCONIA</div>
                                                <div class="col pl-0 checkbox-container">
                                                    <div class="row m-0">
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>MONO</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="zirconia_mono" id="zirconia_mono">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Non Pre Veneers</p>
                                                                <input type="checkbox" current-color="DarkCyan"
                                                                    name="zirconia_non_pre_veneers"
                                                                    id="zirconia_non_pre_veneers">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>LAYERED</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="zirconia_layered" id="zirconia_layered">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Veneers</p>
                                                                <input type="checkbox" current-color="DarkKhaki"
                                                                    name="zirconia_veneers" id="zirconia_veneers">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Crown</p>
                                                                <input type="checkbox" current-color="Aqua"
                                                                    name="zirconia_crown" id="zirconia_crown">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Bridges</p>
                                                                <input type="checkbox" current-color="Aquamarine"
                                                                    name="zirconia_bridges" id="zirconia_bridges">
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
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_main_1" name="shade_main_1">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-top: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_1_1"
                                                                                    name="shade_left_1_1">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; min-width:22px !important; border: 1px dotted black; border-top: none; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_1_2"
                                                                                    name="shade_left_1_2">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-left: none;"
                                                                                class="p-0 text-center align-content-center">
                                                                                <span
                                                                                    style="position:absolute;left:-12px;top:35px; font-size: 10px;"
                                                                                    id="span_shade_left_1_3a">D</span><input
                                                                                    type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_1_3a"
                                                                                    name="shade_left_1_3a">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_1_3"
                                                                                    name="shade_left_1_3">

                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; min-width:22px !important; border: 1px dotted black; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_1_1"
                                                                                    name="shade_right_1_1">

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; border-left: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_1_2"
                                                                                    name="shade_right_1_2">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; "
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_1_3"
                                                                                    name="shade_right_1_3">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; min-width:22px !important; border: 1px dotted black; border-bottom: none; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_2_4"
                                                                                    name="shade_right_2_4">
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
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_main_2" name="shade_main_2">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-top: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_1"
                                                                                    name="shade_left_2_1">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center;min-width:22px !important; border: 1px dotted black; border-top: none; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_2"
                                                                                    name="shade_left_2_2">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-left: none;"
                                                                                class="p-0 text-center align-content-center">
                                                                                <span id="span_shade_left_2_3a"
                                                                                    style="position:absolute;left:-8px;top:35px; font-size: 10px;">M</span><input
                                                                                    type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_3a"
                                                                                    name="shade_left_2_3a">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_3"
                                                                                    name="shade_left_2_3">

                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center;min-width:22px !important; border: 1px dotted black; border-right: none;"
                                                                                class="p-0 text-center align-content-center">
                                                                                <span id="span_shade_left_2_3b"
                                                                                    style="position:absolute;right:-20px;top:35px; font-size: 10px;">D</span><input
                                                                                    type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_3b"
                                                                                    name="shade_left_2_3b">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; border-left: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_2_1"
                                                                                    name="shade_right_2_1">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; "
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_2_2"
                                                                                    name="shade_right_2_2">
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center;min-width:22px !important; border: 1px dotted black; border-bottom: none; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_2_3"
                                                                                    name="shade_right_2_3">
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 m-0 p-2" style="position: relative; bottom: 8px;">
                                                        <table class="table table-bordered border-dark"
                                                            style="margin-bottom: 0;">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        8
                                                                        <input type="checkbox" name="shade_d_top_8"
                                                                            selected-color="" id="shade_d_top_8"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">
                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        7
                                                                        <input type="checkbox" name="shade_d_top_7"
                                                                            selected-color="" id="shade_d_top_7"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        6
                                                                        <input type="checkbox" name="shade_d_top_6"
                                                                            selected-color="" id="shade_d_top_6"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        5
                                                                        <input type="checkbox" name="shade_d_top_5"
                                                                            selected-color="" id="shade_d_top_5"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        4
                                                                        <input type="checkbox" name="shade_d_top_4"
                                                                            selected-color="" id="shade_d_top_4"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        3
                                                                        <input type="checkbox" name="shade_d_top_3"
                                                                            selected-color="" id="shade_d_top_3"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        2
                                                                        <input type="checkbox" name="shade_d_top_2"
                                                                            selected-color="" id="shade_d_top_2"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        1
                                                                        <input type="checkbox" name="shade_d_top_1"
                                                                            selected-color="" id="shade_d_top_1"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        1
                                                                        <input type="checkbox" name="shade_d_bottom_1"
                                                                            selected-color="" id="shade_d_bottom_1"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        2
                                                                        <input type="checkbox" name="shade_d_bottom_2"
                                                                            selected-color="" id="shade_d_bottom_2"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        3
                                                                        <input type="checkbox" name="shade_d_bottom_3"
                                                                            selected-color="" id="shade_d_bottom_3"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        4
                                                                        <input type="checkbox" name="shade_d_bottom_4"
                                                                            selected-color="" id="shade_d_bottom_4"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        5
                                                                        <input type="checkbox" name="shade_d_bottom_5"
                                                                            selected-color="" id="shade_d_bottom_5"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        6
                                                                        <input type="checkbox" name="shade_d_bottom_6"
                                                                            selected-color="" id="shade_d_bottom_6"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        7
                                                                        <input type="checkbox" name="shade_d_bottom_7"
                                                                            selected-color="" id="shade_d_bottom_7"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 33px; min-width:0px;">8
                                                                        <input type="checkbox" name="shade_d_bottom_8"
                                                                            selected-color="" id="shade_d_bottom_8"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        8
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_top_8" id="shade_m_top_8"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">
                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        7
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_top_7" id="shade_m_top_7"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        6
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_top_6" id="shade_m_top_6"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        5
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_top_5" id="shade_m_top_5"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        4
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_top_4" id="shade_m_top_4"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        3
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_top_3" id="shade_m_top_3"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        2
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_top_2" id="shade_m_top_2"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        1
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_top_1" id="shade_m_top_1"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        1
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_bottom_1" id="shade_m_bottom_1"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        2
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_bottom_2" id="shade_m_bottom_2"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        3
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_bottom_3" id="shade_m_bottom_3"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        4
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_bottom_4" id="shade_m_bottom_4"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        5
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_bottom_5" id="shade_m_bottom_5"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        6
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_bottom_6" id="shade_m_bottom_6"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 24px; font-size: 10px; padding: 2px !important;">
                                                                        7
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_bottom_7" id="shade_m_bottom_7"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

                                                                    </td>
                                                                    <td class="p-0 text-center"
                                                                        style="width: 33px; min-width:0px;">8
                                                                        <input type="checkbox" selected-color=""
                                                                            name="shade_m_bottom_8" id="shade_m_bottom_8"
                                                                            style="padding: 0px; margin:0px; width: 12px; height: 12px;">

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
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="e_max_milled" id="e_max_milled">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Non Pre Veneers</p>
                                                                <input type="checkbox" current-color="yellow"
                                                                    name="e_max_non_pre_veneers"
                                                                    id="e_max_non_pre_veneers">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>PRESSED</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="e_max_pressed" id="e_max_pressed">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Veneers</p>
                                                                <input type="checkbox" current-color="purple"
                                                                    name="e_max_veneers" id="e_max_veneers">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Crown</p>
                                                                <input type="checkbox" current-color="orange"
                                                                    name="e_max_crown" id="e_max_crown">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Bridges</p>
                                                                <input type="checkbox" current-color="pink"
                                                                    name="e_max_bridges" id="e_max_bridges">
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
                                                                <input type="checkbox"
                                                                    name="peek_removable_partial_denture"
                                                                    id="peek_removable_partial_denture">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Fixed Prosthetic Framework</p>
                                                                <input type="checkbox"
                                                                    name="peek_fixed_prosthetic_framework"
                                                                    id="peek_fixed_prosthetic_framework">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Attachment Restorations</p>
                                                                <input type="checkbox" name="peek_attachment_restorations"
                                                                    id="peek_attachment_restorations">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Screw</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="peek_screw" id="peek_screw">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Retained</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="peek_retained" id="peek_retained">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Implant</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="peek_implant" id="peek_implant">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Supported</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="peek_supported" id="peek_supported">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Superstructures</p>
                                                                <input type="checkbox" name="peek_superstructures"
                                                                    id="peek_superstructures">
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
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="pfm_porcelain" id="pfm_porcelain">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Implant</p>
                                                                <input type="checkbox" current-color="HotPink"
                                                                    name="pfm_implant" id="pfm_implant">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>NON-PRES</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="pfm_non_pres" id="pfm_non_pres">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Post & Core</p>
                                                                <input type="checkbox" current-color="LightBlue"
                                                                    name="pfm_post_and_core" id="pfm_post_and_core">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Crown</p>
                                                                <input type="checkbox" current-color="gray"
                                                                    name="pfm_crown" id="pfm_crown">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Bridges</p>
                                                                <input type="checkbox" current-color="LightSalmon"
                                                                    name="pfm_bridges" id="pfm_bridges">
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
                                                                <input type="checkbox" name="removable_diagnostic_wax_up"
                                                                    id="removable_diagnostic_wax_up">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Flexible</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="removable_flexible" id="removable_flexible">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Hybrid Denture</p>
                                                                <input type="checkbox" name="removable_hybrid_denture"
                                                                    id="removable_hybrid_denture">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col pl-0 checkbox-container">
                                                    <div class="row m-0">
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Veneers</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="removable_veneers" id="removable_veneers">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Tooth Addition</p>
                                                                <input type="checkbox" name="removable_tooth_addition"
                                                                    id="removable_tooth_addition">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Crown</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="removable_crown" id="removable_crown">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Over Denture</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="removable_over_denture"
                                                                    id="removable_over_denture">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Bridges</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="removable_bridges" id="removable_bridges">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Relining hard/soft</p>
                                                                <input type="checkbox" name="removable_relining_hard_soft"
                                                                    id="removable_relining_hard_soft">
                                                            </div>
                                                        </div>
                                                        <!-- Bottom row moved into Flow -->
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Screw</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="removable_screw" id="removable_screw">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Retained</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="removable_retained" id="removable_retained">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 checkbox-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p>Implant</p>
                                                                <input type="checkbox" current-color="nocolor"
                                                                    name="removable_implant" id="removable_implant">
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
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Imp</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="items_imp" id="items_imp">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Bite</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="items_bite" id="items_bite">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Partial</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="items_partial" id="items_partial">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Photo</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="items_photo" id="items_photo">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Digital Impression</p>
                                                                    <input type="checkbox" name="items_digital_impression"
                                                                        id="items_digital_impression">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Study Models</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="items_study_models" id="items_study_models">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Shade Tab</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="items_shade_tab" id="items_shade_tab">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 checkbox-item d-flex align-items-center">
                                                                <p>Further</p>
                                                                <div class="d-flex align-items-center flex-grow-1 ml-2">
                                                                    <input type="text"
                                                                        style="height:20px; font-size: 10px;"
                                                                        class="form-control px-1 w-100 mr-1"
                                                                        name="items_furthers">
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="items_further" id="items_further">
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
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Ortho</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="appliance_ortho" id="appliance_ortho">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Night Guard</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="appliance_night_guard"
                                                                        id="appliance_night_guard">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Retainer</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="appliance_retainer" id="appliance_retainer">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Occlusal Splint</p>
                                                                    <input type="checkbox"
                                                                        name="appliance_occlusal_splint"
                                                                        id="appliance_occlusal_splint">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Wire</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="appliance_wire" id="appliance_wire">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Sheet Press Retainer</p>
                                                                    <input type="checkbox"
                                                                        name="appliance_sheet_press_retainer"
                                                                        id="appliance_sheet_press_retainer">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Hyrax</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="appliance_hyrax" id="appliance_hyrax">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Obturator</p>
                                                                    <input type="checkbox" name="appliance_obturator"
                                                                        id="appliance_obturator">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>TPA</p>
                                                                    <input type="checkbox" current-color="nocolor"
                                                                        name="appliance_tpa" id="appliance_tpa">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 checkbox-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p>Space Maintainer</p>
                                                                    <input type="checkbox"
                                                                        name="appliance_space_maintainer"
                                                                        id="appliance_space_maintainer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2 p-0">
                                            <span style="font-size: 12px; font-weight: bold;">Further
                                                Instructions:</span><br>
                                            <div style="width: 100%;">
                                                <textarea placeholder="Other Details" name="further_instructions" id="further_instructions"
                                                    style="width: 100%; padding: 5px; margin: 0; margin-bottom: 5px; font-size: 12px;" rows="2"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2 p-0">
                                            <span style="font-size: 12px; font-weight: bold;">Lab Details:</span><br>
                                            <div style="width: 100%;">
                                                <textarea placeholder="Other Details" name="instructions_from_lab" id="instructions_from_lab"
                                                    style="width: 100%; padding: 5px; margin: 0; margin-bottom: 5px; font-size: 12px;" rows="2"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 text-right mt-2 mb-2">
                                            <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                                            <a href="{{ route('dental_lab_orders.index') }}"
                                                class="btn btn-secondary ml-2">@lang('Cancel')</a>
                                        </div>
                            </div>

                            </form>
                        </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize a variable to store the current selected color
        let colorSelect = "";

        // Get all the current-color checkboxes
        const currentColorCheckboxes = document.querySelectorAll('input[type="checkbox"][current-color]');
        console.log(currentColorCheckboxes);

        // Get all the selected-color checkboxes
        const selectedColorCheckboxes = document.querySelectorAll('input[selected-color]');

        // Disable all selected-color checkboxes initially
        selectedColorCheckboxes.forEach(selectedColorCheckbox => {
            //selectedColorCheckbox.disabled = true;
        });

        // Add event listeners to the current-color checkboxes
        currentColorCheckboxes.forEach(currentColorCheckbox => {
            currentColorCheckbox.addEventListener('click', function() {
                // Get the parent div
                const parentDiv = currentColorCheckbox.closest('div');

                // When a current-color checkbox is clicked, store its value in colorSelect
                colorSelect = currentColorCheckbox.getAttribute('current-color');
                console.log('colorSelect: ' + colorSelect);

                // Change or reset the background color of the parent div
                if (currentColorCheckbox.checked) {
                    parentDiv.style.backgroundColor = colorSelect; // Set background color
                } else {
                    parentDiv.style.backgroundColor = ''; // Reset background color to none
                }

                // Enable or disable all selected-color checkboxes based on selection
                if (colorSelect !== "" && currentColorCheckbox.checked) {
                    selectedColorCheckboxes.forEach(selectedColorCheckbox => {
                        //selectedColorCheckbox.disabled = false;
                    });
                } else {
                    selectedColorCheckboxes.forEach(selectedColorCheckbox => {
                        // selectedColorCheckbox.disabled = true;
                    });
                }
            });
        });

        $(document).ready(function() {
            // When the dropdown value changes
            $('#lab_id').on('change', function() {
                // Get the selected option
                var selectedOption = $(this).find(':selected');

                // Get data attributes
                var name = selectedOption.data('name');
                var address = selectedOption.data('address');
                var phone = selectedOption.data('phone');

                // Update the display area
                if (name) {
                    $('#selected-lab-info').show();
                    $('#lab-name-display').text(name);
                    $('#lab-phone-display').text(phone ? phone : '');
                    $('#lab-address-display').text(address ? address : '');
                } else {
                    $('#selected-lab-info').hide();
                }
            });
        });

        // Add event listeners to the selected-color checkboxes
        selectedColorCheckboxes.forEach(selectedColorCheckbox => {
            selectedColorCheckbox.addEventListener('click', function(e) {
                console.log(selectedColorCheckbox.value);
                const parentTd = selectedColorCheckbox.closest(
                'td'); // Get the parent <td> element

                // Check if the checkbox is checked
                if (selectedColorCheckbox.checked) {
                    // Check if a color is selected
                    if (colorSelect === "") {
                        alert(
                            "Please select a material/shade color from the left options (Zirconia, E-MAX, etc.) first.");
                        e.preventDefault(); // Prevent checking
                        selectedColorCheckbox.checked = false;
                        return;
                    }

                    // When a selected-color checkbox is clicked and checked, set its 'selected-color' attribute to colorSelect
                    selectedColorCheckbox.setAttribute('selected-color', colorSelect);
                    selectedColorCheckbox.setAttribute('value', colorSelect);

                    // Apply the background color to the parent <td>
                    parentTd.style.backgroundColor = colorSelect;
                    console.log('Background color applied to td:', parentTd);
                } else {
                    // When the checkbox is unchecked, reset its 'selected-color' attribute
                    selectedColorCheckbox.setAttribute('selected-color', '');
                    selectedColorCheckbox.setAttribute('value', '');

                    // Reset the background color of the parent <td>
                    parentTd.style.backgroundColor = '';
                    console.log('Background color cleared from td:', parentTd);
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', (event) => {
        const sendingDateInput = document.getElementById('sending_date');
        if (sendingDateInput && !sendingDateInput.value) {
            sendingDateInput.value = new Date().toISOString().split('T')[0];
        }
    });
</script>
