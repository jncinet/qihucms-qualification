<?php

namespace Qihucms\Qualification;

use Illuminate\Support\ServiceProvider;

class QualificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'qualification');

        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/qualification'),
        ]);
    }
}
