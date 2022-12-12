<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncreaseDecreaseFare extends Model
{
    protected $table = 'increase_decrease_fares';

    protected $fillable = ['action_type', 'trip_type', 'amount_type', 'amount', 'status'];
}
