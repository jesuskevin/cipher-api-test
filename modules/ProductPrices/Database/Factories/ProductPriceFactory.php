<?php

namespace Modules\ProductPrices\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Currencies\Models\Currency;
use Modules\ProductPrices\Models\ProductPrice;
use Modules\Products\Models\Product;

class ProductPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = ProductPrice::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'currency_id' => Currency::factory(),
            'price' => $this->faker->randomFloat(2,0,100),
        ];
    }
}