@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h3>@lang('User Profile')</h3>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('profile.setting') }}" class="btn btn-outline-primary shadow-sm mr-1">
                    <i class="fas fa-edit"></i> @lang('Edit Profile')
                </a>
                <a href="{{ route('profile.password') }}" class="btn btn-outline-secondary shadow-sm">
                    <i class="fas fa-key"></i> @lang('Change Password')
                </a>
            </div>
        </div>
    </div>
</section>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card shadow-sm border-0 card-primary card-outline">
                    <div class="card-body box-profile text-center">
                        <div class="text-center mb-3">
                            @php
                            if($user->photo == null) {
                            $photo = "assets/images/profile/male.png";
                            } else {
                            $photo = $user->photo;
                            }
                            @endphp
                            <img class="profile-user-img img-fluid img-circle shadow-sm"
                                src="{{ asset($photo) }}"
                                alt="User profile picture"
                                style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #dee2e6;">
                        </div>
                        <h3 class="profile-username text-center font-weight-bold mb-1">{{ Auth::user()->name }}</h3>
                        <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white p-3 border-bottom-0">
                        <h3 class="card-title font-weight-bold">@lang('Profile Details')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold text-muted">@lang('Name')</div>
                            <div class="col-sm-9">{{ $user->name }}</div>
                        </div>
                        <div class="dropdown-divider"></div>

                        <div class="row mb-3 mt-3">
                            <div class="col-sm-3 font-weight-bold text-muted">@lang('Email')</div>
                            <div class="col-sm-9">{{ $user->email }}</div>
                        </div>
                        <div class="dropdown-divider"></div>

                        <div class="row mb-3 mt-3">
                            <div class="col-sm-3 font-weight-bold text-muted">@lang('Phone')</div>
                            <div class="col-sm-9">{{ $user->phone ?? 'N/A' }}</div>
                        </div>
                        <div class="dropdown-divider"></div>

                        <div class="row mb-3 mt-3">
                            <div class="col-sm-3 font-weight-bold text-muted">@lang('Address')</div>
                            <div class="col-sm-9">{!! $user->address ?? 'N/A' !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection