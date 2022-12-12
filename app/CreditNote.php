<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model
{
    Protected $table = 'credit_notes';
    Protected $fillable = ['credit_no', 'sd_id', 'currency', 'amount', 'due_amount', 'status'];

    public function User()
    {
        return $this->belongsTo(AdminUser::class, 'sd_id');
    }
}

