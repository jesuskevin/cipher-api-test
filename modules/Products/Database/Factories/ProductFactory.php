<?php

namespace Modules\Products\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Currencies\Models\Currency;
use Modules\Products\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'description' => $this->faker->text(50),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'currency_id' => Currency::factory(),
            'tax_cost' => $this->faker->randomFloat(2, 0, 100),
            'manufacturing_cost' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}