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
        $customers = \App\Models\Customers::pluck('id')->toArray();

        return [
            'users_id' => $this->faker->randomElement($users),
            'customers_id' => $this->faker->randomElement($customers),
            'total_items' => $this->faker->numberBetween(1,150),
            'discount' => $this->faker->numberBetween(0,100),
            'total_price' => $this->faker->numberBetween(500, 1000000),
            'pay' => $this->faker->numberBetween(1000,1000000),
            'payment_method' => $this->faker->randomElement(['cash','card','e-wallet']),
            'payment_status' => $this->faker->randomElement(['paid','unpaid','refund','pending'])
        ];
    }
}
