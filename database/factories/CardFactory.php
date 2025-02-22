<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question' => fake()->sentence(6), // Genera una pregunta aleatoria
            'answer' => fake()->word(), // Genera una respuesta aleatoria
        ];
    }
}
