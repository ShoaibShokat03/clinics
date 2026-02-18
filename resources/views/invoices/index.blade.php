@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Invoice List')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    @can('invoice-create')
                        <a href="{{ route('invoices.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> @lang('Add Invoice')
                        </a>
                    @endcan
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
                            <h3 class="card-title font-weight-bold">@lang('Filter Invoices')</h3>
                            <div class="card-tools">
                                <a class="btn btn-outline-primary btn-sm" target="_blank"
                                    href="{{ route('invoices.index') }}?export=1">
                                    <i class="fas fa-cloud-download-alt"></i> @lang('Export')
                                </a>
                                <button class="btn btn-outline-secondary btn-sm ml-2" data-toggle="collapse" href="#filter">
                                    <i class="fas fa-filter"></i> @lang('Filter')
                                </button>
                            </div>
                        </div>

                        <div id="filter" class="collapse @if (request()->isFilterActive) show @endif">
                            <div class="card-body p-3 bg-light border-bottom">
                                <form action="" method="get" role="form" autocomplete="off">
                                    <input type="hidden" name="isFilterActive" value="true">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Patient')</label>
                                                <select name="user_id" class="form-control form-control-sm select2"
                                                    id="user_id">
                                                    <option value="">--@lang('Select')--</option>
                                                    @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $patient)
                                                        <option value="{{ $patient->id }}"
                                                            {{ old('user_id', request()->user_id) == $patient->id ? 'selected' : '' }}>
                                                            {{ $patient->name }} -
                                                            {{ $patient->patientDetails->mrn_number ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Doctor')</label>
                                                <select name="doctor_id" class="form-control form-control-sm select2"
                                                    id="doctor_id">
                                                    <option value="">--@lang('Select')--</option>
                                                    @foreach ($doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')) as $doctor)
                                                        <option value="{{ $doctor->id }}"
                                                            {{ old('doctor_id', request()->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                                            {{ $doctor->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Invoice Number')</label>
                                                <input type="text" name="invoice_number" id="invoice_number"
                                                    class="form-control form-control-sm" placeholder="@lang('Invoice Number')"
                                                    value="{{ old('invoice_number', request()->invoice_number) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Invoice Date')</label>
                                                <input type="text" name="invoice_date" id="invoice_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="@lang('Invoice Date')"
                                                    value="{{ old('invoice_date', request()->invoice_date) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Start Date')</label>
                                                <input type="text" name="start_date" id="start_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="@lang('Start Date')"
                                                    value="{{ old('start_date', request()->start_date) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('End Date')</label>
                                                <input type="text" name="end_date" id="end_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="@lang('End Date')"
                                                    value="{{ old('end_date', request()->end_date) }}">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Payment Status')</label>
                                                <select name="paid" class="form-control form-control-sm select2"
                                                    id="paid">
                                                    <option value="">--@lang('Select')--</option>
                                                    <option value="partial"
                                                        {{ old('paid', request()->paid) == 'partial' ? 'selected' : '' }}>
                                                        @lang('Partial')</option>
                                                    <option value="complete"
                                                        {{ old('paid', request()->paid) == 'complete' ? 'selected' : '' }}>
                                                        @lang('Complete')</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 text-right mt-4">
                                            <button type="submit" class="btn btn-info btn-sm">@lang('Submit')</button>
                                            @if (request()->isFilterActive)
                                                <a href="{{ route('invoices.index') }}"
                                                    class="btn btn-secondary btn-sm ml-2">@lang('Clear')</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-hover table-striped" id="laravel_datatable">
                                <thead class="bg-light">
                                    <tr>

                                        <th>@lang('Invoice #')</th>
                                        <th>@lang('Patient')</th>
                                        <th>@lang('Doctor')</th>
                                        <th>@lang('Date')</th>
                                        <th>Total</th>
                                        <th>Discount</th>
                                        <th>After Discount</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <?php
                                            $insurance = '';
                                            if ($invoice->checkInsurance()) {
                                                $insurance = "<i class='fa fa-flag text-danger' title='Invoice with insurance'></i>";
                                            }
                                            ?>
                                            <td><span style="text-wrap:nowrap;">{{ $invoice->invoice_number ?? '-' }}
                                                    <?= $insurance ?></span></td>
                                            <td>{{ $invoice->user->name ?? '-' }}</td>
                                            <td>
                                                {{ $invoice->doctor->name ?? ($invoice->patienttreatmentplan->doctor->name ?? '-') }}
                                            </td>
                                            <td> {{ date($companySettings->date_format ?? 'Y-m-d', strtotime($invoice->invoice_date)) }}
                                            </td>
                                            <td>{{ number_format($invoice->total) }}</td>
                                            <td>{{ number_format($invoice->total_discount) }}</td>
                                            <td>{{ number_format($invoice->grand_total) }}</td>
                                            <td>{{ number_format($invoice->paid) }}</td>
                                            <td>{{ number_format($invoice->due) }}</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <a href="{{ route('invoices.invoiceTemplate', $invoice) }}"
                                                        class="btn btn-sm btn-outline-info ml-1" data-toggle="tooltip"
                                                        title="@lang('View')"><i class="fas fa-eye"></i></a>
                                                    @can('invoice-update')
                                                        <a href="{{ route('invoices.edit', $invoice) }}"
                                                            class="btn btn-sm btn-outline-warning ml-1" data-toggle="tooltip"
                                                            title="@lang('Edit')"><i class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('invoice-delete')
                                                        <a href="#"
                                                            data-href="{{ route('invoices.destroy', $invoice->id) }}"
                                                            class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal"
                                                            data-target="#myModal" title="@lang('Delete')"><i
                                                                class="fa fa-trash"></i></a>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">@lang('Total')</th>
                                        <th>{{ number_format($total) }}</th>
                                        <th>{{ number_format($totalTotalDiscount) }}</th>
                                        <th>{{ number_format($totalGrandTotal) }}</th>
                                        <th>{{ number_format($totalPaid) }}</th>
                                        <th>{{ number_format($totalDue) }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="mt-3">
                                {{ $invoices->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.delete_modal')
        @endsection
