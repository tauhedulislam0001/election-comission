<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('role.view')) {
            abort(403, 'You are Unauthorized to access this page!');
        }
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }
        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }

        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'You are Unauthorized to create any role!');
        }
        
        $permissions = Permission::all();
        $permissionGroups = AdminUser::getPermissionGroups();
        // dd($permissionGroups);
        return view('admin.roles.create', compact('permissions', 'permissionGroups'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'You are Unauthorized to create any role!');
        }
        $request->validate([
            'name' => ['required', 'unique:roles'],
            'permissions' => ['required'],
        ]);

        $role = Role::create(['name' => $request->name]);

        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
            return redirect()->route('roles.index')->with('success', "The $role->name has been saved successfully");
        } else {
            return redirect()->back()->with('error', 'failed to create role');
        }

        // $role->givePermissionTo($permissions);
    }


    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'You are Unauthorized to to edit any role!');
        }
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permissionGroups = AdminUser::getPermissionGroups();
        return view('admin.roles.edit', compact('role', 'permissions', 'permissionGroups'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdateRolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'You are Unauthorized to create any role!');
        }
        $request->validate([
            'name' => ['required', 'unique:roles,name,' . $id],
            'permissions' => ['required'],
        ]);
        // dd($request->all());

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->update();
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
            return redirect()->route('roles.index')->with('success', "The $role->name has been updated successfully");
        } else {
            return redirect()->back()->with('error', 'failed to update role');
        }
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('role.delete')) {
            abort(403, 'You are Unauthorized to to delete any role!');
        }
        $role = Role::findOrFail($id);
        if ($role->delete()) {
            return redirect()->route('roles.index')->with('success', "The $role->name has been deleted successfully");
        } else {
            return redirect()->route('roles.index')->with('error', "Unable to delete $role->name!");
        }
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Role::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
