<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingelTripServiceStatus extends Model
{
    protected $table = 'singel_trip_service_status';
    protected $fillable = ['booking_id', 'assigned_by', 'driver_name', 'driver_mobile', 'driver_nid', 'car_no', 'service_provider', 'status'];
}
