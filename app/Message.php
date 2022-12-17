<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    protected $table = "messages";
    protected $fillable = ["sender_id", "reply_id", "subject", "message", "reply", "image_one", "image_two", "image_three", "comments", "updated_by", "flag", "status"];

    protected function newMessage() {
        $user = Auth::guard('admin')->user();

        if($user->user_type == 1 or $user->user_type == 2) {
            return self::whereDate('created_at', Carbon::today())->count();
        } elseif($user->user_type == 3) {
            return self::whereDate('status', 1)->where('created_at', Carbon::today())->count();
        }
    }

    protected function totalMessage() {
        $user = Auth::guard('admin')->user();

        if($user->user_type == 1 or $user->user_type == 2) {
            return self::count();
        } elseif($user->user_type == 3) {
            return self::where('status', 1)->count();
        }
    }

    public function senderUser()
    {
        return $this->belongsTo(AdminUser::class, 'sender_id');
    }
}
