<?php

namespace Modules\Currencies\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'symbol' => $this->symbol,
            'exchange_rate' => $this->exchange_rate,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at,
        ];
    }
}
