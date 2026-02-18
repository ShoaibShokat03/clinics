@extends('layouts.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Dental Lab Order List')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    @can('lab-report-create')
                        <a href="{{ route('dental_lab_orders.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> @lang('Add Dental Lab Order')
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
                            <h3 class="card-title font-weight-bold ml-1">@lang('Filter Orders')</h3>
                            <div class="card-tools">
                                <button class="btn btn-outline-secondary btn-sm ml-2" data-toggle="collapse" href="#filter">
                                    <i class="fas fa-filter"></i> @lang('Filter')
                                </button>
                            </div>
                        </div>

                        <div id="filter" class="collapse @if (request()->has('isFilterActive')) show @endif">
                            <div class="card-body p-3 bg-light border-bottom">
                                <form action="{{ route('dental_lab_orders.index') }}" method="get" role="form"
                                    autocomplete="off">
                                    <input type="hidden" name="isFilterActive" value="true">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Patient')</label>
                                                <select name="patient_id" class="form-control form-control-sm select2">
                                                    <option value="">@lang('Select Patient')</option>
                                                    @foreach ($patients->sortBy(fn($patient) => strtolower($patient->user->name ?? '')) as $patient)
                                                        <option value="{{ $patient->id }}"
                                                            {{ request()->patient_id == $patient->id ? 'selected' : '' }}>
                                                            {{ ($patient->user->name ?? '') . ' - ' . ($patient->mrn_number ?? '') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Doctor')</label>
                                                <select name="doctor_id" class="form-control form-control-sm select2">
                                                    <option value="">@lang('Select Doctor')</option>
                                                    @foreach ($doctors->sortBy(fn($doctors) => strtolower($doctors->user->name ?? '')) as $doctor)
                                                        @if (!is_null(optional($doctor->user)->name))
                                                            <option value="{{ $doctor->id }}"
                                                                {{ request()->doctor_id == $doctor->id ? 'selected' : '' }}>
                                                                {{ $doctor->user->name ?? '' }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right mt-4">
                                            <button type="submit" class="btn btn-info btn-sm">@lang('Submit')</button>
                                            @if (request()->has('isFilterActive'))
                                                <a href="{{ route('dental_lab_orders.index') }}"
                                                    class="btn btn-secondary btn-sm ml-2">@lang('Clear')</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0" id="laravel_datatable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>@lang('Doctor')</th>
                                            <th>@lang('Patient')</th>
                                            <th>@lang('Sending Date')</th>
                                            <th>@lang('Returning Date')</th>
                                            <th>@lang('Time')</th>
                                            <th data-orderable="false">@lang('Actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->doctor->user->name ?? '-' }}</td>
                                                <td>
                                                    {{ $order->patient->user->name ?? '-' }}
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ $order->patient->mrn_number ?? '-' }}</small>
                                                </td>
                                                <td>{{ $order->sending_date ? \Carbon\Carbon::parse($order->sending_date)->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>{{ $order->returning_date ? \Carbon\Carbon::parse($order->returning_date)->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>{{ $order->time ?? '-' }}</td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        @can('lab-report-read')
                                                            <a href="{{ route('dental_lab_orders.show', $order) }}"
                                                                class="btn btn-sm btn-outline-info ml-1" data-toggle="tooltip"
                                                                title="@lang('View')">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endcan
                                                        @can('lab-report-update')
                                                            <a href="{{ route('dental_lab_orders.edit', $order) }}"
                                                                class="btn btn-sm btn-outline-warning ml-1"
                                                                data-toggle="tooltip" title="@lang('Edit')">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('lab-report-delete')
                                                            <a href="#"
                                                                data-href="{{ route('dental_lab_orders.destroy', $order) }}"
                                                                class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal"
                                                                data-target="#myModal" title="@lang('Delete')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        {{ $orders->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.delete_modal')
@endsection
