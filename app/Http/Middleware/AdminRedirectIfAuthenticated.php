<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        if (Auth::guard('admin')->check()) {
            $user_type = Auth::guard('admin')->user()->user_type;
            // dd($user_type);
            if ($user_type == 10) {
                return redirect()->route('welcome');
            } else {
                return redirect()->route('admin.dashboard');
            }
        }
        return $next($request);
    }
}
