<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
                'max:50',
                'email:rfc,dns',
            ],
            'subject' => [
                'required',
                'min:3',
                'max:50'
            ],
            'description' => [
                'required',
                'min:10',
                'max:500'
            ],
        ];
    }
}
