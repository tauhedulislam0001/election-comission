<?php

namespace App\Http\Controllers\Admin;

use App\CarBook;
use App\CarRental;
use App\Http\Controllers\Controller;
use App\MultiCityTripBooking;
use App\RoundTripBooking;
use App\SingleTripBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function getIndex()
    {
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'You are Unauthorized to access this page!');
        }
        
        return view('dashboard.dashboard');
    }
}
