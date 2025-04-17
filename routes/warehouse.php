<?php

use App\Http\Controllers\InTransactionController;
use App\Http\Controllers\OutTransactionController;
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

// in transaction  route
Route::prefix('warehouse/in/transactions')->controller(InTransactionController::class)->group(function () {
    Route::get('/','index');
    Route::delete('/{id}','destroy');
});

// out transaction  route
Route::prefix('warehouse/out/transactions')->controller(OutTransactionController::class)->group(function () {
    Route::get('/','index');
    Route::delete('/{id}','destroy');
});




