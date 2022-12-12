<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    Protected $table = 'invoices';
    Protected $fillable = ['invoice_no', 'sd_id', 'booking_id', 'credit_note_id', 'amount', 'currency', 'status', 'booking_date'];

    public function booking() 
    {
        return $this->belongsTo(CarBook::class, 'booking_id');
    }

    public function user() 
    {
        return $this->belongsTo(AdminUser::class, 'sd_id');
    }

    public function creditNote() 
    {
        return $this->belongsTo(CreditNote::class, 'credit_note_id');
    }
}

