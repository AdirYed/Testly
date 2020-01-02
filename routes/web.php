<?php

use App\Http\Controllers\SpaController;

Route::get('verify', 'UserVerificationController');

Route::get('/{any?}', [SpaController::class , 'index'])
    ->where('any', '.*');
