<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleItems>
 */
class SaleItemsFactory extends Factory
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
        $discount =  $this->faker->numberBetween(0,99);
        $totalPrice = $price * $quantity;
        $discAmount =  $totalPrice * ($discount/100);
        $subtotal = $totalPrice - $discAmount;

        return [
            'sales_id' => $this->faker->randomElement($sales),
            'products_id' => $this->faker->randomElement($products),
            'quantity' => $quantity,
            'price' => $price,
            'discount' => $discount,
            'subtotal' => $subtotal,
        ];
    }
}
