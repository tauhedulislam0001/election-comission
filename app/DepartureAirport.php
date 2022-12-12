<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartureAirport extends Model
{
    protected $table = 'departure_airports';

    protected $fillable = ['name','country', 'status'];
}
