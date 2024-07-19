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

class VkontakteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback()
    {
        $v_user = Socialite::driver('vkontakte')->user();
        $user = User::where('vk_id', $v_user->getId())->first();

        if (!$user) {
            $user = User::updateOrCreate([
                'email' => $v_user->getEmail(),
            ], [
                'name'              => $v_user->getName(),
                'avatar'            => $v_user->getAvatar(),
                'google_id'         => $v_user->getId(),
                'password'          => Hash::make(Str::random()),
                'email_verified_at' => Date::now()
            ]);
        }

        Auth::login($user, true);

        return redirect(RouteServiceProvider::HOME);
    }
}
