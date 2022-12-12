<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BkashManualPayment extends Model
{
    protected $table = "bkash_manual_payments";
    protected $fillable = ["booking_id", "trxID", "amount", "status"];
}
