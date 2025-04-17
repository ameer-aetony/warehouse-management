<?php

use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;


// warehouse route
Route::prefix('warehouses')->controller(WarehouseController::class)->group(function () {
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::post('/','store');
    Route::put('/{id}','update');
    Route::delete('/{id}','destroy');
});


