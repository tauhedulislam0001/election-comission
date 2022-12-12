<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionProfitsActivity extends Model
{
    protected $table = "commission_profits_activities";

    protected $fillable = ['booking_id', 'agent_id','sd_id','agent_commission','sd_profit','status', 'updated_by'];

    public function singleTripBookingCommission()
    {
        return $this->hasMany(SingleTripBooking::class);
    }
}
