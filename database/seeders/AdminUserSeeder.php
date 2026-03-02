<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        $adminExists = User::where('email', 'admin@archtech.com')->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'Archtech Admin',
                'email' => 'admin@archtech.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin@archtech.com'), // Default password - CHANGE THIS IN PRODUCTION!
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@archtech.com');
            $this->command->info('Password: admin@archtech.com');
        }


        else {
            $this->command->info('Admin user already exists.');
        }
    }
}
