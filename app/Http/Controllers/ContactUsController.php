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

        Mail::to('adir.yed@gmail.com')->send(new ContactUsMail($validatedRequest));
    }
}
//'support@' . env('MAILGUN_DOMAIN')
