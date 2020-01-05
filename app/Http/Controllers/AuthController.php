<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Notifications\VerifyUserNotification;
use App\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $payload = $request->validated();
        $payload['password'] = bcrypt($payload['password']);

        $user = User::create($payload);

        $user->notify(new VerifyUserNotification);
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
