<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductGalleries>
 */
class ProductGalleriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = \App\Models\Products::pluck('id')->toArray();
        return [
            'products_id' => $this->faker->randomElement($products),
            'url_path' => $this->faker->name()
        ];
    }
}
