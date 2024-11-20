<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseDetails>
 */
class PurchaseDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $purchaseId = \App\Models\Purchases::pluck('id')->toArray();
        $productId = \App\Models\Products::pluck('id')->toArray();
        $buy = $this->faker->numberBetween(100, 100000);
        $qty = $this->faker->numberBetween(1, 250);
        $sub = $buy*$qty;
        return [
            'purchases_id' => $this->faker->randomElement($purchaseId),
            'products_id' => $this->faker->randomElement($productId),
            'buying_price' => $buy,
            'quantities' => $qty,
            'subtotal' => $sub
        ];
    }
}
