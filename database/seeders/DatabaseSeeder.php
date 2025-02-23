<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Card;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear 5 usuarios
        User::factory(5)->create()->each(function ($user) {
            // Crear 20 tarjetas para cada usuario
            Card::factory(20)->create(['user_id' => $user->id]);
        });
    }
}
