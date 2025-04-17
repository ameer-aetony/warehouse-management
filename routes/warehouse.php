<?php

use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseTransactionTypeController;
use App\Http\Controllers\WarehouseTransactionController;
use Illuminate\Support\Facades\Route;


// warehouse route
Route::prefix('warehouses')->controller(WarehouseController::class)->group(function () {
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::post('/','store');
    Route::put('/{id}','update');
    Route::delete('/{id}','destroy');
});

// warehouse transaction type route
Route::prefix('warehouse/transaction/types')->controller(WarehouseTransactionTypeController::class)->group(function () {
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::post('/','store');
    Route::put('/{id}','update');
    Route::delete('/{id}','destroy');
});

// warehouse transaction  route
Route::prefix('warehouse/transactions')->controller(WarehouseTransactionController::class)->group(function () {
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::post('/','store');
    Route::delete('/{id}','destroy');
});



