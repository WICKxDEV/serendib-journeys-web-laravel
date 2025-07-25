<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        $adminUser = User::where('email', 'admin@tourism.com')->first();
        $adminRole = Role::where('slug', 'admin')->first();

        if (!$adminUser && $adminRole) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@tourism.com',
                'password' => Hash::make('password'), // Change 'password' in production
            ]);

            $admin->roles()->attach($adminRole);
        }
    }
}
