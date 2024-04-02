<?php

namespace Database\Seeders;

use App\Models\ShippingUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ShippingUnit::count()) {
            return;
        }

        ShippingUnit::factory()->count(20)->create();
    }
}
