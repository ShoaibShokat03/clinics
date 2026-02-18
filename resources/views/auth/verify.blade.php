@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-white text-center py-4 border-bottom-0">
                    <h3 class="font-weight-bold text-dark mb-0">{{ __('Verify Email') }}</h3>
                    <p class="text-muted small mb-0 mt-2">Verify your email address to continue</p>
                </div>
                <div class="card-body p-4 text-center">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    <p class="text-muted mb-4">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                    </p>

                    <a href="{{ route('verification.resend') }}" class="btn btn-primary btn-block font-weight-bold shadow-sm py-2">
                        {{ __('Click here to request another') }}
                    </a>
                </div>
            </div>
            <div class="text-center mt-3 text-muted small">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </div>
        </div>
    </div>
</div>
@endsection