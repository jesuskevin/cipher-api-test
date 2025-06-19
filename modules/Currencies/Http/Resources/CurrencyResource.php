<?php

namespace Modules\Currencies\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
