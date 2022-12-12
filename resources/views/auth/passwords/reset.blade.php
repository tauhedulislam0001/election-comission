@extends('frontend.layouts.lang.english.main')

@section('title')
Password Reset
@endsection

@section('extra-css')
<style>
    .modal-body .form-horizontal .col-sm-2,
.modal-body .form-horizontal .col-sm-10 {
    width: 100%
}

.modal-body .form-horizontal .control-label {
    text-align: left;
}
.modal-body .form-horizontal .col-sm-offset-2 {
    margin-left: 15px;
}
#content{
    display: none;
}
.bkash .nav_hotline {
    width: 65%;
    text-align: center;
    float: left;
    font-size: 22px;
}
.bkash .nav_select_language {
    float: right;
}
.top_nav_wrap.bkash {
    margin-top: 30px;
}
.bkashSection{
    padding-top: 120px;
}
@media(max-width:991px){
    .bkash .nav_hotline {
        display: none;
        }
    }
    @media(max-width:450px){
    .bkash .nav_select_language button {
            font-size: 10px;
        }
    }
</style>
@endsection
@section('content')
{{-- @include('frontend.layouts.lang.english.nav') --}}
<div class="mobile_view_aps_download dispaly-none ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="#">
                    <span>Download Garibook New App</span>
                    <img src="{{ asset('dashboard/new-ui/assets') }}/image/icon/google_play.png"
                        class="app_store_icon" alt="">
                </a>
            </div>
        </div>
    </div>
</div>
    <header id="header">
        <div class="container">
            <nav>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="header_icon_wrap">
                            <a href="/">
                                
                                    <img src="{{ asset('dashboard/new-ui/assets') }}/image/icon/logo.png" alt="">
                                
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-6">
                        <div class="top_nav_wrap bkash">
                            <div class="nav_hotline  " >
                                <span class="default_color"><span style="font-weight: 600;color: #000;">{{ __('site.top_nav.hotline') }}:</span> +8801810198969</span>
                            </div>
                            <div class="nav_select_language  " >
                                <button type="button" class="btn btn-primary"><a style="color: #fff !important;" href="/">{{ __('site.payment.back_to_homepage') }}</a></button>
                            </div>
                            
                        </div>
                    
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <section id="forgotPassword">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                          <div class="forgot_password_wrap">
                                <div class="col-md-6 m-auto">
                                      <div class="forgot_password_title">
                                            <h3>Reset Password</h3>
                                      </div>
                                      <div class="forgot_password_form">
                                        <form method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="form-group">
                                                  <label for="">Email <b style="color:red">* </b></label>
                                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
    
                                                  @error('email')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                  @enderror                                            </div>
                                            <div class="form-group">
                                                  <label for="">New Password <b style="color:red">*</b></label>
                                                  <div class="password_show_wrap">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror                                                        
                                                    <img class="password_show_ico" onclick="newPassword()" id="reset_new_password_close_eye"  src="assets/image/icon/close_eye.png" alt="">
                                                    <img class="password_show_ico " id="reset_new_password_open_eye" onclick="newPassword()" src="assets/image/icon/open_eye.png" alt="">
                                                  </div>
                                            </div>
                                            <div class="form-group">
                                                  <label for="">Confirm Password <b style="color:red">*</b></label>
                                                  <div class="password_show_wrap">
                                                        <input type="password" id="confirm_password" name="password_confirmation" placeholder="Confirm Password" class="form-control" id="">
                                                        <img class="password_show_ico" onclick="confirm_password()" id="reset_confirm_password_close_eye" src="assets/image/icon/close_eye.png" alt="">
                                                        <img class="password_show_ico" onclick="confirm_password()" id="reset_confirm_password_open_eye" src="assets/image/icon/open_eye.png" alt="">
                                                  </div>
                                            </div>
                                            <button type="submit">Reset Password</button>
                                        </form>
                                      </div>
                                </div>
                          </div>
                    </div>
              </div>
        </div>
 </section>

{{-- 
    <div class="container" style="padding-top: 130px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
    
                            <input type="hidden" name="token" value="{{ $token }}">
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

@include('frontend.layouts.lang.english.footer')

@endsection


