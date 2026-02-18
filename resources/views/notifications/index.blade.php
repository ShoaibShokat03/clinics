@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('All Notifications')</h1>
            </div>
            <div class="col-sm-6 text-right">
                <div class="bulk-actions d-inline-block" style="display: none;">
                    <button type="button" class="btn btn-primary btn-sm mx-1" id="bulkMarkRead">
                        <i class="fas fa-check"></i> @lang('Mark Selected as Read')
                    </button>
                    <button type="button" class="btn btn-danger btn-sm mx-1" id="bulkDelete">
                        <i class="fas fa-trash"></i> @lang('Delete Selected')
                    </button>
                </div>
                <form action="{{ route('notifications.readAll') }}" method="POST" style="display: inline;" class="all-read-form">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-check-double"></i> @lang('Mark All as Read')
                    </button>
                </form>
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
                        <h3 class="card-title font-weight-bold">@lang('Notification List')</h3>
                        <div class="card-tools">
                            <button class="btn btn-default btn-sm" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> @lang('Filter')
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="filter" class="collapse @if (request()->status || request()->from_date || request()->to_date) show @endif">
                            <div class="card-body border mb-3">
                                <form action="{{ route('notifications.index') }}" method="get" role="form" autocomplete="off">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small font-weight-bold">@lang('Status')</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">@lang('All Status')</option>
                                                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>@lang('New / Unread')</option>
                                                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>@lang('Read')</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small font-weight-bold">@lang('From Date')</label>
                                                <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="small font-weight-bold">@lang('To Date')</label>
                                                <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 align-self-end">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                                @if (request()->status || request()->from_date || request()->to_date)
                                                <a href="{{ route('notifications.index') }}"
                                                    class="btn btn-secondary">@lang('Clear')</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="custom-control custom-checkbox mb-3 ml-2">
                                <input type="checkbox" class="custom-control-input" id="selectAll">
                                <label class="custom-control-label font-weight-bold" for="selectAll">@lang('Select All')</label>
                            </div>
                            <div class="list-group list-group-flush">
                                @forelse ($notifications as $notification)
                                <div class="list-group-item list-group-item-action d-flex align-items-center py-3 {{ $notification->status == 'new' ? 'bg-light' : '' }}" data-notification-id="{{ $notification->id }}">
                                    <div class="custom-control custom-checkbox mr-3">
                                        <input type="checkbox" class="custom-control-input notification-checkbox" id="check-{{ $notification->id }}" value="{{ $notification->id }}">
                                        <label class="custom-control-label" for="check-{{ $notification->id }}"></label>
                                    </div>
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="rounded-circle bg-{{ $notification->status == 'new' ? 'primary' : 'secondary' }} d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; opacity: {{ $notification->status == 'new' ? '1' : '0.6' }};">
                                            <i class="fas fa-{{ $notification->status == 'new' ? 'bell' : 'bell-slash' }} text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex w-100 justify-content-between align-items-start">
                                            <h6 class="mb-1 {{ $notification->status == 'new' ? 'font-weight-bold' : 'text-muted' }}">
                                                <a href="{{ url($notification->url) }}" class="text-{{ $notification->status == 'new' ? 'dark' : 'muted' }} notification-item-link" data-id="{{ $notification->id }}">
                                                    {{ $notification->text }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0 text-xs text-muted">
                                            {{ $notification->created_at->format('d M Y, h:i A') }}
                                            @if($notification->status == 'read')
                                            <span class="ml-2 text-success"><i class="fas fa-check"></i> @lang('Read')</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="ml-3">
                                        @if($notification->status == 'new')
                                        <span class="badge badge-primary">@lang('New')</span>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-5">
                                    <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">@lang('No notifications found.')</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    @if($notifications->hasPages())
                    <div class="card-footer bg-white border-top">
                        {{ $notifications->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('footer')
<script>
    $(document).ready(function() {
        // Select all checkbox
        $('#selectAll').on('change', function() {
            $('.notification-checkbox').prop('checked', $(this).prop('checked'));
            toggleBulkActions();
        });

        // Individual checkbox change
        $('.notification-checkbox').on('change', function() {
            if (!$(this).prop('checked')) {
                $('#selectAll').prop('checked', false);
            } else if ($('.notification-checkbox:checked').length === $('.notification-checkbox').length) {
                $('#selectAll').prop('checked', true);
            }
            toggleBulkActions();
        });

        function toggleBulkActions() {
            const checkedCount = $('.notification-checkbox:checked').length;
            if (checkedCount > 0) {
                $('.bulk-actions').fadeIn();
                $('.all-read-form').hide();
            } else {
                $('.bulk-actions').fadeOut();
                $('.all-read-form').show();
            }
        }

        // Bulk Mark as Read
        $('#bulkMarkRead').on('click', function() {
            const ids = $('.notification-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (ids.length > 0) {
                $.post("{{ route('notifications.bulkMarkAsRead') }}", {
                    _token: "{{ csrf_token() }}",
                    ids: ids
                }).done(function() {
                    location.reload();
                });
            }
        });

        // Bulk Delete
        $('#bulkDelete').on('click', function() {
            if (confirm("@lang('Are you sure you want to delete selected notifications?')")) {
                const ids = $('.notification-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (ids.length > 0) {
                    $.post("{{ route('notifications.bulkDelete') }}", {
                        _token: "{{ csrf_token() }}",
                        ids: ids
                    }).done(function() {
                        location.reload();
                    });
                }
            }
        });

        $('.notification-item-link').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const url = $(this).attr('href');

            $.post("{{ route('notifications.markAsRead') }}", {
                _token: "{{ csrf_token() }}",
                id: id
            }).always(function() {
                window.location.href = url;
            });
        });
    });
</script>
@endpush