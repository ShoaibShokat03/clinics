@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Invoice Payments')</h1>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">@lang('Payments')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3 border-bottom-0">
                        <h3 class="card-title font-weight-bold">@lang('Filter Payments')</h3>
                        <div class="card-tools">
                            <button class="btn btn-outline-secondary btn-sm" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> @lang('Filter')
                            </button>
                        </div>
                    </div>

                    <div id="filter" class="collapse @if(request()->filled('invoice_number') || request()->filled('patient_name') || request()->filled('payment_date') || request()->filled('start_date') || request()->filled('end_date')) show @endif">
                        <div class="card-body p-3 bg-light border-bottom">
                            <form action="" method="get" role="form" autocomplete="off">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Invoice Number')</label>
                                            <input type="text" name="invoice_number" class="form-control form-control-sm"
                                                value="{{ request()->invoice_number }}" placeholder="@lang('Invoice Number')">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Patient Name')</label>
                                            <input type="text" name="patient_name" class="form-control form-control-sm"
                                                value="{{ request()->patient_name }}" placeholder="@lang('Patient Name')">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Start Date')</label>
                                            <input type="date" name="start_date" class="form-control form-control-sm"
                                                value="{{ request()->start_date }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('End Date')</label>
                                            <input type="date" name="end_date" class="form-control form-control-sm"
                                                value="{{ request()->end_date }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-right mt-4">
                                        <button type="submit" class="btn btn-primary btn-sm">@lang('Submit')</button>
                                        <a href="{{ route('invoice-payments.index') }}" class="btn btn-secondary btn-sm ml-2">@lang('Clear')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-striped" id="laravel_datatable">
                            <thead class="bg-light">
                                <tr>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Invoice #')</th>
                                    <th>@lang('Patient')</th>
                                    <th>@lang('Invoice Amount')</th>
                                    <th>@lang('Paid Amount')</th>
                                    <th>@lang('Remaining')</th>
                                    <th>@lang('Method')</th>
                                    <th>@lang('Notes')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ date(auth()->user()->company->date_format ?? 'Y-m-d', strtotime($payment->payment_date ?? $payment->created_at)) }}</td>
                                    <td>
                                        @if($payment->invoice)
                                        <a href="{{ route('invoices.show', $payment->invoice_id) }}">
                                            {{ $payment->invoice->invoice_number }}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if($payment->invoice && $payment->invoice->user)
                                        {{ $payment->invoice->user->name }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if($payment->invoice)
                                        {{ number_format($payment->invoice->grand_total, 2) }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{ number_format($payment->paid_amount, 2) }}</td>
                                    <td>
                                        @if($payment->invoice)
                                        {{ number_format($payment->invoice->due, 2) }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($payment->payment_type) }}</td>
                                    <td>{{ $payment->comments ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">@lang('Total')</th>
                                    <th>{{ number_format($totalInvoice, 2) }}</th>
                                    <th>{{ number_format($totalPaid, 2) }}</th>
                                    <th>{{ number_format($totalRemaining, 2) }}</th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="mt-3">
                            {{ $payments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection