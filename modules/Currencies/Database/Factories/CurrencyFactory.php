<?php

namespace Modules\Currencies\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Currencies\Models\Currency;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Currency::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'symbol' => '$',
            'exchange_rate' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}