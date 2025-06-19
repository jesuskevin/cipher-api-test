<?php

namespace Modules\ProductPrices\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = [
        'product_id',
        'currency_id',
        'price',
    ];
}
