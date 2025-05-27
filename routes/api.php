<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StorageController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [InventoryController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::patch('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

Route::prefix('storages')->group(function () {
    Route::get('/', [StorageController::class, 'index']);
    Route::post('/', [StorageController::class, 'store']);
    Route::get('/{id}', [StorageController::class, 'show']);
    Route::patch('/{id}', [StorageController::class, 'update']);
    Route::delete('/{id}', [StorageController::class, 'delete']);
});

Route::prefix('inventory')->group(function () {
    Route::post('/movements', [InventoryController::class, 'movement']);
    Route::get('/', [InventoryController::class, 'index']);
    Route::get('/product/{id}', [InventoryController::class, 'showProduct']);
    Route::get('/storage/{id}', [InventoryController::class, 'showStorage']);
});
