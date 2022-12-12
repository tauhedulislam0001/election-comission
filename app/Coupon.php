<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupons";

    protected $fillable = ['created_by', 'agent_id','coupon_code','coupon_type','duration','amount','country','status'];

    public function agent()
    {
        return $this->belongsTo(AdminUser::class, 'agent_id');
    }
}
