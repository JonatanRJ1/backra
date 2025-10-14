<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth as Controller;

Route::controller(Controller::class)->group(function () {
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
    Route::get('/user', 'user')->middleware('auth:sanctum');
});