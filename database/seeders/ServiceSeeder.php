<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $services = [
            [
                'icon'=>'flaticon-security'
            ],
            [
                'icon'=>'flaticon-coding'
            ],
            [
                'icon'=>'flaticon-smart-contracts'
            ],
        ];

        /* foreach(config('languages') as $lang=>$langs){
            $serviceTranslations = [];
            foreach ($services as $service) {
                $serviceTranslations[] = [
                    'service_id'=> 1,
                    'title'=>'Lorem ipsum_'.$lang,
                    'content'=>'Lorem ipsum_'.$lang,
                    'alt'=>'Lorem ipsum_'.$lang,
                    'locale'=>$lang
                ];
            }
            ServiceTranslation::insert($serviceTranslations);
        } */
        
       /*  foreach(config('languages') as $lang=>$langs){
            $serviceTranslations = [
                [
                    'service_id'=>1,
                    'title'=>'Lorem ipsum_'.$lang,
                    'content'=>'Lorem ipsum_'.$lang,
                    'alt'=>'Lorem ipsum_'.$lang,
                    'locale'=>$lang
                ],
                [
                    'service_id'=>2,
                    'title'=>'Lorem ipsum_'.$lang,
                    'content'=>'Lorem ipsum_'.$lang,
                    'alt'=>'Lorem ipsum_'.$lang,
                    'locale'=>$lang
                ],
                [
                    'service_id'=>3,
                    'title'=>'Lorem ipsum_$lang',
                    'content'=>'Lorem ipsum_$lang',
                    'alt'=>'Lorem ipsum_$lang',
                    'locale'=>$lang
                ],
            ];
        } */
        $serviceTranslations = [
            [
                'service_id'=>1,
                'title'=>'Lorem ipsum_az',
                'content'=>'Lorem ipsum_az',
                'alt'=>'Lorem ipsum_az',
                'locale'=>'az'
            ],
            [
                'service_id'=>1,
                'title'=>'Lorem ipsum_en',
                'content'=>'Lorem ipsum_en',
                'alt'=>'Lorem ipsum_en',
                'locale'=>'en'
            ],
            [
                'service_id'=>1,
                'title'=>'Lorem ipsum_ru',
                'content'=>'Lorem ipsum_ru',
                'alt'=>'Lorem ipsum_ru',
                'locale'=>'ru'
            ],
            [
                'service_id'=>2,
                'title'=>'Lorem ipsum_az',
                'content'=>'Lorem ipsum_az',
                'alt'=>'Lorem ipsum_az',
                'locale'=>'az'
            ],
            [
                'service_id'=>2,
                'title'=>'Lorem ipsum_en',
                'content'=>'Lorem ipsum_en',
                'alt'=>'Lorem ipsum_en',
                'locale'=>'en'
            ],
            [
                'service_id'=>2,
                'title'=>'Lorem ipsum_ru',
                'content'=>'Lorem ipsum_ru',
                'alt'=>'Lorem ipsum_ru',
                'locale'=>'ru'
            ],
            [
                'service_id'=>3,
                'title'=>'Lorem ipsum_az',
                'content'=>'Lorem ipsum_az',
                'alt'=>'Lorem ipsum_az',
                'locale'=>'az'
            ],
            [
                'service_id'=>3,
                'title'=>'Lorem ipsum_en',
                'content'=>'Lorem ipsum_en',
                'alt'=>'Lorem ipsum_en',
                'locale'=>'en'
            ],
            [
                'service_id'=>3,
                'title'=>'Lorem ipsum_ru',
                'content'=>'Lorem ipsum_ru',
                'alt'=>'Lorem ipsum_ru',
                'locale'=>'ru'
            ],
        ];
    
        foreach ($services as $service) {
            Service::create($service);
        }

        foreach ($serviceTranslations as $trans) {
            ServiceTranslation::create($trans);
        }
    }
}
