@extends('customlayouts.master')
@section('dashboard')
active
@endsection
@section('title')
develop Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-xxxl-3 col-lg-3 col-12">
        <div class="box wrap-style">
            <div class="box-body">
                <div class="d-flex align-items-start wrap-content">
                    <div class="col-xxxl-5 col-md-5 col-sm-5 col-lg-5 col-5">
                        <div class="dashboard-content-image">
                            <img src="{{ asset('dashboard/admin/images/dashboard_icon/total_agent.svg') }}" width="60"
                                height="80" alt="" />
                        </div>
                    </div>
                    <div class="col-xxxl-7 col-md-7 col-sm-7 col-lg-7 col-7">
                        <a href="{{ route('user.index') }}">
                            <div class="wrap-content-dashboard">
                                <h2 class="my-0 font-weight-700">{{ App\AdminUser::myUser() }}</h2>
                                <span class="text-fade">Total User</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxxl-3 col-lg-3 col-12">
        <div class="box wrap-style">
            <div class="box-body">
                <div class="d-flex align-items-start wrap-content">
                    <div class="col-xxxl-5 col-md-5 col-sm-5 col-lg-5 col-5">
                        <div class="dashboard-content-image">
                            <img src="{{ asset('dashboard/admin/images/dashboard_icon/total_agent.svg') }}" width="60"
                                height="80" alt="" />
                        </div>
                    </div>
                    <div class="col-xxxl-7 col-md-7 col-sm-7 col-lg-7 col-7">
                        <a href="{{ route('user.index') }}">
                            <div class="wrap-content-dashboard">
                                <h2 class="my-0 font-weight-700">{{ App\Message::newMessage() }}</h2>
                                <span class="text-fade">New Messager</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxxl-3 col-lg-3 col-12">
        <div class="box wrap-style">
            <div class="box-body">
                <div class="d-flex align-items-start wrap-content">
                    <div class="col-xxxl-5 col-md-5 col-sm-5 col-lg-5 col-5">
                        <div class="dashboard-content-image">
                            <img src="{{ asset('dashboard/admin/images/dashboard_icon/total_agent.svg') }}" width="60"
                                height="80" alt="" />
                        </div>
                    </div>
                    <div class="col-xxxl-7 col-md-7 col-sm-7 col-lg-7 col-7">
                        <a href="{{ route('user.index') }}">
                            <div class="wrap-content-dashboard">
                                <h2 class="my-0 font-weight-700">{{ App\AdminUser::myUser() }}</h2>
                                <span class="text-fade">Total User</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxxl-3 col-lg-3 col-12">
        <div class="box wrap-style">
            <div class="box-body">
                <div class="d-flex align-items-start wrap-content">
                    <div class="col-xxxl-5 col-md-5 col-sm-5 col-lg-5 col-5">
                        <div class="dashboard-content-image">
                            <img src="{{ asset('dashboard/admin/images/dashboard_icon/total_agent.svg') }}" width="60"
                                height="80" alt="" />
                        </div>
                    </div>
                    <div class="col-xxxl-7 col-md-7 col-sm-7 col-lg-7 col-7">
                        <a href="{{ route('user.index') }}">
                            <div class="wrap-content-dashboard">
                                <h2 class="my-0 font-weight-700">{{ App\AdminUser::myUser() }}</h2>
                                <span class="text-fade">Total User</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      
@endsection