<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DrivingLicenseTypeController;
use App\Http\Controllers\DrivingLicenseTypeQuestionController;
use App\Http\Controllers\TestReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'driving-license-types'], static function () {
    Route::get('', [DrivingLicenseTypeController::class, 'index']);

    Route::group(['prefix' => '{driving_license_type}'], static function () {
        Route::get('questions/random', [DrivingLicenseTypeQuestionController::class, 'random']);
    });
});

Route::group(['prefix' => 'auth'], static function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

// Auth routes

Route::group([
    'prefix' => 'test-reports',
    'middleware' => 'auth:api',
], static function () {
    Route::get('', [TestReportController::class, 'index']);
    Route::post('', [TestReportController::class, 'store']);
});
