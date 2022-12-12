<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // Get the currently authenticated user...
            $user = Auth::user();
            // dd($user);
            // if ($user->user_type == 0) {
            // this is Super-ADMIN user. so redirect user to admin home
            // return redirect(RouteServiceProvider::SUPERADMINHOME);
            // } elseif ($user->user_type == 1) {
            //     return redirect(RouteServiceProvider::ADMINHOME);
            // } elseif ($user->user_type == 2) {
            //     return redirect(RouteServiceProvider::HOME);
            // }


            // Normal user. so redirect user to website home page
            // return redirect("/");
        }

        return $next($request);
    }
}
