<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('permission.view')) {
            abort(403, 'You are Unauthorized to access this page!');
        }
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }
        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }
        
        $permissions = Permission::latest()->get();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('permission.create')) {
            abort(403, 'You are Unauthorized to create any permission!');
        }
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('permission.create')) {
            abort(403, 'You are Unauthorized to create any permission!');
        }
        $request->validate([
            'name' => ['required', 'unique:permissions'],
            'group_name' => ['required'],
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->group_name = $request->group_name;

        if ($permission->save()) {
            return redirect()->route('permissions.index')->with('success', "The $permission->name has been saved successfully");
        } else {
            return redirect()->route('permissions.index')->with('error', "Unable to create permission");
        }
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('permission.edit')) {
            abort(403, 'You are Unauthorized to edit permission!');
        }
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('permission.edit')) {
            abort(403, 'You are Unauthorized to edit permission!');
        }
        $request->validate([
            'name' => ['required'],
            'group_name' => ['required'],
        ]);

        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->group_name = $request->group_name;

        if ($permission->save()) {
            return redirect()->route('permissions.index')->with('success', "The $permission->name has been updated successfully");
        } else {
            return redirect()->route('permissions.index')->with('error', "Unable to update permission");
        }
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('permission.delete')) {
            abort(403, 'You are Unauthorized to delete permission!');
        }
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', "The $permission->name was deleted successfully");
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Permission::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
