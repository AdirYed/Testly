<?php

namespace App\Http\Controllers;

use App\DrivingLicenseType;
use App\Question;

class DrivingLicenseTypeQuestionController extends Controller
{
    public function random(DrivingLicenseType $drivingLicenseType)
    {
        return [
            'driving_license_type' => $drivingLicenseType->only(['id', 'code', 'name']),
            'questions' => Question::random($drivingLicenseType)
                ->get()
                ->append('formatted_image_url'),
        ];
    }
}
