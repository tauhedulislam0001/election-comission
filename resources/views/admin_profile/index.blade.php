@extends('customlayouts.master')
@section('title')
My Profile
@endsection
@section('page-name')
My Profile
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>
<li class="breadcrumb-item" aria-current="page">My Profile</li>
<li class="breadcrumb-item active" aria-current="page">{{ Auth::user()->name }}
</li>
@endsection
@section('content')
<div class="row fx-element-overlay">
    <div class="col-md-12 col-lg-4">
        <div class="box box-default">
            <div class="fx-card-item">
                <div class="fx-card-avatar fx-overlay-1">
                    @if (Auth::user()->avatar == !'')
                    <img src="{{ asset(Auth::user()->avatar) }}" class="user-image rounded-circle avatar bg-white mx-10"
                        alt=" user">
                    @elseif(Auth::user()->avatar == '' && Auth::user()->gender !== 'male')
                    <img src="{{ asset('dashboard/admin/images/avatar/avatar_female.jpg') }}"
                        class="user-image rounded-circle avatar bg-white mx-10" alt="User Image">
                    @else
                    <img src="{{ asset('dashboard/admin/images/avatar/avatar_male.jpg') }}"
                        class="user-image rounded-circle avatar bg-white mx-10" alt="User Image">
                    @endif
                    <div class="fx-overlay">
                        <ul class="fx-info">
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit"
                                    href="{{ asset(Auth::user()->avatar) }}">
                                    <i class="ti-zoom-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="fx-card-content">
                    <h3 class="box-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <small>{{ Auth::user()->designation }}</small>
                    <br>
                    <div class="box-body" style="margin-top: -18px">
                        <button type="button" class="btn btn-primary btn-sm mb-5" data-toggle="modal"
                            data-target="#modal-center">
                            <i class="ti-camera"></i> Update profile picture
                        </button> <br>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#modal-center-1">
                            <i class="ti-trash"></i> Remove profile picture
                        </button> <br>
                        <button type="button" class="btn btn-primary btn-sm mt-5" data-toggle="modal"
                            data-target=".bs-example-modal-lg">
                            <i class="ti-pencil"></i> Update profile information
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </div>

    <div class="col-8">
        <div class="box box-default">
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home2" role="tab">
                            <span class="hidden-xs-down">
                                <i class="ti-user"></i> My Profile
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">
                            <span class="hidden-xs-down">
                                <i class="ti-mobile"></i> Contact
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home2" role="tabpanel">
                        <div class="p-15">
                            <p>User Name :<span class="text-gray pl-10"><b>{{ Auth::user()->username }}</b></span>
                            </p>
                            <p>First Name :<span class="text-gray pl-10"><b>{{ Auth::user()->first_name }}</b></span>
                            </p>
                            <p>Last Name :<span class="text-gray pl-10"><b>{{ Auth::user()->last_name }}</b></span>
                            </p>
                            <p>User Type :<span class="text-gray pl-10"><b>
                                        @if (Auth::user()->user_type == 0)
                                        User
                                        @elseif(Auth::user()->user_type == 1)
                                        Admin
                                        @elseif(AUth::user()->user_type == 2)
                                        Moderator
                                        @endif
                                    </b></span>
                            </p>
                            <p>Designation :
                                <span class="text-gray pl-10"><b>{{ Auth::user()->designation }}</b></span>
                            </p>
                            <p>Date of Birth: <span class="text-gray pl-10">

                                <b>{{ Auth::user()->dd }}&nbsp;
                                    @if (Auth::user()->mm == '1')January 
                                    @elseif (Auth::user()->mm == '2')February 
                                    @elseif (Auth::user()->mm == '3')March 
                                    @elseif (Auth::user()->mm == '4')April  
                                    @elseif (Auth::user()->mm == '5')May 
                                    @elseif (Auth::user()->mm == '6')June  
                                    @elseif (Auth::user()->mm == '7')July  
                                    @elseif (Auth::user()->mm == '8')August  
                                    @elseif (Auth::user()->mm == '9')September  
                                    @elseif (Auth::user()->mm == '10')October  
                                    @elseif (Auth::user()->mm == '11')November   
                                    @else
                                    December 
                                    @endif
                                    &nbsp;{{ Auth::user()->yy }}</b>
                                
                            </span></p>
                            <p>Nationality:
                                <span class="text-gray pl-10"><b>{{ Auth::user()->nationality }}</b></span>
                            </p>
                            <p>Gender: <span class="text-gray pl-10"><b>{{ Auth::user()->gender }}</b></span></p>
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile2" role="tabpanel">
                        <div class="p-15">
                            <p>Email :<span class="text-gray pl-10"><b>{{ Auth::user()->email }}</b></span>
                            </p>
                            <p>Phone :<span class="text-gray pl-10"><b>{{ Auth::user()->mobile }}</b></span></p>
                            <p>Address :<span class="text-gray pl-10">
                                    <b>{{ Auth::user()->address }}</b>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <!-- ================== Update Profile Information =================== -->


    {{-- modal --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        <span class="wrapupdate" style="text-align: center">
                            <b>
                                <i class="ti-pencil"></i>
                                Update User Information
                            </b>
                        </span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{ route('admin.update-profile') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h4 class="box-title text-primary"><i class="ti-user"></i> User
                                            Profile</h4>
                                    </div>

                                    <div class="box-body">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">First Name
                                                <span class="text-primary"><b>*</b></span>
                                            </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"
                                                    value="{{ Auth::user()->first_name }}" name="first_name">
                                                @error('first_name')
                                                <span class="text-primary">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Last Name
                                                <span class="text-primary"><b>*</b></span>
                                            </label>
                                            <div class="col-md-10">
                                                <input class="form-control" value="{{ Auth::user()->last_name }}"
                                                    type="text" name="last_name">
                                                @error('last_name')
                                                <span class="text-primary">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Designation
                                                <span class="text-primary"><b>*</b></span>
                                            </label>
                                            <div class="col-md-10">
                                                <input class="form-control" value="{{ Auth::user()->designation }}"
                                                    type="text" name="designation">
                                                @error('designation')
                                                <span class="text-primary">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Date Of Birth
                                                <span class="text-primary"><b>*</b></span>
                                            </label>                                         
                                            <div class="col-md-10">
                                                <div class="col-md-4 float-left p-1">
                                                    <select name="dd" id="" class="form-control form-control select2 select2-hidden-accessible" style="width: 100%;" id="dd">
                                                        <option value="">DD</option>
                                                        @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" @if(isset(Auth::user()->dd) && Auth::user()->dd==$i)
                                                            selected @endif>{{ $i }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-4 float-left p-1">
                                                    <select name="mm" id="mm" class="form-control form-control select2 select2-hidden-accessible" style="width: 100%;" >
                                                        <option value="">MM</option>
                                                        @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" @if(isset(Auth::user()->mm) && Auth::user()->mm==$i)
                                                            selected @endif>{{ $i }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-4 float-left p-1">
                                                    <select name="yy" id="yy" class="form-control form-control select2 select2-hidden-accessible" style="width: 100%;">
                                                        <option value="">YYYY</option>
                                                        {{ $last= date('Y')-120 }}
                                                        {{ $now = date('Y') }}
                                                        @for ($i = $now; $i >= $last; $i--)
                                                        <option value="{{ $i }}" @if(isset(Auth::user()->yy) && Auth::user()->yy==$i) selected @endif>{{ $i }}
                                                        </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Nationality
                                                <span class="text-primary"><b>*</b></span>
                                            </label>
                                            <div class="col-md-10">
                                                <input class="form-control" value="{{ Auth::user()->nationality }}"
                                                    type="text" name="nationality">
                                                @error('nationality')
                                                <span class="text-primary">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Gender <span
                                                    class="text-primary"><b>*</b></label>
                                            <div class="col-md-10 c-inputs-stacked">
                                                @if (Auth::user()->gender == 'Male')
                                                <input type="checkbox" checked name="gender"
                                                value="Male"
                                                id="checkbox_123">
                                                <label for="checkbox_123" class="d-block">Male</label>
                                                <input type="checkbox" name="gender"
                                                    value="Female"
                                                    id="checkbox_124">
                                                <label for="checkbox_124" class="d-block">Female</label>
                                                @elseif (Auth::user()->gender == 'Female')
                                                <input type="checkbox" name="gender"
                                                value="Male"
                                                id="checkbox_123">
                                                <label for="checkbox_123" class="d-block">Male</label>
                                                <input type="checkbox" checked name="gender"
                                                    value="Female"
                                                    id="checkbox_124">
                                                <label for="checkbox_124" class="d-block">Female</label>
                                                @else
                                                <input type="checkbox" name="gender"
                                                value="Male"
                                                id="checkbox_123">
                                                <label for="checkbox_123" class="d-block">Male</label>
                                                <input type="checkbox"  name="gender"
                                                    value="Female"
                                                    id="checkbox_124">
                                                <label for="checkbox_124" class="d-block">Female</label>
                                                @endif
                                               
                                                @error('gender')
                                                <span class="text-primary">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-header">
                                    <h4 class="box-title text-primary"><i class="ti-mobile"></i> Contact</h4>
                                </div>
                                <div class="box-body">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Mobile no
                                            <span class="text-primary"><b>*</b></span>
                                        </label>
                                        <div class="col-md-10">
                                            <input class="form-control" value="{{ Auth::user()->mobile }}" type="tel"
                                                name="mobile">
                                            @error('mobile')
                                            <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Address
                                            <span class="text-primary"><b>*</b></span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea rows="5" class="form-control" name="address"
                                                placeholder="Enter your address here">{{ Auth::user()->address }}</textarea>
                                            @error('address')
                                            <span class="text-primary">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- ./col -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning text-left">Update
                            information</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>

<!-- ================== Update Profile Pic =================== -->

<div class="modal center-modal fade" id="modal-center" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload profile picture</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('admin.update-picture') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p><strong></strong></p>
                    <img src="{{ asset(Auth::user()->avatar) }}" class="profile_size" alt="">
                    <input type="hidden" name="profile_id" value="{{ Auth::guard('admin')->user()->id }}">
                    <input type="hidden" name="avatar" value="{{ Auth::guard('admin')->user()->avatar }}">
                    <input type="file" name="avatar" class="file">
                    @error('avatar')
                    <span class="text-primary">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary float-right">Upload Picture</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================== Remove Profile Pic =================== -->

<div class="modal center-modal fade" id="modal-center-1" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove profile picture</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Are you sure? You want to remove your profile picture?</strong></p>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                @php
                $id = Auth::user()->id;
                @endphp
                <a href="{{ route('admin.remove-picture') }}">
                    <button type="submit" class="btn btn-primary float-right">Yes, Remove!</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection