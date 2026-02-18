@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Doctor Schedule')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button type="button" id="bulk_delete" class="btn btn-danger btn-sm d-none">
                        <i class="fas fa-trash"></i> @lang('Delete Selected')
                    </button>
                    @can('doctor-schedule-create')
                        <!-- <a href="{{ route('doctor-schedules.create') }}" class="btn btn-primary btn-sm ml-2">
                                    <i class="fas fa-plus"></i> @lang('Add Schedule')
                                </a> -->
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
                            <h3 class="card-title font-weight-bold ml-1">@lang('Filter Schedules')</h3>
                            <div class="card-tools">
                                <a class="btn btn-outline-primary btn-sm" target="_blank"
                                    href="{{ route('doctor-schedules.index') }}?export=1">
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
                                        <div class="col-sm-4">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Doctor')</label>
                                                <select name="user_id" class="form-control form-control-sm select2"
                                                    id="user_id">
                                                    <option value="">--@lang('Select')--</option>
                                                    @foreach ($doctors->sortBy(fn($doctor) => strtolower(optional($doctor->user)->name)) as $doctor)
                                                        @if (!is_null(optional($doctor->user)->name))
                                                            <option value="{{ $doctor->user->id }}"
                                                                {{ old('user_id', request()->user_id) == $doctor->user->id ? 'selected' : '' }}>
                                                                {{ optional($doctor->user)->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-2">
                                                <label
                                                    class="text-secondary small font-weight-bold">@lang('Week Day')</label>
                                                <select name="weekday" class="form-control form-control-sm select2">
                                                    <option value="">--@lang('Select')--</option>
                                                    @foreach (config('constant.weekdays') as $day)
                                                        <option value="{{ $day }}"
                                                            {{ request()->weekday == $day ? 'selected' : '' }}>
                                                            @lang($day)
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-right mt-4">
                                            <button type="submit" class="btn btn-info btn-sm">@lang('Submit')</button>
                                            @if (request()->isFilterActive)
                                                <a href="{{ route('doctor-schedules.index') }}"
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
                                            <th style="width: 40px;" class="align-middle">
                                                <div class="custom-control custom-checkbox text-center">
                                                    <input type="checkbox" class="custom-control-input" id="check_all">
                                                    <label class="custom-control-label" for="check_all"></label>
                                                </div>
                                            </th>
                                            <th>@lang('Doctor Name')</th>
                                            <th>@lang('Weekday')</th>
                                            <th>@lang('Start Time')</th>
                                            <th>@lang('End Time')</th>
                                            <th>@lang('Status')</th>
                                            <th data-orderable="false">@lang('Actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($doctorSchedules as $doctorSchedule)
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="custom-control custom-checkbox text-center">
                                                        <input type="checkbox"
                                                            class="custom-control-input schedule_checkbox"
                                                            id="check-{{ $doctorSchedule->id }}"
                                                            value="{{ $doctorSchedule->id }}">
                                                        <label class="custom-control-label"
                                                            for="check-{{ $doctorSchedule->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="align-middle">{{ $doctorSchedule->user->name ?? '-' }}</td>
                                                <td class="align-middle">{{ $doctorSchedule->weekday }}</td>
                                                <td class="align-middle">{{ $doctorSchedule->start_time }}</td>
                                                <td class="align-middle">{{ $doctorSchedule->end_time }}</td>
                                                <td class="align-middle">
                                                    @if ($doctorSchedule->status == '1')
                                                        <span class="badge badge-success">@lang('Active')</span>
                                                    @else
                                                        <span class="badge badge-danger">@lang('Inactive')</span>
                                                    @endif
                                                </td>
                                                <td class="text-right align-middle">
                                                    <div class="btn-group">
                                                        <a href="{{ route('doctor-schedules.show', $doctorSchedule) }}"
                                                            class="btn btn-sm btn-outline-info" data-toggle="tooltip"
                                                            title="@lang('View')">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        @can('doctor-schedule-update')
                                                            <a href="{{ route('doctor-schedules.edit', $doctorSchedule) }}"
                                                                class="btn btn-sm btn-outline-warning ml-1"
                                                                data-toggle="tooltip" title="@lang('Edit')">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        @can('doctor-schedule-delete')
                                                            <a href="#"
                                                                data-href="{{ route('doctor-schedules.destroy', $doctorSchedule) }}"
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
                            <div class="card-footer bg-white">
                                {{ $doctorSchedules->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.delete_modal')

    @push('footer')
        <script>
            $(document).ready(function() {
                // Check All functionality
                $('#check_all').on('click', function() {
                    $('.schedule_checkbox').prop('checked', $(this).prop('checked'));
                    toggleBulkDeleteBtn();
                });

                // Individual checkbox change
                $('.schedule_checkbox').on('change', function() {
                    if ($('.schedule_checkbox:checked').length == $('.schedule_checkbox').length) {
                        $('#check_all').prop('checked', true);
                    } else {
                        $('#check_all').prop('checked', false);
                    }
                    toggleBulkDeleteBtn();
                });

                function toggleBulkDeleteBtn() {
                    if ($('.schedule_checkbox:checked').length > 0) {
                        $('#bulk_delete').removeClass('d-none');
                    } else {
                        $('#bulk_delete').addClass('d-none');
                    }
                }

                // Bulk Delete click
                $('#bulk_delete').on('click', function() {
                    var selectedIds = [];
                    $('.schedule_checkbox:checked').each(function() {
                        selectedIds.push($(this).val());
                    });

                    if (selectedIds.length > 0) {
                        Swal.fire({
                            title: "@lang('Are you sure?')",
                            text: "@lang('You will not be able to revert this!')",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: "@lang('Yes, delete them!')",
                            cancelButtonText: "@lang('Cancel')"
                        }).then((result) => {
                            if (result.isConfirmed || result.value) {
                                $.ajax({
                                    url: "{{ url('') }}/{{ request()->segment(1) }}/doctor-schedules/bulk-delete",
                                    type: 'POST',
                                    data: {
                                        ids: selectedIds,
                                        _token: "{{ csrf_token() }}"
                                    },
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            Swal.fire({
                                                title: "@lang('Deleted!')",
                                                text: response.message,
                                                icon: 'success'
                                            }).then(() => {
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire(
                                                "@lang('Error!')",
                                                response.message,
                                                'error'
                                            );
                                        }
                                    },
                                    error: function() {
                                        Swal.fire(
                                            "@lang('Error!')",
                                            "@lang('Something went wrong. Please try again.')",
                                            'error'
                                        );
                                    }
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
