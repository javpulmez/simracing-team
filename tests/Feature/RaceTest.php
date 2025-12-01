<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Race;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_view_races_index()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin)->get('/races');
        
        $response->assertStatus(200);
        $response->assertSee('Carreras');
    }

    /** @test */
    public function admin_can_create_race()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $raceData = [
            'name' => 'Gran Premio de México',
            'description' => 'Carrera oficial del equipo',
            'circuit' => 'Autódromo Hermanos Rodríguez',
            'game' => 'F1 2024',
            'race_date' => now()->addDays(7)->format('Y-m-d\TH:i'),
            'max_participants' => 20,
            'status' => 'upcoming',
        ];
        
        $response = $this->actingAs($admin)->post('/races', $raceData);
        
        $this->assertDatabaseHas('races', [
            'name' => 'Gran Premio de México',
            'circuit' => 'Autódromo Hermanos Rodríguez',
        ]);
        
        $response->assertRedirect();
    }

    /** @test */
    public function pilot_can_register_to_race()
    {
        $pilot = User::factory()->create(['role' => 'pilot']);
        $race = Race::factory()->create(['status' => 'upcoming']);
        
        $response = $this->actingAs($pilot)->post("/races/{$race->id}/register");
        
        $this->assertDatabaseHas('race_user', [
            'race_id' => $race->id,
            'user_id' => $pilot->id,
        ]);
        
        $response->assertRedirect();
    }
}