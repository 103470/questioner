<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

  
    public function create()
    {
        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

  
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated() + ['password' => bcrypt($request->password)]);
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('admin.users.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

  
    public function edit(User $user)
    {
        $roles = Role::pluck('title', 'id');

        return view('admin.users.edit', compact('user','roles'));
    }

    
    public function update(UpdateUserRequest $request,User $user)
    {
        $user->update($request->validated() + ['password' => bcrypt($request->password)]);
        $user->roles()->sync($request->input('roles'));

        return redirect()->route('admin.users.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

   
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

     
    public function massDestroy(Request $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}