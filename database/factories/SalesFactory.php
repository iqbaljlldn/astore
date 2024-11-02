<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales>
 */
class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = \App\Models\User::pluck('id')->toArray();
        $prices = \App\Models\SaleItems::where('sale_id', 'id')->pluck('subtotal')->toArray();

        $totalPrice = array_sum($prices);

        return [
            'user_id' => $this->faker->randomElement($users),
            'total_price' => $totalPrice,
            'payment_method' => $this->faker->randomElement(['cash','card','e-wallet']),
            'payment_status' => $this->faker->randomElement(['paid','unpaid','refund','pending'])
        ];
    }
}
