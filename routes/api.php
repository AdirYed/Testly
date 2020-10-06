<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\DrivingLicenseTypeController;
use App\Http\Controllers\DrivingLicenseTypeQuestionController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResendVerificationController;
use App\Http\Controllers\TestReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'driving-license-types'], static function () {
  Route::get('', [DrivingLicenseTypeController::class, 'index']);

  Route::group(['prefix' => '{driving_license_type}'], static function () {
    Route::get('questions/random', [DrivingLicenseTypeQuestionController::class, 'random']);
  });
});

Route::group(['prefix' => 'auth'], static function () {
  Route::get('', [AuthController::class, 'auth'])->middleware('auth:api');
  Route::post('register', [AuthController::class, 'register']);
  Route::post('lead', [AuthController::class, 'registerLead']);
  Route::post('login', [AuthController::class, 'login']);
});

// Auth routes

Route::group([
  'prefix' => 'test-reports',
  'middleware' => 'auth:api',
], static function () {
  Route::get('', [TestReportController::class, 'index']);
  Route::get('/{uuid}', [TestReportController::class, 'preview']);
  Route::post('', [TestReportController::class, 'store']);
});

Route::get('categories', [CategoryTypeController::class, 'index']);

Route::post('resend-verification', [ResendVerificationController::class, 'resend']);

Route::group(['prefix' => 'forgot-password'], static function () {
  Route::post('', [ForgotPasswordController::class, 'mail']);
  Route::post('check-token', [ForgotPasswordController::class, 'checkToken']);
  Route::post('reset', [ForgotPasswordController::class, 'update']);
});
