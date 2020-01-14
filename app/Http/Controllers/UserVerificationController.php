<?php

namespace App\Http\Controllers;

use App\UrlToken;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        $urlToken = UrlToken::whereToken($request->token)
            ->whereType(UrlToken::TYPE_VERIFICATION)
            ->firstOrFail();

        $user = $urlToken->user;

        if ($user->email_verified_at) {
            return response()->view('app');
        }

        $user->markUnreadNotificationAsRead($request->token);
        $user->markEmailAsVerified();

        return redirect('/login?verified=1');
    }
}
