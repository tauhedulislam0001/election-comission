<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use App\Http\Controllers\Controller;
use App\UserLoginLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function authenticate(Request $request)
    {
        $credential = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credential)) {
            $user = AdminUser::where('email', $request->email)->first();
            $guard = Auth::guard('admin')->login($user);
            $user_type = Auth::guard('admin')->user()->user_type;

            if ($user_type == 1 or $user_type == 2 or $user_type == 3) {
                if ($user->can_login == 1) {
                    return redirect()->route('admin.dashboard')->with('error', "You have logged in successfully!");
                } elseif ($user->can_login == 2) {
                    $this->guard()->logout();
                    return redirect()->route('adminuser.login')->with('error', "Sorry, your account has been banned! Please contact with your administrator");
                } else {
                    $this->guard()->logout();
                    return redirect()->route('adminuser.login')->with('error', "You don't have permission to login! Please contact with your administrator");
                }
            }
        } else {
            return redirect()->route('adminuser.login')->with('error', 'Your credential does not match our records');
        }
    }

    public function getLogout(Request $request)
    {
        $this->session()->flash();
        $this->guard('admin')->logout();
        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('welcome');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}