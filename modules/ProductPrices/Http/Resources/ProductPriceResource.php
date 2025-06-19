<?php

namespace Modules\ProductPrices\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPriceResource extends JsonResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
