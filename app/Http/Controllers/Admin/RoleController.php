<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;

class RoleController extends Controller
{
   
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

   
    public function create()
    {
        $permissions = Permission::pluck('title', 'id');

        return view('admin.roles.create', compact('permissions'));
    }

   
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());
        $role->permissions()->sync($request->input('permissions'));

        return redirect()->route('admin.roles.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);  
    }

   
    public function edit(Role $role)
    {
        $permissions = Permission::pluck('title', 'id');

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

   
    public function update(UpdateRoleRequest $request,Role $role)
    {
        $role->update($request->validated());
        $role->permissions()->sync($request->input('permissions'));

        return redirect()->route('admin.roles.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

   
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.roles.index')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy(Request $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}