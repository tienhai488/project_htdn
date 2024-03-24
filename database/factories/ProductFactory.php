<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = ProductCategory::all()->shuffle()->first();

        return [
            'name' => fake()->name(),
            'quantity' => fake()->numberBetween(1, 100),
            'category_id' => $category->id,
        ];
    }
}