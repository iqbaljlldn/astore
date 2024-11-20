<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchases>
 */
class PurchasesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $supplierId = \App\Models\Suppliers::pluck('id')->toArray();
        return [
            'suppliers_id' => $this->faker->randomElement($supplierId),
            'total_items' => $this->faker->numberBetween(1,99),
            'total_price' => $this->faker->numberBetween(1000,1000000),
            'discon' => $this->faker->numberBetween(1000,10000),
            'pay' => $this->faker->numberBetween(1000,10000000)
        ];
    }
}
