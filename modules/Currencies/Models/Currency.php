<?php

namespace Modules\Currencies\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
    ];
}
