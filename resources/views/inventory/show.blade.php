@extends('layouts.layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">@lang('Inventory Details')</h3>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title font-weight-bold ml-1">
                                <i class="fas fa-boxes text-primary mr-2"></i> {{ $inventory->item->title ?? '-' }}
                            </h3>
                            <span class="badge badge-pill badge-info px-3 py-2">
                                @lang('Stock'): {{ $inventory->quantity }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="text-secondary small font-weight-bold d-block">@lang('Category')</label>
                                <span class="h6 font-weight-bold">{{ $inventory->category->title ?? '-' }}</span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-secondary small font-weight-bold d-block">@lang('Sub Category')</label>
                                <span class="h6 font-weight-bold">{{ $inventory->subcategory->title ?? '-' }}</span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-secondary small font-weight-bold d-block">@lang('Item Name')</label>
                                <span class="h6 font-weight-bold text-primary">{{ $inventory->item->title ?? '-' }}</span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-secondary small font-weight-bold d-block">@lang('Unit Price')</label>
                                <span class="h6 font-weight-bold text-success">PKR {{ number_format($inventory->unitprice, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    {{-- Consume History --}}
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-white p-3 border-bottom">
                                <h3 class="card-title font-weight-bold ml-1 text-danger">
                                    <i class="fas fa-minus-circle mr-2"></i> @lang('Consumption History')
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="px-3">@lang('User')</th>
                                                <th class="text-center">@lang('Qty')</th>
                                                <th class="text-right px-3">@lang('Date & Time')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($consumeInventorys as $consumeInventory)
                                            <tr>
                                                <td class="px-3 font-weight-bold">{{ $consumeInventory->createdBy->name ?? '-' }}</td>
                                                <td class="text-center">
                                                    <span class="badge badge-warning">{{ $consumeInventory->quantity }}</span>
                                                </td>
                                                <td class="text-right px-3 text-muted small">
                                                    {{ $consumeInventory->created_at->format('M d, Y') }}<br>
                                                    {{ $consumeInventory->created_at->format('h:i A') }}
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

                    {{-- Addition History --}}
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-header bg-white p-3 border-bottom">
                                <h3 class="card-title font-weight-bold ml-1 text-success">
                                    <i class="fas fa-plus-circle mr-2"></i> @lang('Stock Addition History')
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="px-3">@lang('User')</th>
                                                <th class="text-center">@lang('Qty')</th>
                                                <th class="text-center">@lang('Price')</th>
                                                <th class="text-right px-3">@lang('Date & Time')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($additionInventorys as $additionInventory)
                                            <tr>
                                                <td class="px-3 font-weight-bold">{{ $additionInventory->createdBy->name ?? '-' }}</td>
                                                <td class="text-center">
                                                    <span class="badge badge-success">{{ $additionInventory->quantity }}</span>
                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    {{ number_format($additionInventory->unitprice, 2) }}
                                                </td>
                                                <td class="text-right px-3 text-muted small">
                                                    {{ $additionInventory->created_at->format('M d, Y') }}<br>
                                                    {{ $additionInventory->created_at->format('h:i A') }}
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-muted">@lang('No addition records found')</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.delete_modal')
@endsection