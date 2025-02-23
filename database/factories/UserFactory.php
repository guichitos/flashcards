<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password = null;

    protected $model = User::class;

    public function definition(): array
    {
        static $guichitosCreated = false; // Evita duplicados en cada ejecución

        if (!$guichitosCreated) {
            $guichitosCreated = true;
            return [
                'name' => 'Guichitos',
                'email' => 'guichitos@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('altillo9'),
                'remember_token' => Str::random(10),
            ];
        }

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password123'),
            'remember_token' => Str::random(10),
        ];
    }
}
