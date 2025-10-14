<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController as Controller;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [Controller::class, 'index']);
    Route::post('/products', [Controller::class, 'store']);
    Route::get('/products/{id}', [Controller::class, 'show']);
});