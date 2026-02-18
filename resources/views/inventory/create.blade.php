@extends('layouts.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">@lang('Create Inventory')</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('inventories.index') }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-eye"></i> @lang('View Inventory')
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
                        <div class="card-header bg-white p-3 border-bottom">
                            <h3 class="card-title font-weight-bold ml-1">@lang('Inventory Details')</h3>
                        </div>

                        <div class="card-body p-4">
                            <form id="inventoryForm" action="{{ route('inventories.store') }}" method="POST"
                                enctype="multipart/form-data" data-parsley-validate>
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="text-secondary small font-weight-bold"
                                                for="category_id">@lang('Category') <b class="text-danger">*</b></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0"><i
                                                            class="fas fa-folder text-primary"></i></span>
                                                </div>
                                                <select id="category_id" name="category_id"
                                                    class="form-control select2 @error('category_id') is-invalid @enderror"
                                                    required data-parsley-required-message="@lang('Please select a category')">
                                                    <option value="">@lang('Select Category')</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"> {{ $category->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('category_id')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="text-secondary small font-weight-bold"
                                                for="subcategory_id">@lang('Sub Category')</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0"><i
                                                            class="fas fa-list text-primary"></i></span>
                                                </div>
                                                <select id="subcategory_id" name="subcategory_id"
                                                    class="form-control select2 @error('subcategory_id') is-invalid @enderror">
                                                    <option value="">@lang('Select Sub Category')</option>
                                                </select>
                                            </div>
                                            @error('subcategory_id')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="text-secondary small font-weight-bold"
                                                for="item_id">@lang('Item') <b class="text-danger">*</b></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0"><i
                                                            class="fas fa-box-open text-primary"></i></span>
                                                </div>
                                                <select id="item_id" name="item_id"
                                                    class="form-control select2 @error('item_id') is-invalid @enderror"
                                                    required data-parsley-required-message="@lang('Please select an item')">
                                                    <option value="">@lang('Select Item')</option>
                                                </select>
                                            </div>
                                            @error('item_id')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="text-secondary small font-weight-bold"
                                                for="quantity">@lang('Quantity') <b class="text-danger">*</b></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0"><i
                                                            class="fas fa-calculator text-primary"></i></span>
                                                </div>
                                                <input type="number"
                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                    id="quantity" name="quantity" placeholder="0" required
                                                    data-parsley-required-message="@lang('Please enter the quantity')"
                                                    data-parsley-type="number" data-parsley-min="0">
                                            </div>
                                            @error('quantity')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="text-secondary small font-weight-bold"
                                                for="unitprice">@lang('Unit Price') <b class="text-danger">*</b></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span
                                                        class="input-group-text bg-light border-right-0 font-weight-bold text-primary">PKR</span>
                                                </div>
                                                <input type="number"
                                                    class="form-control @error('unitprice') is-invalid @enderror"
                                                    id="unitprice" name="unitprice" placeholder="0" required
                                                    data-parsley-required-message="@lang('Please enter the unit price')"
                                                    data-parsley-type="number" data-parsley-min="0">
                                            </div>
                                            @error('unitprice')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12 text-center text-md-left">
                                        <button type="submit" class="btn btn-primary btn-lg px-4 mr-2">
                                            <i class="fas fa-save mr-1"></i> {{ __('Create Inventory') }}
                                        </button>
                                        <a href="{{ route('inventories.index') }}"
                                            class="btn btn-outline-secondary btn-lg px-4">
                                            {{ __('Cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @push('scripts') --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            @php
                $project = request()->segment(1);
            @endphp
            var baseUrl = '{{ url('/') }}'; // Dynamically set base URL for the project

            // URLs with placeholders
            var getSubCategoriesUrl =
                '{{ route('inventories.subcategories', ['project' => $project, 'category' => ':categoryId']) }}';
            var getItemsUrl =
                '{{ route('inventories.items', ['project' => $project, 'category' => ':categoryId']) }}';

            $('#category_id').change(function() {
                var categoryId = $(this).val();

                if (categoryId) {
                    // Update subcategory URL and fetch data
                    var subCategoriesUrl = getSubCategoriesUrl.replace(':categoryId', categoryId);
                    $.ajax({
                        url: subCategoriesUrl,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var subcategorySelect = $('#subcategory_id');
                            subcategorySelect.empty();
                            subcategorySelect.append(
                                '<option value="">@lang('Select Sub Category')</option>');
                            $.each(data, function(key, value) {
                                subcategorySelect.append('<option value="' + value.id +
                                    '">' + value.title + '</option>');
                            });

                            // Clear items dropdown
                            $('#item_id').empty().append(
                                '<option value="">@lang('Select Item')</option>');
                        }
                    });

                    // Update items URL and fetch data
                    var itemsUrl = getItemsUrl.replace(':categoryId', categoryId);
                    $.ajax({
                        url: itemsUrl,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var itemSelect = $('#item_id');
                            itemSelect.empty();
                            itemSelect.append('<option value="">@lang('Select Item')</option>');
                            $.each(data, function(key, value) {
                                itemSelect.append('<option value="' + value.id + '">' +
                                    value.title + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory_id').empty().append('<option value="">@lang('Select Sub Category')</option>');
                    $('#item_id').empty().append('<option value="">@lang('Select Item')</option>');
                }
            });

            $('#subcategory_id').change(function() {
                var subcategoryId = $(this).val();
                var categoryId = $('#category_id').val();

                if (subcategoryId && categoryId) {
                    // Update items URL and fetch data
                    var itemsUrl = getItemsUrl.replace(':categoryId', categoryId);
                    $.ajax({
                        url: itemsUrl,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var itemSelect = $('#item_id');
                            itemSelect.empty();
                            itemSelect.append('<option value="">@lang('Select Item')</option>');
                            $.each(data, function(key, value) {
                                itemSelect.append('<option value="' + value.id + '">' +
                                    value.title + '</option>');
                            });
                        }
                    });
                } else {
                    $('#item_id').empty().append('<option value="">@lang('Select Item')</option>');
                }
            });
        });
    </script>

    {{-- @endpush --}}
@endsection
