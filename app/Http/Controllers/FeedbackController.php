<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name'    => ['required', 'string'],
            'email'   => ['required', 'string', 'email'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string'],
        ]);

        Mail::to(config('mail.admin_email_address'))->send(new FeedbackMail($request));

        return response()->json(['response' => 'ok', 'message' => 'Сообщение отправлено успешно!']);
    }
}
