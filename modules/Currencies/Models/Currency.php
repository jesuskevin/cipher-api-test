<?php

namespace Modules\Currencies\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Currencies\Database\Factories\CurrencyFactory;
use Modules\ProductPrices\Models\ProductPrice;

class Currency extends Model
{
    use SoftDeletes, HasUuids, HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return CurrencyFactory::new();
    }

    public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }
}
