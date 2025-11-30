<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RaceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true) . ' Grand Prix',
            'description' => fake()->paragraph(),
            'circuit' => fake()->randomElement([
                'Spa-Francorchamps',
                'Nürburgring',
                'Monza',
                'Silverstone',
                'Suzuka',
                'COTA',
                'Monaco',
                'Interlagos'
            ]),
            'game' => fake()->randomElement(['iRacing', 'Assetto Corsa Competizione', 'F1 2024', 'rFactor 2']),
            'race_date' => fake()->dateTimeBetween('now', '+3 months'),
            'max_participants' => fake()->numberBetween(16, 24),
            'status' => fake()->randomElement(['upcoming', 'ongoing', 'completed']),
        ];
    }
}