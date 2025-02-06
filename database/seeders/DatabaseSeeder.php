<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create an admin user if none exists
        if (!\App\Models\User::count()) {
            \App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'rafaelmiano366@gmail.com',
                'is_admin' => true,
            ]);
        }
    }
}
