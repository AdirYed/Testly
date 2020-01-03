<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'min:2',
                'max:20',
            ],
            'last_name' => [
                'required',
                'min:2',
                'max:20',
            ],
            'email' => [
                'required',
                'email',
                'unique:users',
                'max:50',
                'email:rfc,dns',
            ],
            'password' => [
                'required',
                'min:6',
                'max:255',
                'confirmed',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'אימייל זה כבר תפוס.',
            'password.confirmed' => 'הסיסמאות אינן זהות.',
        ];
    }
}
