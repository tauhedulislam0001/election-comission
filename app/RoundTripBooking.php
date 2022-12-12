<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RoundTripBooking extends Model
{
    protected $table = 'round_trip_bookings';
    protected $fillable = ["booking_id", "created_by", "updated_by",'agent_commission',
    'sd_profit', "sd_id", "car_name", "car_type", "airport_name", "division_name", "district_name", "thana_name", "city_name", "street_address", "village_name", "pickup_date_time", "return_date_time", "full_name", "no_of_passenger", "passport_no", "nationality", "phone_no", "email", "departure_airport", "airlines_name", "flight_number", "emergency_contact", "trip_type", "status", "payment_method", "payment_status", "fare", "discount", "coupon_code", "subtotal",'adb_pgw_subtotal', "pgw_subtotal", 'service_provider', 'driver_name', 'driver_mobile', 'driver_nid', 'car_no', 'bdt_fare', 'vendor_sale', 'payment_recieved_bdt', 'gb_profit'];

    public function userCurrency()
    {
        return $this->belongsTo(AdminUser::class, 'currency');
    }

    public function provider()
    {
        return $this->belongsTo(AdminUser::class, 'service_provider');
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
            return self::where('payment_status', 'Due')->count();
        } elseif($userType == 3 or $userType == 4) {
            return self::where('payment_status', 'Due')->where('sd_id', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
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

        if($userType == 1 or $userType ==2 or $userType == 14) {
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
