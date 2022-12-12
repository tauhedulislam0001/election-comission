<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $table = 'otps';
    protected $fillable = ["otp", "sender_id", "mode",'resend_it','status'];

}
