<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeekendFare extends Model
{
    protected $table = 'weekend_fares';

    protected $fillable = ['day', 'increase_type', 'car_type', 'car_name', 'inside_city_amount', 'outside_city_amount', 'status', 'trip_type'];
}
