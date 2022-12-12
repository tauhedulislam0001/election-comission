@extends('customlayouts.master')
@section('manage-user.roles')
    active
@endsection
@section('title')
    Edit | Role
@endsection
@section('page-name')
    Edit Role - {{ $role->name }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
@endsection
@section('extra-css')
    <style>
        .form-group label {
            font-weight: 500;
            text-transform: capitalize;
        }

    </style>
@endsection
@section('content')
    <form method="POST" action="{{ route('roles.update', $role->id) }}" novalidate>
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="form-group">
                    <h5>Role Name<span class="text-warning">*</span></h5>
                    <div class="controls">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $role->name }}" required>
                        @error('name')
                            <label id="name-error" class="error" for="name">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Permissions (Multiple Selection)</label>
                    <br>
                    <div class="controls">
                        <input type="checkbox" id="checkPermissionAll" value="1" class="filled-in chk-col-info" />
                        <label for="checkPermissionAll">All Permission</label>
                    </div>
                    <hr>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($permissionGroups as $permissionGroup)
                        <div class="row">
                            <div class="col-3">
                                <div class="controls">
                                    <p><span class="text-info" style="font-weight: 500; text-transform: capitalize;">
                                            <b>{{ $loop->index + 1 }}.
                                                {{ $permissionGroup->name }}
                                            </b>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-9 role-{{ $i }}-management-checkbox">
                                @php
                                    $permissions = App\AdminUser::getPermissionByGroupName($permissionGroup->name);
                                    $j = 1;
                                @endphp
                                @foreach ($permissions as $permission)
                                    <div class="controls">
                                        <input type="checkbox" name="permissions[]"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                            id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}"
                                            class="filled-in chk-col-info" />
                                        <label
                                            for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                    @php
                                        $j++;
                                    @endphp
                                @endforeach
                                <br>
                            </div>
                        </div>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <div class="box-footer">
            <a href="{{ route('roles.index') }}">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
            <button type="submit" class="btn btn-success">Update Role</button>
        </div>
    </form>
@endsection
@section('script')
    <script>
        /**
         * Check all the permissions
         */
        $("#checkPermissionAll").click(function() {
            if ($(this).is(':checked')) {
                // check all the checkbox
                $('input[type=checkbox]').prop('checked', true);
            } else {
                // un check all the checkbox
                $('input[type=checkbox]').prop('checked', false);
            }
        });
    </script>
@endsection
