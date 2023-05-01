<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Statistics;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountSeeder extends Seeder
{

    public function run()
    {
        $set = [
            ['name' => "customers_count", 'count' => "510"],
            ['name' => "product_count", 'count' => "510"],
            ['name' => "services_count", 'count' => "510"],
            ['name' => "project_count", 'count' => "510"],
        ];
        Statistics::insert($set);
    }
}
