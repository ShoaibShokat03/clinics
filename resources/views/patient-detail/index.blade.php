@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Patient List')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    @can('patient-detail-create')
                        <a href="{{ route('patient-details.create') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-plus"></i> @lang('Add Patient')
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
                            <h3 class="card-title font-weight-bold">@lang('Patient List')</h3>
                            <div class="card-tools">
                                <a class="btn btn-success btn-sm" target="_blank"
                                    href="{{ route('patient-details.index') }}?export=1">
                                    <i class="fas fa-cloud-download-alt"></i> @lang('Export')
                                </a>
                                <button class="btn btn-default btn-sm" data-toggle="collapse" href="#filter">
                                    <i class="fas fa-filter"></i> @lang('Filter')
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="min-height:60vh;">
                            <div id="filter" class="collapse @if (request()->isFilterActive) show @endif">
                                <div class="card-body border mb-3">
                                    <form action="" method="get" role="form" autocomplete="off">
                                        <input type="hidden" name="isFilterActive" value="true">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>@lang('Name')</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ request()->name }}" placeholder="@lang('Name')">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>@lang('MRN Number')</label>
                                                    <input type="text" name="mrn_number" class="form-control"
                                                        value="{{ request()->mrn_number }}" placeholder="@lang('MRN Number')">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>@lang('Phone')</label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="{{ request()->phone }}" placeholder="@lang('Phone')">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>@lang('City')</label>
                                                    <input type="text" name="city" id="city" class="form-control"
                                                        placeholder="@lang('city')"
                                                        value="{{ old('city', request()->city) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>@lang('Area')</label>
                                                    <input type="text" name="area" id="area" class="form-control"
                                                        placeholder="@lang('area')"
                                                        value="{{ old('area', request()->area) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>@lang('Start Date')</label>
                                                    <input type="text" name="start_date" id="start_date"
                                                        class="form-control flatpickr" placeholder="@lang('Start Date')"
                                                        value="{{ old('start_date', request()->start_date) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>@lang('End Date')</label>
                                                    <input type="text" name="end_date" id="end_date"
                                                        class="form-control flatpickr" placeholder="@lang('End Date')"
                                                        value="{{ old('end_date', request()->end_date) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3 align-self-end">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                                    @if (request()->isFilterActive)
                                                        <a href="{{ route('patient-details.index') }}"
                                                            class="btn btn-secondary">@lang('Clear')</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive" style="overflow:visible !important">
                                <table class="table table-hover table-striped" id="laravel_datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <!-- <th>Profile</th> -->
                                            <th>@lang('Name')</th>
                                            <th style="min-width: 100px;">@lang('MRN Number')</th>
                                            <th>@lang('Phone')</th>
                                            <th>@lang('Area')</th>
                                            <th>@lang('City')</th>
                                            <th class="text-right">@lang('Actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patientDetails as $patientDetail)
                                            <tr>
                                                <td style="display: none;">
                                                    @php
                                                        $profilePic = $patientDetail->profilePicture;
                                                        if (is_array($profilePic)) {
                                                            $profilePic = reset($profilePic); // Take first item if array
                                                        }
                                                        // Ensure it is a valid string path
                                                        $profilePicUrl =
                                                            !empty($profilePic) && is_string($profilePic)
                                                                ? asset('storage/' . $profilePic)
                                                                : asset('assets/images/profile/male.png');
                                                    @endphp
                                                    <img class="profile-user-img img-fluid img-circle"
                                                        src="{{ $profilePicUrl }}" alt="Profile Picture"
                                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" />
                                                </td>
                                                <td>
                                                    {{ $patientDetail->name }}
                                                    @if ($patientDetail->patientDetails && $patientDetail->patientDetails->insurance_verified == 'yes')
                                                        <i class='fa fa-flag text-danger'
                                                            title='Patient with insurance'></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-light border">{{ $patientDetail->patientDetails->mrn_number ?? '-' }}</span>
                                                </td>
                                                <td>{{ $patientDetail->phone }}</td>
                                                <td>{{ $patientDetail->patientDetails ? $patientDetail->patientDetails->area : '-' }}
                                                </td>
                                                <td>{{ $patientDetail->patientDetails ? $patientDetail->patientDetails->city : '-' }}
                                                </td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-info dropdown-toggle"
                                                            data-toggle="dropdown">
                                                            <i class="fas fa-bars"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            @can('patient-appointment-create')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('patient-appointments.createFromPatientDetails', ['userid' => $patientDetail->id]) }}">
                                                                    @lang('Create Appointment')
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('invoices.create', ['userid' => $patientDetail->id]) }}">
                                                                    @lang('Create Invoice')
                                                                </a>
                                                            @endcan
                                                            @can('patient-treatment-plans-create')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('patient-treatment-plans.create', ['patient_id' => $patientDetail->id]) }}">
                                                                    @lang('Treatment Plan')
                                                                </a>
                                                            @endcan
                                                            @can('exam-investigations-create')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('exam-investigations.create', ['patient_id' => $patientDetail->id]) }}">
                                                                    @lang('Exam & Diagnoses')
                                                                </a>
                                                            @endcan
                                                            <div class="dropdown-divider"></div>
                                                            @if (
                                                                $patientDetail->patientMedicalHistories->isNotEmpty() ||
                                                                    $patientDetail->patientDentalHistories->isNotEmpty() ||
                                                                    $patientDetail->patientDrugHistories->isNotEmpty() ||
                                                                    $patientDetail->patientSocialHistories->isNotEmpty())
                                                                <a class="dropdown-item"
                                                                    href="{{ route('patient-details.history', $patientDetail->id) }}">
                                                                    @lang('View History')
                                                                </a>
                                                            @endif

                                                            {{-- Medical History --}}
                                                            @if ($patientDetail->patientMedicalHistories->isNotEmpty())
                                                                @can('patient-medical-histories-update')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('patient-medical-histories.edit', $patientDetail->patientMedicalHistories->first()->id) }}">
                                                                        @lang('Edit Medical History')
                                                                    </a>
                                                                @endcan
                                                            @else
                                                                @can('patient-medical-histories-create')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('patient-medical-histories.create.from-patient', ['userid' => $patientDetail->id]) }}">
                                                                        @lang('Add Medical History')
                                                                    </a>
                                                                @endcan
                                                            @endif

                                                            {{-- Dental History --}}
                                                            @if ($patientDetail->patientDentalHistories->isNotEmpty())
                                                                @can('patient-dental-histories-update')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('patient-dental-histories.edit', $patientDetail->patientDentalHistories->first()->id) }}">
                                                                        @lang('Edit Dental History')
                                                                    </a>
                                                                @endcan
                                                            @else
                                                                @can('patient-dental-histories-create')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('patient-dental-histories.create.from-patient', ['userid' => $patientDetail->id]) }}">
                                                                        @lang('Add Dental History')
                                                                    </a>
                                                                @endcan
                                                            @endif

                                                            {{-- Drug History --}}
                                                            @if ($patientDetail->patientDrugHistories->isNotEmpty())
                                                                @can('patient-drug-histories-update')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('patient-drug-histories.edit', $patientDetail->patientDrugHistories->first()->id) }}">
                                                                        @lang('Edit Drug History')
                                                                    </a>
                                                                @endcan
                                                            @else
                                                                @can('patient-drug-histories-create')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('patient-drug-histories.create.from-patient', ['userid' => $patientDetail->id]) }}">
                                                                        @lang('Add Drug History')
                                                                    </a>
                                                                @endcan
                                                            @endif

                                                            {{-- Social History --}}
                                                            @if ($patientDetail->patientSocialHistories->isNotEmpty())
                                                                @can('patient-social-histories-update')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('patient-social-histories.edit', $patientDetail->patientSocialHistories->first()->id) }}">
                                                                        @lang('Edit Social History')
                                                                    </a>
                                                                @endcan
                                                            @else
                                                                @can('patient-social-histories-create')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('patient-social-histories.create.from-patient', ['userid' => $patientDetail->id]) }}">
                                                                        @lang('Add Social History')
                                                                    </a>
                                                                @endcan
                                                            @endif
                                                        </div>
                                                        <a href="{{ route('patient-details.show', $patientDetail) }}"
                                                            class="btn btn-sm btn-outline-info ml-1" data-toggle="tooltip"
                                                            title="@lang('View')">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        @can('patient-detail-update')
                                                            <a href="{{ route('patient-details.edit', $patientDetail) }}"
                                                                class="btn btn-sm btn-outline-warning ml-1"
                                                                data-toggle="tooltip" title="@lang('Edit')">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('patient-detail-delete')
                                                            <a href="#"
                                                                data-href="{{ route('patient-details.destroy', $patientDetail) }}"
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
                                {{ $patientDetails->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Picture Modal -->
    <div id="profilePicModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPatientName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="profilePicModalImg" src="" alt="Profile Picture" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.profile-user-img').on('click', function() {
                var imgSrc = $(this).attr('src');
                var patientName = $(this).closest('tr').find('td:eq(1)').text().trim();

                $('#profilePicModalImg').attr('src', imgSrc);
                $('#modalPatientName').text(patientName);
                $('#profilePicModal').modal('show');
            });
        });
    </script>

    @include('layouts.delete_modal')
@endsection
