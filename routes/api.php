<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactInfoController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\StatisticController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/service',ServiceController::class)->only(['index','show']); 
Route::apiResource('/why-choose-us',WhyChooseUsController::class)->only(['index','show']); 
Route::apiResource('/packages',PackageController::class)->only('index'); 
Route::apiResource('/slider',SliderController::class)->only('index'); 
Route::apiResource('/team',TeamController::class)->only('index'); 
Route::apiResource('/partner',PartnerController::class)->only('index'); 
Route::apiResource('/faq',FaqController::class)->only('index'); 
Route::apiResource('/blog',BlogController::class)->only(['index','show']); 
Route::apiResource('/portfolio',PortfolioController::class)->only('index'); 
Route::apiResource('/contact-info',ContactInfoController::class)->only('index'); 
Route::apiResource('/statistic',StatisticController::class)->only('index'); 
Route::get('/domain',[DomainController::class, 'index']); 
Route::post('/contact',[ContactController::class, 'store'])->name('contact.store'); 




