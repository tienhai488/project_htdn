<?php

namespace Database\Seeders;

use App\Acl\Acl;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        $hr = User::create([
            'name' => 'HR',
            'email' => 'hr@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        $warehouse = User::create([
            'name' => 'Warehouse',
            'email' => 'warehouse@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        $business = User::create([
            'name' => 'Business',
            'email' => 'business@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        $staff = User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        $adminRole = Role::findByName(Acl::ROLE_ADMIN);
        $hrRole = Role::findByName(Acl::ROLE_HR);
        $warehouseRole = Role::findByName(Acl::ROLE_WAREHOUSE);
        $businessRole = Role::findByName(Acl::ROLE_BUSINESS);
        $staffRole = Role::findByName(Acl::ROLE_STAFF);

        $admin->syncRoles($adminRole);
        $hr->syncRoles($hrRole);
        $warehouse->syncRoles($warehouseRole);
        $business->syncRoles($businessRole);
        $staff->syncRoles($staffRole);
    }
}