<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorUser extends Model
{
    protected $table = 'vendor_users';

    protected $fillable = ['vendor_type', 'fullname', 'email', 'mobile', 'airport_name', 'division_name', 'district_name', 'address', 'status'];

    public function vendor()
    {
        return $this->hasMany(VendorUser::class, 'id');
    }
}
