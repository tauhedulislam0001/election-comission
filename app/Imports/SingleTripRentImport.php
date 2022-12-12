<?php

namespace App\Imports;

use App\SingleTrip;
use App\VendorFare;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SingleTripRentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new VendorFare([
            'vendor_id'     => $row['vendor_id'],
            'fare_type'     => $row['fare_type'],
            'airport_name'  => $row['airport_name'],
            'division_name' => $row['division_name'],
            'district_name' => $row['district_name'],
            'thana_name'    => $row['thana_name'],
            'sedan_fare'    => $row['sedan_fare'],
            'noah_fare'     => $row['noah_fare'],
            'hiace_fare'    => $row['hiace_fare'],
            'status'        => 1,
        ]);
    }
}
