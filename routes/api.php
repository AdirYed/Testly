<?php

use App\Http\Controllers\DrivingLicenseTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'driving-license-types'], static function () {
    Route::get('licenses', [DrivingLicenseTypeController::class, 'licenses']);

    Route::group(['prefix' => '{driving_license_type}'], static function () {
        Route::get('questions/random', [DrivingLicenseTypeController::class, 'random']);
    });
});
