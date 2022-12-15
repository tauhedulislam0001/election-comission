<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    protected $table = "messages";
    protected $fillabel = ["sender", "receiver", "message", "reply", "image_one", "image_two", "image_three", "comments", "updated_by", "flag", "status"];

    protected function newMessage() {
        $user = Auth::guard('admin')->user();

        if($user->user_type == 1 or $user->user_type == 2) {
            return self::where('created_at', Carbon::now())->count();
        } elseif($user->user_type == 3) {
            return self::where('created_at', Carbon::now())->count();
        }
    }

    public function senderUser()
    {
        return $this->belongsTo(AdminUser::class, 'sender_id');
    }

    public function reciverUser()
    {
        return $this->belongsTo(AdminUser::class, 'receiver_id');
    }
}
