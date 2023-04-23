<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
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
        $config = cache()->get('config');
        if ($config) {
            config(['app.name' => $config->title ?? env('APP_NAME')]);
            config(['app.locale' => $config->locale ?? 'en']);
            if (!session('locale')) {
                app()->setLocale(config('app.locale'));
            }
        }
    }
}
