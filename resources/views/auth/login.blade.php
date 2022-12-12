@extends('front')

@section('title')
    | Login
@endsection

@section('extra-css')
    <link href="{{ asset('dashboard/assets/css/passenger.css') }}" rel="stylesheet" />
    <style>
        @media only screen and (min-width: 1600px) {
            .agentlogin-row {
                width: 100%;
            }
        }

    </style>
@endsection

@section('body')
@if (session('status'))    
<div>
    <div class="status-alert" style="text-align:center; background-color:#f5c2c7; padding: 10px; width:100%; color:#842029;">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{session('status')}}
    </div>
</div>
@endif
    <form method="POST" action="{{ route('adminuser.login') }}" style="margin-bottom: 350px;">
        @csrf
        <div class="agentlogin" style="position: relative; margin-top: 6vh; top:unset;">
            <!-- <div class="agentlogin-cross-row">
                                <img src="{{ asset('dashboard/assets/Images/backicon.svg') }}" alt="" class="agentlogin-cross-img">
                            </div> -->
            <!-- row 1 starts here -->
            <div class="agentlogin-row agentlogin-row-1">
                <div class="agentlogin-row-column agentlogin-row-1-column">
                    <label class="agentlogin-row-column-label agentlogin-row-1-column-label">ID / Email</label>
                    <input id="email" type="email"
                        class="form-control agentlogin-row-column-input agentlogin-row-1-column-input @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="{{ __('E-Mail Address') }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!-- row 1 ends here -->
            <!-- row 2 starts here -->
            <div class="agentlogin-row agentlogin-row-2">
                <div class="agentlogin-row-column agentlogin-row-1-column">
                    <label class="agentlogin-row-column-label agentlogin-row-1-column-label">Password</label>
                    <input id="password" type="password"
                        class="form-control agentlogin-row-column-input agentlogin-row-1-column-input @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            @if (Route::has('password.request'))
                <!-- row 2 ends here -->
                <div class="agentlogin-row agentlogin-row-3">
                    <div class="agentlogin-row-column agentlogin-row-3-column">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div>
            @endif

            <!-- row 2 ends here -->
            <div class="agentlogin-row agentlogin-row-3">
                <div class="agentlogin-row-column agentlogin-row-3-column">
                    <div>
                        You don't have an account? <a href="#" class="signuppopup-link">Signup</a> Or <a href="#"
                            class="agentsignupform-link">Become an Agent</a>
                    </div>
                </div>
            </div>
            <!-- row 4 starts here -->
            <div class="agentlogin-row agentlogin-row-4">
                <div class="agentlogin-row-column agentlogin-row-4-column">
                    <button type="submit" class="agentlogin-row-column-login agentlogin-row-4-column-login">
                        Login
                    </button>

                    <!-- <a href="#" class="agentlogin-row-column-login agentlogin-row-4-column-login">
                                        Login
                                    </a> -->
                </div>
            </div>
            <!-- row 4 ends here -->
        </div>

    </form>

@endsection

@section('extra-script')
    <script src="{{ asset('dashboard/assets/js/passenger.js') }}" defer></script>
@endsection
