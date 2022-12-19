@extends('customlayouts.master')
@section('message')
active
@endsection
@section('title')
Message | View
@endsection
@section('page-name')
Message View
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item" aria-current="page">Message</li>
<li class="breadcrumb-item active" aria-current="page">Message View</li>
@endsection
@section('content')
<div>
    <form method="POST" action="{{ route('message.update', Crypt::encryptString($item->id)) }}" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="box-header">
                        <b>
                            <h4 class="box-title text-info" style="margin: -20px;">Subject</h4>
                        </b>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    @if(Auth::guard('admin')->user()->id == $item->sender_id && $item->flag == 0)
                        <textarea name="subject" class="form-control" id="message" cols="200" rows="1" required>{{ $item->subject }}</textarea>
                    @else
                        <textarea name="subject" class="form-control" id="message" cols="200" rows="1" readonly>{{ $item->subject }}</textarea>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-6">
                    <div class="box-header">
                        <b>
                            <h4 class="box-title text-info" style="margin: -20px;">Message Details</h4>
                        </b>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    @if(Auth::guard('admin')->user()->id == $item->sender_id && $item->flag == 0)
                            <textarea name="message" class="form-control" id="message" cols="200" rows="5" required>{{ $item->message }}</textarea>
                    @else
                        <textarea name="message" class="form-control" id="message" cols="200" rows="5" readonly>{{ $item->message }}</textarea>
                    @endif
                </div>
            </div>
            <br>
            @if($item->image_one != null or $item->image_two != null or $item->image_three != null) 
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="box-header">
                            <b>
                                <h4 class="box-title text-info" style="margin: -20px;">Uploaded Image</h4>
                            </b>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row"`>
                    @if ($item->image_one != null)
                        <div class="col-4 col-sm-4 col-lg-4 col-xl-4 col-md-4">
                            <div class="row fx-element-overlay">
                                <div class="box box-default" style="height: 250px; width: 250px; margin: 0 0 21px 16px;">
                                    <div class="fx-card-item">
                                        <div class="fx-card-avatar fx-overlay-1">
                                            <div class="show-image" id="imageOneDB">
                                                <img src="{{ asset($item->image_one ?? null) }}" height="250px" width="250px" alt="no record found!">
                                            </div>
                                            <div class="fx-overlay">
                                                <ul class="fx-info">
                                                    <li>
                                                        <a class="btn default btn-outline image-popup-vertical-fit"
                                                            href="{{ asset($item->image_one ?? null) }}">
                                                            <i class="ti-zoom-in"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Image One</label> <br>
                                @if(Auth::guard('admin')->user()->id == $item->sender_id && $item->flag == 0)
                                <input type="file" name="image_one" id="image_one" class="form-control">
                                @endif
                                <div class="error-message text-danger">
                                    @if ($errors->has('image_one'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('image_one') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($item->image_two != null)
                        <div class="col-4 col-sm-4 col-lg-4 col-xl-4 col-md-4">
                            <div class="row fx-element-overlay">
                                <div class="box box-default" style="height: 250px; width: 250px; margin: 0 0 21px 16px;">
                                    <div class="fx-card-item">
                                        <div class="fx-card-avatar fx-overlay-1">
                                            <img src="{{ asset($item->image_two ?? null) }}" height="250px" width="250px" alt="no record found!">
                                            <div class="fx-overlay">
                                                <ul class="fx-info">
                                                    <li>
                                                        <a class="btn default btn-outline image-popup-vertical-fit"
                                                            href="{{ asset($item->image_two ?? null) }}">
                                                            <i class="ti-zoom-in"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Image Two</label> <br>
                                @if(Auth::guard('admin')->user()->id == $item->sender_id && $item->flag == 0)
                                <input type="file" name="image_two" id="image_two" class="form-control">
                                @endif
                                <div class="error-message text-danger">
                                    @if ($errors->has('image_two'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('image_two') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($item->image_three != null)
                        <div class="col-4 col-sm-4 col-lg-4 col-xl-4 col-md-4">
                            <div class="row fx-element-overlay">
                                <div class="box box-default" style="height: 250px; width: 250px; margin: 0 0 21px 16px;">
                                    <div class="fx-card-item">
                                        <div class="fx-card-avatar fx-overlay-1">
                                            <img src="{{ asset($item->image_three ?? null) }}" height="250px" width="250px" alt="no record found!">
                                            <div class="fx-overlay">
                                                <ul class="fx-info">
                                                    <li>
                                                        <a class="btn default btn-outline image-popup-vertical-fit"
                                                            href="{{ asset($item->image_three ?? null) }}">
                                                            <i class="ti-zoom-in"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Image Three</label> <br>
                                @if(Auth::guard('admin')->user()->id == $item->sender_id && $item->flag == 0)
                                <input type="file" name="image_three" id="image_three" class="form-control">
                                @endif
                                <div class="error-message text-danger">
                                    @if ($errors->has('image_three'))
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('image_three') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>                
                    @endif
                </div>
            @endif
            <br>
            @if($item->sender_id == Auth::guard('admin')->user()->id && $item->reply != null)
                <div class="row">
                    <div class="col-md-6 col-6">
                        <div class="box-header">
                            <b>
                                <h4 class="box-title text-info" style="margin: -20px;">You Replied</h4>
                            </b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <textarea class="form-control" id="reply" cols="200" rows="5" readonly>{{ $item->reply }}</textarea>
                    </div>
                </div>
            @elseif($item->sender_id != Auth::guard('admin')->user()->id && $item->reply != null)
                <div class="row">
                    <div class="col-md-6 col-6">
                        <div class="box-header">
                            <b>
                                <h4 class="box-title text-info" style="margin: -20px;">{{$item->repliedUser->username}} Replied</h4>
                            </b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <textarea class="form-control" id="reply" cols="200" rows="5" readonly>{{ $item->reply }}</textarea>
                    </div>
                </div>
            @elseif(Auth::guard('admin')->user()->can('message.edit') && $item->sender_id != Auth::guard('admin')->user()->id && $item->reply == null)
                <div class="row">
                    <div class="col-md-6 col-6">
                        <div class="box-header">
                            <b>
                                <h4 class="box-title text-info" style="margin: -20px;">Reply</h4>
                            </b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <textarea name="reply" class="form-control" id="reply" cols="200" rows="5">{{ $item->reply }}</textarea>
                    </div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a href="{{ route('message.index') }}">
                <button type="button" class="btn btn-danger">Back</button>
            </a>
            @if(Auth::guard('admin')->user()->can('message.update') && $item->sender_id != Auth::guard('admin')->user()->id && $item->reply == null)
                <button type="submit" class="btn btn-success">Send</button>
            @elseif (Auth::guard('admin')->user()->id == $item->sender_id && $item->flag == 0)
                <button type="submit" class="btn btn-success">Send</button>
            @endif
        </div>
    </form>
</div>
@endsection

@section('script')
@endsection