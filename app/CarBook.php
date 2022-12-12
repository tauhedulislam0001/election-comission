<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class CarBook extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_name','booking_id', 'sd_id', 'created_by', 'car_name', 'pickup_date_time', 'airport_name', 'pickup_area', 'pickup_address', 'division_name', 'district_name', 'thana_name', 'no_of_passenger',
        'fair', 'status', 'passenger_title', 'last_name', 'first_name', 'dob', 'passport_number', 'mobile_number', 'email', 'airlines_name',
        'flight_date', 'flight_time', 'departure_time', 'flight_number', 'departure_country', 'ticket_number', 'relative_name',
        'relative_mobile1', 'relative_mobile2', 'children', 'infants', 'notes', 'payment_status', 'nationality',
        'driver_name', 'driver_mobile', 'driver_nid', 'car_no', 'service_provider', 'relative_name2', 'payment_method', 'coupon_code', 'subtotal', 'discount_amount', 'village_name','updated_by','updated_at','created_at', 'pgw_subtotal'
    ];

    public function user()
    {
        return $this->belongsTo(AdminUser::class, 'created_by');
    }

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

    public static function carBookCount()
    {
        $user_type = Auth::guard('admin')->user()->user_type;
        $agent_code = Auth::guard('admin')->user()->agent_code;

        if($user_type == 1 or $user_type == 2) {
            return CarBook::count();
        } else {
            return CarBook::where('sd_id', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        }
    }
    
    public static function myBookingGB()
    {
        return CarBook::count();
    }
    

    public static function mybooking() {
        return Carbook::where('created_by', Auth::guard('admin')->user()->agent_code)->count();
    }

    public static function todayBook()
    {
        $userType = Auth::guard('admin')->user()->user_type;
        $agent_code = Auth::guard('admin')->user()->agent_code;

        if($userType == 1 or $userType ==2 or $userType == 14) {
            return CarBook::whereDate('created_at', Carbon::today())->count();
        } elseif($userType == 4) {
            return CarBook::whereDate('created_at', Carbon::today())->where('sd_id', Auth::guard('admin')->user()->id)->count();
        } elseif($userType == 3) {
            return CarBook::whereDate('created_at', Carbon::today())->where('sd_id', Auth::guard('admin')->user()->id)->orWhere('created_by', $agent_code)->count();
        } 
    }

    // public static function carbookStatus()
    // {
    //     $status = CarBook::where('updated_at', '=', Carbon::now())->where('status', '!=', '')->latest()->get();
    //     $user_type = Auth::guard('admin')->user()->user_type;
    //     if ($status == "Pending") {
    //         if ($user_type == 1) {
    //             return CarBook::where('status', '=', 'Pending')->count();
    //         }
    //     } elseif ($status == "Received") {
    //         return CarBook::where('status', '=', 'Received')->count();
    //     } elseif ($status == "Assigned Driver") {
    //         return CarBook::where('status', '=', 'Assigned Driver')->count();
    //     } elseif ($status == "Customer Communicate") {
    //         return CarBook::where('status', '=', 'Customer Communicate')->count();
    //     } elseif ($status == "Cancel By User") {
    //         return CarBook::where('status', '=', 'Cancel By User')->count();
    //     } elseif ($status == "Pickup Completed") {
    //         return CarBook::where('status', '=', 'Pickup Completed')->count();
    //     }
    // }

    // public static function commission(CarBook $carBook) {
    //     return AgentCommision::carBookCommission($carBook);
    // }


    /**
     * Get all of the carbook ledger.
     */
    public function ledger()
    {
        return $this->morphMany('App\WalletLedger', 'head');
    }
}
