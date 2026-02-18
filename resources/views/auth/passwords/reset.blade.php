@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-white text-center py-4 border-bottom-0">
                    <h3 class="font-weight-bold text-dark mb-0">{{ __('Reset Password') }}</h3>
                    <p class="text-muted small mb-0 mt-2">Enter your new password</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-3">
                            <label for="email" class="font-weight-bold ml-1">{{ __('E-Mail Address') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control border-left-0 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="font-weight-bold ml-1">{{ __('Password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-lock text-muted"></i></span>
                                </div>
                                <input id="password" type="password" class="form-control border-left-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm" class="font-weight-bold ml-1">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-check-circle text-muted"></i></span>
                                </div>
                                <input id="password-confirm" type="password" class="form-control border-left-0" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm New Password">
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm py-2">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3 text-muted small">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </div>
        </div>
    </div>
</div>
@endsection