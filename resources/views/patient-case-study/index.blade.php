@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @can('patient-case-studies-create')
                        <h3><a href="{{ route('patient-case-studies.create') }}" class="btn btn-outline btn-info">+
                                @lang('Add Patient Case Study')</a>
                            <span class="pull-right"></span>
                        </h3>
                    @endcan
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('Dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('Patient Case Studies List')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">@lang('Patient Case Studies List') </h3>
                    <div class="card-tools">
                        <button class="btn btn-default" data-toggle="collapse" href="#filter"><i class="fas fa-filter"></i>
                            @lang('Filter')</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="filter" class="collapse @if (request()->isFilterActive) show @endif">
                        <div class="card-body border">
                            <form action="" method="get" role="form" autocomplete="off">
                                <input type="hidden" name="isFilterActive" value="true">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                        <label>@lang('Patient')</label>
                                            <select name="user_id" class="form-control select2" id="user_id">
                                                <option value="">--@lang('Select')--</option>
                                                @foreach ($patients->sortBy(fn($patient) => strtolower($patient->user->name ?? '')) as $patient)
                                                   @if (!is_null(optional($patient->user)->name))
                                                    <option value="{{ $patient->user_id }}" {{ old('user_id', request()->user_id) == $patient->user_id ? 'selected' : '' }}>{{ ($patient->user->name ?? '') . ' - ' . ($patient->mrn_number ?? '') }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>@lang('Email')</label>
                                            <input type="text" name="email" class="form-control"
                                                value="{{ request()->email }}" placeholder="@lang('Email')">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>@lang('Phone')</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ request()->phone }}" placeholder="@lang('Phone')">
                                        </div>
                                    </div>
                                <!-- </div>
                                <div class="row"> -->
                                <div class="col-sm-3 align-content-center">
                                        <button type="submit" class="btn btn-info mt-4">@lang('Submit')</button>
                                        @if (request()->isFilterActive)
                                            <a href="{{ route('patient-case-studies.index') }}"
                                                class="btn btn-secondary mt-4">@lang('Clear')</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped" id="laravel_datatable">
                        <thead>
                            <tr>

                                <th class="col-">@lang('Name')</th>
                                <th class="col-">@lang('Email')</th>
                                <th class="col-">@lang('Phone')</th>
                                <th class="col-">@lang('Food Allergy')</th>
                                <th class="col-">@lang('Heart Disease')</th>
                                <th class="col-">@lang('Diabetic')</th>
                                <th class="col-" data-orderable="false">@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patientCaseStudies as $patientCaseStudy)

                                <td><span style="text-wrap:nowrap;">{{ $patientCaseStudy->user->name ?? ' '}}</span></td>
                                <td>{{ $patientCaseStudy->user->email ?? ' ' }}</td>
                                <td>{{ $patientCaseStudy->user->phone ?? ' '}}</td>
                                <td>{{ $patientCaseStudy->food_allergy?? ' ' }}</td>
                                <td>{{ $patientCaseStudy->heart_disease ?? ' '}}</td>
                                <td>{{ $patientCaseStudy->diabetic }}</td>
                                <td>
                                    <a href="{{ route('patient-case-studies.show', $patientCaseStudy) }}"
                                        class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip"
                                        title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"></i></a>
                                    @can('patient-case-studies-update')
                                        <a href="{{ route('patient-case-studies.edit', $patientCaseStudy) }}"
                                            class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="tooltip"
                                            title="@lang('Edit')"><i class="fa fa-edit ambitious-padding-btn"></i></a>
                                    @endcan
                                    @can('patient-case-studies-delete')
                                        <a href="#"
                                            data-href="{{ route('patient-case-studies.destroy', $patientCaseStudy) }}"
                                            class="btn btn-info btn-outline btn-circle btn-lg" data-toggle="modal"
                                            data-target="#myModal" title="@lang('Delete')"><i
                                                class="fa fa-trash ambitious-padding-btn"></i></a>
                                    @endcan

                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $patientCaseStudies->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('layouts.delete_modal')
@endsection
