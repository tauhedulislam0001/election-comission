<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserLoginLog extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id', 'status'
    ];


    public static function logActivity()
    {
        $user_type = Auth::guard('admin')->user()->user_type;

        if ($user_type == 1 or $user_type == 2) {
            // return UserLoginLog::where('id', '=', Auth::check())->count();
            return UserLoginLog::where('status', '=', 1)->count();
        } elseif ($user_type == 4) {
            return UserLoginLog::where('sd_id', '=', Auth::guard('admin')->user()->id)->count();
        } elseif ($user_type == 5 or $user_type == 6) {
            // return AdminUser::whereIn('user_type',[5,6] )->where('created_by', '=', Auth::guard('admin')->user()->created_by)->count();
        }
    }
}
