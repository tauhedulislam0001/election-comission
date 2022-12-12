<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class BookingFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "car_name" => "required",
            "airport_name" => "required",
            "date" => "required",
            "time" => "required",
            "division_name" => "required",
            "district_name" => "required",
            "thana_name" => "required",
            "first_name" => "required",
            // "last_name" => "required",
            // "dob_dd" => "required",
            // "dob_mm" => "required",
            // "dob_yyyy" => "required",
            // "nationality" => "required",
            // "passport_number" => "required",
            // "mobile_number" => "required",
            // "email" => "required",
            // "airlines_name" => "required",
            // "flight_date" => "required",
            // "flight_time" => "required",
            // "flight_number" => "required",
            // "departure_time" => "required",
            // "ticket_number" => "required",
            // "departure_country" => "required",
            // "relative_name" => "required",
            // "relative_mobile1" => "required",
            // "payment_method" => "required",
            // "fare2" => "required",
        ];
    }
}
