<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('nl2br', static function ($string) {
            return "<?php echo _br(e($string)); ?>";
        });
        Blade::directive('currencyIcon', static function () {
            return "<?php echo '<em class=\"icon ni ni-' . config('settings.currency_icon') .'\"></em>'; ?>";
        });
    }
}
