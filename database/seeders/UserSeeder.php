<?php

namespace Database\Seeders; // Namespace yang benar untuk Seeder

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin POS',
            'email' => 'admin@pos.com',
            'password' => Hash::make('admin123'), // Password harus di-hash
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@pos.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir'
        ]);
    }
}



