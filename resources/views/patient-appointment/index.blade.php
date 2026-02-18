@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Patient Appointment')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    @can('patient-appointment-create')
                        <a href="{{ route('patient-appointments.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> @lang('Add Appointment')
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
                            <h3 class="card-title font-weight-bold ml-1">@lang('Filter Appointments')</h3>
                            <div class="card-tools">
                                @if (request()->has('today_appointments'))
                                    <a href="{{ route('patient-appointments.index') }}"
                                        class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-calendar-day"></i> @lang('All Appointments')
                                    </a>
                                @endif
                                <a href="{{ route('patient-appointments.index') }}?today_appointments=1"
                                    class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-calendar-day"></i> @lang('Today Appointments')
                                </a>
                                <a class="btn btn-outline-primary btn-sm ml-2" target="_blank"
                                    href="{{ route('patient-appointments.index') }}?export=1">
                                    <i class="fas fa-cloud-download-alt"></i> @lang('Export')
                                </a>
                                <button class="btn btn-outline-secondary btn-sm ml-2" data-toggle="collapse" href="#filter">
                                    <i class="fas fa-filter"></i> @lang('Filter')
                                </button>
                            </div>
                        </div>

                        <div id="filter" class="collapse @if (request('isFilterActive')) show @endif">
                            <div class="card-body p-3 bg-light border-bottom">
                                <form action="" method="get" role="form" autocomplete="off">
                                    <input type="hidden" name="isFilterActive" value="true">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Patient')</label>
                                                <select name="user_id" class="form-control form-control-sm select2"
                                                    id="user_id">
                                                    <option value="">--@lang('Select')--</option>
                                                    @foreach ($patientinfo->sortBy(fn($patient) => strtolower($patient->user->name ?? '')) as $patient)
                                                        <option value="{{ $patient->user_id }}"
                                                            {{ (is_array(request('user_id')) ? '' : request('user_id')) == $patient->user_id ? 'selected' : '' }}>
                                                            {{ ($patient->user->name ?? '') . ' - ' . ($patient->mrn_number ?? '') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if (!auth()->user()->hasRole('Doctor'))
                                            <div class="col-sm-2">
                                                <div class="form-group mb-2">
                                                    <label
                                                        class="text-secondary small font-weight-bold">@lang('Doctor')</label>
                                                    <select name="doctor_id" class="form-control form-control-sm select2"
                                                        id="doctor_id">
                                                        <option value="">--@lang('Select')--</option>
                                                        @foreach ($doctors->sortBy(fn($doctor) => strtolower($doctor->name ?? '')) as $doctor)
                                                            <option value="{{ $doctor->id }}"
                                                                {{ (is_array(request('doctor_id')) ? '' : request('doctor_id')) == $doctor->id ? 'selected' : '' }}>
                                                                {{ $doctor->name ?? '-' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-2">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Appointment Date')</label>
                                                <input type="text" name="appointment_date" id="appointment_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="@lang('Date')"
                                                    value="{{ is_array(request('appointment_date')) ? '' : request('appointment_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Start Date')</label>
                                                <input type="text" name="start_date" id="start_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="@lang('Start')"
                                                    value="{{ is_array(request('start_date')) ? '' : request('start_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('End Date')</label>
                                                <input type="text" name="end_date" id="end_date"
                                                    class="form-control form-control-sm flatpickr"
                                                    placeholder="@lang('End')"
                                                    value="{{ is_array(request('end_date')) ? '' : request('end_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-right mt-4">
                                            <button type="submit" class="btn btn-info btn-sm">@lang('Submit')</button>
                                            @if (request('isFilterActive'))
                                                <a href="{{ route('patient-appointments.index') }}"
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
                                            <th style="white-space:nowrap;">Apt No</th>
                                            <th>Doctor</th>
                                            <th>Patient</th>
                                            <th>MRN</th>
                                            <th>Apt Date</th>
                                            <th>Apt Time</th>
                                            <th>Status</th>
                                            <th>Reminder</th>
                                            <th data-orderable="false" class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patientAppointments as $patientAppointment)
                                            <tr>
                                                <td class="align-middle border-right">
                                                    {{ $patientAppointment->appointment_number }}</td>
                                                <td class="align-middle">{{ $patientAppointment->doctor->name ?? '-' }}
                                                </td>
                                                <td class="align-middle">{{ $patientAppointment->patient->name ?? '-' }}
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="badge badge-light border">{{ $patientAppointment->patient->patientDetails->mrn_number ?? '-' }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    {{ date(is_object($companySettings) ? $companySettings->date_format ?? 'Y-m-d' : $companySettings['date_format'] ?? 'Y-m-d', strtotime($patientAppointment->appointment_date)) }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ \Carbon\Carbon::parse($patientAppointment->start_time)->format('h:i A') . ' - ' . \Carbon\Carbon::parse($patientAppointment->end_time)->format('h:i A') }}
                                                </td>
                                                <td class="align-middle">
                                                    @if (isset($patientAppointment->appointmentstatus->id))
                                                        @php
                                                            $statusId = $patientAppointment->appointmentstatus->id;
                                                            $statusName =
                                                                $patientAppointment->appointmentstatus->name ?? '-';
                                                        @endphp
                                                        @if ($statusId == 1)
                                                            <span class="badge badge-primary">{{ $statusName }}</span>
                                                        @elseif ($statusId == 2)
                                                            <span class="badge badge-warning">{{ $statusName }}</span>
                                                        @elseif ($statusId == 3)
                                                            <span class="badge badge-success">{{ $statusName }}</span>
                                                        @elseif ($statusId == 4)
                                                            <span class="badge badge-danger">{{ $statusName }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ $statusName }}</span>
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @php
                                                        $clinicName = isset($ApplicationSetting)
                                                            ? $ApplicationSetting->item_name
                                                            : '-';

                                                        // 1. Current Date aur Time
                                                        $currentDateTime = \Carbon\Carbon::now();

                                                        // 2. Date aur Time ko merge kar ke parse karein
                                                        // Hum 'appointment_date' aur 'start_time' dono ko combine kar rahe hain
                                                        $fullAppointmentPath =
                                                            $patientAppointment->appointment_date .
                                                            ' ' .
                                                            $patientAppointment->start_time;
                                                        $appointmentDateTime = \Carbon\Carbon::parse(
                                                            $fullAppointmentPath,
                                                        );

                                                        $rawPhone = $patientAppointment->patient->phone ?? null;
                                                        $phone = $rawPhone
                                                            ? preg_replace('/\D+/', '', $rawPhone)
                                                            : null;
                                                        $waUrl = null;

                                                        if (
                                                            $phone &&
                                                            strlen($phone) === 11 &&
                                                            substr($phone, 0, 1) === '0'
                                                        ) {
                                                            $phone = '92' . substr($phone, 1);
                                                            $patientName = $patientAppointment->patient->name ?? '';
                                                            $doctorName = $patientAppointment->doctor->name ?? '';

                                                            $formattedDate = $appointmentDateTime->format('d-M-Y');
                                                            $formattedTime = $appointmentDateTime->format('h:i A');

                                                            $message = "Hi *{$patientName}*, Your appointment *{$patientAppointment->appointment_number}* with *{$doctorName}* is scheduled on *{$formattedDate}* at *{$formattedTime}*. Please arrive on time. *{$clinicName}*. Thank you!";
                                                            $message = urlencode($message);
                                                            $waUrl = "https://wa.me/{$phone}?text={$message}";
                                                        }
                                                    @endphp

                                                    {{-- 3. Ab comparison Date aur Time dono par base karega --}}
                                                    @if ($currentDateTime->lessThanOrEqualTo($appointmentDateTime))
                                                        @if ($waUrl)
                                                            <a class="btn btn-sm btn-outline-success btn-send-reminder"
                                                                style="width:fit-content !important;gap:5px;"
                                                                href="{{ $waUrl }}" target="_blank"
                                                                rel="noopener" data-id="{{ $patientAppointment->id }}">
                                                                <i class="fab fa-whatsapp"></i> Send
                                                            </a>
                                                        @else
                                                            <small class="text-muted">-</small>
                                                        @endif
                                                    @else
                                                        <small class="text-muted">Past Appointment</small>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-right">
                                                    <div class="btn-group">
                                                        <a href="{{ route('patient-appointments.show', $patientAppointment->id) }}"
                                                            class="btn btn-sm btn-outline-info" data-toggle="tooltip"
                                                            title="@lang('View')">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        @can('patient-appointments-update')
                                                            <a href="{{ route('patient-appointments.edit', $patientAppointment) }}"
                                                                class="btn btn-sm btn-outline-warning ml-1"
                                                                data-toggle="tooltip" title="@lang('Edit')">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('patient-appointment-delete')
                                                            <a href="#"
                                                                data-href="{{ route('patient-appointments.destroy', $patientAppointment) }}"
                                                                class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal"
                                                                data-target="#myModal" title="@lang('Delete')">
                                                                <i class="fa fa-trash"></i>
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
                        <div class="card-footer bg-white border-top-0">
                            {{ $patientAppointments->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    @include('layouts.delete_modal')
@endpush
