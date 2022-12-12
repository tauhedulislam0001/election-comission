<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperatorCharge extends Model
{
    protected $table = 'operator_charges';

    protected $fillable = ['country', 'type', 'amount', 'status'];
}
