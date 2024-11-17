<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $example = [
            'name' => 'John Doe',
            'email' => 'john.doe@mail.com',
        ];
        // Check if user already exists
        if (!User::where('email', $example['email'])->exists()) {
            User::factory()->create([
                'name' => $example['name'],
                'email' => $example['email'],
                'password' => Hash::make('password'),
            ]);
        }

        $admin = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ];
        // Check if admin already exists
        if (!User::where('email', $admin['email'])->exists()) {
            User::factory()->create([
                'name' => $admin['name'],
                'email' => $admin['email'],
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
