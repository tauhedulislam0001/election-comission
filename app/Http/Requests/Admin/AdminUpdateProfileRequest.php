<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminUpdateProfileRequest extends FormRequest
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
        // $id = Auth::user()->id;

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required|',
            'mobile_no' => 'required|regex:/^01[3-9]/|digits:11',
            'gender' => 'required',
            'DOB' => 'required',
            'address' => 'required',
            'nationality' => 'required',
            'designation' => 'required',
        ];
    }
}