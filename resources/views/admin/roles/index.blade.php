@extends('customlayouts.master')
@section('manage-user.roles')
    active
@endsection
@section('title')
    Roles
@endsection
@section('page-name')
    Roles
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Roles</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-6">
            @if (Auth::guard('admin')->user()->can('role.create'))
                <a href="{{ route('roles.create') }}" style="color: #fefeff;">
                    <button type="button" class="btn btn-primary text-white float-right mb-10">
                        Create Role
                    </button>
                </a>
            @endif
            <!-- /.box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example"
                            class="table table-bordered table-hover display nowrap margin-top-10 w-p100 text-center">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div style="display:inline-flex;">
                                                @if (Auth::guard('admin')->user()->can('role.edit'))
                                                    <a href="{{ route('roles.edit', $row->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                @endif
                                                &nbsp;
                                                @if (Auth::guard('admin')->user()->can('role.delete'))
                                                    <form id="delete_form{{ $row->id }}" method="POST"
                                                        action="{{ route('roles.destroy', $row->id) }}"
                                                        onclick="return confirm('Are you sure?')">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            @foreach ($row->permissions()->pluck('name') as $permission)
                                                {{ $permission }},
                                            @endforeach
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
