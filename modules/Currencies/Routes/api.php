<?php

use Illuminate\Support\Facades\Route;
use Modules\Currencies\Http\Controllers\CurrencyController;

Route::prefix('api/v1/currencies')->group(function () {
    Route::get('/', [CurrencyController::class, 'index']);
    Route::post('/', [CurrencyController::class, 'store']);
    Route::get('/{id}', [CurrencyController::class, 'show']);
    Route::put('/{id}', [CurrencyController::class, 'update']);
    Route::delete('/{id}', [CurrencyController::class, 'destroy']);
});
