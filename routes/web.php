<?php

use App\Http\Controllers\SpaController;

Route::get('/{any?}', [SpaController::class , 'index'])
    ->where('any', '.*');
