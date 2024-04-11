<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Position::count()) {
            return;
        }

        Position::create(['name' => 'Giám đốc']);
        Position::create(['name' => 'Quản lý']);
        Position::create(['name' => 'Thư ký']);
        Position::create(['name' => 'Bán hàng']);
        Position::create(['name' => 'Kế toán']);
        Position::create(['name' => 'Kho']);
    }
}
