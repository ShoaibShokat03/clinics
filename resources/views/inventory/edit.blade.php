@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">@lang('Update Inventory')</h3>
            </div>
            <div class="col-sm-6 text-right">
                @can('inventory-create')
                <a href="{{ route('inventories.create') }}" class="btn btn-primary btn-sm mr-2">
                    <i class="fas fa-plus"></i> @lang('Add Inventory')
                </a>
                @endcan
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
                        <h3 class="card-title font-weight-bold ml-1">@lang('Inventory Information')</h3>
                    </div>

                    <div class="card-body p-4">
                        <form id="subcategoryForm" action="{{ route('inventories.update', $inventory->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-secondary small font-weight-bold">@lang('Category')</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-folder text-primary"></i></span>
                                            </div>
                                            <input type="text" class="form-control bg-light" value="{{ $inventory->category->title }}" readonly disabled>
                                            <input type="hidden" name="category_id" value="{{ $inventory->category_id }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-secondary small font-weight-bold">@lang('Sub Category')</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-list text-primary"></i></span>
                                            </div>
                                            <input type="text" class="form-control bg-light" value="{{ $inventory->subcategory->title ?? '-' }}" readonly disabled>
                                            <input type="hidden" name="subcategory_id" value="{{ $inventory->subcategory_id }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-secondary small font-weight-bold">@lang('Item')</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-box-open text-primary"></i></span>
                                            </div>
                                            <input type="text" class="form-control bg-light" value="{{ $inventory->item->title }}" readonly disabled>
                                            <input type="hidden" name="item_id" value="{{ $inventory->item_id }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-secondary small font-weight-bold">@lang('Current Quantity')</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-calculator text-primary"></i></span>
                                            </div>
                                            <input type="number" class="form-control bg-light" value="{{ $inventory->quantity }}" readonly disabled>
                                            <input type="hidden" name="quantity" value="{{ $inventory->quantity }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="text-secondary small font-weight-bold">@lang('Unit Price')</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0 font-weight-bold text-primary">PKR</span>
                                            </div>
                                            <input type="number" class="form-control bg-light" value="{{ $inventory->unitprice }}" readonly disabled>
                                            <input type="hidden" name="unitprice" value="{{ $inventory->unitprice }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-success text-white p-3 border-bottom-0">
                        <h3 class="card-title font-weight-bold ml-1">@lang('Update Inventory Quantity')</h3>
                    </div>
                    <div class="card-body p-4 bg-light">
                        <form action="{{ URL::to('consumedQuantity') }}" method="POST" class="form-inline">
                            @csrf
                            <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                            <input type="hidden" name="username" value="{{ Auth::user()->name }}">

                            <div class="form-group mr-sm-3 mb-2 flex-grow-1">
                                <label for="quantity_input" class="sr-only">@lang('Quantity')</label>
                                <div class="input-group w-100">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0 text-success"><i class="fas fa-plus-circle"></i></span>
                                    </div>
                                    <input type="number" id="quantity_input" placeholder="@lang('Enter Quantity to Add')" name="quantity" max="{{ $inventory->quantity }}" min="1" class="form-control" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mb-2 px-4 shadow-sm">
                                <i class="fas fa-check-circle mr-1"></i> @lang('Submit Update')
                            </button>
                        </form>
                        <p class="text-muted small mt-2 ml-1">
                            <i class="fas fa-info-circle mr-1 text-info"></i> @lang('Use this form to adjust the available stock for this item.')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white p-3 border-bottom">
                <h3 class="card-title font-weight-bold ml-1 text-danger">
                    <i class="fas fa-history mr-2"></i> @lang('Consumption History')
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light text-dark">
                            <tr>
                                <th class="px-4">@lang('Username')</th>
                                <th class="text-center">@lang('Quantity')</th>
                                <th class="text-right px-4">@lang('Time')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($consumeInventorys as $consumeInventory)
                            <tr>
                                <td class="px-4 font-weight-bold">{{ $consumeInventory->created->name ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-warning px-2">{{ $consumeInventory->quantity }}</span>
                                </td>
                                <td class="text-right px-4 text-muted small">
                                    {{ $consumeInventory->created_at->format('M d, Y h:i A') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">@lang('No consumption records found')</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($logs)
<div class="row mt-4 mb-4">
    <div class="col-12">
        @canany(['userlog-read'])
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white p-3 border-bottom-0">
                <h3 class="card-title font-weight-bold ml-1">
                    <i class="fas fa-clipboard-list mr-2"></i> @lang('User Change Logs')
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="bg-light font-weight-bold">
                            <tr>
                                <th class="px-3">@lang('User')</th>
                                <th>@lang('Action')</th>
                                <th class="text-center">@lang('Table/Column')</th>
                                <th class="text-center">@lang('Old Value')</th>
                                <th class="text-center">@lang('New Value')</th>
                                <th class="text-right px-3">@lang('Timestamp')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                            <tr>
                                <td class="px-3">
                                    <span class="font-weight-bold">{{ $log->user->name }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-outline-secondary">{{ strtoupper($log->action) }}</span>
                                </td>
                                <td class="text-center small">
                                    <code class="text-primary">{{ $log->table_name }}</code><br>
                                    <span class="text-dark">{{ $log->field_name }}</span>
                                </td>
                                <td class="text-center">
                                    <del class="text-danger small">{{ $log->old_value ?? 'N/A' }}</del>
                                </td>
                                <td class="text-center">
                                    <ins class="text-success font-weight-bold">{{ $log->new_value ?? 'N/A' }}</ins>
                                </td>
                                <td class="text-right px-3 text-muted small">
                                    {{ $log->created_at }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endcanany
    </div>
</div>
@endif
@endsection