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
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }

        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }
        
        $credential = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credential)) {
            $user = AdminUser::where('email', $request->email)->first();
            $guard = Auth::guard('admin')->login($user);
            $user_type = Auth::guard('admin')->user()->user_type;

            if ($user_type == 1 or $user_type == 2 or $user_type == 3) {
                if ($user->can_login == 1) {
                    return redirect()->route('admin.dashboard');
                    // return response()->json(["success"]);

                } elseif ($user->can_login == 2) {
                    $this->guard()->logout();
                    // return response()->json(["ErrorId"=>'1',"ErrorName"=>"Sorry, your account has been banned! Please contact with your administrator"]);
                    return redirect()->route('welcome')->with('error', "Sorry, your account has been banned! Please contact with your administrator");
                } else {
                    $this->guard()->logout();
                    // return response()->json(["ErrorId"=>'1',"ErrorName"=>"You don't have permission to login! Please contact with your administrator"]);
                    return redirect()->route('welcome')->with('error', "You don't have permission to login! Please contact with your administrator");
                }
            } else {
                return response()->json("You have no permission");
            }
        } else {
            // return response()->json(["ErrorId"=>'1',"ErrorName"=>"Your credential does not match our records"]);
            return redirect()->route('welcome')->with('error', 'Your credential does not match our records');
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