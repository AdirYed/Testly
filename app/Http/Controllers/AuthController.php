<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Notifications\VerifyUserNotification;
use App\User;

class AuthController extends Controller
{
  public function me()
  {
    return $this->respondWithToken(auth()->login(auth()->user()));
  }

  public function register(RegisterRequest $request)
  {
    $payload = $request->validated();
    $payload['password'] = bcrypt($payload['password']);

    $isGuestLoggedIn = auth()->check() && ! auth()->user()->email;

    $user = $isGuestLoggedIn ? auth()->user() : User::create($payload);

    if ($isGuestLoggedIn) {
      $user->update($payload);
    }

    $user->notify(new VerifyUserNotification);
  }

  public function guestRegister()
  {
    return auth()->login(User::create());
  }

  public function login(LoginRequest $request)
  {
    $payload = $request->validated();

    $token = auth()->attempt($payload);

    if (auth()->user()->email_verified_at === null) {
      return response()->json(['error' => 'verification', 'token' => $token], 422);
    }

    return $this->respondWithToken($token);
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'token' => $token,
      'user' => auth()->user()->only(['first_name', 'last_name', 'email']),
    ]);
  }
}
