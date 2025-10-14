<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        // Test user creation
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ra.com',
            'password' => Hash::make('123456'),
        ]);

        // Call individual seeders
        $this->call([
            ProductSeeder::class,
        ]);
    }
}