<?php

namespace Database\Factories;

use App\Models\Race;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true) . '.pdf',
            'file_path' => 'documents/' . fake()->uuid() . '.pdf',
            'file_type' => fake()->randomElement(['setup', 'reglamento', 'guia', 'resultado']),
            'race_id' => Race::factory(),
            'user_id' => User::factory(),
        ];
    }
}