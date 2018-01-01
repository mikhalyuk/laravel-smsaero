<?php

namespace Mikhalyuk\SmsAero;

use Illuminate\Support\ServiceProvider;

class SmsAeroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/smsaero.php' => config_path('smsaero.php')
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/smsaero.php', 'smsaero');
    }
}
