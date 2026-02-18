@extends('layouts.layout')

@section('content')
<style>
    body {
        overscroll-x: hidden;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@lang('Inventory List')</h1>
            </div>
            <div class="col-sm-6 text-right">
                @can('inventory-create')
                <a href="{{ route('inventories.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> @lang('Add Inventory')
                </a>
                @endcan
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
                        <h3 class="card-title font-weight-bold ml-1">@lang('Filter Inventory')</h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-primary btn-sm" target="_blank"
                                href="{{ route('inventories.index') }}?export=1">
                                <i class="fas fa-cloud-download-alt"></i> @lang('Export')
                            </a>
                            <button class="btn btn-outline-secondary btn-sm ml-2" data-toggle="collapse" href="#filter">
                                <i class="fas fa-filter"></i> @lang('Filter')
                            </button>
                        </div>
                    </div>

                    <div id="filter" class="collapse @if (request()->has('isFilterActive')) show @endif">
                        <div class="card-body p-3 bg-light border-bottom">
                            <form action="{{ route('inventories.index') }}" method="get" role="form" autocomplete="off">
                                <input type="hidden" name="isFilterActive" value="true">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Item')</label>
                                            <select name="item_id" class="form-control form-control-sm select2">
                                                <option value="">@lang('Select Item')</option>
                                                @foreach ($items as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request()->input('item_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Category')</label>
                                            <select name="category_id" class="form-control form-control-sm select2">
                                                <option value="">@lang('Select Category')</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ request()->input('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('SubCategory')</label>
                                            <select name="subcategory_id" class="form-control form-control-sm select2">
                                                <option value="">@lang('Select SubCategory')</option>
                                                @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}"
                                                    {{ request()->input('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                                    {{ $subcategory->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('Start Date')</label>
                                            <input type="text" name="start_date" id="start_date"
                                                class="form-control form-control-sm flatpickr" placeholder="@lang('Start Date')"
                                                value="{{ old('start_date', request()->start_date) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-2">
                                            <label class="text-secondary small font-weight-bold">@lang('End Date')</label>
                                            <input type="text" name="end_date" id="end_date"
                                                class="form-control form-control-sm flatpickr" placeholder="@lang('End Date')"
                                                value="{{ old('end_date', request()->end_date) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-1 text-right mt-4">
                                        <button type="submit" class="btn btn-info btn-sm">@lang('Submit')</button>
                                        @if (request()->has('isFilterActive'))
                                        <a href="{{ route('inventories.index') }}"
                                            class="btn btn-secondary btn-sm ml-2">@lang('Clear')</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0" id="laravel_datatable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>@lang('Item')</th>
                                        <th>@lang('Category')</th>
                                        <th>@lang('SubCategory')</th>
                                        <th class="text-center">@lang('Unit Price')</th>
                                        <th class="text-center">@lang('Total Qty')</th>
                                        <th class="text-center">@lang('Consumed')</th>
                                        <th class="text-center">@lang('Available')</th>
                                        <th data-orderable="false" class="text-right">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventories as $inventory)
                                    <tr>
                                        <td class="font-weight-bold text-primary">{{ $inventory->item->title ?? '-' }}</td>
                                        <td>{{ $inventory->category->title ?? '-' }}</td>
                                        <td>{{ $inventory->subcategory->title ?? '-' }}</td>
                                        <td class="text-center font-weight-bold">{{ $inventory->unitprice }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-info">{{ $inventory->quantity }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">{{ $inventory->consumed_quantity }}</span>
                                        </td>
                                        <td class="text-center">
                                            @php
                                            $available = max(0, $inventory->quantity - $inventory->consumed_quantity);
                                            $badgeClass = $available > 5 ? 'badge-success' : ($available > 0 ? 'badge-warning' : 'badge-danger');
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ $available }}</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="{{ route('inventories.show', $inventory) }}"
                                                    class="btn btn-sm btn-outline-info"
                                                    data-toggle="tooltip" title="@lang('View')">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @can('inventory-update')
                                                <a href="#" data-id="{{ $inventory->id }}"
                                                    data-item="{{ $inventory->item->title ?? '-' }}"
                                                    data-category="{{ $inventory->category->title ?? '-' }}"
                                                    data-subcategory="{{ $inventory->subcategory->title ?? '-' }}"
                                                    data-quantity="{{ max(0, $inventory->quantity - $inventory->consumed_quantity) }}"
                                                    class="btn btn-sm btn-outline-success ml-1 consume-btn"
                                                    data-toggle="tooltip" title="@lang('Consume')">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                @endcan
                                                @can('inventory-delete')
                                                <a href="#" data-href="{{ route('inventories.destroy', $inventory) }}"
                                                    class="btn btn-sm btn-outline-danger ml-1"
                                                    data-toggle="modal" data-target="#myModal" title="@lang('Delete')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        {{ $inventories->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="consumeModal" tabindex="-1" role="dialog" aria-labelledby="consumeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="consumeModalLabel">@lang('Consume Inventory')</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="consumeForm" method="POST" action="{{ route('inventories.consume') }}">
                @csrf
                <input type="hidden" name="inventory_id" id="inventory_id">
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="text-secondary small font-weight-bold">@lang('Item')</label>
                            <input type="text" id="item_title" class="form-control bg-light" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="text-secondary small font-weight-bold">@lang('Category')</label>
                            <input type="text" id="category" class="form-control bg-light" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-secondary small font-weight-bold">@lang('SubCategory')</label>
                            <input type="text" id="subcategory" class="form-control bg-light" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="text-secondary small font-weight-bold text-success">@lang('Available Quantity')</label>
                            <input type="number" id="available_quantity" class="form-control bg-light font-weight-bold text-success border-success" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-secondary small font-weight-bold text-primary">@lang('Quantity to Consume')</label>
                            <input type="number" name="quantity" id="consume_quantity" class="form-control border-primary" required min="1">
                        </div>
                    </div>
                    <div id="consume-error" class="text-danger small mt-n2 mb-2" style="display: none;">
                        @lang('Quantity cannot be greater than the available inventory.')
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check mr-1"></i> @lang('Consume')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.consume-btn').on('click', function(e) {
            e.preventDefault();

            var inventoryId = $(this).data('id');
            var item = $(this).data('item');
            var category = $(this).data('category');
            var subcategory = $(this).data('subcategory');
            var quantity = $(this).data('quantity');

            // Populate the modal fields
            $('#inventory_id').val(inventoryId);
            $('#item_title').val(item);
            $('#category').val(category);
            $('#subcategory').val(subcategory);
            $('#available_quantity').val(quantity);
            $('#consume_quantity').attr('max', quantity);
            $('#consume-error').hide();
            $('#consume_quantity').removeClass('is-invalid');

            // Show the modal
            $('#consumeModal').modal('show');
        });

        $('#consumeForm').on('submit', function(e) {
            var quantity = parseInt($('#consume_quantity').val());
            var maxQuantity = parseInt($('#consume_quantity').attr('max'));

            if (quantity > maxQuantity) {
                e.preventDefault();
                $('#consume_quantity').addClass('is-invalid');
                $('#consume-error').show();
            } else {
                $('#consume_quantity').removeClass('is-invalid');
                $('#consume-error').hide();
            }
        });
    });
</script>

@include('layouts.delete_modal')
@endsection