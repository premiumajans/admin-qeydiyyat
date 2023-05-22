<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $infos = [
            [
                'title' => 'phone-1',
                'link'  => '+994',
            ],
            [
                'title' => 'phone-2',
                'link'  => '+994',
            ],
            [
                'title' => 'place-1',
                'link'  => 'Test',
            ],
            [
                'title' => 'place-2',
                'link'  => 'Test',
            ],
            [
                'title' => 'email',
                'link'  => 'Test',
            ],
            [
                'title' => 'facebook',
                'link'  => 'Test',
            ],
            [
                'title' => 'instagram',
                'link'  => 'Test',
            ],
            [
                'title' => 'whatsapp',
                'link'  => 'Test',
            ],
        ];
        
        foreach ($infos as $info) {
            ContactInfo::create($info);
        }
    }
}       
