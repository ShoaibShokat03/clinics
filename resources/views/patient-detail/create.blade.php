@extends('layouts.layout')
@section('content')
    <style>
        .email-label {
            display: inline-block;
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .input-group {
            position: relative;
        }

        .email-checkbox {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Add Patient')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('patient-details.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> @lang('Back to List')
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
                            <h3 class="card-title font-weight-bold">@lang('Create Patient')</h3>
                        </div>
                        <div class="card-body">
                            <form id="patientForm" class="form-material form-horizontal"
                                action="{{ route('patient-details.store') }}" method="POST" enctype="multipart/form-data"
                                data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">@lang('Name') <b
                                                    class="ambitious-crimson">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                                </div>
                                                <input type="text" id="name" name="name"
                                                    value="{{ old('name') }}"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="@lang('John Doe')" required data-parsley-required="true"
                                                    data-parsley-required-message="@lang(" Please enter patient's name")">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone">@lang('Phone') <b
                                                    class="ambitious-crimson">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="number" id="phone" name="phone"
                                                    value="{{ old('phone') }}"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    placeholder="@lang('03375544887')" required data-parsley-required="true"
                                                    data-parsley-required-message="@lang('Phone is required')"
                                                    data-parsley-type="number"
                                                    data-parsley-type-message="@lang('Invalid phone number')">
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email" class="email-label">
                                                @lang('Email') <b class="ambitious-crimson">*</b>
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                </div>
                                                <input type="email" id="email" name="email" required
                                                    value="{{ old('email') }}"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="@lang('example@gmail.com')" data-parsley-required="true"
                                                    data-parsley-required-message="@lang('Email is required')"
                                                    data-parsley-type="email"
                                                    data-parsley-type-message="@lang('Invalid email address')">
                                                <input style="position: absolute;top: -19px;right: 10px;" type="checkbox"
                                                    class="form-check-input email-checkbox" id="noEmailCheckbox">
                                                <label style="position: absolute;top: -30px;right: 30px;"
                                                    class="form-check-label"
                                                    for="noEmailCheckbox">@lang('No Email')</label>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender">@lang('Gender')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                                </div>
                                                <select name="gender"
                                                    class="form-control @error('gender') is-invalid @enderror"
                                                    id="gender" data-parsley-required="true"
                                                    data-parsley-required-message="@lang('Gender is required')">
                                                    <option value="">--@lang('Select')--</option>
                                                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>
                                                        @lang('Male')
                                                    </option>
                                                    <option value="female"
                                                        {{ old('gender') === 'female' ? 'selected' : '' }}>
                                                        @lang('Female')</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="blood_group">@lang('Blood Group')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heartbeat"></i></span>
                                                </div>
                                                <select name="blood_group"
                                                    class="form-control select2 @error('blood_group') is-invalid @enderror"
                                                    id="blood_group">
                                                    <option value="" {{ old('blood_group') ? '' : 'selected' }}>
                                                        Select Blood Group</option>
                                                    @foreach ($bloodGroups as $bloodGroup)
                                                        <option value="{{ $bloodGroup->id }}"
                                                            {{ old('blood_group') == $bloodGroup->id ? 'selected' : '' }}>
                                                            {{ $bloodGroup->name }}
                                                        </option>
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date_of_birth">@lang('Date of Birth')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-birthday-cake"></i></span>
                                                </div>
                                                <input type="date" name="date_of_birth" id="date_of_birth"
                                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                                    value="{{ old('date_of_birth') }}" max="{{ date('Y-m-d') }}">
                                                @error('date_of_birth')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="marital_status">@lang('Marital Status')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                                </div>
                                                <select
                                                    class="form-control select2 ambitious-form-loading @error('marital_status') is-invalid @enderror"
                                                    name="marital_status" id="marital_status">
                                                    <option value="" {{ old('marital_status') ? '' : 'selected' }}>
                                                        Select
                                                    </option>
                                                    @foreach ($maritalStatuses as $maritalStatus)
                                                        <option value="{{ $maritalStatus->id }}"
                                                            {{ old('marital_status') == $maritalStatus->id ? 'selected' : '' }}>
                                                            {{ $maritalStatus->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('marital_status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cnic">@lang('CNIC / Passport')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                </div>
                                                <input type="text" id="cnic" name="cnic" class="form-control"
                                                    value="{{ old('cnic') }}" placeholder="@lang('11111-1111111-1')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="display: none;">
                                        <div class="form-group">
                                            <label for="credit_balance">@lang('Credit Balance')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rs.</span>
                                                </div>
                                                <input type="number" name="credit_balance" id="credit_balance"
                                                    class="form-control @error('credit_balance') is-invalid @enderror"
                                                    value="{{ old('credit_balance') }}" placeholder="@lang('15000')">
                                                @error('credit_balance')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="insurance_provider_id">@lang('Insurance Provider')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-shield-alt"></i></span>
                                                </div>
                                                <select
                                                    class="select2-custom form-control select2 ambitious-form-loading @error('insurance_provider_id') is-invalid @enderror"
                                                    name="insurance_provider_id" id="insurance_provider_id">
                                                    <option value=""
                                                        {{ old('insurance_provider_id') ? '' : ' selected' }}>
                                                        Select Provider</option>
                                                    @foreach ($insuranceProviders as $insuranceProvider)
                                                        <option value="{{ $insuranceProvider->id }}"
                                                            {{ old('insurance_provider_id') == $insuranceProvider->id ? 'selected' : '' }}>
                                                            {{ $insuranceProvider->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('insurance_provider_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="area">@lang('Area')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fa fa-solid fa-map-marker"></i></span>
                                                </div>
                                                <input type="text" name="area" id="area"
                                                    value="{{ old('area') }}"
                                                    class="form-control @error('area') is-invalid @enderror"
                                                    rows="1" placeholder="@lang('i8 Markaz')"
                                                    {{ old('area') }} />
                                                @error('area')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city">@lang('City')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fa fa-solid fa-map-marker"></i></span>
                                                </div>
                                                <input type="text" name="city" id="city"
                                                    value="{{ old('city') }}"
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    rows="1" placeholder="@lang('Islamabad')"
                                                    {{ old('city') }} />
                                                @error('city')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="address">@lang('Address')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fa fa-solid fa-map-marker"></i></span>
                                                </div>
                                                <input type="text" name="address" id="address"
                                                    value="{{ old('address') }}"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    rows="1" placeholder="@lang('House 35, Street 66, i8 markaz, Islamabad')"
                                                    {{ old('address') }} />
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="password" name="password" value="12345678" required>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="other_details">Other Details</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                </div>
                                                <textarea rows="1" type="text" id="other-details" name="other_details" value="{{ old('other_details') }}"
                                                    class="form-control" placeholder="Additional details..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="enquirysource">@lang('Where did you hear about us?')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-heartbeat"></i></span>
                                                </div>
                                                <select name="enquirysource"
                                                    class="form-control select2 @error('enquirysource') is-invalid @enderror"
                                                    id="enquirysource">
                                                    <option value="" disabled
                                                        {{ old('enquirysource') ? '' : 'selected' }}>
                                                        Select Source</option>
                                                    @foreach ($enquirysource as $enquiry)
                                                        <option value="{{ $enquiry->id }}"
                                                            {{ old('enquirysource') == $enquiry->id ? 'selected' : '' }}>
                                                            {{ $enquiry->source_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('enquirysource')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary btn-lg">@lang('Submit')</button>
                                        <a href="{{ route('patient-details.index') }}"
                                            class="btn btn-outline-secondary btn-lg ml-1">@lang('Cancel')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('noEmailCheckbox').addEventListener('change', function() {
                var emailField = document.getElementById('email');
                var phoneField = document.getElementById('phone');

                if (this.checked) {

                    var characters = '123456789';
                    var randomValue = '';

                    for (var i = 0; i < 5; i++) {
                        var randomIndex = Math.floor(Math.random() * characters.length);
                        randomValue += characters[randomIndex];
                    }


                    emailField.value = 'noemail' + phoneField.value + randomValue + '@gmail.com';
                    emailField.setAttribute('readonly', true);
                } else {
                    emailField.value = '';
                    emailField.removeAttribute('readonly');
                }
            });
        </script>
    @endsection
