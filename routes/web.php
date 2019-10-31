<?php

use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('app');
});

Route::get('/tests/finish', function () {
    return view('app');
});
