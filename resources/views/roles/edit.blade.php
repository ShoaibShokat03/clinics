@extends('layouts.layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">@lang('Role List')</a></li>
                        <li class="breadcrumb-item active">@lang('Update Role')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3>@lang('Update Role')</h3>
                </div>
                <div class="card-body">
                    <form class="form-material form-horizontal" action="{{ route('roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-0">
                            <label class="col-md-2 col-form-label ambitious-center">
                                <h4 class="ambitious-role-margin ambitious-center">@lang('Role Name') <b
                                        class="ambitious-crimson">*</b></h4>
                            </label>
                            <div class="col-md-8">
                                <input class="form-control ambitious-form-loading @error('name') is-invalid @enderror"
                                    name="name" id="name" type="text" placeholder="@lang('Role Name')"
                                    value="{{ old('name', $role->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label class="col-md-2 col-form-label ambitious-center">
                                <h4>@lang('Role For')</h4>
                            </label>
                            <div class="col-md-8">
                                <select class="form-control ambitious-form-loading @error('role_for') is-invalid @enderror"
                                    name="role_for" id="role_for">
                                    <option value="1" {{ old('role_for', $role->role_for) == 1 ? 'selected' : '' }}>
                                        @lang('General User')</option>
                                    <option value="0" {{ old('role_for', $role->role_for) == 0 ? 'selected' : '' }}>
                                        @lang('System User')</option>
                                </select>
                                @error('role_for')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div id="user_block">
                            <div class="form-group row mb-0">
                                <label class="col-md-2 col-form-label ambitious-center">
                                    <h4 class="ambitious-role-margin">@lang('Price') <b class="ambitious-crimson">*</b>
                                    </h4>
                                </label>
                                <div class="col-md-8">
                                    <input class="form-control ambitious-form-loading @error('price') is-invalid @enderror"
                                        name="price" id="price" type="text" placeholder="@lang('Role Price')"
                                        value="{{ old('price', $role->price) }}">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label class="col-md-2 col-form-label ambitious-center">
                                    <h4 class="ambitious-role-margin">@lang('Validity Day') <b class="ambitious-crimson">*</b>
                                    </h4>
                                </label>
                                <div class="col-md-8">
                                    <input
                                        class="form-control ambitious-form-loading @error('validity') is-invalid @enderror"
                                        name="validity" id="validity" type="text" placeholder="@lang('Validity Day')"
                                        value="{{ old('validity', $role->validity) }}">
                                    @error('validity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label class="col-md-2 col-form-label ambitious-center">
                                <h4 class="ambitious-role-margin">@lang('Permissions')</h4>
                            </label>
                            <div class="col-md-10">
                                <div class="form-control-plaintext">
                                    @php
                                        // Ensure $permissions is a Collection of Permission models
                                        $groupedPermissions = $permissions->groupBy('display_name');

                                        // Safely get checked permission IDs
                                        $rolePermIds = is_array(old('permission'))
                                            ? old('permission')
                                            : (is_array($rolePermissions)
                                                ? $rolePermissions
                                                : $rolePermissions->pluck('id')->toArray());
                                    @endphp

                                    @foreach ($groupedPermissions as $moduleName => $perms)
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <h4 class="ambitious-role-margin-extra">{{ $moduleName }}</h4>

                                                <div
                                                    style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; align-items: center;">
                                                    @foreach (['read', 'create', 'update', 'delete'] as $action)
                                                        @php
                                                            $perm = $perms->first(function ($p) use ($action) {
                                                                return str_ends_with($p->name, "-{$action}");
                                                            });
                                                        @endphp

                                                        <div
                                                            class="role-form-ambi checkbox
                                                            {{ $action == 'read'
                                                                ? 'checkbox-info'
                                                                : ($action == 'create'
                                                                    ? 'checkbox-primary'
                                                                    : ($action == 'update'
                                                                        ? 'checkbox-warning'
                                                                        : 'checkbox-danger')) }}">
                                                            @if ($perm)
                                                                <input name="permission[]"
                                                                    id="permission_{{ $perm->id }}" type="checkbox"
                                                                    value="{{ $perm->id }}"
                                                                    {{ in_array($perm->id, $rolePermIds) ? 'checked' : '' }}>
                                                                <label class="ambitious-capital"
                                                                    for="permission_{{ $perm->id }}">
                                                                    {{ ucfirst($action) }}
                                                                </label>
                                                            @else
                                                                <input type="checkbox" disabled>
                                                                <label
                                                                    class="ambitious-capital text-muted">{{ ucfirst($action) }}</label>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-0">
                            <label class="col-md-2 col-form-label"></label>
                            <div class="col-md-8">
                                <input type="submit" value="@lang('Submit')" class="btn btn-outline btn-info btn-lg" />
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script src="{{ asset('assets/js/custom/roles/edit.js') }}"></script>
@endpush
