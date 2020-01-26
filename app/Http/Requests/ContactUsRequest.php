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
                'email:rfc,dns',
                'max:50',
            ],
            'subject' => [
                'required',
                'min:3',
                'max:50'
            ],
            'content' => [
                'required',
                'min:10',
                'max:500'
            ],
        ];
    }
}
