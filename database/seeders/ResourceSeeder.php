<?php

namespace Database\Seeders;

use App\Models\Resource;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Kaan Paat (কান পেতে রই)',
                'type' => 'Helpline',
                'phone' => '09612119966', // Their updated number
                'website' => 'https://kaanpaateroi.org',
                'is_24_7' => true,
            ],
            [
                'name' => 'Moner Janala',
                'type' => 'Counseling Center',
                'address' => 'Panthapath, Dhaka',
                'is_24_7' => false,
            ],
            [
                'name' => 'National Mental Health Helpline',
                'type' => 'Helpline',
                'phone' => '16263',
                'is_24_7' => true,
            ],
        ];

        foreach ($data as $item) {
            Resource::create($item);
        }
    }
}
