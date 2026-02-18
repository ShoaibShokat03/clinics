@extends('layouts.layout')

@section('content')
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

    .tooth-card {
        margin-bottom: 20px;
        border: 1px solid #0066CC !important;
    }

    .tooth-header {
        background-color: #f0f7ff !important;
        border-bottom: 1px solid #0066CC !important;
        display: flex;
        align-items: center;
        padding: 8px 12px;
    }

    .tooth-issues-box {
        background-color: #fff;
        border-bottom: 1px solid #0066CC;
        padding: 10px;
        font-size: 13px;
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

        #treatment-container {
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
                <h1 class="m-0 text-dark">@lang('Treatment Plan Details')</h1>
            </div>
            <div class="col-sm-6 text-right">
                <button class="btn btn-outline-secondary btn-sm mr-1" type="button" data-toggle="collapse"
                    data-target="#printSettings" aria-expanded="false">
                    <i class="fas fa-cog"></i> @lang('Print Settings')
                </button>
                <a href="{{ route('patient-treatment-plans.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> @lang('Back to List')
                </a>
                @can('patient-treatment-plans-update')
                <a href="{{ route('patient-treatment-plans.edit', $patientTreatmentPlan->id) }}" class="btn btn-outline-warning btn-sm ml-2">
                    <i class="fas fa-edit"></i> @lang('Edit')
                </a>
                @endcan
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
                                        {{ ($pageSettings['show_header'] ?? true) ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-normal" for="showHeader">@lang('Show')</label>
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
                        @php
                        $showHeader = isset($pageSettings['show_header']) ? ($pageSettings['show_header'] === true || $pageSettings['show_header'] === 'true' || $pageSettings['show_header'] === 1 || $pageSettings['show_header'] === '1') : true;
                        $marginTop = $pageSettings['margin_top'] ?? 0;
                        $marginLeft = $pageSettings['margin_left'] ?? 0;
                        @endphp
                        <div class="treatment-plan" id="treatment-container" style="padding-top: {{ $marginTop }}mm !important; padding-left: {{ $marginLeft }}mm !important;">

                            <div id="companyInfoBox" class="clinic-header {{ $showHeader ? '' : 'd-none' }}">
                                <div class="clinic-logo-box">
                                    @if(isset($ApplicationSetting->logo) && !empty($ApplicationSetting->logo))
                                    <img src="{{ asset('public/'.$ApplicationSetting->logo) }}" alt="Logo" class="clinic-logo">
                                    @else
                                    <div class="p-3 bg-light rounded text-center" style="width: 80px; height: 80px; border: 2px dashed #ccc;">
                                        <i class="fas fa-hospital fa-2x text-muted mt-2"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="clinic-info">
                                    <h4>{{ $ApplicationSetting->item_name ?? 'Company Name' }}</h4>
                                    <p>{{ $ApplicationSetting->company_address ?? '' }}</p>
                                    <p>{{ $ApplicationSetting->company_email ?? '' }}</p>
                                    <p>{{ $ApplicationSetting->contact ?? '' }}</p>
                                </div>
                            </div>

                            <table class="info-table">
                                <tr>
                                    <td><strong>@lang('Patient'):</strong> {{ $patientTreatmentPlan->patient->name ?? '-' }}</td>
                                    <td><strong>@lang('MRN No'):</strong> {{ $patientTreatmentPlan->patient->patientDetails->mrn_number ?? '-' }}</td>
                                    <td><strong>@lang('Date'):</strong> {{ $patientTreatmentPlan->created_at ? \Carbon\Carbon::parse($patientTreatmentPlan->created_at)->format('d M Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>@lang('Doctor'):</strong> {{ $patientTreatmentPlan->doctor->name ?? '-' }}</td>
                                    <td><strong>@lang('Exam No'):</strong> {{ $patientTreatmentPlan->examinvestigation->examination_number ?? '-' }}</td>
                                    <td><strong>@lang('Plan No'):</strong> {{ $patientTreatmentPlan->treatment_plan_number }}</td>
                                </tr>
                                <tr>
                                    <td><strong>@lang('Age'):</strong> {{ $patientTreatmentPlan->patient->age ?? '-' }} @lang('Years')</td>
                                    <td><strong>@lang('Gender'):</strong> {{ $patientTreatmentPlan->patient->gender ?? '-' }}</td>
                                    <td><strong>@lang('Total Cost'):</strong> {{ $totalPrice }}</td>
                                </tr>
                            </table>

                            @foreach ($teeth as $tooth)
                            <div class="tooth-card">
                                <div class="tooth-header">
                                    <img src="{{ asset('assets/images/teeth/' . $tooth->tooth_number . '.png') }}"
                                        onerror="this.style.display='none'"
                                        style="max-height: 25px; max-width: 25px; margin-right: 10px;">
                                    <h6 class="m-0 font-weight-bold text-primary">@lang('Tooth') {{ $tooth->tooth_number }}</h6>
                                </div>
                                @if($tooth->toothIssues->count() > 0)
                                <div class="tooth-issues-box">
                                    @foreach ($tooth->toothIssues as $issue)
                                    <span class="mr-3">
                                        <strong>{{ $issue->tooth_issue }}</strong>{{ $issue->diagnosis ? ' ('.$issue->diagnosis->name.')' : '' }}:
                                        <span class="text-muted">{{ $issue->description }}</span>
                                    </span>
                                    @endforeach
                                </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%">@lang('Category')</th>
                                                <th style="width: 45%">@lang('Procedure')</th>
                                                <th style="width: 15%">@lang('Cost')</th>
                                                <th style="width: 15%">@lang('Status')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $procedures = $patientTreatmentPlanProcedures->where('tooth_number', $tooth->tooth_number); @endphp
                                            @forelse ($procedures as $planProcedure)
                                            <tr>
                                                <td style="text-align: left;">{{ $planProcedure->procedure->ddprocedurecategory->title ?? '-' }}</td>
                                                <td style="text-align: left;">{{ $planProcedure->procedure->title ?? '-' }}</td>
                                                <td>{{ $planProcedure->procedure->price ?? '-' }}</td>
                                                <td>
                                                    @if ($planProcedure->ready_to_start === 'yes' && $planProcedure->is_procedure_started === 'no')
                                                    <span class="text-info">@lang('Ready')</span>
                                                    @elseif ($planProcedure->is_procedure_started === 'yes' && $planProcedure->is_procedure_finished === 'no')
                                                    <span class="text-warning">@lang('Started')</span>
                                                    @elseif ($planProcedure->is_procedure_finished === 'yes')
                                                    <span class="text-success">@lang('Finished')</span>
                                                    @else
                                                    <span class="text-muted">@lang('Planned')</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-2 text-muted">@lang('No treatment procedures found.')</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach

                            @if ($allTeethProcedures->isNotEmpty())
                            <div class="tooth-card">
                                <div class="tooth-header">
                                    <i class="fas fa-teeth mr-2 text-primary"></i>
                                    <h6 class="m-0 font-weight-bold text-primary">@lang('Overall Treatment Procedures')</h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%">@lang('Category')</th>
                                                <th style="width: 45%">@lang('Procedure')</th>
                                                <th style="width: 15%">@lang('Cost')</th>
                                                <th style="width: 15%">@lang('Status')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allTeethProcedures as $planProcedure)
                                            <tr>
                                                <td style="text-align: left;">{{ $planProcedure->procedure->ddprocedurecategory->title ?? '-' }}</td>
                                                <td style="text-align: left;">{{ $planProcedure->procedure->title ?? '-' }}</td>
                                                <td>{{ $planProcedure->procedure->price ?? '-' }}</td>
                                                <td>
                                                    @if ($planProcedure->ready_to_start === 'yes' && $planProcedure->is_procedure_started === 'no')
                                                    <span class="text-info">@lang('Ready')</span>
                                                    @elseif ($planProcedure->is_procedure_started === 'yes' && $planProcedure->is_procedure_finished === 'no')
                                                    <span class="text-warning">@lang('Started')</span>
                                                    @elseif ($planProcedure->is_procedure_finished === 'yes')
                                                    <span class="text-success">@lang('Finished')</span>
                                                    @else
                                                    <span class="text-muted">@lang('Planned')</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif

                            @if($patientTreatmentPlan->comments)
                            <div class="mt-4">
                                <h6 class="font-weight-bold">@lang('Comments'):</h6>
                                <div class="p-2 border" style="min-height: 40px; font-size: 13px;">
                                    {{ $patientTreatmentPlan->comments }}
                                </div>
                            </div>
                            @endif

                            <div class="signature-box">
                                <div class="signature-line">
                                    <strong>@lang('Doctor Signature')</strong>
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
                $('#companyInfoBox').removeClass('d-none');
            } else {
                $('#companyInfoBox').addClass('d-none');
            }
        });

        // Adjust Margins
        $('#marginTop').on('input change', function() {
            const val = $(this).val() || 0;
            $('#treatment-container').css('margin-top', val + 'mm');
        });

        $('#marginLeft').on('input change', function() {
            const val = $(this).val() || 0;
            $('#treatment-container').css('margin-left', val + 'mm');
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
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> @lang("Saving...")');

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
                    page_name: "treatment_plan_show",
                    settings: settings
                }),
                success: function(response) {
                    btn.html('<i class="fas fa-check"></i> @lang("Saved")');
                    setTimeout(() => {
                        btn.prop('disabled', false).html(originalText);
                    }, 2000);
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html('<i class="fas fa-exclamation-triangle"></i> @lang("Error")');
                }
            });
        });

        // Ensure live settings are applied on load
        $('#treatment-container').css({
            'margin-top': '{{ $marginTop }}mm',
            'margin-left': '{{ $marginLeft }}mm',
            'padding': '20px'
        });
        $('#print-area *').css('font-size', '{{ $pageSettings["font_size"] ?? 14 }}px');
    });
</script>
@endpush
@endsection