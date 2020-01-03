<?php

namespace App\Http\Controllers;

use App\UrlToken;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        if (UrlToken::whereToken($request->token)->doesntExist()) {
            abort(404);
        }

        $user = UrlToken::whereToken($request->token)->first()->user()->first();

        if ($user->email_verified_at) {
            return redirect('/');
        }

        foreach ($user->unreadNotifications as $unreadNotification) {
            if ($unreadNotification->data['token'] === $request->token){
                $unreadNotification->markAsRead();
                break;
            }
        }

        $user->verify();

        return redirect('/login');
    }
}
