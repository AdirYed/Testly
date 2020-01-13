<?php

namespace App\Http\Controllers;

use App\DrivingLicenseType;
use App\Question;

class DrivingLicenseTypeQuestionController extends Controller
{
    public function random(string $drivingLicenseType)
    {
        $drivingLicenseType = DrivingLicenseType::whereCode($drivingLicenseType)->first();

        if (! $drivingLicenseType) {
            return response()->json(['error' => 'driving_license_type'], 422);
        }

        return [
            'driving_license_type' => $drivingLicenseType->only(['id', 'code', 'name']),
            'questions' => $drivingLicenseType->questions()
                ->random()
                ->get()
                ->append('formatted_image_url'),
        ];
    }
}
