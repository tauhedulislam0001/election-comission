<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarBookDraft extends Model
{
    protected $fillable = [
        'booking_id', 'sd_id', 'created_by', 'car_name', 'pickup_date_time', 'airport_name', 'pickup_area', 'pickup_address', 'division_name', 'district_name', 'thana_name', 'no_of_passenger',
        'fair', 'status', 'passenger_title', 'last_name', 'first_name', 'dob', 'passport_number', 'mobile_number', 'email', 'airlines_name',
        'flight_date', 'flight_time', 'departure_time', 'flight_number', 'departure_country', 'ticket_number', 'relative_name',
        'relative_mobile1', 'relative_mobile2', 'children', 'infants', 'notes', 'payment_status', 'nationality',
        'driver_name', 'driver_mobile', 'driver_nid', 'car_no', 'service_provider', 'relative_name2', 'payment_method', 'coupon_code', 'subtotal', 'discount_amount', 'village_name','updated_by','updated_at'
    ];


    
}
