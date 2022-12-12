<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => "required|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "mobile" => "required|numeric|digits:10|unique:users",
            "password" => "required|min:5",
            "roles.*" => "required",
            "user_type" => "required"
        ];
    }
}