<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PGBKashSuccessLog extends Model
{
    protected $table = "p_g_b_kash_success_logs";
    protected $fillable = ['bookingID', 'customerMsisdn', 'amount', 'currency', 'trxID', 'paymentID', 'intent', 'transactionStatus',];
}
