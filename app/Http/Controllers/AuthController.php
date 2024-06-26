<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationExeption;

class AuthController extends Controller 
{
    public function register(){
        return view('register');
    }

    public function save(Request $request){
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required',
                        'unique:users'],
            'password' => 'required|confirmed',

        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'User'
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
}

?>