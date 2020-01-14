<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'exists:users',
                'max:50',
                'email:rfc,dns',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'אימייל זה אינו קיים במערכת.',
        ];
    }
}
