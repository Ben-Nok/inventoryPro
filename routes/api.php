<?php

use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Products\StorageController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

Route::prefix('storages')->group(function () {
    Route::get('/', [StorageController::class, 'index']);
    Route::post('/', [StorageController::class, 'store']);
    Route::get('/{id}', [StorageController::class, 'show']);
    Route::put('/{id}', [StorageController::class, 'update']);
    Route::delete('/{id}', [StorageController::class, 'delete']);
});

