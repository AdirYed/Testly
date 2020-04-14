<?php

namespace App\Http\Controllers;

use App\DrivingLicenseType;

class DrivingLicenseTypeQuestionController extends Controller
{
  public function random(string $drivingLicenseType)
  {
    $drivingLicenseType = DrivingLicenseType::select(['id', 'code', 'name'])
      ->whereCode($drivingLicenseType)
      ->first();

    if (!$drivingLicenseType) {
      return response()->json(['error' => 'driving_license_type'], 422);
    }

    return [
      'driving_license_type' => $drivingLicenseType,
      'questions' => $drivingLicenseType->questions()
        ->random()
        ->get()
        ->append('formatted_image_url'),
    ];
  }
}
