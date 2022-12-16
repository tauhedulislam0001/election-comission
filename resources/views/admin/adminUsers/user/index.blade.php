@extends('customlayouts.master')
@section('manage-user.user-details')
active
@endsection
@section('title')
All User
@endsection
@section('page-name')
All User
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item active" aria-current="page">All User
</li>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-6">
        @if (Auth::guard('admin')->user()->can('user.create'))
        <a href="{{ route('user.create') }}" style="color: #fefeff;">
            <button type="button" class="btn btn-primary text-white float-right mb-10">
                Create User
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
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Role</th>
                                <th>User Type</th>
                                <th>Can Login</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adminUsers as $row)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->mobile }}</td>
                                <td>
                                    @foreach ($row->roles as $role)
                                    <div class="px-25 py-10 w-100">
                                        <span class="badge badge-info">{{ $role->name }}</span>
                                    </div>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($row->user_type == 2)
                                    <div class="px-25 py-10 w-100">
                                        <span class="badge badge-success">Admin</span>
                                    </div>
                                    @elseif ($row->user_type == 3)
                                    <div class="px-25 py-10 w-100">
                                        <span class="badge badge-primary">User</span>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($row->can_login == 0)
                                    <div class="px-25 py-10 w-100">
                                        <span class="badge badge-warning">No</span>
                                    </div>
                                    @elseif ($row->can_login == 1)
                                    <div class="px-25 py-10 w-100">
                                        <span class="badge badge-success">Yes</span>
                                    </div>
                                    @elseif ($row->can_login == 2)
                                    <div class="px-25 py-10 w-100">
                                        <span class="badge badge-primary">Banned</span>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::guard('admin')->user()->can('user.edit'))
                                    <a href="{{ url('user/edit/' . $row->id) }}">
                                        <button type="button"
                                            class="waves-effect waves-light btn btn-warning btn-flat mb-5"><i
                                                class="ti-pencil"></i> Edit</button>
                                    </a>
                                    @if ($row->can_login == 1)
                                    <a href="{{ url('user/disable/' . $row->id) }}">
                                        <button type="button"
                                            class="waves-effect waves-light btn btn-primary btn-flat mb-5"><i
                                                class="ti-power-off"></i> Disable</button>
                                    </a>
                                    @elseif($row->can_login == 0)
                                    <a href="{{ url('user/enable/' . $row->id) }}">
                                        <button type="button"
                                            class="waves-effect waves-light btn btn-warning btn-flat mb-5"><i
                                                class="ti-power-off"></i> Enable</button>
                                    </a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Role</th>
                                <th>User Type</th>
                                <th>Can Login</th>
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

@section('script')

@endsection