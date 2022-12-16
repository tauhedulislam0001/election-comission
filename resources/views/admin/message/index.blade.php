@extends('customlayouts.master')
@section('message')
active
@endsection
@section('title')
Message | List
@endsection
@section('page-name')
Message List
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item" aria-current="page">Message</li>
<li class="breadcrumb-item active" aria-current="page">Message List</li>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-6">
        @if (Auth::guard('admin')->user()->can('message.create'))
            <a href="{{ route('message.create') }}" style="color: #fefeff;">
                <button type="button" class="btn btn-success text-white float-right mb-5">
                    New Message
                </button>
            </a>
        @endif
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example"
                        class="table table-bordered table-hover display nowrap margin-top-10 w-p100 text-center">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>User</th>
                                <th>Message</th>
                                <th>Image One</th>
                                <th>Image Two</th>
                                <th>Image Three</th>
                                <th>Message Status</th>
                                @if (Auth::Guard('admin')->user()->user_type == 1 or Auth::Guard('admin')->user()->user_type == 2)
                                <th>Status</th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($message as $row)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $row->senderUser->username }}</td>
                                <td>{{ Str::limit($row->message, 50) }}</td>
                                <td>
                                    @if ($row->image_one != null)
                                        <img src="{{ asset($row->image_one) }}" width="60px" height="60px" alt="">
                                    @endif
                                </td>
                                <td>
                                    @if ($row->image_two != null)
                                        <img src="{{ asset($row->image_two) }}" width="60px" height="60px" alt="">
                                    @endif
                                </td>
                                <td>
                                    @if ($row->image_three != null)
                                        <img src="{{ asset($row->image_three) }}" width="60px" height="60px" alt="">
                                    @endif
                                </td>
                                <td>
                                    @if ($row->flag == 0)
                                    <b>message sent <br> {{ $row->created_at->diffForHumans() }}</b>
                                    @elseif($row->flag == 1)
                                    <b>message seen <br> {{ $row->updated_at->diffForHumans() }}</b>
                                    @elseif($row->flag == 2)
                                    <b>message replied <br> {{ $row->updated_at->diffForHumans() }}</b>
                                    @endif
                                </td>
                                @if (Auth::Guard('admin')->user()->user_type == 1 or Auth::Guard('admin')->user()->user_type == 2)
                                <td>
                                    @if ($row->status == 1)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                @endif
                                <td>
                                    @if (Auth::guard('admin')->user()->can('message.edit'))
                                        <a href="{{ route('message.view' , Crypt::encryptString($row->id)) }}">
                                            <button type="button"
                                                class="waves-effect waves-light btn btn-warning btn-flat mb-5"><i
                                                    class="ti-eye"></i> view</button>
                                        </a>
                                    @endif
                                    @if (Auth::guard('admin')->user()->can('message.delete'))
                                        <a href="{{ route('message.destroy' , Crypt::encryptString($row->id)) }}">
                                            <button type="button"
                                                class="waves-effect waves-light btn btn-primary btn-flat mb-5"
                                                onclick="return confirm('Are you sure to delete this {{ Str::limit($row->message, 10) }} message ?')"><i
                                                    class="ti-trash"></i> Delete</button>
                                        </a>
                                    @endif
                                    @if (Auth::guard('admin')->user()->can('message.status'))
                                        @if ($row->status == 1)
                                            <a href="{{ route('message.inactive' , Crypt::encryptString($row->id)) }}">
                                                <button type="button"
                                                    class="waves-effect waves-light btn btn-warning btn-flat mb-5"><i
                                                        class="ti-power-off"></i> InActive</button>
                                            </a>
                                        @else
                                            <a href="{{ route('message.active' , Crypt::encryptString($row->id)) }}">
                                                <button type="button"
                                                    class="waves-effect waves-light btn btn-primary btn-flat mb-5"><i
                                                        class="ti-power-off"></i> Active</button>
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>User</th>
                                <th>Message</th>
                                <th>Image One</th>
                                <th>Image Two</th>
                                <th>Image Three</th>
                                <th>Message Status</th>
                                @if (Auth::Guard('admin')->user()->user_type == 1 or Auth::Guard('admin')->user()->user_type == 2)
                                <th>Status</th>
                                @endif
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
