<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Driver;
use App\Models\Race;
use App\Models\RaceResult;
use App\Models\Document;
use App\Models\News;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear admin
        $admin = User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@simracing.test',
        ]);

        // Crear pilotos
        $pilots = User::factory()->pilot()->count(10)->create();
        
        // Crear perfil de piloto para cada piloto
        foreach ($pilots as $pilot) {
            Driver::factory()->create([
                'user_id' => $pilot->id,
            ]);
        }

        // Crear visitantes
        User::factory()->visitor()->count(5)->create();

        // Crear carreras
        $races = Race::factory()->count(8)->create();

        // Inscribir pilotos en carreras
        foreach ($races as $race) {
            $selectedPilots = $pilots->random(rand(5, 10));
            foreach ($selectedPilots as $pilot) {
                $race->users()->attach($pilot->id, [
                    'status' => fake()->randomElement(['registered', 'confirmed']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Crear resultados para carreras completadas
        $completedRaces = $races->where('status', 'completed');
        foreach ($completedRaces as $race) {
            $racePilots = $race->users;
            $position = 1;
            foreach ($racePilots as $pilot) {
                RaceResult::factory()->create([
                    'race_id' => $race->id,
                    'user_id' => $pilot->id,
                    'position' => $position++,
                    'points' => max(0, 26 - $position),
                ]);
            }
        }

        // Crear documentos
        Document::factory()->count(15)->create();

        // Crear noticias
        News::factory()->count(10)->create([
            'user_id' => $admin->id,
        ]);
    }
}