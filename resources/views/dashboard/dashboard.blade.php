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
                            <img src="{{ asset('dashboard/admin/images/dashboard_icon/all_message.png') }}" width="60"
                                height="80" alt="" />
                        </div>
                    </div>
                    <div class="col-xxxl-7 col-md-7 col-sm-7 col-lg-7 col-7">
                        <a href="{{ route('message.index') }}">
                            <div class="wrap-content-dashboard">
                                <h2 class="my-0 font-weight-700">{{ App\Message::totalMessage() }}</h2>
                                <span class="text-fade">Total Messager</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxxl-3 col-lg-3 col-12">
        <div class="box wrap-style" style="height: 123px!important">
            <div class="box-body">
                <div class="d-flex align-items-start wrap-content">
                    <div class="col-xxxl-5 col-md-5 col-sm-5 col-lg-5 col-5">
                        <div class="dashboard-content-image">
                            <img src="{{ asset('dashboard/admin/images/dashboard_icon/new_message.png') }}" width="50"
                                height="50" alt="" style="margin:15px 0 0 0" />
                        </div>
                    </div>
                    <div class="col-xxxl-7 col-md-7 col-sm-7 col-lg-7 col-7">
                        <a href="{{ route('message.index') }}">
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
            <div class="box-body" style="height: 123px!important">
                <div class="d-flex align-items-start wrap-content">
                    <div class="col-xxxl-5 col-md-5 col-sm-5 col-lg-5 col-5">
                        <div class="dashboard-content-image">
                            <img src="{{ asset('dashboard/admin/images/dashboard_icon/clock.png') }}" width="50"
                                height="50" alt="" style="margin:15px 0 0 0"/>
                        </div>
                    </div>
                    <div class="col-xxxl-7 col-md-7 col-sm-7 col-lg-7 col-7">
                        <a>
                            <div class="wrap-content-dashboard">
                                <b><div id="time" style="font-size:28px"></div></b>
                                <span class="text-fade">Time</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  function showTime() {
    var date = new Date(),
        utc = new Date(Date.UTC(
          date.getFullYear(),
          date.getMonth(),
          date.getDate(),
          date.getHours() - 6,
          date.getMinutes(),
          date.getSeconds()
        ));

    document.getElementById('time').innerHTML = utc.toLocaleTimeString();
  }

  setInterval(showTime, 1000);
</script>
@endsection