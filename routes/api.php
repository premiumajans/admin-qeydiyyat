<?php

use App\Http\Controllers\Backend\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/service',ServiceController::class)->except(['store','create']);
