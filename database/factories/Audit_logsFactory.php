<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Audit_logs>
 */
class Audit_logsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::pluck('id')->toArray();
        $action = [
            'update' => 'Update data',
            'add' => 'Add data',
            'delete' => 'Delete data'
        ];

        $selectedAction = $this->faker->randomElement(array_keys($action));

        return [
            'user_id' => $this->faker->randomElement($user),
            'action' => $selectedAction,
            'description' => $action[$selectedAction], //mengambil value sesuai kolom action
            'ip_address' => $this->faker->ipv4
        ];
    }
}
