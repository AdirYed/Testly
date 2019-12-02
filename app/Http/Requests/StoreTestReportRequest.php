<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestReportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'wrong_answers' => 'required|integer',
            'correct_answers' => 'required|integer',
            'started_at' => 'required|date_format:Y-m-d H:i:s',
            'finished_at' => 'required|date_format:Y-m-d H:i:s',
            'test' => 'required|array',
            'driving_license_type_id' => 'required|exists:driving_license_types,id',
        ];
    }
}
