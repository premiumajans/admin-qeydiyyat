<?php

namespace Database\Seeders;

use App\Models\SiteLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $az = SiteLanguage::create(['name'=>'Azərbaycan','code' => 'az','icon' => 'backend/images/flags/az.png','status' => 1]);
        $en = SiteLanguage::create(['name'=>'English','code' => 'en','icon' => 'backend/images/flags/en.jpg','status' => 1]);
        $ru = SiteLanguage::create(['name'=>'Русский','code' => 'ru','icon' => 'backend/images/flags/ru.jpg','status' => 1]);
    }
}
