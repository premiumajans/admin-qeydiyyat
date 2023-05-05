<?php

use App\Http\Controllers\Api\PriceCategoryController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\WhyChooseUsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/* Route::middleware('auth:sanctum')->group(function () {
    //
}); */

Route::apiResource('/service',ServiceController::class)->only(['index','show']); 
Route::apiResource('/why-choose-us',WhyChooseUsController::class)->only(['index','show']); 



