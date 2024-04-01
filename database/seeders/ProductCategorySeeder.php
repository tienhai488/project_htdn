<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ProductCategory::count()) {
            return;
        }

        ProductCategory::create([
            'name' => 'Áo Thun',
        ]);
        ProductCategory::create([
            'name' => 'Áo Hoodie',
        ]);
        ProductCategory::create([
            'name' => 'Áo Sơ Mi',
        ]);
        ProductCategory::create([
            'name' => 'Áo Polo',
        ]);
        ProductCategory::create([
            'name' => 'Áo khoác',
        ]);
    }
}