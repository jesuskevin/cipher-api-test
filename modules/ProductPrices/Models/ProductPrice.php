<?php

namespace Modules\ProductPrices\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Currencies\Models\Currency;
use Modules\ProductPrices\Database\Factories\ProductPriceFactory;
use Modules\Products\Models\Product;


class ProductPrice extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'product_id',
        'currency_id',
        'price',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return ProductPriceFactory::new();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
