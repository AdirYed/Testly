<?php

use App\Http\Controllers\SpaController;
use App\User;
use Illuminate\Http\Request;

Route::get('/verification/verify/{user}', function (Request $request, User $user) {
    abort_if(! $request->hasValidSignature(), 404);

    if ($user->email_verified_at) {
        return redirect('/');
    }

    foreach ($user->unreadNotifications as $unreadNotification) {
        if ($unreadNotification->data['url'] === $request->fullUrl()){
            $unreadNotification->markAsRead();
        }
    }

    $user->verify();

    return redirect('/login');
})->name('verification.verify');

Route::get('/{any?}', [SpaController::class , 'index'])
    ->where('any', '.*');
