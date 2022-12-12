<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MultiCityTripBooking extends Model
{
    protected $table = 'multi_city_trip_bookings';
    protected $fillable = ['booking_id', 'created_by', 'car_name', 'car_type', 'emergency_contact', 'sd_id', 'updated_by', 'form', 'form1', 'form2', 'form3', 'form4', 'full_name', 'no_of_passenger', 'pid_no', 'nationality', 'phone_no', 'email', 'status', 'payment_method', 'Due', 'fare', 'discount', 'coupon_code', 'subtotal', 'pgw_subtotal', 'service_provider', 'driver_name', 'driver_mobile', 'driver_nid', 'car_no', 'channel'];

    public static function todayBookComplete()
    {
        return self::whereDate('created_at', Carbon::today())->where('status', 'Customer Dropped')->count();
    }

    public static function todayCancelByUser()
    {
        return self::whereDate('created_at', Carbon::today())->where('status', 'Cancelled By User')->count();
    }

    public static function carBookCount()
    {
        $user_type = Auth::guard('admin')->user()->user_type;
        $agent_code = Auth::guard('admin')->user()->agent_code;

        if($user_type == 1 or $user_type == 2) {
            return MultiCityTripBooking::where('payment_status', 'Paid')->count();
        } else {
            return MultiCityTripBooking::where('sd_id', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        }
    }

    public static function totalDueBooking()
    {
        $userType = Auth::guard('admin')->user()->user_type;
        $agent_code = Auth::guard('admin')->user()->agent_code;

        if($userType == 1 or $userType ==2) {
            return self::where('payment_status', 'Due')->count();
        } elseif($userType == 3 or $userType == 4) {
            return self::where('payment_status', 'Due')->where('sd_id', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        }
    }
    
    public static function myBookingGB()
    {
        return MultiCityTripBooking::count();
    }
    

    public static function mybooking() {
        return MultiCityTripBooking::where('created_by', Auth::guard('admin')->user()->agent_code)->count();
    }

    public static function todayBook()
    {
        $userType = Auth::guard('admin')->user()->user_type;
        $agent_code = Auth::guard('admin')->user()->agent_code;

        if($userType == 1 or $userType ==2 or $userType == 14) {
            return MultiCityTripBooking::whereDate('created_at', Carbon::today())->count();
        } elseif($userType == 4) {
            return MultiCityTripBooking::whereDate('created_at', Carbon::today())->where('sd_id', Auth::guard('admin')->user()->id)->count();
        } elseif($userType == 3) {
            return MultiCityTripBooking::whereDate('created_at', Carbon::today())->where('sd_id', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        } elseif($userType == 9) {
            return SingleTripBooking::whereDate('updated_at', Carbon::today())->where('service_provider', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        }
    }

    public function ledger()
    {
        return $this->morphMany('App\WalletLedger', 'head');
    }
}
