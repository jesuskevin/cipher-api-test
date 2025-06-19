<?php

namespace Modules\Products\Eloquents\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\ProductPrices\Http\Requests\StoreProductPriceRequest;
use Modules\ProductPrices\Models\ProductPrice;
use Modules\Products\Http\Requests\StoreProductRequest;
use Modules\Products\Http\Requests\UpdateProductRequest;
use Modules\Products\Models\Product;

interface ProductServiceInterface
{
    public function index(): LengthAwarePaginator;
    public function store(StoreProductRequest $request): Product;
    public function show(string $id): Product;
    public function update(UpdateProductRequest $request, string $id): Product;
    public function destroy(string $id): array;
    public function prices(string $id): LengthAwarePaginator;
    public function storePrice(StoreProductPriceRequest $request, string $id): ProductPrice;
    
}
