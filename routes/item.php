<?php

use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;


// item category route
Route::prefix('categories')->controller(ItemCategoryController::class)->group(function () {
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::post('/','store');
    Route::put('/{id}','update');
    Route::delete('/{id}','destroy');
});


// item  route
Route::prefix('items')->controller(ItemController::class)->group(function () {
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::get('/reverse/{code}','reverseCode');
    Route::get('movements/{id}','itemMovement');
    Route::get('inventory/{id}','itemInventory');
    Route::post('/','store');
    Route::put('/{id}','update');
    Route::delete('/{id}','destroy');
});