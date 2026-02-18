@extends('layouts.layout')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @can('task-create')
                    <h3>
                        <a href="{{ route('tasks.create') }}" class="btn btn-outline btn-info">+ @lang('Add Task')</a>
                    </h3>
                @endcan
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item active">@lang('Assigned Tasks')</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="card-title">@lang('Assigned Tasks')</h3>
                <div class="card-tools">
                    <button class="btn btn-default" data-toggle="collapse" href="#filter"><i class="fas fa-filter"></i> @lang('Filter')</button>
                </div>
            </div>
            <div class="card-body">
                <div id="filter" class="collapse @if(request()->isFilterActive) show @endif">
                    <form action="" method="get" role="form" autocomplete="off">
                        <input type="hidden" name="isFilterActive" value="true">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>@lang('Title')</label>
                                    <input type="text" name="title" class="form-control" value="{{ request()->title }}" placeholder="@lang('Title')">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>@lang('Assigned To')</label>
                                    <input type="text" name="assign_to" class="form-control" value="{{ request()->assign_to }}" placeholder="@lang('Assigned To')">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-info mt-4">@lang('Submit')</button>
                                @if(request()->isFilterActive)
                                    <a href="{{ route('tasks.assigned') }}" class="btn btn-secondary mt-4">@lang('Clear')</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('Title')</th>
                            <th>@lang('Assigned To')</th>
                            <th>@lang('Due Date')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Priority')</th>
                            <th>@lang('Actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->assignTo->name ?? '-' }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->taskStatus->title ?? '-' }}</td>
                                <td>{{ $task->taskPriority->title ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-outline btn-circle btn-lg" title="@lang('View')"><i class="fa fa-eye ambitious-padding-btn"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tasks->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
