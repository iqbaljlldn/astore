<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transactions>
 */
class TransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sales = \App\Models\Sales::pluck('id')->toArray();
        $status = ['success', 'failed', 'refund'];
        $code = ['QR','BCA','BRI','DANA','OVO'];

        $saleId = $this->faker->randomElement($sales);
        $sale = \App\Models\Sales::find($saleId);

        return [
            'sale_id' => $saleId,
            'status' => $this->faker->randomElement($status),
            'description' => $this->faker->realText(),
            'transaction_code' => $this->faker->randomElement($code) . $this->faker->numberBetween(100000, 999999),
            'amount' => $sale ? $sale->total_price : $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
