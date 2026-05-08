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
            'https://i.ibb.co/4Zs9FpRH/1.png',
            'https://i.ibb.co/rRcWR6dy/2.png',
            'https://i.ibb.co/QvyBL0Lv/3.png',
        ];

        return [
            //
            'path' => $this->faker->randomElement($images),
        ];
    }
}
