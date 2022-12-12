<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaSuccessLog extends Model
{
    protected $table = 'visa_success_logs';
    protected $fillable = ['transactionStatus', 'authCode', 'postData', 'transactionReferenceID', 'marchTrackID', 'transactionID', 'transactionAmount', 'ECI', 'cardNumber', 'issuerResponseCode', 'getUdf1', 'getUdf2', 'getUdf3', 'getUdf4', 'getUdf5', 'getUdf6', 'getUdf7', 'getUdf8', 'getUdf9', 'getUdf10', 'getUdf11', 'getUdf12', 'getUdf13', 'getUdf14', 'getUdf15', 'paymentID', 'customerID'];
}
