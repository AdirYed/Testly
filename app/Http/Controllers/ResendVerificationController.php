<?php

namespace App\Http\Controllers;

use App\Notifications\VerifyUserNotification;
use App\User;

class ResendVerificationController extends Controller
{
  public function resend() {
    /* @var User $user */
    $user = auth()->user();

    if ($user->email_verified_at) {
      return response()->json(['verified' => true], 422);
    }

    $user->notify(new VerifyUserNotification);
  }
}
