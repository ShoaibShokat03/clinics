@extends('layouts.layout')

@section('one_page_js')
<script src="{{ asset('assets/js/quill.js') }}"></script>
<script src="{{ asset('assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
@endsection

@section('one_page_css')
<link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h3>@lang('Account Settings')</h3>
            </div>
            <div class="col-sm-6 text-right">
                <button type="button" class="btn btn-primary shadow-sm" onclick="document.getElementById('setting-form').submit();">
                    <i class="fas fa-save"></i> {{ __('Save Changes') }}
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
                        <h3 class="card-title font-weight-bold ml-1">{{ __('Account Setting Title') }}</h3>
                    </div>
                    <div class="card-body">
                        <form id="setting-form" class="form-material" action="{{ route('profile.updateSetting') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name" class="font-weight-bold">{{ __('Name') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" name="name" id="name" value="{{ $user->name }}" type="text" placeholder="{{ __('Type Your Name Here') }}" required>
                                    @if ($errors->has('name'))
                                    <span class="text-danger small">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="email" class="font-weight-bold">{{ __('Email') }} <span class="text-danger">*</span></label>
                                    <input class="form-control" name="email" id="email" value="{{ $user->email }}" type="email" placeholder="{{ __('Type Your Email Here') }}" required>
                                    @if ($errors->has('email'))
                                    <span class="text-danger small">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="phone" class="font-weight-bold">{{ __('Phone') }}</label>
                                    <input class="form-control" name="phone" value="{{ $user->phone }}" id="phone" type="text" placeholder="{{ __('Type Your Phone Here') }}">
                                    @if ($errors->has('phone'))
                                    <span class="text-danger small">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="photo" class="font-weight-bold">{{ __('Photo') }}</label>
                                    <p class="text-muted small mb-1">{{ __('Max Dimension: 200 x 200, Max Size: 100kb, Allowed format: png, jpg, jpeg') }}</p>
                                    <input id="photo" class="dropify" name="photo" type="file" data-default-file="{{ asset('public/'.$user->photo) }}" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="5120K" />
                                    <small class="form-text text-muted">{{ __('Leave Blank For Remain Unchanged') }}</small>
                                    @if ($errors->has('photo'))
                                    <span class="text-danger small">{{ $errors->first('photo') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="address" class="font-weight-bold">{{ __('Address') }}</label>
                                    <div id="edit_input_address" style="min-height: 100px;"></div>
                                    <input type="hidden" name="address" id="address" value="{{ $user->address }}">
                                    @if ($errors->has('address'))
                                    <span class="text-danger small">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="{{ asset('assets/js/custom/setting.js') }}"></script> --}}
<script>
    // Initialize Quill with value if needed (usually handled by setting.js but verifying)
</script>
@endsection