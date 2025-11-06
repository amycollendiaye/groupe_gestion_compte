<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compte>
 */
class CompteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'client_id' => null, // sera assigné dans le seeder
            'numero_compte' => 'ORANGE_BANK' . $this->faker->unique()->numberBetween(100000, 999999),
            'type' => $this->faker->randomElement(['epargne', 'cheque']),
            'statut' => 'actif',
            "date_debut_blocage" => fake()->date('Y-m-d'),
            'date_fin_blocage' => fake()->dateTimeBetween('now', '+3 months'),




        ];
    }
}
