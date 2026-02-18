@extends('layouts.layout')

@section('content')

    <section class="content-header">
        <?php //echo 'dadas'; ?>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">@lang('Report')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">@lang('Report')</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" target="_blank" href="{{ route('new-reports.index') }}?export=1"><i class="fas fa-cloud-download-alt"></i> @lang('Export')</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('new-reports.index') }}" method="get" class="bg-custom">
                        <div class="row border col-12 m-0 p-0">
                            <input type="hidden" name="isFilterActive" value="true">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>@lang('Date From')</label>
                                    <div class="form-group input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" name="date_from" id="date_from" class="form-control flatpickr" placeholder="@lang('Date From')" value="{{ old('date_from', request()->date_from) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>@lang('Date To')</label>
                                    <div class="form-group input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" name="date_to" id="date_to" class="form-control flatpickr" placeholder="@lang('Date To')" value="{{ old('date_to', request()->date_to) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>@lang('MRN Number')</label>
                                    <input type="text" name="mrn_number" class="form-control" value="{{ old('mrn_number', request()->mrn_number) }}" placeholder="@lang('MRN Number')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>@lang('Invoice Number')</label>
                                    <input type="text" name="invoice_number" class="form-control" value="{{ old('invoice_number', request()->invoice_number) }}" placeholder="@lang('Invoice Number')">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>@lang('Doctor')</label>
                                                <select name="doctor" class="form-control select2" id="doctor">
                                                    <option value="">--@lang('Select')--</option>
                                                    @foreach ($doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')) as $doctor)
                                                        <option value="{{ $doctor->id }}" {{ old('doctor_id', request()->doctor) == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                                    @endforeach
                                                </select>
                                    <!-- <input type="text" name="doctor" class="form-control" value="{{ old('doctor', request()->doctor) }}" placeholder="@lang('Doctor')"> -->
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>@lang('Patient')</label>
                                                <select name="patient" class="form-control select2" id="patient">
                                                    <option value="">--@lang('Select')--</option>
                                                    @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                        <option value="{{ $patient->id }}" {{ old('patient', request()->patient) == $patient->id ? 'selected' : '' }}>
                                                            {{ $patient->name }} - {{ $patient->patientDetails->mrn_number ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                </div>
                            </div>
                            <!-- <div class="col-sm-3">
                                <div class="form-group">
                                    <label>@lang('Procedure')</label>
                                    <select name="procedure" class="form-control">
                                        <option value="">@lang('Select Procedure')</option>
                                        @foreach ($procedures as $procedure)
                                            <option value="{{ $procedure->id }}" {{ request('procedure') == $procedure->id ? 'selected' : '' }}>
                                                {{ $procedure->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->


                            <div class="col-sm-2 align-content-center">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary mt-4">@lang('Submit')</button>
                                    @if (request()->has('isFilterActive'))
                                        <a href="{{ route('new-reports.index') }}"
    class="btn btn-secondary mt-4">@lang('Clear')</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    <br>
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">@lang('Reports')</h3>
                        </div>
                        <div class=" card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered custom-table">
                                    <thead>
                                        <tr>
                                            <th>@lang('MRN #')</th>
                                            <th>@lang('Patient')</th>
                                            <th>@lang('Invoice #')</th>
                                            <th>@lang('Doctor')</th>
                                            <th>@lang('Procedure Category')</th>
                                            <th>@lang('Procedure')</th>
                                            <th>@lang('Total Amount')</th>
                                            <th>@lang('Hospital Amount')</th>
                                            <th>@lang('Commission %')</th>
                                            <th>@lang('Total Commission Value')</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-custom">
                                        {{-- @php
                                        dd($invoices);
                                        exit;
                                        @endphp --}}
                                        @forelse ($invoices as $invoice)
    @php
        // Collect all categories and procedures from invoice items
        $categories = $invoice->invoiceItems
            ->pluck('procedure.ddprocedurecategory.title')
            ->filter()
            ->unique()
            ->implode(', ');

        $procedures = $invoice->invoiceItems
            ->pluck('procedure.title')
            ->filter()
            ->unique()
            ->implode(', ');
    @endphp

    <tr>
        <td>{{ $invoice->user->patientDetails->mrn_number ?? '-' }}</td>
        <td>{{ $invoice->user->name ?? '-' }}</td>
        <td>{{ $invoice->invoice_number }}</td>
        <td>{{ $invoice->doctor->name ?? '-' }}</td>

        <!-- Comma-separated Categories -->
        <td>{{ $categories ?: '-' }}</td>

        <!-- Comma-separated Procedures -->
        <td>{{ $procedures ?: '-' }}</td>

        <td>{{ number_format($invoice->grand_total ?? 0, 2) }}</td>
        <td>{{ number_format(($invoice->grand_total - $invoice->total_commission) ?? 0, 2) }}</td>
        <td>{{ $invoice->commission_percentage ?? 0 }}%</td>
        <td>{{ number_format($invoice->total_commission ?? 0, 2) }}</td>
    </tr>
@empty
    <tr class="text-center">
        <td colspan="10" class="text-secondary">@lang('Apply Filter for Report')</td>
    </tr>
@endforelse
                                        @if($invoices->count())
                                        <tr>
                                            <td colspan="5"></td>
                                            <th>@lang('Total')</th>
                                            <th>{{ $invoices->sum('grand_total') }}</th>
                                            <th>{{ $invoices->sum(function ($invoice) {
                                                return $invoice->grand_total - $invoice->total_commission;
                                            }) }}</th>
                                            <td></td>
                                            <th>{{ $invoices->sum('total_commission') }}</th>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
