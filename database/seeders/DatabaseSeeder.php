<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'grahamransford3@gmail.com',
            'password' => bcrypt('12345678'), // Ensure the password is hashed
            'role' => 'admin', // Set the role to admin
            'phone' => '1234567890',
        ]);
       
    }
}
