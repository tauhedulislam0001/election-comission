<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Auth;
use Illuminate\Support\Facades\Auth;
use App\UserLoginLog;
use App\Events\UserEvent;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an Agent authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    // public function authenticateAgent(Request $request)
    // {
    //     // $credentials = $request->only('email', 'password');

    //     if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'user_type' => 1])) {
    //         // Authentication passed...
    //         return redirect('/');
    //     }

    //     return $this->sendFailedLoginResponse($request);
    // }

    /**
     * Handle an NBR authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    // public function authenticateNbr(Request $request)
    // {
    //     // $credentials = $request->only('email', 'password');

    //     if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'user_type' => 2])) {
    //         // Authentication passed...
    //         return redirect('/');
    //     }

    //     return $this->sendFailedLoginResponse($request);
    // }

    function authenticated(Request $request, $user)
    {
        if (!Auth::check()) {
            return view('errors.404');
        }

        event(new UserEvent($request, $user));

        if (!empty($request->session()->get('carBookingStep2Data', []))) {
            // Carbooking process is in progress to finish it.
            return redirect()->route('completeCarBookForm');
        }

        $user = Auth::user();
        // var_dump($user->user_type); exit;
        if ($user->user_type = 10) {
            return redirect("/");
        }
    }

    protected function guard()
    {
        return Auth::guard('web');
    }
}
