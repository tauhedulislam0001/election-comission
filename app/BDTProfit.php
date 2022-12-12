<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BDTProfit extends Model
{
    protected $table = 'b_d_t_profits';
    protected $fillable = ['trip_type', 'car_type', 'car_name', 'inside_city_amount', 'outside_city_amount', 'status'];


}
