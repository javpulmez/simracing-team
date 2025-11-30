<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nickname' => fake()->unique()->userName(),
            'country' => fake()->country(),
            'photo' => null,
            'bio' => fake()->paragraph(3),
            'racing_number' => fake()->numberBetween(1, 99),
        ];
    }
}