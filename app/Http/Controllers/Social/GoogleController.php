<?php

namespace App\Http\Controllers\Social;


use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $g_user = Socialite::driver('google')->user();
        $user = User::where('google_id', $g_user->getId())->first();

        if (!$user) {
            $user = User::updateOrCreate([
                'email' => $g_user->getEmail(),
            ], [
                'name'              => $g_user->getName(),
                //'avatar'            => $g_user->getAvatar(), // Забанен для России QUIC, поэтому лучше отключить
                'google_id'         => $g_user->getId(),
                'password'          => Hash::make(Str::random()),
                'email_verified_at' => Date::now()
            ]);
        }

        Auth::login($user, true);

        return redirect(RouteServiceProvider::HOME);
    }
}
