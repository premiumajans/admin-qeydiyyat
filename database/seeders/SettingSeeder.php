<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $set = [
            ['name' => "facebook", 'link' => "https://facebook.com/", 'status' => 1],
            ['name' => "linkedin", 'link' => "https://linkedin.com/in/", 'status' => 1],
            ['name' => "instagram", 'link' => "https://instagram.com/", 'status' => 1],
            ['name' => "email", 'link' => "adm@turquoise-az.com", 'status' => 1],
            ['name' => "whatsapp", 'link' => "+99470 224 80 59", 'status' => 1],
            ['name' => "location", 'link' => "TURQUOISE MMC Hökməli qəsəbəsi, Bakı-Şamaxı yolu, 16-cı km", 'status' => 1],
            ['name' => "location_link", 'link' => "https://goo.gl/maps/8FrLi6UffGdMhrMs6", 'status' => 1],
            ['name' => "phone", 'link' => "+99470 224 80 59", 'status' => 1],
            ['name' => "home-phone", 'link' => "+99412 341 03 73 / 74", 'status' => 1],
            ['name' => "services_az", 'link' => "sajdhsakjbf", 'status' => 1],
            ['name' => "services_en", 'link' => "assiudhsak", 'status' => 1],
            ['name' => "projects_az", 'link' => "assiudhsak", 'status' => 1],
            ['name' => "projects_en", 'link' => "assiudhsak", 'status' => 1],
        ];
        Setting::insert($set);
    }
}
