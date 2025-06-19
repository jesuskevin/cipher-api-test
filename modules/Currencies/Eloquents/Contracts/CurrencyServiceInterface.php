<?php

namespace Modules\Currencies\Eloquents\Contracts;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Currencies\Http\Requests\StoreCurrencyRequest;
use Modules\Currencies\Http\Requests\UpdateCurrencyRequest;
use Modules\Currencies\Models\Currency;

interface CurrencyServiceInterface
{
    public function index(): LengthAwarePaginator;
    public function store(StoreCurrencyRequest $request): Currency;
    public function show(string $id): Currency;
    public function update(UpdateCurrencyRequest $request, string $id): Currency;
    public function destroy(string $id): array;
}
