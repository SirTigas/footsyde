<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Category;
use App\Models\Product;

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
        //GERADOR DE PRODUTOS FAKES
        return [
            'name' => $this->faker->words(1, true),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'description' => $this->faker->paragraph(),
            // 'stock' => $this->faker->numberBetween(1, 100),
            'fornecedor' => fake()->company(),
            'image_path' => 'images/products/default/thumbnail.png',
            'category_id' => Category::inRandomOrder()->first()->id,
            'code' => $this->faker->numberBetween(1000, 99999),

        ];
    }

    public function configure()
{
    //DEFININDO AS IMAGENS DO CARROSSEL
    return $this->afterCreating(function (Product $product) {
        $images = [
            'images/products/default/1.png',
            'images/products/default/2.png',
            'images/products/default/3.png',
        ];

        foreach ($images as $path) {
            \App\Models\ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
            ]);
        }
    });
}

}
