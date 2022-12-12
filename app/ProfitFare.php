<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfitFare extends Model
{
    protected $table = 'profit_fares';

    protected $fillable = ['car_type', 'car_name', 'country', 'currency', 'inside_city_amount', 'outside_city_amount', 'amount', 'status'];
}
