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
            // test
            'started_at' => 'required|date_format:Y-m-d H:i:s',
            'finished_at' => 'required|date_format:Y-m-d H:i:s',
            'driving_license_type_id' => 'required|exists:driving_license_types,id',
            // answers
            'answers' => 'required|array|size:30',
            'answers.*.question_id' => 'required|exists:questions,id',
        ];
    }
}
