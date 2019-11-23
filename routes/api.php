<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DrivingLicenseTypeController;
use App\Http\Controllers\DrivingLicenseTypeQuestionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'driving-license-types'], static function () {
    Route::get('', [DrivingLicenseTypeController::class, 'index']);

    Route::group(['prefix' => '{driving_license_type}'], static function () {
        Route::get('questions/random', [DrivingLicenseTypeQuestionController::class, 'random']);
    });
});

Route::group([
    'prefix' => 'auth',
], static function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
});



/**
 * finished_tests
 *
 * user_id
 * wrong_answers
 * correct_answers
 * started_at
 * finished_at
 * driving_license_type_id
 * questions - json
 *
 */
