<?php

namespace Database\Factories;

use App\Models\Race;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceResultFactory extends Factory
{
    public function definition(): array
    {
        return [
            'race_id' => Race::factory(),
            'user_id' => User::factory(),
            'position' => fake()->numberBetween(1, 20),
            'points' => fake()->numberBetween(0, 25),
            'fastest_lap' => fake()->time('i:s.v'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}