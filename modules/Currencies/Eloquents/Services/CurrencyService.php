<?php

namespace Modules\Currencies\Eloquents\Services;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Currencies\Eloquents\Contracts\CurrencyServiceInterface;
use Modules\Currencies\Http\Requests\StoreCurrencyRequest;
use Modules\Currencies\Http\Requests\UpdateCurrencyRequest;
use Modules\Currencies\Models\Currency;

class CurrencyService implements CurrencyServiceInterface
{
    public function __construct(
        private Currency $model,
    ) {}

    public function index(): LengthAwarePaginator
    {
        return $this->model->paginate();
    }

    public function store(StoreCurrencyRequest $request): Currency
    {
        $currency = $this->model->create([
            ...$request->validated(),
        ]);

        return $currency;
    }

    public function show(string $id): Currency
    {
        return $this->model->findOrFail($id);
    }

    public function update(UpdateCurrencyRequest $request, string $id): Currency
    {
        $currency = $this->show($id);
        $currency->update($request->validated());
        return $currency;
    }

    public function destroy(string $id): array
    {
        $currency = $this->show($id);
        $currency->delete();
        return [];
    }
}
