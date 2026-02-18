@extends('layouts.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">@lang('Edit Social History')</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('patient-details.history', $patient->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> @lang('Back to History')
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="container-fluid">
            <input type="hidden" id="record_id" value="{{ $patient->id }}">
            <input type="hidden" id="table_name" value="patient">
            <!-- Social History Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white p-3 border-bottom">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-users mr-2 text-primary"></i>
                        @lang('Social History for') {{ $patient->name }}
                    </h3>
                </div>
                <div class="card-body p-4">
                    <form id="socialhistoryForm" action="{{ route('patient-social-histories.update', $patient->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="patient" value="{{ $patient->id }}">
                        <input type="hidden" name="doctor" value="{{ $patientSocialHistories[0]->doctor_id }}">

                        <div class="row">
                            @foreach ($ddSocialHistories as $item)
                                @php
                                    $historyRecord = $patientSocialHistories
                                        ->where('dd_social_history_id', $item->id)
                                        ->first();
                                    $isChecked = !empty($historyRecord);
                                @endphp
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div
                                        class="history-item-card p-3 border rounded h-100 {{ $isChecked ? 'border-primary bg-light' : '' }}">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input history-checkbox"
                                                id="title_{{ $item->id }}"
                                                name="social_histories[{{ $item->id }}][checked]"
                                                {{ $isChecked ? 'checked' : '' }}>
                                            <label class="custom-control-label font-weight-bold"
                                                for="title_{{ $item->id }}">
                                                {{ $item->title }}
                                            </label>
                                        </div>
                                        <div class="form-group mb-0 history-comment-group"
                                            style="{{ $isChecked ? '' : 'display:none;' }}">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-white border-right-0"><i
                                                            class="fas fa-comment-dots text-muted"></i></span>
                                                </div>
                                                <input type="text" class="form-control border-left-0"
                                                    id="details_{{ $item->id }}"
                                                    name="social_histories[{{ $item->id }}][comments]"
                                                    placeholder="@lang('Add details...')"
                                                    value="{{ $historyRecord->comments ?? '' }}"
                                                    {{ $isChecked ? '' : 'disabled' }}>
                                            </div>
                                            <input type="hidden" value="{{ $item->id }}"
                                                name="social_histories[{{ $item->id }}][title_id]">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-3 border-top text-right">
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="fas fa-save mr-2"></i>@lang('Save Changes')
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Documents Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white p-3 border-bottom">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-file-upload mr-2 text-info"></i>
                        @lang('Social Documents')
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="upload-area mb-4">
                        <label class="font-weight-bold mb-2">@lang('Upload Files')</label>
                        <input id="social_history" name="social_history[]" type="file" multiple
                            data-allowed-file-extensions="png jpg jpeg pdf xml txt doc docx mp4"
                            data-max-file-size="2048K" />
                        <p class="text-muted small mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            @lang('Max Size: 2048kb. Allowed Formats: PNG, JPG, JPEG, PDF, XML, TXT, DOC, DOCX, MP4')
                        </p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover border">
                            <thead class="bg-light">
                                <tr>
                                    <th>@lang('File Name')</th>
                                    <th>@lang('Uploaded By')</th>
                                    <th>@lang('Upload Date')</th>
                                    <th class="text-right">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody id="socialHistoryTableBody" class="fileTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Logs Section -->
            @if ($logs)
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3 border-bottom d-flex align-items-center justify-content-between"
                        data-toggle="collapse" data-target="#logsCollapse" style="cursor:pointer;">
                        <h3 class="card-title font-weight-bold m-0">
                            <i class="fas fa-history mr-2 text-muted"></i>@lang('Activity Logs')
                        </h3>
                        <i class="fas fa-chevron-down text-muted"></i>
                    </div>
                    <div id="logsCollapse" class="collapse">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>@lang('User')</th>
                                            <th>@lang('Action')</th>
                                            <th>@lang('Field')</th>
                                            <th>@lang('Old Value')</th>
                                            <th>@lang('New Value')</th>
                                            <th>@lang('Timestamp')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $log)
                                            <tr>
                                                <td class="font-weight-500">{{ $log->user->name }}</td>
                                                <td><span
                                                        class="badge badge-soft-{{ $log->action == 'created' ? 'success' : 'info' }}">{{ $log->action }}</span>
                                                </td>
                                                <td><code>{{ $log->field_name }}</code></td>
                                                <td><small class="text-muted">{{ $log->old_value }}</small></td>
                                                <td><small class="text-dark">{{ $log->new_value }}</small></td>
                                                <td class="small">{{ $log->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .history-item-card {
            border-left: 4px solid #dee2e6 !important;
            transition: all 0.2s;
        }

        .history-item-card.border-primary {
            border-left-color: var(--primary-color) !important;
        }

        .history-item-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .badge-soft-success {
            background: #e6f7ef;
            color: #1e7e34;
        }

        .badge-soft-info {
            background: #e7f3ff;
            color: #004085;
        }
    </style>

    <script>
        var getFilesUrl = "{{ route('get-files', $patient->id) }}";
        var uploadFilesUrl = "{{ route('upload-file') }}";
        var deleteFilesUrl = "{{ route('delete-file') }}";
        var baseUrl = "{{ asset('') }}";

        document.addEventListener('DOMContentLoaded', function() {
            // Toggle comment inputs based on checkbox
            $('.history-checkbox').on('change', function() {
                const card = $(this).closest('.history-item-card');
                const commentGroup = card.find('.history-comment-group');
                const input = commentGroup.find('input');

                if ($(this).is(':checked')) {
                    card.addClass('border-primary bg-light');
                    commentGroup.slideDown(200);
                    input.prop('disabled', false);
                } else {
                    card.removeClass('border-primary bg-light');
                    commentGroup.slideUp(200);
                    input.prop('disabled', true);
                }
            });
        });
    </script>
@endsection
