@extends('customlayouts.master')
@section('manage-user.permission-list')
    active
@endsection
@section('title')
    Permissions
@endsection
@section('page-name')
    Permissions
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Permissions</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-6">
            @if (Auth::guard('admin')->user()->can('permission.create'))
                <a href="{{ route('permissions.create') }}" style="color: #fefeff;">
                    <button type="button" class="btn btn-primary text-white float-right mb-10">
                        Create Permission
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
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            <div style="display:inline-flex;">
                                                @if (Auth::guard('admin')->user()->can('permission.edit'))
                                                    <a href="{{ route('permissions.edit', $row->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    &nbsp;
                                                @endif
                                                @if (Auth::guard('admin')->user()->can('permission.delete'))
                                                    <form id="delete_form{{ $row->id }}" method="POST"
                                                        action="{{ route('permissions.destroy', $row->id) }}"
                                                        onclick="return confirm('Are you sure?')">
                                                        {{ csrf_field() }}
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button class="btn btn-danger btn-sm" style="display: inline-flex;"
                                                            type="submit">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
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
