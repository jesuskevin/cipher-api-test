<?php

namespace Modules\ProductPrices\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Currencies\Http\Resources\CurrencyResource;
use Modules\Products\Http\Resources\ProductResource;

class ProductPriceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'product' => new ProductResource($this->product),
            'currency' => new CurrencyResource($this->currency),
            'price' => $this->price,
        ];
    }
}
