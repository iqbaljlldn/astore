<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale_items>
 */
class Sale_itemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sales = \App\Models\Sales::pluck('id')->toArray();
        $products = \App\Models\Products::pluck('id')->toArray();

        $quantity = $this->faker->numberBetween(1, 25);
        $price = $this->faker->numberBetween(1000, 250000);
        return [
            'sale_id' => $this->faker->randomElement($sales),
            'product_id' => $this->faker->randomElement($products),
            'quantity' => $quantity,
            'price' => $price,
            'subtotal' => fn() => $quantity * $price,
        ];
    }
}
