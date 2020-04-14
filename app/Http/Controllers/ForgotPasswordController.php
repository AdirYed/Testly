<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckTokenController;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Notifications\ForgotPasswordNotification;
use App\UrlToken;
use App\User;

class ForgotPasswordController extends Controller
{
  public function mail(ForgotPasswordRequest $request)
  {
    $validatedRequest = $request->validated();

    $user = User::whereEmail($validatedRequest['email'])->first();

    $user->notify(new ForgotPasswordNotification);
  }

  public function checkToken(CheckTokenController $request)
  {
    $validatedRequest = $request->validated();

    $urlToken = UrlToken::whereToken($validatedRequest['token'])
      ->whereType(UrlToken::TYPE_FORGOT_PASSWORD)
      ->firstOrFail();

    if (!$urlToken->expires_at || $urlToken->expires_at && $urlToken->expires_at->isPast()) {
      return response()->json(['errors' => 'token'], 422);
    }
  }

  public function update(SetPasswordRequest $request)
  {
    $validatedRequest = $request->validated();

    $urlToken = UrlToken::whereToken($validatedRequest['token'])
      ->whereType(UrlToken::TYPE_FORGOT_PASSWORD)
      ->firstOrFail();

    if (!$urlToken->expires_at || $urlToken->expires_at && $urlToken->expires_at->isPast()) {
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
