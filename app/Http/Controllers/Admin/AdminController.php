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
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function login() {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
         dd($request->all());
        $credential = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credential)) {
            $user = AdminUser::where('email', $request->email)->first();
            $guard = Auth::guard('admin')->login($user);
            $user_type = Auth::guard('admin')->user()->user_type;

            if ($user_type == 10 or $user_type == 7 or $user_type == 8) {
                if ($user->can_login == 1) {
                    $created_by= Auth::guard('admin')->user()->created_by;
                    $clientIP = request()->ip();
                    $device= $request->header('User-Agent');
                     UserLoginLog::insert(['subject' => $user->email, 'ip' => $clientIP, 'status' => '1','sd_id' =>$created_by, 'agent' => $device, 'user_id' => $user->id, 'created_at' => Carbon::now()]);
                    // return redirect()->intended(route('welcome'));  //intended(route('welcome'))
                    return response()->json(["success"]);

                } elseif ($user->can_login == 2) {
                    $this->guard()->logout();
                    return response()->json(["ErrorId"=>'1',"ErrorName"=>"Sorry, your account has been banned! Please contact with your administrator"]);

                    // return redirect()->route('welcome')->with('error', "Sorry, your account has been banned! Please contact with your administrator");
                } elseif ($user->can_login == 0) {
                    if ($user_type == 7 or $user_type == 8) {
                        if (Auth::guard('admin')->user()->passport_no == null) {
                            $created_by= Auth::guard('admin')->user()->created_by;
                            $clientIP = request()->ip();
                            $device= $request->header('User-Agent');
                             UserLoginLog::insert(['subject' => $user->email, 'ip' => $clientIP, 'status' => '1','sd_id' =>$created_by, 'agent' => $device, 'user_id' => $user->id, 'created_at' => Carbon::now()]);
                             return response()->json(["ErrorId"=>'3',"ErrorName"=>"success"]);
                            }
                    }
                    $this->guard()->logout();
                    return response()->json(["ErrorId"=>'1',"ErrorName"=>"You don't have permission to login! Please contact with your administrator"]);

                    // return redirect()->route('welcome')->with('error', "You don't have permission to login! Please contact with your administrator");
                }
            }

            if ($user_type !== 10 or $user_type !== 7 or $user_type !== 8) {
                if ($user->can_login == 1) {
                  
                    $created_by= Auth::guard('admin')->user()->created_by;
                    $clientIP = request()->ip();
                    $device= $request->header('User-Agent');
                     UserLoginLog::insert(['subject' => $user->email, 'ip' => $clientIP, 'status' => '1','sd_id' =>$created_by, 'agent' => $device, 'user_id' => $user->id, 'created_at' => Carbon::now()]);
                    // return redirect()->route('admin.dashboard');
                    return response()->json(["success"]);

                } elseif ($user->can_login == 2) {
                    $this->guard()->logout();
                    return response()->json(["ErrorId"=>'1',"ErrorName"=>"Sorry, your account has been banned! Please contact with your administrator"]);
                    // return redirect()->route('welcome')->with('error', "Sorry, your account has been banned! Please contact with your administrator");
                } else {
                    $this->guard()->logout();
                    return response()->json(["ErrorId"=>'1',"ErrorName"=>"You don't have permission to login! Please contact with your administrator"]);
                    // return redirect()->route('welcome')->with('error', "You don't have permission to login! Please contact with your administrator");
                }
            }
        } else {
            return response()->json(["ErrorId"=>'1',"ErrorName"=>"Your credential does not match our records"]);
            // return redirect()->route('welcome')->with('error', 'Your credential does not match our records');
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
    public function AgentInfo(){
        return view('agent.agent_info');
    }
}