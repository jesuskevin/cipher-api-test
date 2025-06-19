<?php

namespace Modules\Products\Eloquents\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\ProductPrices\Http\Requests\StoreProductPriceRequest;
use Modules\ProductPrices\Models\ProductPrice;
use Modules\Products\Eloquents\Contracts\ProductServiceInterface;
use Modules\Products\Http\Requests\StoreProductRequest;
use Modules\Products\Http\Requests\UpdateProductRequest;
use Modules\Products\Models\Product;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        private Product $model,
        private ProductPrice $productPriceModel,
    ){}

    public function index(): LengthAwarePaginator
    {
        return $this->model->paginate();
    }

    public function store(StoreProductRequest $request): Product
    {
        $product = $this->model->create([
            ...$request->validated(),
        ]);

        return $product;
    }

    public function show(string $id): Product
    {
        return $this->model->findOrFail($id);
    }

    public function update(UpdateProductRequest $request, string $id): Product
    {
        $product = $this->show($id);
        $product->update($request->validated());
        return $product;
    }

    public function destroy(string $id): array
    {
        $product = $this->show($id);
        $product->delete();
        return [];
    }

    public function prices(string $id): LengthAwarePaginator
    {
        $product = $this->model->findOrFail($id);
        return $product->prices()->paginate();
    }

    public function storePrice(StoreProductPriceRequest $request, string $id): ProductPrice
    {
        $product = $this->model->findOrFail($id);
        $productPrice = $this->productPriceModel->create([
            'product_id' => $product->id,
            ...$request->validated(),
        ]);

        return $productPrice;
    }
}
