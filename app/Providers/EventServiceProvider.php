<?php

namespace App\Providers;

use App\Models\Photo;
use App\Models\Review;
use App\Models\Product;
use App\Observers\PhotoObserver;
use App\Observers\ReviewObserver;
use App\Observers\ProductObserver;
use Illuminate\Auth\Events\Registered;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\VKontakte\VKontakteExtendSocialite;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     */
    protected $listen = [
        Registered::class         => [
            SendEmailVerificationNotification::class,
        ],
        SocialiteWasCalled::class => [
            VKontakteExtendSocialite::class . '@handle',
        ],
    ];

    /**
     * Observers
     *
     * @var array
     */
    protected $observers = [
        Review::class  => [ReviewObserver::class],
        Product::class => [ProductObserver::class],
        Photo::class   => [PhotoObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
