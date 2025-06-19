<?php

namespace Modules\Currencies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrencyRequest extends FormRequest
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
            'symbol' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'exchange_rate' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }
}
