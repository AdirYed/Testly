<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
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
            ],
            'password' => [
                'required',
                'min:6',
                'max:255',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'אימייל זה אינו קיים במערכת.',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            if ($validator->valid()) {
                $payload = $validator->validated();
                if(auth()->attempt($payload) === false) {
                    $validator->errors()->add('general', 'הפרטים שהזנת שגויים!');
                }
            }
        });
    }
}
