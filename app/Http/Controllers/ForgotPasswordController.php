<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Notifications\ForgotPasswordNotification;
use App\UrlToken;
use App\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function mail(ForgotPasswordRequest $request)
    {
        $validatedRequest = $request->validated();

        $user = User::whereEmail($validatedRequest['email'])->first();

        $user->notify(new ForgotPasswordNotification);
    }

    public function checkToken(Request $request)
    {
        $validatedRequest = $request->validate([
            'token' => [
                'required',
                'exists:url_tokens'
            ],
        ]);

        $urlToken = UrlToken::whereToken($validatedRequest['token'])
            ->whereType(UrlToken::TYPE_FORGOT_PASSWORD)
            ->firstOrFail();

        if (! $urlToken->expires_at || $urlToken->expires_at && strtotime($urlToken->expires_at) - strtotime(now()) < 0) {
            return response()->json(['errors' => 'token'], 422);
        }
    }

    public function update(SetPasswordRequest $request)
    {
        $validatedRequest = $request->validated();

        $urlToken = UrlToken::whereToken($validatedRequest['token'])
            ->whereType(UrlToken::TYPE_FORGOT_PASSWORD)
            ->firstOrFail();

        if (! $urlToken->expires_at || $urlToken->expires_at && strtotime($urlToken->expires_at) - strtotime(now()) < 0) {
            return response()->json(['errors' => 'token'], 422);
        }

        $user = $urlToken->user;

        $urlToken->update([
            'expires_at' => null,
        ]);

        $user->markUnreadNotificationAsRead($validatedRequest['token']);
        $user->resetPassword($validatedRequest['password']);
    }
}
