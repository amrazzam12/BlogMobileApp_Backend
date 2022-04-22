<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:20',
            'email' => ['required' , 'email' , Rule::unique('users' , 'email')],
            'password' => ['required' ,'min:8' , 'confirmed']
        ];
    }


    public function messages()
    {
        return [
            'email.email' => 'Email Must Be Correct',
            'password.confirmed' => 'Password Must Match'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'Status'   => 'Failed',
            'Errors'      => $validator->errors()
        ]));

    }
}
