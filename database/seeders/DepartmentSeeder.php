<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Department::count()) {
            return;
        }

        Department::create(['name' => 'Nhân sự']);
        Department::create(['name' => 'Kho']);
        Department::create(['name' => 'IT']);
        Department::create(['name' => 'Kinh doanh']);
    }
}
