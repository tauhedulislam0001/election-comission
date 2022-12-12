<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CarRental extends Model
{
    protected $table = 'car_rentals';

    protected $fillable = [ 'booking_id', 'created_by', 'updated_by', 'sp_id', 'sd_id', 'pickup_location', 'pickup_date_time', 'trip_duration', 'trip_type', 'car_name', 'car_type', 'fare', 'bdt_fare', 'subtotal', 'vendor_sale', 'gb_profit', 'adb_pgw_subtotal', 'pgw_subtotal', 'status', 'full_name', 'pid_no', 'mobile', 'nationality', 'email', 'payment_status', 'payment_method', 'emergency_contact', 'address', 'destination', 'driver_name', 'driver_mobile', 'driver_nid', 'car_no', 'channel',];
    public function serviceProvider()
    {
        return $this->belongsTo(AdminUser::class, 'sp_id');
    }

    public function user()
    {
        return $this->belongsTo(AdminUser::class, 'created_by');
    }

    public static function todayBookComplete()
    {
        return self::whereDate('created_at', Carbon::today())->where('status', 'Customer Dropped')->count();
    }

    public static function todayCancelByUser()
    {
        return self::whereDate('created_at', Carbon::today())->where('status', 'Cancelled By User')->count();
    }

    public static function totalDueBooking()
    {
        $userType = Auth::guard('admin')->user()->user_type;
        $agent_code = Auth::guard('admin')->user()->agent_code;

        if($userType == 1 or $userType ==2) {
            return self::where('payment_status', 'Payment Due')->orWhere('payment_status', null)->count();
        } elseif($userType == 3 or $userType == 4) {
            return self::where('payment_status', 'Payment Due')->orWhere('payment_status', null)->where('sd_id', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        }
    }

    public static function carBookCount()
    {
        $user_type = Auth::guard('admin')->user()->user_type;
        $agent_code = Auth::guard('admin')->user()->agent_code;

        if($user_type == 1 or $user_type == 2 or $user_type == 14) {
            return self::where('payment_status', 'Paid')->count();
        } else {
            return self::where('sd_id', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        }
    }
    
    public static function myBookingGB()
    {
        return self::count();
    }
    

    public static function mybooking() {
        return self::where('created_by', Auth::guard('admin')->user()->agent_code)->count();
    }

    public static function todayBook()
    {
        $userType = Auth::guard('admin')->user()->user_type;
        $agent_code = Auth::guard('admin')->user()->agent_code;

        if($userType == 1 or $userType == 2 or $userType == 14) {
            return self::whereDate('created_at', Carbon::today())->count();
        } elseif($userType == 4) {
            return self::whereDate('created_at', Carbon::today())->where('sd_id', Auth::guard('admin')->user()->id)->count();
        } elseif($userType == 3) {
            return self::whereDate('created_at', Carbon::today())->where('sd_id', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        } elseif($userType == 9) {
            return SingleTripBooking::whereDate('updated_at', Carbon::today())->where('service_provider', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        }
    }
    public function ledger()
    {
        return $this->morphMany('App\WalletLedger', 'head');
    }
}
