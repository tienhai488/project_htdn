<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPrice>
 */
class ProductPriceFactory extends Factory
{
    protected $model = ProductPrice::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::all()->shuffle()->first();
        $regular_price = fake()->randomFloat(4, 100, 200);
        $price = fake()->randomFloat(4, 50, $regular_price);
        return [
            'product_id' => $product->id,
            'sale_price' => $price,
            'regular_price' => $regular_price,
        ];
    }
}