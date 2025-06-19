<?php

namespace Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'currency_id' => [
                'required',
                'uuid',
                Rule::exists('currencies', 'id'),
            ],
            'tax_cost' => [
                'required',
                'numeric',
                'min:0',
            ],
            'manufacturing_cost' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}
