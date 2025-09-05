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
        $images = [
            'storage/app/public/images/1.png',
            'storage/app/public/images/2.png',
            'storage/app/public/images/3.png',
            'storage/app/public/images/4.png',

        ];

        return [
            //
            'path' => $this->faker->randomElement($images),
        ];
    }
}
