<?php

use App\Http\Controllers\SpaController;
use App\Http\Controllers\UserVerificationController;

Route::get('verify', [UserVerificationController::class, '__invoke']);

Route::get('/{any?}', [SpaController::class , 'index'])
    ->where('any', '.*');
