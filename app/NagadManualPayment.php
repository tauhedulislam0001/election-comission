<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NagadManualPayment extends Model
{
    protected $table = "nagad_manual_payments";
    protected $fillable = ["booking_id", "trxID", "amount", "status"];
}
