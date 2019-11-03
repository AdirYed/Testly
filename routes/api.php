<?php

use App\Http\Controllers\TestController;
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/questions/random', [TestController::class, 'random']);
