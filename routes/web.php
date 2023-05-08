<?php

//Backend Controllers
use App\Http\Controllers\Backend\HomeController as BHome;
use App\Http\Controllers\Backend\LanguageController as LChangeLan;
use App\Http\Controllers\Backend\SettingController as BSetting;
use App\Http\Controllers\Backend\SiteLanguageController as BSiteLan;
use App\Http\Controllers\Backend\AdminController as BAdmin;
use App\Http\Controllers\Backend\InformationController as BInformation;
use App\Http\Controllers\Backend\PackageComponentController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\ReportController as BReport;
use App\Http\Controllers\Backend\PermissionController as BPermission;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\StatusController as BStatus;
use App\Http\Controllers\Backend\WhyChooseUsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => 'auth:sanctum', 'backendLanguage'], function () {
    //General
    Route::get('/menu-status/change/{name}', [BStatus::class, 'change'])->name('menuStatus');
    Route::get('/change-language/{lang}', [LChangeLan::class, 'switchLang'])->name('switchLang');
    Route::get('/', [BHome::class, 'index'])->name('index');
    Route::get('/dashboard', [BHome::class, 'index'])->name('dashboard');
    Route::get('/reports', [BReport::class, 'index'])->name('report');
    Route::get('/give-permission', [BPermission::class, 'givePermission'])->name('givePermission');
    Route::get('/give-permission-to-user/{user}', [BPermission::class, 'giveUserPermission'])->name('giveUserPermission');
    Route::post('/give-permission-to-user-update', [BPermission::class, 'giveUserPermissionUpdate'])->name('givePermissionUserUpdate');
    //Statuses
    Route::get('/site-language/{id}/change-status', [BSiteLan::class, 'siteLanStatus'])->name('siteLanStatus');
    Route::get('/packages/{id}/package-choose', [PackageController::class, 'packageChoose'])->name('packages.packageChoose');
    Route::post('/packages/{id}/package-store', [PackageController::class, 'packageStore'])->name('packages.packageStore');
    //Delete
    Route::get('/site-languages/{id}/delete', [BSiteLan::class, 'delSiteLang'])->name('delSiteLang');
    Route::get('/settings/{id}/delete', [BSetting::class, 'delSetting'])->name('delSetting');
    Route::get('/users/{id}/delete', [BAdmin::class, 'delAdmin'])->name('delAdmin');
    Route::get('/report/{id}/delete', [BReport::class, 'delReport'])->name('delReport');
    Route::get('/report/clean-all', [BReport::class, 'cleanAllReport'])->name('cleanAllReport');
    Route::get('/permission/{id}/delete', [BPermission::class, 'delPermission'])->name('delPermission');
    Route::get('/service/{id}/delete', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::get('/why-choose-us/{id}/delete', [WhyChooseUsController::class, 'destroy'])->name('why-choose-us.destroy');
    Route::get('/packages/{id}/delete', [PackageController::class, 'destroy'])->name('packages.destroy');
    Route::get('/package-components/{id}/delete', [PackageComponentController::class, 'destroy'])->name('package-components.destroy');

    Route::resource('/site-languages', BSiteLan::class);
    Route::resource('/settings', BSetting::class);
    Route::resource('/users', BAdmin::class);
    Route::resource('/my-informations', BInformation::class);
    Route::resource('/permissions', BPermission::class);
    Route::resource('/service', ServiceController::class)->except(['destroy','show']);
    Route::resource('/why-choose-us', WhyChooseUsController::class)->except(['destroy','show']);
    Route::resource('/packages', PackageController::class)->except(['destroy','show']);
    Route::resource('/package-components', PackageComponentController::class)->except(['destroy','show']);

    

    Route::get('/clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');
        Artisan::call('config:cache');
        dd("Cache cleared");
    });
});

/*   */
