<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salesReport extends Model
{
    protected $table = 'sales_reports';
    protected $fillable = ['singletrip_booking_id', 'roundtrip_booking_id','multicity_booking_id'
    ,'car_rental_booking_id','sd_id','booked_by','agent_commission','sd_profit','gb_profit','sale_price','currency','country','discount','total_sale_price','total_bd_price','total_cost','status'];

    public function SingleTripBooking() 
    {
        return $this->belongsTo(SingleTripBooking::class, 'singletrip_booking_id', 'id');
    }    
    public function RoundTripBooking() 
    {
        return $this->belongsTo(RoundTripBooking::class, 'roundtrip_booking_id', 'id');
    }
    public function Multicity() 
    {
        return $this->belongsTo(MultiCityTripBooking::class, 'multicity_booking_id', 'id');
    } 
    public function CarRental() 
    {
        return $this->belongsTo(CarRental::class, 'car_rental_booking_id', 'id');
    }
}
