<?php

namespace Modules\Currencies\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Currencies\Eloquents\Services\CurrencyService;
use Modules\Currencies\Http\Requests\StoreCurrencyRequest;
use Modules\Currencies\Http\Requests\UpdateCurrencyRequest;
use Modules\Currencies\Http\Resources\CurrencyResource;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends Controller
{
    public function __construct(
        private CurrencyService $currencyService,
    ){}

    public function index(): AnonymousResourceCollection
    {
        return CurrencyResource::collection($this->currencyService->index());
    }

    public function store(StoreCurrencyRequest $request): CurrencyResource
    {
        try {
            return new CurrencyResource($this->currencyService->store($request));
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['message' => 'Somenthing went wrong. Please try again later or contact support if problem persist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $id)
    {
        return new CurrencyResource($this->currencyService->show($id));
    }

    public function update(UpdateCurrencyRequest $request, $id)
    {
        try {
            return new CurrencyResource($this->currencyService->update($request, $id));
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['message' => 'Somenthing went wrong. Please try again later or contact support if problem persist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $this->currencyService->destroy($id);
            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['message' => 'Somenthing went wrong. Please try again later or contact support if problem persist.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
