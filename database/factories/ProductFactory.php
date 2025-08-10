<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Category;

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
        return [
            'name' => $this->faker->words(1, true),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'description' => $this->faker->paragraph(),
            'stock' => $this->faker->numberBetween(1, 100),
            'image_path' => 'images/JD8-6364-058_zoom1.png',
            'slug' => $this->faker->slug(),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
