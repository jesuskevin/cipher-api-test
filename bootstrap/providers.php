<?php

return [
    App\Providers\AppServiceProvider::class,
    Modules\Authentication\Providers\AuthenticationServiceProvider::class,
    Modules\Accesscontrol\Providers\AccesscontrolServiceProvider::class,
    Modules\Products\Providers\ProductsServiceProvider::class,
    Modules\Currencies\Providers\CurrenciesServiceProvider::class,
    Modules\ProductPrices\Providers\ProductPricesServiceProvider::class,
];
