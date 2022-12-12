<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SDProfit extends Model
{
    protected $table = 'sd_profits';
    protected $fillable = ['sd_id', 'car_type', 'car_name', 'agent_type', 'inside_city', 'outside_city', 'status'];

    public function SoleDistributor() 
    {
        return $this->belongsTo(AdminUser::class, 'sd_id');
    }
}
