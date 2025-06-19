<?php

namespace Modules\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\ProductPrices\Http\Requests\StoreProductPriceRequest;
use Modules\ProductPrices\Http\Resources\ProductPriceResource;
use Modules\Products\Eloquents\Services\ProductService;
use Modules\Products\Http\Requests\StoreProductRequest;
use Modules\Products\Http\Requests\UpdateProductRequest;
use Modules\Products\Http\Resources\ProductResource;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    public function __construct(
        private ProductService $productService,
    ){}

    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection($this->productService->index());
    }

    public function store(StoreProductRequest $request): ProductResource
    {
        try {
            return new ProductResource($this->productService->store($request));
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['message' => 'Somenthing went wrong. Please try again later or contact support if problem persist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $id)
    {
        return new ProductResource($this->productService->show($id));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            return new ProductResource($this->productService->update($request, $id));
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['message' => 'Somenthing went wrong. Please try again later or contact support if problem persist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->destroy($id);
            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['message' => 'Somenthing went wrong. Please try again later or contact support if problem persist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function prices(string $id)
    {
        try {
           return ProductPriceResource::collection($this->productService->prices($id));
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['message' => 'Somenthing went wrong. Please try again later or contact support if problem persist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function storePrice(StoreProductPriceRequest $request, $id)
    {
        try {
           return new ProductPriceResource($this->productService->storePrice($request, $id));
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['message' => 'Somenthing went wrong. Please try again later or contact support if problem persist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
