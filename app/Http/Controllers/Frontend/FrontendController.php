<?php

namespace App\Http\Controllers\Frontend;

use App\Airlines;
use App\Airport;
use App\Car;
use App\District;
use App\Division;
use App\Http\Controllers\Controller;
use App\Thana;
use App\Tracker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Countries\Package\Services\Countries;
use Alert;
use App\ContactUs;
use App\CustomerFeedBack;
use App\DepartureAirport;
use App\HolidayFare;
use App\PGCurrencyConversion;
use App\Session as AppSession;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function getIndex()
    {
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }

        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }
        
        return view('login.login');
    }
    
}
