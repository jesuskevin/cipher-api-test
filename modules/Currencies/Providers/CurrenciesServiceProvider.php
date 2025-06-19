<?php

namespace Modules\Currencies\Providers;

use Illuminate\Support\ServiceProvider;

class CurrenciesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Lang/es.json', 'Currencies');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
