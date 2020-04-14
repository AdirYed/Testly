<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'token' => [
        'required',
        'exists:url_tokens',
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
      'password.confirmed' => 'הסיסמאות אינן זהות.',
    ];
  }
}
