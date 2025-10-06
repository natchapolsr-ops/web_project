<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'john',
            'email' => 'john@example.com',
            'password' => Hash::make('secret123'),
        ]);

        User::create([
            'name' => 'jane',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}