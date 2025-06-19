<?php

namespace Modules\Currencies\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ProductPrices\Models\ProductPrice;

class Currency extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
    ];

    public function prices(): HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }
}
