<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        $admin = User::where('email', 'admin@tourism.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@tourism.com',
                'password' => Hash::make('password'), // Change 'password' in production
                'role' => 'admin', // Make sure 'role' column exists in users table
            ]);
        }
    }
}
