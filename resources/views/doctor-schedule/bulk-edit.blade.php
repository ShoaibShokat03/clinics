@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Manage Weekly Schedule')</h1>
                <p class="text-muted small">@lang('Doctor'): <span class="font-weight-bold text-primary">{{ $doctor->name }}</span></p>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('doctor-details.index') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> @lang('Back to Doctors')
                </a>
            </div>
        </div>
    </div>
</section>

<div class="content">
    <div class="container-fluid">
        <form action="{{ route('doctor-schedules.bulk-update') }}" method="POST" id="bulkScheduleForm">
            @csrf
            <input type="hidden" name="user_id" value="{{ $doctor->id }}">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-3 border-bottom">
                    <h3 class="card-title font-weight-bold">@lang('Availability Settings')</h3>
                    <div class="card-tools">
                        <button type="submit" class="btn btn-primary btn-sm px-4">
                            <i class="fas fa-save mr-1"></i> @lang('Save All Changes')
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 150px;">@lang('Weekday')</th>
                                    <th style="width: 120px;">@lang('Status')</th>
                                    <th>@lang('Start Time')</th>
                                    <th>@lang('End Time')</th>
                                    <th style="width: 150px;">@lang('Duration (Mins)')</th>
                                    <th>@lang('Serial Type')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($weekdays as $day)
                                @php
                                $schedule = $schedules->get($day);
                                $isEnabled = $schedule ? true : false;
                                @endphp
                                <tr class="day-row {{ $isEnabled ? 'bg-white' : 'bg-light text-muted' }}" id="row-{{ $day }}">
                                    <td class="font-weight-bold">{{ $day }}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input toggle-day"
                                                id="switch-{{ $day }}"
                                                name="schedules[{{ $day }}][enabled]"
                                                value="1"
                                                {{ $isEnabled ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="switch-{{ $day }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="text" name="schedules[{{ $day }}][start_time]"
                                                class="form-control flatpickr-pick-time schedule-input"
                                                value="{{ $schedule->start_time ?? '09:00' }}"
                                                {{ !$isEnabled ? 'disabled' : '' }} required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="text" name="schedules[{{ $day }}][end_time]"
                                                class="form-control flatpickr-pick-time schedule-input"
                                                value="{{ $schedule->end_time ?? '17:00' }}"
                                                {{ !$isEnabled ? 'disabled' : '' }} required>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="schedules[{{ $day }}][avg_appointment_duration]"
                                            class="form-control form-control-sm schedule-input"
                                            value="{{ $schedule->avg_appointment_duration ?? 15 }}"
                                            min="1" {{ !$isEnabled ? 'disabled' : '' }} required>
                                    </td>
                                    <td>
                                        <select name="schedules[{{ $day }}][serial_type]"
                                            class="form-control form-control-sm schedule-input"
                                            {{ !$isEnabled ? 'disabled' : '' }}>
                                            <option value="Sequential" {{ ($schedule->serial_type ?? '') == 'Sequential' ? 'selected' : '' }}>@lang('Sequential')</option>
                                            <option value="Social" {{ ($schedule->serial_type ?? '') == 'Social' ? 'selected' : '' }}>@lang('Social')</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer bg-white text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> @lang('Save All Changes')
                    </button>
                </div> --}}
            </div>
        </form>
    </div>
</div>

@push('footer')
<script>
    $(document).ready(function() {
        $('.toggle-day').on('change', function() {
            const row = $(this).closest('tr');
            const isEnabled = $(this).is(':checked');

            if (isEnabled) {
                row.removeClass('bg-light text-muted').addClass('bg-white');
                row.find('.schedule-input').prop('disabled', false);
            } else {
                row.removeClass('bg-white').addClass('bg-light text-muted');
                row.find('.schedule-input').prop('disabled', true);
            }
        });
    });
</script>
@endpush
@endsection