<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BkashRefund extends Model
{
    protected $table = 'bkash_refunds';
    protected $fillable = ["sku", "amount", "trxID", "paymentID", "reason"];
}
