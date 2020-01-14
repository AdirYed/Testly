<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Notifications\ForgotPasswordNotification;
use App\User;

class ForgotPasswordController extends Controller
{
    public function mail(ForgotPasswordRequest $request)
    {
        $validatedRequest = $request->validated();

        $user = User::whereEmail($validatedRequest['email'])->first();

        $user->notify(new ForgotPasswordNotification);
    }
}
