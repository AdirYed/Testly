<?php

namespace App\Http\Controllers;

use App\DrivingLicenseType;

class DrivingLicenseTypeQuestionController extends Controller
{
    public function random(DrivingLicenseType $drivingLicenseType)
    {
        return $drivingLicenseType->questions()
            ->random()
            ->get()
            ->append('formatted_image_url');
    }
}
