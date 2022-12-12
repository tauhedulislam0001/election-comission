<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BkashRefundErrorLog extends Model
{
    protected $table = 'bkash_refund_error_logs';
    protected $fillable = ['refund_error_log'];
}
