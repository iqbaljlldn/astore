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
            'name' => $this->faker->domainName(),
            'price' => $this->faker->randomFloat(0, 1000, 500000),
            'stock' => $this->faker->numberBetween(1,99),
            'category_id' => $this->faker->randomElement($categories),
            'barcode' => $this->faker->numberBetween(100000,999999),
            'description' => $this->faker->realText(),
            'cost_price' => $this->faker->randomFloat(1000,1000,10000),
        ];
    }
}
