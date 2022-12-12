@extends('customlayouts.master')
@section('title')
    Login Activities
@endsection
@section('page-name')
    Login Activities
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Login Activities</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-6">
            <!-- /.box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="login-activity"
                            class="table table-bordered table-hover display nowrap margin-top-10 w-p100 text-center">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Email</th>
                                    <!-- <th>Email</th> -->

                                    <!-- <th>Url</th> -->
                                    <!-- <th>Method</th> -->
                                    <th>IP</th>
                                    <th>Device</th>
                                    <th>Date and Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($userLoginActivities) > 0)
                                    @foreach ($userLoginActivities as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td style="width: 1%;">{{ $row->subject }} </td>
                                            <!-- <td>{{ $row->email }}</td> -->
                                            <!-- <td>{{ $row->url }}</td> -->
                                            <!-- <td>{{ $row->method }}</td> -->
                                            <td>{{ $row->ip }}</td>
                                            <td style="width: 1%;">{{ $row->agent }}</td>
                                           <td>{{ $row->created_at->toDayDateTimeString() ? $row->created_at->addHours(6) : 'NA' }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SL</th>
                                    <th>Email</th>
                                    <!-- <th>Email</th> -->
                                    <!-- <th>Url</th> -->
                                    <!-- <th>Method</th> -->
                                    <th>IP</th>
                                    <th>Device</th>
                                    <th>Date and Time</th>
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
<script>
    $(document).ready(function() {
    $('#login-activity').DataTable( {
        "lengthMenu": [[20, 50, -1], [ 20, 50, "All"]]
    } );
} );
</script>
@endsection
