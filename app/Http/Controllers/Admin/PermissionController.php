<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;

class PermissionController extends Controller
{
   
    public function index()
    {      
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        $permissions = Permission::get();

        return view('admin.permissions.index', compact('permissions'));
    }

    
    public function create()
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.create');
    }

    
    public function store(StorePermissionRequest $request)
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Permission::create($request->validated());

        return redirect()->route('admin.permissions.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    
    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.permissions.edit', compact('permission'));
    }

    
    public function update(UpdatePermissionRequest $request,Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->update($request->validated());

        return redirect()->route('admin.permissions.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

   
    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $permission->delete();

        return redirect()->route('admin.permissions.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'danger'
        ]);
    }

     
    public function massDestroy(Request $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}