<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

  
    public function rules()
    {
        return [
            'name'     => ['required'],
            'email'    => ['required','unique:users',],
            'roles.*'  => ['integer',],
            'roles'    => ['required','array',],
        ];
    }
}