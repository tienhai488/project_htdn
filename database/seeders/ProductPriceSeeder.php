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

        $products = Product::withCount('productPrices')->get();

        foreach ($products as $product) {
            if ($product->productPrices_count == 0) {
                $regular_price = fake()->randomFloat(4, 100, 200);
                $sale_price = fake()->randomFloat(4, 50, $regular_price);
                ProductPrice::create([
                    'product_id' => $product->id,
                    'sale_price' => $sale_price,
                    'regular_price' => $regular_price,
                ]);
            }
        }
    }
}
