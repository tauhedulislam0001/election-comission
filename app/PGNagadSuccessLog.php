<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PGNagadSuccessLog extends Model
{
    
    protected $fillable = ['orderId', 'booking_id','paymentRefId', 'amount', 'clientMobileNo', 'orderDateTime', 'issuerPaymentDateTime', 'issuerPaymentRefNo','status','statusCode','cancelIssuerDateTime','cancelIssuerRefNo','serviceType'];
}
