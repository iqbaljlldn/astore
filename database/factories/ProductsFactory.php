<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = \App\Models\Categories::pluck('id')->toArray();

        return [
            'categories_id' => $this->faker->randomElement($categories),
            'name' => $this->faker->domainName(),
            'buying_price' => $this->faker->randomFloat(0, 1000, 500000),
            'discount' => $this->faker->numberBetween(1,99),
            'selling_price' => $this->faker->randomFloat(1000,1000,10000),
            'stock' => $this->faker->numberBetween(1,99),
        ];
    }
}
