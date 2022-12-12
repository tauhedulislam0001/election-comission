<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PGCurrencyConversion extends Model
{
    protected $table = "p_g_currency_conversions";
    protected $fillable = ['base_currency', 'converted_currency', 'conversion_rate', 'status'];
}
