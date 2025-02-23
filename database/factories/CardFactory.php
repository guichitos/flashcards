<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Card;
use App\Models\User;

class CardFactory extends Factory
{
    protected $model = Card::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Asigna a un usuario aleatorio
            'question' => $this->faker->sentence(6),
            'answer' => $this->faker->sentence(4),
        ];
    }
}
