@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h3>@lang('Change Password')</h3>
            </div>
            <div class="col-sm-6 text-right">
                <button type="button" class="btn btn-primary shadow-sm" onclick="document.getElementById('change-password-form').submit();">
                    <i class="fas fa-save"></i> {{ __('Update Password') }}
                </button>
                <a href="{{ route('profile.view') }}" class="btn btn-outline-secondary ml-1">
                    <i class="fas fa-times"></i> {{ __('Cancel') }}
                </a>
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
                        <h3 class="card-title font-weight-bold ml-1">{{ __('Change Your Password') }}</h3>
                    </div>
                    <div class="card-body">
                        <form id="change-password-form" class="form-material" action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="current-password" class="font-weight-bold">{{ __('Current Password') }} <span class="text-danger">*</span></label>
                                        <input class="form-control" name="current-password" id="current-password" type="password" placeholder="{{ __('Type Your Current Password Here') }}" required>
                                        @if ($errors->has('current-password'))
                                        <span class="text-danger small">{{ $errors->first('current-password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="new-password" class="font-weight-bold">{{ __('New Password') }} <span class="text-danger">*</span></label>
                                        <input class="form-control" name="new-password" id="new-password" type="password" placeholder="{{ __('Type Your New Password Here') }}" required>
                                        <small class="form-text text-muted">{{ __('Minimum 6 characters') }}</small>
                                        @if ($errors->has('new-password'))
                                        <span class="text-danger small">{{ $errors->first('new-password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="new-password-confirm" class="font-weight-bold">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                        <input class="form-control" name="new-password_confirmation" id="new-password-confirm" type="password" placeholder="{{ __('Confirm Your New Password') }}" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection