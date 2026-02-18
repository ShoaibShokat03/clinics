@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Patient Info')</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="{{ route('patient-details.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> @lang('Back to List')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <input type="hidden" id="record_id" value="{{ $patientDetail->id }}">
    <input type="hidden" id="table_name" value="patient">

    <div class="content">
        <div class="container-fluid">
            <!-- Patient Info Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white p-3 border-bottom-0 d-flex align-items-center">
                            <div class="d-flex gap-3 align-items-center flex-grow-1">
                                <div class="padding:5px;">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset($profilePicture) }}"
                                        alt="" style="width: 80px; height: 80px;" />
                                </div>
                                <span>&nbsp;</span>
                                <h3 class="card-title font-weight-bold m-0">@lang('Patient Info') - {{ $patientDetail->name }}
                                </h3>
                            </div>
                            @can('patient-detail-update')
                                <div>
                                    <a href="{{ route('patient-details.edit', $patientDetail) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-edit"></i> @lang('Edit')
                                    </a>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="name">@lang('Name')</label>
                                        <p>{{ $patientDetail->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="mrn">@lang('MRN Number')</label>
                                        <p>{!! optional($patientDetail->patientDetails)->mrn_number ?? ' ' !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="email">@lang('Email')</label>
                                        <p>{{ $patientDetail->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="phone">@lang('Phone')</label>
                                        <p>{{ $patientDetail->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="gender">@lang('Gender')</label>
                                        <p>{{ ucfirst($patientDetail->gender) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="cnic">@lang('CNIC')</label>
                                        <p>{!! $patientDetail->patientDetails->cnic ?? ' ' !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="blood_group">@lang('Blood Group')</label>
                                        <p>{{ $patientDetail->ddbloodgroup->name ?? ' ' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="date_of_birth">@lang('Date of Birth')</label>
                                        <p>{{ $patientDetail->date_of_birth ? \Carbon\Carbon::parse($patientDetail->date_of_birth)->format('d-M-Y') : '-' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="age">@lang('Age')</label>
                                        <p>{{ $patientDetail->age ? $patientDetail->age : '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="marital_status">@lang('Marital Status')</label>
                                        <p>{!! $patientDetail->patientDetails->maritalStatus->name ?? '-' !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="credit_balance">@lang('Credit Balance')</label>
                                        <p>{!! $patientDetail->patientDetails->credit_balance ?? ' ' !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="insurance_provider">@lang('Insurance Company')</label>
                                        <p>{!! $patientDetail->patientDetails->insurance->name ?? ' ' !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="status">@lang('Status')</label>
                                        <p>
                                            @if ($patientDetail->status == 1)
                                                <span class="badge badge-success">@lang('Active')</span>
                                            @else
                                                <span class="badge badge-danger">@lang('Inactive')</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="area">@lang('Area')</label>
                                        <p>{!! $patientDetail->patientDetails->area ?? ' ' !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="city">@lang('City')</label>
                                        <p>{!! $patientDetail->patientDetails->city ?? ' ' !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="address">@lang('Address')</label>
                                        <p>{{ $patientDetail->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="row">
                <div class="col-12">

                    <!-- Profile Picture Card -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h3 class="card-title font-weight-bold">Profile Pictures</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>@lang('File Name')</th>
                                            <th>@lang('Uploaded By')</th>
                                            <th>@lang('Upload Date')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody id="profilePictureTableBody" class="fileTableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Insurance Card -->
                    <div class="card shadow-sm border-0"
                        @if (isset($patientDetail->patientDetails) && $patientDetail->patientDetails->insurance_provider_id !== null) style="display: block;" @else style="display: none;" @endif>
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h3 class="card-title font-weight-bold">Upload Insurance Documents</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>@lang('File Name')</th>
                                            <th>@lang('Uploaded By')</th>
                                            <th>@lang('Upload Date')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody id="insuranceCardTableBody" class="fileTableBody"></tbody>
                                </table>
                            </div>
                            <div class="form-check mt-2"
                                @if ($insuranceFiles > 0) style="display: block;" @else style="display: none;" @endif>
                                <label class="form-check-label">
                                    {{ __('Insurance Verified') }}
                                </label>
                            </div>
                            @error('insurance_card')
                                <div class="error ambitious-red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            <!-- Patient History -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">{{ $patientDetail->name }}'s history</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Medical History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Drug History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab"
                                aria-controls="messages" aria-selected="false">Social History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                                aria-controls="settings" aria-selected="false">Dental History</a>
                        </li>
                    </ul>

                    <div class="tab-content pt-3" id="myTabContent">
                        <!-- Medical History -->
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <h4 class="font-weight-bold mb-3">@lang('Medical History of') {{ $patientDetail->name }}</h4>
                            <div class="row">
                                @foreach ($patientMedicalHistories as $item)
                                    <div class="col-xl-3 col-md-4 p-3 border rounded bg-light mr-3 mb-3">
                                        <label
                                            class="font-weight-bold">{{ $item->ddMedicalHistory->title ?? ' ' }}</label>
                                        <p class="m-0">{{ $item->comments }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card shadow-sm border-0 mt-3">
                                <div class="card-header bg-white p-3 border-bottom-0">
                                    <h3 class="card-title font-weight-bold">Medical Documents</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('File Name')</th>
                                                    <th>@lang('Uploaded By')</th>
                                                    <th>@lang('Upload Date')</th>
                                                    <th>@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody id="medicalHistoryTableBody" class="fileTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Drug History -->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h4 class="font-weight-bold mb-3">@lang('Drug History of') {{ $patientDetail->name }}</h4>
                            <div class="row">
                                @foreach ($patientDrugHistories as $item)
                                    <div class="col-xl-3 col-md-4 p-3 border rounded bg-light mr-3 mb-3">
                                        <label class="font-weight-bold">{{ $item->ddDrugHistory->title }}</label>
                                        <p class="m-0">{{ $item->comments }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card shadow-sm border-0 mt-3">
                                <div class="card-header bg-white p-3 border-bottom-0">
                                    <h3 class="card-title font-weight-bold">Drug Documents</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('File Name')</th>
                                                    <th>@lang('Uploaded By')</th>
                                                    <th>@lang('Upload Date')</th>
                                                    <th>@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody id="drugHistoryTableBody" class="fileTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Social History -->
                        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                            <h4 class="font-weight-bold mb-3">@lang('Social History of') {{ $patientDetail->name }}</h4>
                            <div class="row">
                                @foreach ($patientSocialHistories as $item)
                                    <div class="col-xl-3 col-md-4 p-3 border rounded bg-light mr-3 mb-3">
                                        <label class="font-weight-bold">{{ $item->ddSocialHistory->title ?? '-' }}</label>
                                        <p class="m-0">{{ $item->comments }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card shadow-sm border-0 mt-3">
                                <div class="card-header bg-white p-3 border-bottom-0">
                                    <h3 class="card-title font-weight-bold">Social Documents</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('File Name')</th>
                                                    <th>@lang('Uploaded By')</th>
                                                    <th>@lang('Upload Date')</th>
                                                    <th>@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody id="socialHistoryTableBody" class="fileTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Dental History -->
                        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                            <h4 class="font-weight-bold mb-3">@lang('Dental History of') {{ $patientDetail->name }}</h4>
                            <div class="row">
                                @foreach ($patientDentalHistories as $item)
                                    <div class="col-xl-3 col-md-4 p-3 border rounded bg-light mr-3 mb-3">
                                        <label class="font-weight-bold">{{ $item->ddDentalHistory->title ?? '-' }}</label>
                                        <p class="m-0">{{ $item->comments }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card shadow-sm border-0 mt-3">
                                <div class="card-header bg-white p-3 border-bottom-0">
                                    <h3 class="card-title font-weight-bold">Dental Documents</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('File Name')</th>
                                                    <th>@lang('Uploaded By')</th>
                                                    <th>@lang('Upload Date')</th>
                                                    <th>@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dentalHistoryTableBody" class="fileTableBody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Modules -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">Related Modules</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="relatedTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="appointments-tab" data-toggle="tab" href="#tab-appointments"
                                role="tab" aria-controls="appointments" aria-selected="true">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="exam-investigations-tab" data-toggle="tab"
                                href="#tab-exam-investigations" role="tab" aria-controls="exam-investigations"
                                aria-selected="false">Exam & Investigations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="treatment-plans-tab" data-toggle="tab" href="#tab-treatment-plans"
                                role="tab" aria-controls="treatment-plans" aria-selected="false">Treatment Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="prescriptions-tab" data-toggle="tab" href="#tab-prescriptions"
                                role="tab" aria-controls="prescriptions" aria-selected="false">Prescriptions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="invoices-tab" data-toggle="tab" href="#tab-invoices" role="tab"
                                aria-controls="invoices" aria-selected="false">Invoices</a>
                        </li>
                    </ul>

                    <div class="tab-content pt-3" id="relatedTabsContent">
                        <!-- Appointments -->
                        <div class="tab-pane fade show active" id="tab-appointments" role="tabpanel"
                            aria-labelledby="appointments-tab">
                            <h4 class="font-weight-bold mb-3">Appointments</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="appointments_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>@lang('Appointment Number')</th>
                                            <th>@lang('Doctor')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Problem')</th>
                                            <th>@lang('Start Time')</th>
                                            <th>@lang('End Time')</th>
                                            <th>@lang('Dated')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patientAppointments as $patientAppointment)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('patient-appointments.show', $patientAppointment->id) }}"
                                                        class="text-decoration-underline">
                                                        {{ $patientAppointment->appointment_number }}
                                                    </a>
                                                </td>
                                                <td>{{ $patientAppointment->doctor->name }}</td>
                                                <td>{{ isset($patientAppointment->appointmentstatus->name) ? $patientAppointment->appointmentstatus->name : '-' }}
                                                </td>
                                                <td>{{ isset($patientAppointment->problem) ? $patientAppointment->problem : '-' }}
                                                </td>
                                                <td>{{ $patientAppointment->start_time }}</td>
                                                <td>{{ $patientAppointment->end_time }}</td>
                                                <td>{{ $patientAppointment->appointment_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Exam Investigations -->
                        <div class="tab-pane fade" id="tab-exam-investigations" role="tabpanel"
                            aria-labelledby="exam-investigations-tab">
                            <h4 class="font-weight-bold mb-3">Exam Investigations</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="exam_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>@lang('Examination Number')</th>
                                            <th>@lang('Appointment Number')</th>
                                            <th>@lang('Doctor')</th>
                                            <th>@lang('Comments')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($examInvestigations as $examInvestigation)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('exam-investigations.show', $examInvestigation->id) }}"
                                                        class="text-decoration-underline">
                                                        {{ $examInvestigation->examination_number }}</a>
                                                </td>
                                                <td>{{ isset($examInvestigation->PatientAppointment->appointment_number) ? $examInvestigation->PatientAppointment->appointment_number : '-' }}
                                                </td>
                                                <td>{{ isset($examInvestigation->doctor->name) ? $examInvestigation->doctor->name : '-' }}
                                                </td>
                                                <td>{{ isset($examInvestigation->comments) ? $examInvestigation->comments : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Treatment Plans -->
                        <div class="tab-pane fade" id="tab-treatment-plans" role="tabpanel"
                            aria-labelledby="treatment-plans-tab">
                            <h4 class="font-weight-bold mb-3">Treatment Plans</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="treatment_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>@lang('Treatment Plan Number')</th>
                                            <th>@lang('Examination Number')</th>
                                            <th>@lang('Doctor')</th>
                                            <th>@lang('Comments')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patientTreatmentPlans as $patientTreatmentPlan)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('patient-treatment-plans.show', $patientTreatmentPlan->id) }}"
                                                        class="text-decoration-underline">
                                                        {{ $patientTreatmentPlan->treatment_plan_number }}</a>
                                                </td>
                                                <td>{{ isset($patientTreatmentPlan->examinvestigation->examination_number) ? $patientTreatmentPlan->examinvestigation->examination_number : '-' }}
                                                </td>
                                                <td>{{ isset($patientTreatmentPlan->doctor->name) ? $patientTreatmentPlan->doctor->name : '-' }}
                                                </td>
                                                <td>{{ isset($patientTreatmentPlan->comments) ? $patientTreatmentPlan->comments : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Prescriptions -->
                        <div class="tab-pane fade" id="tab-prescriptions" role="tabpanel"
                            aria-labelledby="prescriptions-tab">
                            <h4 class="font-weight-bold mb-3">Prescriptions</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="prescriptions_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>@lang('Prescription Number')</th>
                                            <th>@lang('Examination Number')</th>
                                            <th>@lang('Doctor')</th>
                                            <th>@lang('Notes')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prescriptions as $prescription)
                                            <tr>
                                                <td>{{ isset($prescription->prescription_number) ? $prescription->prescription_number : '-' }}
                                                </td>
                                                <td>
                                                    @if (isset($prescription->examinvestigations->examination_number))
                                                        <a href="{{ url('/prescriptions/' . $prescription->id) }}"
                                                            class="text-decoration-underline">
                                                            {{ $prescription->examinvestigations->examination_number }}
                                                        </a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ isset($prescription->doctor->name) ? $prescription->doctor->name : '-' }}
                                                </td>
                                                <td>{{ isset($prescription->note) ? $prescription->note : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Invoices -->
                        <div class="tab-pane fade" id="tab-invoices" role="tabpanel" aria-labelledby="invoices-tab">
                            <h4 class="font-weight-bold mb-3">Invoices</h4>
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="invoices_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>@lang('Invoice Number')</th>
                                            <th>@lang('Doctor Name')</th>
                                            <th>@lang('Insurance')</th>
                                            <th>@lang('Treatment Plan')</th>
                                            <th>@lang('Total')</th>
                                            <th>@lang('Paid')</th>
                                            <th>@lang('Due')</th>
                                            <th>@lang('Dated')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('invoices.show', $invoice->id) }}"
                                                        class="text-decoration-underline">
                                                        {{ $invoice->invoice_number }}</a>
                                                </td>
                                                <td>{{ isset($invoice->patienttreatmentplan->doctor->name) ? $invoice->patienttreatmentplan->doctor->name : '-' }}
                                                </td>
                                                <td>{{ isset($invoice->insurance->name) ? $invoice->insurance->name : '-' }}
                                                </td>
                                                <td>{{ isset($invoice->patienttreatmentplan->treatment_plan_number) ? $invoice->patienttreatmentplan->treatment_plan_number : '-' }}
                                                </td>
                                                <td>{{ isset($invoice->grand_total) ? $invoice->grand_total : '-' }}</td>
                                                <td>{{ $invoice->paid }}</td>
                                                <td>{{ $invoice->due }}</td>
                                                <td>{{ $invoice->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CNIC Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">CNIC</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>@lang('File Name')</th>
                                    <th>@lang('Uploaded By')</th>
                                    <th>@lang('Upload Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody id="cnicFileTableBody" class="fileTableBody"></tbody>
                        </table>
                    </div>
                    @error('cnic_file')
                        <div class="error ambitious-red">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <!-- Other Documents Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom-0">
                    <h3 class="card-title font-weight-bold">Other Documents</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>@lang('File Name')</th>
                                    <th>@lang('Uploaded By')</th>
                                    <th>@lang('Upload Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody id="otherFilesTableBody" class="fileTableBody"></tbody>
                        </table>
                    </div>
                    @error('other_files')
                        <div class="error ambitious-red">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

    </div>

    @push('footer')
        <script>
            var getFilesUrl = "{{ route('get-files', $patientDetail->id) }}";
            var uploadFilesUrl = "{{ route('upload-file') }}";
            var deleteFilesUrl = "{{ route('delete-file') }}";
            var baseUrl = '{{ asset('') }}';
        </script>
    @endpush
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const insuranceVerifiedCheckbox = document.getElementById('insuranceVerifiedCheckbox');

            if (insuranceVerifiedCheckbox) {
                insuranceVerifiedCheckbox.addEventListener('change', function() {
                    const insurance_verified = this.checked ? 'yes' : 'no';
                    $.ajax({
                        url: '{{ route('updateInsuranceVerified', $patientDetail->id) }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            insurance_verified: insurance_verified
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Insurance status updated successfully.');
                            } else {
                                alert('Failed to update insurance status.');
                            }
                        },
                        error: function(xhr) {
                            alert('Error occurred while updating insurance status: ' + xhr
                                .responseJSON.message);
                        }
                    });
                });
            }
        });

        function updateCheckboxVisibility() {
            const tableBody = $('#insuranceCardTableBody');
            const checkboxContainer = $('.form-check');

            // Check if the table body has any rows
            if (tableBody.find('tr').length > 0) {
                checkboxContainer.show();
            }
        }
        $(document).ready(function() {
            // Attach change event to file input
            $('#insurance_card').on('change', function() {
                // Set a timeout to call updateCheckboxVisibility after 500ms
                setTimeout(function() {
                    console.log("Before Uploading File at " + new Date().toLocaleString());
                    updateCheckboxVisibility();
                    console.log("After Uploading File at " + new Date().toLocaleString());
                }, 3000);
            });

            // Initial call to set the checkbox visibility on page load
            updateCheckboxVisibility();
        });
    </script>
@endsection
