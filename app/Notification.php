<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    protected $table = "notifications";
    Protected $fillable = ["agent_request_id", "wallet_deposite_id", "user_id", "status"];

    public static function notificationCount()
    {
        $userType = Auth::guard('admin')->user()->user_type;

        if($userType == 1 or $userType == 2) {
            return self::count();
        } elseif($userType == 4) {
            return self::count();
        }
    }
}
