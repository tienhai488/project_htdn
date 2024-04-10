<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductPriceSeeder::class);
        $this->call(CustommerSeeder::class);
        $this->call(ShippingUnitSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(DepartmentSeeder::class);
    }
}