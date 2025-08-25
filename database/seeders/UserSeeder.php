<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ===========================
        // Buat admin
        // ===========================
        User::create([
            'name' => 'ozan',
            'email' => 'ozan28@gmail.com',
            'password' => '123456789',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'admin2',
            'email' => 'admin2@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        // ===========================
        // Buat user biasa
        // ===========================
        User::create([
            'name' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => Hash::make('testing123'), // jangan lupa hash password
            'role' => 'user',
        ]);
    }
}
