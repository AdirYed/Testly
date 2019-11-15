<?php

namespace App\Http\Controllers;

use App\DrivingLicenseType;

class DrivingLicenseTypeController extends Controller
{
    public function random(DrivingLicenseType $drivingLicenseType)
    {
        return [
            'driving_license_type' => $drivingLicenseType->only(['code', 'name']),
            'questions' => $drivingLicenseType->questions()
                ->random()
                ->get()
                ->append('formatted_image_url'),
        ];
    }

    public function licenses()
    {
        return DrivingLicenseType::select(['code', 'name'])->get();
    }
}
