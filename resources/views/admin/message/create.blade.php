@extends('customlayouts.master')
@section('message')
active
@endsection
@section('title')
Message | Create
@endsection
@section('page-name')
Message Create
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item" aria-current="page">Message</li>
<li class="breadcrumb-item active" aria-current="page">Message Create</li>
@endsection
@section('content')
<div>
    <form method="POST" action="{{ route('message.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            <div class="row">
                <div class="col-md-1 col-12">
                    <div class="box-header">
                        <b>
                            <h4 class="box-title text-info" style="margin: -20px;">Send To</h4>
                        </b>
                    </div>
                </div>
                <div class="col-md-11 col-sm-6 col-611col-xl-11 col-lg-11">
                    <div class="area-wrap" style="margin: 12px 0 0 -35px">
                        <select class="form-control select2" name="receiver" id="receiver" style="width: 100%;" required>
                            <option value="">Select User</option>
                            @foreach ($users as $row)
                            <option value="{{ $row->id }}">{{ $row->username }}</option>
                            @endforeach
                        </select>
                        <div class="error-message text-danger">
                            @if ($errors->has('receiver'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('receiver') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="box-header">
                        <b>
                            <h4 class="box-title text-info" style="margin: -20px;">Message Details</h4>
                        </b>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <textarea name="message" class="form-control" id="message" cols="200" rows="5" required></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="box-header">
                        <b>
                            <h4 class="box-title text-info" style="margin: -20px;">Upload Image</h4>
                        </b>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4 col-sm-4 col-lg-4 col-xl-4 col-md-4">
                    <div class="form-group">
                        <label>Product Image One</label> <br>
                        <input type="file" name="image_one" class="form-control">
                        <div class="error-message text-danger">
                            @if ($errors->has('image_one'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('image_one') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-lg-4 col-xl-4 col-md-4">
                    <div class="form-group">
                        <label>Product Image Two</label> <br>
                        <input type="file" name="image_two" class="form-control">
                        <div class="error-message text-danger">
                            @if ($errors->has('image_two'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('image_two') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-lg-4 col-xl-4 col-md-4">
                    <div class="form-group">
                        <label>Product Image Three</label> <br>
                        <input type="file" name="image_three" class="form-control">
                        <div class="error-message text-danger">
                            @if ($errors->has('image_three'))
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('image_three') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a href="{{ route('message.index') }}">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
            <button type="submit" class="btn btn-success">Send</button>
        </div>
    </form>
</div>
@endsection

@section('script')

<script>

</script>

@endsection