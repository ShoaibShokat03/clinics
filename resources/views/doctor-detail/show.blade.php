@extends('layouts.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Doctor Info')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('doctor-details.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> @lang('Back to List')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div
                            class="card-header bg-white p-3 border-bottom-0 d-flex justify-content-between align-items-center">
                            <h3 class="card-title font-weight-bold">@lang('Doctor Details')</h3>
                            @can('doctor-detail-update')
                                <a href="{{ route('doctor-details.edit', $doctorDetail) }}"
                                    class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit"></i> @lang('Edit')
                                </a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                    <img src="{{ $doctorDetail->user->photo_url }}"
                                        class="img-fluid rounded-circle shadow-sm border" alt="User Image"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Name')</label>
                                        <p class="font-weight-normal mb-0">{{ $doctorDetail->user->name ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Email')</label>
                                        <p class="font-weight-normal mb-0">{{ $doctorDetail->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Phone')</label>
                                        <p class="font-weight-normal mb-0">{{ $doctorDetail->user->phone ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Address')</label>
                                        <p class="font-weight-normal mb-0">{{ $doctorDetail->user->address ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Specialist')</label>
                                        <p class="font-weight-normal mb-0">{{ $doctorDetail->specialist }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Designation')</label>
                                        <p class="font-weight-normal mb-0">{{ $doctorDetail->designation }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Gender')</label>
                                        <p class="font-weight-normal mb-0">{{ ucfirst($doctorDetail->user->gender ?? '-') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Blood Group')</label>
                                        <p class="font-weight-normal mb-0">
                                            {{ $doctorDetail->user->ddbloodgroup->name ?? ' ' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Date of Birth')</label>
                                        <p class="font-weight-normal mb-0">
                                            {{ $doctorDetail->user->date_of_birth ? \Carbon\Carbon::parse($doctorDetail->user->date_of_birth)->format('d-M-Y') : '-' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Status')</label>
                                        <p class="mb-0">
                                            @if ($doctorDetail->user->status == 1)
                                                <span class="badge badge-success">@lang('Active')</span>
                                            @else
                                                <span class="badge badge-danger">@lang('Inactive')</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="text-secondary small font-weight-bold mb-0">@lang('Biography')</label>
                                        <p class="font-weight-normal mb-0">{!! $doctorDetail->doctor_biography !!}</p>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs" id="doctorDetailTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="appointments-tab" data-toggle="tab" href="#appointments"
                                        role="tab" aria-controls="appointments"
                                        aria-selected="true">@lang('Appointments')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="treatment-plans-tab" data-toggle="tab" href="#treatment-plans"
                                        role="tab" aria-controls="treatment-plans"
                                        aria-selected="false">@lang('Treatment Plans')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="investigations-tab" data-toggle="tab" href="#investigations"
                                        role="tab" aria-controls="investigations"
                                        aria-selected="false">@lang('Exam & Investigations')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#prescriptions"
                                        role="tab" aria-controls="prescriptions"
                                        aria-selected="false">@lang('Prescriptions')</a>
                                </li>
                            </ul>
                            <div class="tab-content p-3 border border-top-0" id="doctorDetailTabContent">
                                <div class="tab-pane fade show active" id="appointments" role="tabpanel"
                                    aria-labelledby="appointments-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('Appointment No')</th>
                                                    <th>@lang('Patient Name')</th>
                                                    <th>@lang('Date')</th>
                                                    <th>@lang('Time')</th>
                                                    <th>@lang('Status')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($patientAppointments as $appointment)
                                                    <tr>
                                                        <td>{{ $appointment->appointment_number }}</td>
                                                        <td>{{ $appointment->patient->name ?? '-' }}</td>
                                                        <td>{{ $appointment->appointment_date }}</td>
                                                        <td>{{ $appointment->start_time }} - {{ $appointment->end_time }}
                                                        </td>
                                                        <td>
                                                            @if ($appointment->status == 1)
                                                                <span class="badge badge-info">@lang('Active')</span>
                                                            @elseif($appointment->status == 2)
                                                                <span class="badge badge-success">@lang('Completed')</span>
                                                            @elseif($appointment->status == 3)
                                                                <span class="badge badge-danger">@lang('Cancelled')</span>
                                                            @else
                                                                <span class="badge badge-warning">@lang('Pending')</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="treatment-plans" role="tabpanel"
                                    aria-labelledby="treatment-plans-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('Plan No')</th>
                                                    <th>@lang('Patient Name')</th>
                                                    <th>@lang('Comments')</th>
                                                    <th>@lang('Status')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($patientTreatmentPlans as $plan)
                                                    <tr>
                                                        <td>{{ $plan->treatment_plan_number }}</td>
                                                        <td>{{ $plan->patient->name ?? '-' }}</td>
                                                        <td>{{ $plan->comments }}</td>
                                                        <td>
                                                            @if ($plan->status == 1)
                                                                <span class="badge badge-success">@lang('Completed')</span>
                                                            @else
                                                                <span class="badge badge-warning">@lang('Pending')</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="investigations" role="tabpanel"
                                    aria-labelledby="investigations-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('Exam No')</th>
                                                    <th>@lang('Patient Name')</th>
                                                    <th>@lang('Date')</th>
                                                    <th>@lang('Chief Complaint')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($examInvestigations as $investigation)
                                                    <tr>
                                                        <td>{{ $investigation->examination_number }}</td>
                                                        <td>{{ $investigation->patient->name ?? '-' }}</td>
                                                        <td>{{ $investigation->created_at->format('Y-m-d') }}</td>
                                                        <td>{{ Str::limit($investigation->chief_complaints, 50) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="prescriptions" role="tabpanel"
                                    aria-labelledby="prescriptions-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('Prescription No')</th>
                                                    <th>@lang('Patient Name')</th>
                                                    <th>@lang('Date')</th>
                                                    <th>@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($prescriptions as $prescription)
                                                    <tr>
                                                        <td>{{ $prescription->prs_number }}</td>
                                                        <td>{{ $prescription->user->name ?? '-' }}</td>
                                                        <td>{{ $prescription->created_at->format('Y-m-d') }}</td>
                                                        <td>
                                                            <a href="{{ route('prescriptions.show', $prescription->id) }}"
                                                                class="btn btn-sm btn-outline-info">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
    </div>
@endsection
