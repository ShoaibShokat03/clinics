@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Lab List')</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('labs-create')
                <a href="{{ route('labs.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> @lang('Add Lab')
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
                        <h3 class="card-title font-weight-bold ml-1">@lang('Filter Labs')</h3>
                        <div class="card-tools">
                            <button class="btn btn-outline-secondary btn-sm ml-2" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> @lang('Filter')
                            </button>
                        </div>
                    </div>

                    <div id="filter" class="collapse @if(request()->has('isFilterActive')) show @endif">
                        <div class="card-body p-3 bg-light border-bottom">
                            <form action="{{ route('labs.index') }}" method="get" role="form" autocomplete="off">
                                <input type="hidden" name="isFilterActive" value="true">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Lab Number')</label>
                                            <input type="text" name="lab_number" class="form-control form-control-sm" value="{{ request()->input('lab_number') }}" placeholder="@lang('Lab Number')">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Lab Name')</label>
                                            <input type="text" name="title" class="form-control form-control-sm" value="{{ request()->input('title') }}" placeholder="@lang('Lab Name')">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Phone No.')</label>
                                            <input type="text" name="phone_no" class="form-control form-control-sm" value="{{ request()->input('phone_no') }}" placeholder="@lang('Phone No.')">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Address')</label>
                                            <input type="text" name="address" class="form-control form-control-sm" value="{{ request()->input('address') }}" placeholder="@lang('Address')">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-info btn-sm">@lang('Submit')</button>
                                        @if(request()->has('isFilterActive'))
                                        <a href="{{ route('labs.index') }}" class="btn btn-secondary btn-sm ml-2">@lang('Clear')</a>
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
                                        <th>@lang('Lab Number')</th>
                                        <th>@lang('Lab Name')</th>
                                        <th>@lang('Lab Description')</th>
                                        <th>@lang('Lab Address')</th>
                                        <th>@lang('Phone No.')</th>
                                        <th data-orderable="false">@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($labs as $lab)
                                    <tr>
                                        <td><span class="badge badge-light border">{{ $lab->lab_number }}</span></td>
                                        <td>{{ $lab->title }}</td>
                                        <td>{{ Str::limit($lab->description, 50) }}</td>
                                        <td>{{ $lab->address }}</td>
                                        <td>{{ $lab->phone_no }}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="{{ route('labs.show', $lab) }}" class="btn btn-sm btn-outline-info ml-1" data-toggle="tooltip" title="@lang('View')">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @can('labs-update')
                                                <a href="{{ route('labs.edit', $lab) }}" class="btn btn-sm btn-outline-warning ml-1" data-toggle="tooltip" title="@lang('Edit')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('labs-delete')
                                                <a href="#" data-href="{{ route('labs.destroy', $lab) }}" class="btn btn-sm btn-outline-danger ml-1" data-toggle="modal" data-target="#myModal" title="@lang('Delete')">
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
                    {{ $labs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.delete_modal')
@endsection