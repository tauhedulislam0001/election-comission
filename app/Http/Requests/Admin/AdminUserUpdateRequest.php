<?php

namespace App\Http\Requests\Admin;

use App\AdminUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUserUpdateRequest extends FormRequest
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

        $user = AdminUser::findOrFail($id);

        if ($user->user_type == 1 or $user->user_type == 2) {
            return [
                "username" => "required|string|max:255",
                "email" => ['required' | 'string', 'email', 'max:255', 'ignore' . $id],
                'mobile' => ['required', 'numeric', 'digits:10', Rule::unique('users')->ignore($id)],
                // 'password' => ['sometimes', 'nullable', 'min:5'],
                'user_type' => ['required'],
                'can_login' => ['required'],
                'role_id' => ['required']
            ];
        } else {
            return [
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
                'mobile' => ['required', 'numeric', 'digits:10', Rule::unique('users')->ignore($id)],
                // 'password' => ['sometimes', 'nullable', 'min:5'],
                'role_id' => ['required'],
            ];
        }
    }
}