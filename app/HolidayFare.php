<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HolidayFare extends Model
{
    protected $table = 'holiday_fares';

    protected $fillable = ['date', 'event_name', 'increase_type', 'car_type', 'car_name', 'inside_city_amount', 'outside_city_amount', 'trip_type', 'status'];
}
