<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(static function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Подтверждение регистрации')
                ->view('mails.registration', compact('url'));
        });

        ResetPassword::toMailUsing(static function ($notifiable, $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $email = $notifiable->getEmailForPasswordReset(),
            ], false));

            $user = User::where('email', $email)->firstOrFail();

            return (new MailMessage)
                ->subject('Сброс пароля')
                ->view('mails.reset', compact('url', 'user'));
        });
    }
}
