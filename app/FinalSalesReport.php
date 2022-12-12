<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalSalesReport extends Model
{
    protected $table = "final_sales_reports";

    protected $fillable = ['booking_id', 'sd_id', 'booked_by', 'fare', 'discount_amount', 'subtotal', 'vendor_sale', 'operator_charge', 'agent_commission', 'sd_profit', 'gb_profit', 'country', 'payment_method', 'payment_status', 'booking_status', 'status'];
}
