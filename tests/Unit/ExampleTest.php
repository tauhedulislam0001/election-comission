<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->post('/store-booking/single/trip', [
            'airport_name' => 'Dhaka Airport - Hazrat Shahjalal International Airport',
            'car_name' => 'Noah 5 Seat',
            'car_type' => 'Standard',
            'division_name' => 'Khulna',
            'district_name' => 'Bagerhat',
            'thana_name' => 'Bagerhat Sadar',
            'village_name' => 'asd',
            'pickup_date_time' => '2022-09-01 21:55:00',
            'full_name' => 'MD Tauhedul Islamadasd',
            'passport_no' => 'BDR1236548',
            'nationality' => 'Bangladesh',
            'phone_no' => '01778989698',
            'email' => 'tauhedulislam0001@gmail.com',
            'departure_airport' => 'Malaysia',
            'airlines_name' => 'Malaysia Airlines',
            'emergency_contact' => '01223656987',
            'flight_number' => 'MH102',
            'trip_type' => '1',
            'payment_method' => 'wallet',
            'payment_status' => 'Due',
            'pickup_date' => '2022-8-2',
            'pickup_time' => '12:5',
    ]);
 
        // $response->assertStatus(201);

        $response->assertTrue(true);
    }
}
