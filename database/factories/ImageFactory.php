<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\ProductImage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ProductImage::class;

    
    public function definition(): array
    {
        //IMAGENS PADRÃO QUANDO GERA PRODUTOS FAKES
        $images = [
            'storage/app/public/images/default/1.png',
            'storage/app/public/images/default/2.png',
            'storage/app/public/images/default/3.png',
        ];

        return [
            //
            'path' => $this->faker->randomElement($images),
        ];
    }
}
