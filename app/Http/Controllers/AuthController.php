<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(RegisterRequest $request)
    {
        $payload = $request->validated();
        $payload['password'] = bcrypt($payload['password']);

        $user = User::create($payload);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function login(LoginRequest $request)
    {
        $payload = $request->validated();

        $token = auth()->attempt($payload);

//        if (auth()->user()->email_verified_at === null) {
//            return response()->json(['error' => 'verification'], 422);
//        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'user' => auth()->user()->only(['first_name', 'last_name', 'email']),
        ]);
    }
}
