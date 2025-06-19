<?php

namespace Modules\Products\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\ProductPrices\Eloquents\Contracts\ProductPriceServiceInterface;
use Modules\ProductPrices\Eloquents\Services\ProductPriceService;

class ProductsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Lang/es.json', 'Products');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(ProductPriceServiceInterface::class, ProductPriceService::class);
    }
}
