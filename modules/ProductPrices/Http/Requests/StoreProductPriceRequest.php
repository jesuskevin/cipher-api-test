<?php

namespace Modules\ProductPrices\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'currency_id' => [
                'required',
                'uuid',
                Rule::exists('currencies', 'id'),
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}
