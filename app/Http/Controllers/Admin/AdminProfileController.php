<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUpdateProfileRequest;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Http\Requests\Admin\ProfilePictureRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class AdminProfileController extends Controller
{

    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function getIndex()
    {
        if (is_null($this->user) || !$this->user->can('round_trip_booking_list.view')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }
        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }
        return view('admin_profile.index');
    }

    public function getEditPassword()
    {
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }
        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }
        return view('admin_profile.change_password');
    }

    public function postUpdatePassword(ChangePasswordRequest $request)
    {
        $old_password = Auth::guard('admin')->user()->password;
        $current_password = $request->current_password;
        $new_password = $request->new_password;
        $password_confirmation = $request->password_confirmation;

        if (Hash::check($current_password, $old_password)) {
            if ($new_password === $password_confirmation) {
                AdminUser::findOrFail(Auth::id())->update([
                    'password' => Hash::make($new_password)
                ]);
                Auth::logout();
                return redirect()->route('admin.change-password')->with('success', 'Password has been changed successfully! login with your new password');
            } else {
                return redirect()->route('admin.change-password')->with('error', 'New password and Confirm password are not same!');
            }
        } else {
            return redirect()->route('admin.change-password')->with('error', 'Current password does not match our record!');
        }
    }

    public function postUpdateProfile(Request $request)
    {
        $updateProfile = AdminUser::where('id', Auth::user()->id)->first();
        $updateProfile->first_name = $request->first_name;
        $updateProfile->last_name = $request->last_name;
        $updateProfile->designation = $request->designation;
        $updateProfile->dd = $request->dd;
        $updateProfile->mm = $request->mm;
        $updateProfile->yy = $request->yy;
        $updateProfile->gender = $request->gender;
        $updateProfile->nationality = $request->nationality;
        $updateProfile->country = $request->country;
        $updateProfile->company_name = $request->company_name;
        $updateProfile->mobile = $request->mobile;
        $updateProfile->address = $request->address;
        $updateProfile->location = $request->location;
        // dd($request->all());
        if ($updateProfile->save()) {
            return redirect()->route('admin.profile')->with('success', 'Admin profile has been updated successfully');
        } else {
            return redirect()->route('admin.update-profile')->with('error', 'Failed to update your profile!');
        }
    }

    protected function deleteOldImage()
    {
        if (Auth::guard('admin')->user()->avatar) {

            $deleteImage = public_path() . 'dashboard/admin/images/profile_pic/' . Auth::guard('admin')->user()->avatar;
            return File::delete($deleteImage);
        }
    }

    public function postUpdateProfilePicture(ProfilePictureRequest $request)
    {
        $profile_id = Auth::user()->id;
        $old_profile_pic = Auth::guard('admin')->user()->avatar;

        if ($request->hasFile('avatar')) {
            if (file_exists($old_profile_pic)) {
                unlink($old_profile_pic);
            }
            $profile_pic = $request->file('avatar');
            $name_gen = 'avatar' . '_' . Auth::user()->username .  time() . '.' . $profile_pic->getClientOriginalExtension();
            Image::make($profile_pic)->resize(300, 300)->save('dashboard/admin/images/profile_pic/' . $name_gen);
            $profile_pic_url = 'dashboard/admin/images/profile_pic/' . $name_gen;

            $updateProfilePic = AdminUser::where('id', $profile_id)->first();
            $updateProfilePic->avatar = $profile_pic_url;
            $updateProfilePic->save();
        } else {
            return redirect()->route('admin.profile')->with('error', 'Failed to upload profile pic!');
        }
        return redirect()->route('admin.profile')->with('success', 'Profile pic has been uploaded successfully!');
    }

    public function getRemovePicture()
    {
        // print 'ok';
        $profilePictureID = Auth::user()->id;
        $removeProfilePicture = Auth::user()->avatar;
        // dd($removeProfilePicture);
        if (file_exists($removeProfilePicture)) {
            unlink($removeProfilePicture);
            $image = AdminUser::where('id', $profilePictureID)->first();
            $file = $image->avatar;
            $filename = public_path() . 'dashboard/admin/images/profile_pic/' . $image;
            if (File::delete($filename)) {
                return redirect()->route('admin.profile')->with('success', 'Profile picture has been removed successfully!');
            } else {
                return redirect()->route('admin.profile')->with('error', 'Failed to removed profile image!');
            }
        } else {
            return redirect()->route('admin.profile')->with('error', "You didn't upload profile picture!");
        }
    }

    public function agentInfoUpdate() {
        return view('agent.agent_info');
    }
}
