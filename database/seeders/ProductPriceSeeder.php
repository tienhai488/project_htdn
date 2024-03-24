<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ProductPrice::count()) {
            return;
        }

        ProductPrice::factory()->count(200)->create();

        $products = Product::withCount('product_prices')->get();

        foreach ($products as $product) {
            if ($product->product_prices_count == 0) {
                $purchase_price = fake()->randomFloat(4, 100, 200);
                $price = fake()->randomFloat(4, 50, $purchase_price);
                ProductPrice::create([
                    'product_id' => $product->id,
                    'price' => $price,
                    'purchase_price' => $purchase_price,
                ]);
            }
        }
    }
}