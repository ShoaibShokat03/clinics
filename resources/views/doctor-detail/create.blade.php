@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Create Doctor')</h1>
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
                    <div class="card-header bg-white p-3 border-bottom-0">
                        <h3 class="card-title font-weight-bold">@lang('Doctor Info')</h3>
                    </div>
                    <div class="card-body">
                        <form id="departmentForm" data-parsley-validate class="form-material form-horizontal" action="{{ route('doctor-details.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">@lang('Name') <b class="ambitious-crimson">*</b></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                            </div>
                                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('Name')" required data-parsley-required-message="Please enter doctor's name">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">@lang('Email') <b class="ambitious-crimson">*</b></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                                            </div>
                                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Email')" required data-parsley-required-message="Please enter a valid email" data-parsley-type="email">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">@lang('Password') <b class="ambitious-crimson">*</b></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('Password')" required data-parsley-required-message="Please enter password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">@lang('Confirm Password') <b class="ambitious-crimson">*</b></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="@lang('Confirm Password')" required data-parsley-equalto="#password" data-parsley-equalto-message="Passwords do not match">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">@lang('Phone')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="@lang('Phone')" data-parsley-type="digits" data-parsley-required-message="Please enter a valid phone number">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="specialist">@lang('Specialist')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                                            </div>
                                            <input type="text" id="specialist" name="specialist" value="{{ old('specialist') }}" class="form-control @error('specialist') is-invalid @enderror" placeholder="@lang('Specialist')">
                                            @error('specialist')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation">@lang('Designation')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                            </div>
                                            <input type="text" id="designation" name="designation" value="{{ old('designation') }}" class="form-control @error('designation') is-invalid @enderror" placeholder="@lang('Designation')">
                                            @error('designation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">@lang('Gender')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                            </div>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender">
                                                <option value="">--@lang('Select')--</option>
                                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>@lang('Male')</option>
                                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>@lang('Female')</option>
                                                <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>@lang('Other')</option>
                                            </select>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group">@lang('Blood Group')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-heartbeat"></i></span>
                                            </div>
                                            <select name="blood_group" class="form-control select2 @error('blood_group') is-invalid @enderror" id="blood_group">
                                                <option value="" disabled {{ old('blood_group') ? '' : 'selected' }}>Select Blood Group</option>
                                                @foreach ($bloodGroups as $bloodGroup)
                                                <option value="{{ $bloodGroup->id }}" {{ old('blood_group') == $bloodGroup->id ? 'selected' : '' }}>{{ $bloodGroup->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('blood_group')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_birth">@lang('Date of Birth')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                            </div>
                                            <input type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control flatpickr @error('date_of_birth') is-invalid @enderror" placeholder="@lang('Date of Birth')" data-parsley-required-message="Please enter a valid date in the format YYYY-MM-DD" data-parsley-pattern="\d{4}-\d{2}-\d{2}">
                                            @error('date_of_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="commission">@lang('Commission') %</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                            </div>
                                            <input type="number" id="commission" name="commission" value="{{ old('commission') }}" class="form-control @error('commission') is-invalid @enderror" placeholder="@lang('Commission')" min="1" max="100" required data-parsley-required-message="Please enter a commission percentage" data-parsley-type="digits" data-parsley-min="1" data-parsley-max="100" data-parsley-min-message="Commission must be at least 1" data-parsley-max-message="Commission cannot exceed 100">
                                            @error('commission')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">@lang('Status')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                            </div>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>@lang('Active')</option>
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>@lang('Inactive')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="day_from">@lang('Day From')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                            </div>
                                            <select id="day_from" name="day_from" class="form-control @error('day_from') is-invalid @enderror" required data-parsley-required-message="Please select a day of the week">
                                                <option value="">-- Day From --</option>
                                                <option value="monday" {{ old('day_from') == 'monday' ? 'selected' : '' }}>Monday</option>
                                                <option value="tuesday" {{ old('day_from') == 'tuesday' ? 'selected' : '' }}>Tuesday</option>
                                                <option value="wednesday" {{ old('day_from') == 'wednesday' ? 'selected' : '' }}>Wednesday</option>
                                                <option value="thursday" {{ old('day_from') == 'thursday' ? 'selected' : '' }}>Thursday</option>
                                                <option value="friday" {{ old('day_from') == 'friday' ? 'selected' : '' }}>Friday</option>
                                                <option value="saturday" {{ old('day_from') == 'saturday' ? 'selected' : '' }}>Saturday</option>
                                                <option value="sunday" {{ old('day_from') == 'sunday' ? 'selected' : '' }}>Sunday</option>
                                            </select>
                                            @error('day_from')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="day_to">@lang('Day To')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                            </div>
                                            <select id="day_to" name="day_to" class="form-control @error('day_to') is-invalid @enderror" required data-parsley-required-message="Please select a day of the week">
                                                <option value="">-- Day To --</option>
                                                <option value="monday" {{ old('day_to') == 'monday' ? 'selected' : '' }}>Monday</option>
                                                <option value="tuesday" {{ old('day_to') == 'tuesday' ? 'selected' : '' }}>Tuesday</option>
                                                <option value="wednesday" {{ old('day_to') == 'wednesday' ? 'selected' : '' }}>Wednesday</option>
                                                <option value="thursday" {{ old('day_to') == 'thursday' ? 'selected' : '' }}>Thursday</option>
                                                <option value="friday" {{ old('day_to') == 'friday' ? 'selected' : '' }}>Friday</option>
                                                <option value="saturday" {{ old('day_to') == 'saturday' ? 'selected' : '' }}>Saturday</option>
                                                <option value="sunday" {{ old('day_to') == 'sunday' ? 'selected' : '' }}>Sunday</option>
                                            </select>
                                            @error('day_to')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="experience">@lang('Experience (Years)')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                            </div>
                                            <select id="experience" name="experience" class="form-control @error('experience') is-invalid @enderror" required data-parsley-required-message="Please select your experience">
                                                <option value="">-- Select Experience --</option>
                                                @for ($i = 1; $i <= 20; $i++)
                                                    <option value="{{ $i }}" {{ old('experience') == $i ? 'selected' : '' }}>
                                                    {{ $i }} {{ Str::plural('Year', $i) }}
                                                    </option>
                                                    @endfor
                                            </select>
                                            @error('experience')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">@lang('Address')</label>
                                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="2" placeholder="@lang('Address')">{{ old('address') }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="doctor_biography">@lang('Biography')</label>
                                        <textarea name="biography" id="doctor_biography" class="form-control @error('doctor_biography') is-invalid @enderror" rows="4" placeholder="@lang('I am a Doctor')">{{ old('doctor_biography') }}</textarea>
                                        @error('doctor_biography')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="photo">
                                            <h4>{{ __('Photo') }}</h4>
                                        </label>
                                        <input id="photo" class="dropify" name="photo" type="file" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2024K" />
                                        <p class="text-muted small">{{ __('Max Size: 1000kb, Allowed Format: png, jpg, jpeg') }}</p>
                                        @error('photo')
                                        <div class="error ambitious-red">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right mt-3">
                                    <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                                    <a href="{{ route('doctor-details.index') }}" class="btn btn-secondary ml-2">@lang('Cancel')</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/custom/doctor-detail.js') }}"></script>
        @endsection