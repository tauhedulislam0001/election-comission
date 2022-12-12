<?php

namespace App\Http\Controllers\Api\UpdatePassword;

use App\AdminUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiUpdatePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt_verify', ['except' => ['login']]);
    }

    public function updatePassword(Request $request)
    {
        $old_password = Auth::guard('api')->user()->password;
        $current_password = $request->current_password;
        $new_password = $request->new_password;
        $password_confirmation = $request->confirm_password;

        if (Hash::check($current_password, $old_password)) {
            if ($new_password === $password_confirmation) {
                AdminUser::findOrFail(Auth::id())->update([
                    'password' => Hash::make($new_password)
                ]);
                return response()->json(['200' => 'Password has been changed successfully! login with your new password']);
            } else {
                return response()->json(['404' => "Confirm password doesn't match New password"]);
            }
        } else {
            return response()->json(['404' => 'Current password does not match our record!']);
        }
    }
}
