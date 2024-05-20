<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'total_points' => 'nullable',
            'questions.*'  => [
                'integer',
            ],
            'questions'    => [
                'array',
            ],
        ];
    }
}