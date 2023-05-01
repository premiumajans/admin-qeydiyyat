<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SiteLanguage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $currentLanguage = SiteLanguage::where('code', app()->getLocale())->first();
        $languages = SiteLanguage::where('status', 1)->orderBy('id', 'desc')->get();
        view()->share([
            'languages' => $languages,
            'currentLanguage' => $currentLanguage,
            'locale' => app()->getLocale(),
        ]);
    }
}
