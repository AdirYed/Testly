<?php

namespace App\Http\Controllers;

use App\LinkToken;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        if (LinkToken::where('token', $request->token)->doesntExist()) {
            abort(404);
        }

        $user = LinkToken::where('token', $request->token)->first()->user()->first();

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
