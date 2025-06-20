<?php

namespace Modules\Products\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ProductPrices\Models\ProductPrice;
use Modules\Products\Database\Factories\ProductFactory;

class Product extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency_id',
        'tax_cost',
        'manufacturing_cost',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }
}
