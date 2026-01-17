<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\ProductVariant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'size' => $this->faker->randomElement([38, 39, 40]),
        //     'stock' => $this->faker->numberBetween(1, 35),
        //     'product_id' => Product::inRandomOrder()->first()->id,
        // ];
    }
}
