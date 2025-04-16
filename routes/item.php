<?php

use App\Http\Controllers\ItemCategoryController;
use Illuminate\Support\Facades\Route;

// item category route
Route::prefix('categories')->controller(ItemCategoryController::class)->group(function () {
    Route::get('/','index');
    Route::get('/{id}','show');
    Route::post('/','store');
    Route::put('/{id}','update');
    Route::delete('/{id}','destroy');
});