<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function contact(ContactUsRequest $request)
    {
        $validatedRequest = $request->validated();

        Mail::send(new ContactUsMail($validatedRequest));
    }
}
