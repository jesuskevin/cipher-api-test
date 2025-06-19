<?php

namespace Modules\ProductPrices\Providers;

use Illuminate\Support\ServiceProvider;

class ProductPricesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Lang/es.json', 'ProductPrices');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
