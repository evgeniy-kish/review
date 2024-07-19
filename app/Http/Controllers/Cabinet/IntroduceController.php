<?php

namespace App\Http\Controllers\Cabinet;

use App\Mail\IntroduceMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class IntroduceController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email'   => ['required', 'string', 'email'],
            'message' => ['required', 'string']
        ]);

        Mail::to(config('mail.admin_email_address'))->send(new IntroduceMail($request));

        session()->flash('flash', ['message' => 'Запрос на представительство отправлен']);

        return response()->json(['redirect' => route('cabinet.products.index')]);
    }
}