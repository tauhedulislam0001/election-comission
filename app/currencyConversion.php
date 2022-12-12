<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currencyConversion extends Model
{
    protected $table = "currency_conversions";
    protected $fillable = ['currency_name','conversion_rate', 'status'];
}
