@extends('layouts.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Edit Lab')</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('labs.index') }}" class="btn btn-outline-primary btn-sm">
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
                            <h3 class="card-title font-weight-bold">@lang('Lab Information')</h3>
                        </div>
                        <div class="card-body">
                            <form id="labForm" class="form-material form-horizontal"
                                action="{{ route('labs.update', ['lab' => $lab->id]) }}" method="POST"
                                enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="record_id" value="{{ $lab->id }}">
                                <input type="hidden" id="table_name" value="lab">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Title">@lang('Lab Name') <b class="text-danger">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                                </div>
                                                <input type="text" id="Title" name="Title"
                                                    value="{{ old('Title', $lab->title) }}"
                                                    class="form-control @error('Title') is-invalid @enderror"
                                                    placeholder="@lang('Lab Name')" required
                                                    data-parsley-required-message="Please enter the lab name.">
                                            </div>
                                            @error('Title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="PhoneNumber">@lang('Lab Phone')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" id="PhoneNumber" name="PhoneNumber"
                                                    value="{{ old('PhoneNumber', $lab->phone_no) }}"
                                                    class="form-control @error('PhoneNumber') is-invalid @enderror"
                                                    placeholder="@lang('Lab Phone')" data-parsley-type="digits"
                                                    data-parsley-type-message="@lang('The phone number must be digits')">
                                            </div>
                                            @error('PhoneNumber')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Description">@lang('Lab Description') <b class="text-danger">*</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                                </div>
                                                <textarea id="Description" name="Description" class="form-control @error('Description') is-invalid @enderror"
                                                    rows="5" placeholder="@lang('Lab Description')" required data-parsley-required="@lang('The lab description field is required')">{{ old('Description', $lab->description) }}</textarea>
                                            </div>
                                            @error('Description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Address">@lang('Lab Address')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                                </div>
                                                <textarea id="Address" name="Address" class="form-control @error('Address') is-invalid @enderror" rows="5"
                                                    placeholder="@lang('Lab Address')">{{ old('Address', $lab->address) }}</textarea>
                                            </div>
                                            @error('Address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-right mt-3">
                                        <button type="submit" class="btn btn-primary">@lang('Update')</button>
                                        <a href="{{ route('labs.index') }}"
                                            class="btn btn-secondary ml-2">@lang('Cancel')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mt-4">
                        <div class="card-header bg-white p-3 border-bottom-0">
                            <h3 class="card-title font-weight-bold">@lang('Upload Lab Files')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-md-12">
                                        <input id="labs_files" name="labs_files[]" type="file" multiple
                                            data-allowed-file-extensions="png jpg jpeg pdf xml txt doc docx mp4"
                                            data-max-file-size="2048K" />
                                        <p class="text-muted small mt-2">
                                            {{ __('Max Size: 2048kb, Allowed Format: png, jpg, jpeg, pdf, xml, txt, doc, docx, mp4') }}
                                        </p>
                                        <br>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('File Name')</th>
                                                    <th>@lang('Uploaded By')</th>
                                                    <th>@lang('Upload Date')</th>
                                                    <th>@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody id="labsFilesTableBody" class="fileTableBody"></tbody>
                                        </table>
                                    </div>
                                    @error('labs_files')
                                        <div class="error ambitious-red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var getFilesUrl = "{{ route('get-files', $lab->id) }}";
        var uploadFilesUrl = "{{ route('upload-file') }}";
        var deleteFilesUrl = "{{ route('delete-files') }}";
        var baseUrl = "{{ asset('') }}";
    </script>
@endsection
