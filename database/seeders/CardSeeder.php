<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Card;


class CardSeeder extends Seeder
{
    public function run(): void
    {
        Card::factory(50)->create(); // Crea 50 tarjetas falsas
    }
}
