<?php

namespace App\Http\Controllers;

use App\UrlToken;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        $linkToken = UrlToken::whereToken($request->token)
            ->whereType(UrlToken::TYPE_VERIFICATION)
            ->firstOrFail();

        $user = UrlToken::whereToken($linkToken->token)->first()->user()->first();

        if ($user->email_verified_at) {
            return redirect('/');
        }

        $unreadNotification = $user->unreadNotifications()->where('data->token', $request->token)->first();

        if ($unreadNotification) {
            $unreadNotification->markAsRead();
        }

        $user->verify();

        return redirect('/login?verified=1');
    }
}
