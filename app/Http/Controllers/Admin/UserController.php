<?php

namespace App\Http\Controllers\Admin;


use App\AdminUser;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        if (is_null($this->user) || !$this->user->can('user.view')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }

        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }

        $adminUsers = AdminUser::whereIn('user_type', [2,3])->latest()->get();
        return view('admin.adminUsers.user.index', compact('adminUsers'));
    }

    public function getCreate()
    {
        if (is_null($this->user) || !$this->user->can('user.create')) {
            abort(403, 'You are Unauthorized to create user!');
        }

        $user_type = Auth::guard('admin')->user()->user_type;
        
        if($user_type == 1) {
            $roles = Role::get();
        } elseif($user_type == 2) {
            $roles = Role::whereIn('id',[2,3])->get();
        }

        return view('admin.adminUsers.user.create', compact('roles'));
    }

    public function postStore(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('user.create')) {
            abort(403, 'You are Unauthorized to create user!');
        }

        $request->validate([
            'username' => 'required|unique:admin_users',
            'email' => 'required|unique:admin_users',
            'mobile' => 'required|unique:admin_users',
            'password' => 'required',
            'can_login' => 'required',
        ]);

        $adminUser = new AdminUser();
        $username = str_replace(' ', '_', $request->username);
        $adminUser->username = $username;
        $adminUser->email = $request->email;
        $adminUser->mobile = $request->mobile;
        $adminUser->password = Hash::make($request->password);
        $adminUser->user_type = 3;
        $adminUser->can_login = $request->can_login;
        $adminUser->status = 1;
        $adminUser->role_id = $request->role_id;
        $adminUser->save();
        
        if ($adminUser->role_id) {
            $adminUser->assignRole($adminUser->role_id);
            return redirect()->route('user.index')->with('success', "The $adminUser->username user has been created successfully");
        } else {
            return redirect()->route('user.index')->with('error', "Unable to create user!");
        }
    }

    public function getEdit($id)
    {
        if (is_null($this->user) || !$this->user->can('user.edit')) {
            abort(403, 'You are Unauthorized to edit user!');
        }

        $user = AdminUser::findOrFail($id);

        $data = $user->roles()->pluck('name');
        $selectedRoles = $data[0] ?? '';

        $user_type = Auth::guard('admin')->user()->user_type;

        if($user_type == 1) {
            $roles = Role::get();
        } elseif($user_type == 2) {
            $roles = Role::whereIn('id',[2,3])->get();
        }

        return view('admin.adminUsers.user.edit', compact('user', 'roles', 'selectedRoles'));
    }

    public function postUpdate(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('user.edit')) {
            abort(403, 'You are Unauthorized to edit user!');
        }

        $adminUser = AdminUser::findOrFail($id);
        $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('admin_users')->ignore($id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admin_users')->ignore($id)],
            'mobile' => ['required', 'numeric', Rule::unique('admin_users')->ignore($id)],
            'can_login' => ['required'],
        ]);

        $username = str_replace(' ', '_', $request->username);
        $adminUser->username = $username;
        $adminUser->email = $request->email;
        $adminUser->mobile = $request->mobile;
        $adminUser->user_type = 3;
        $adminUser->can_login = $request->can_login;
        $adminUser->role_id = $request->role_id;
        $adminUser->roles()->detach();
        $adminUser->save();
        if ($adminUser->role_id) {
            $adminUser->assignRole($adminUser->role_id);
            return redirect()->route('user.index')->with('success', "The $adminUser->username was updated successfully");
        } else {
            return redirect()->route('user.index')->with('error', "Failed to update this $adminUser->username user");
        }
    }

    public function getDestroy($id)
    {
        if (is_null($this->user) || !$this->user->can('user.delete')) {
            abort(403, 'You are Unauthorized to delete user!');
        }

        $user = AdminUser::findOrFail($id);

        if ($user->delete()) {
            return redirect()->route('user.index')->with('success', "The $user->username user has been deleted successfully");
        } else {
            return redirect()->route('user.index')->with('error', "Failed to delete this $user->username user!");
        }
    }

    public function inActive($id)
    {
        if (is_null($this->user) || !$this->user->can('user.edit')) {
            abort(403, 'You are Unauthorized to edit any user!');
        }

        AdminUser::find($id)->update(['can_login' => 0]);
        return redirect()->route('user.index')->with('error', 'User has been disabled!');
    }

    //status active

    public function active($id)
    {
        if (is_null($this->user) || !$this->user->can('user.edit')) {
            abort(403, 'You are Unauthorized to edit any user!');
        }

        AdminUser::find($id)->update(['can_login' => 1]);
        return redirect()->route('user.index')->with('success', 'User has been enabled!');
    }
}
