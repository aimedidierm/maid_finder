<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Diane Mwiza',
            'address' => 'Kigali, Rwanda',
            'gender' => 'male',
            'phone' => '0788750979',
            'email' => 'mwiza@example.com',
            'role' => 'admin',
            'password' => bcrypt('0788750979'),
        ]);
    }
}
