@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">@lang('Add Social History')</h3>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('patient-social-histories.index') }}" class="btn btn-outline-info btn-sm">
                    <i class="fas fa-eye"></i> @lang('View All')
                </a>
            </div>
        </div>
    </div>
</section>

<div class="content">
    <div class="container-fluid">
        <form id="socialhistoryForm" action="{{ route('patient-social-histories.store') }}" method="POST" data-parsley-validate>
            @csrf

            <!-- Patient & Doctor Selection Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-2">@lang('Select Patient') <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-user-injured text-muted"></i></span>
                                    </div>
                                    <select name="patient" class="form-control select2 @error('patient') is-invalid @enderror" required data-parsley-errors-container="#patient-errors">
                                        <option value="">--@lang('Select')--</option>
                                        @foreach ($patients->sortBy(fn($patient) => strtolower($patient->name ?? '')) as $p)
                                        <option value="{{ $p->id }}" {{ (isset($selectedPatientId) && $selectedPatientId == $p->id) || old('patient') == $p->id ? 'selected' : '' }}>
                                            {{ $p->name }} - {{ $p->patientDetails->mrn_number ?? '#' . $p->id }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="patient-errors"></div>
                                @error('patient') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            @if(auth()->user()->hasRole('Doctor'))
                            <input type="hidden" name="doctor" value="{{ auth()->user()->id }}" />
                            @else
                            <div class="form-group mb-0">
                                <label class="font-weight-600 mb-2">@lang('Select Doctor') <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-user-md text-muted"></i></span>
                                    </div>
                                    <select name="doctor" class="form-control select2 @error('doctor') is-invalid @enderror" required data-parsley-errors-container="#doctor-errors">
                                        <option value="">--@lang('Select')--</option>
                                        @foreach ($doctor as $d)
                                        <option value="{{ $d->id }}" {{ old('doctor') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="doctor-errors"></div>
                                @error('doctor') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Selection Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white p-3 border-bottom">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-users mr-2 text-primary"></i>
                        @lang('Social History Details')
                    </h3>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        @foreach ($ddSocialHistory as $item)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="history-item-card p-3 border rounded h-100">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input history-checkbox"
                                        id="title_{{ $item->id }}"
                                        name="social_histories[{{ $item->id }}][checked]">
                                    <label class="custom-control-label font-weight-bold" for="title_{{ $item->id }}">
                                        {{ $item->title }}
                                    </label>
                                </div>
                                <div class="form-group mb-0 history-comment-group" style="display:none;">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-comment-dots text-muted"></i></span>
                                        </div>
                                        <input type="text" class="form-control border-left-0"
                                            id="details_{{ $item->id }}"
                                            name="social_histories[{{ $item->id }}][comments]"
                                            placeholder="@lang('Add details...')"
                                            disabled>
                                    </div>
                                    <input type="hidden" value="{{ $item->id }}" name="social_histories[{{ $item->id }}][title_id]">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-4 pt-3 border-top text-right">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                            <i class="fas fa-save mr-2"></i>@lang('Save History')
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .history-item-card {
        border-left: 4px solid #dee2e6 !important;
        transition: all 0.2s;
    }

    .history-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .history-item-card.active {
        border-left-color: var(--primary-color) !important;
        background-color: #f9fbfd;
    }

    .font-weight-600 {
        font-weight: 600;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle comment inputs based on checkbox
        $('.history-checkbox').on('change', function() {
            const card = $(this).closest('.history-item-card');
            const commentGroup = card.find('.history-comment-group');
            const input = commentGroup.find('input');

            if ($(this).is(':checked')) {
                card.addClass('active');
                commentGroup.slideDown(200);
                input.prop('disabled', false);
                input.focus();
            } else {
                card.removeClass('active');
                commentGroup.slideUp(200);
                input.prop('disabled', true);
            }
        });
    });
</script>
@endsection