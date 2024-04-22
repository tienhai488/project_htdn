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
        if (User::count() > 0) {
            return;
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        User::create([
            'name' => 'HR Manager',
            'email' => 'hr_manager@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        User::create([
            'name' => 'Warehouse Manager',
            'email' => 'warehouse_manager@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        User::create([
            'name' => 'Business Manager',
            'email' => 'business_manager@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);
    }
}
