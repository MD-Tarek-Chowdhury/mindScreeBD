<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ResourceSeeder::class);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mindscreen.bd',
            'password' => bcrypt('your-secure-password'),
            'is_admin' => true,
        ]);
    }
}
