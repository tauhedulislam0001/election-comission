<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorFare extends Model
{
    protected $table = 'vendor_fares';
    protected $fillable = ["vendor_id", "fare_type", "airport_name", "division_name", "district_name", "thana_name", "regular_sedan_fare", "standard_sedan_fare", "premium_sedan_fare", "regular_noah_fare", "standard_noah_fare", "premium_noah_fare", "regular_hiace_fare", "standard_hiace_fare", "premium_hiace_fare", "status", "note"];
    
    public function vendor()
    {
        return $this->belongsTo(VendorUser::class, 'vendor_id');
    }

    public function fareType()
    {
        return $this->belongsTo(VendorUser::class, 'fare_type');
    }
}
