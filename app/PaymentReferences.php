<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentReferences extends Model
{
    protected $table = 'payment_references';
    protected $fillable = ["agentID", "status", "visibility"];

    public function PaymentReferencesUser()
    {
        return $this->belongsTo(AdminUser::class, 'agentID');
    }
}
