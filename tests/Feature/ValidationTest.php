<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function race_creation_fails_with_invalid_data()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin)->post('/races', [
            'name' => '', // Nombre vacío (inválido)
            'circuit' => '',
            'game' => '',
            'race_date' => '',
            'max_participants' => 0,
            'status' => 'invalid_status',
        ]);
        
        $response->assertSessionHasErrors(['name', 'circuit', 'game', 'race_date']);
    }

    /** @test */
    public function race_creation_requires_future_date()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin)->post('/races', [
            'name' => 'Carrera Test',
            'circuit' => 'Monza',
            'game' => 'F1 2024',
            'race_date' => now()->subDay()->format('Y-m-d\TH:i'), // Fecha pasada
            'max_participants' => 20,
            'status' => 'upcoming',
        ]);
        
        $response->assertSessionHasErrors(['race_date']);
    }

    /** @test */
    public function news_creation_requires_title_and_content()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin)->post('/news', [
            'title' => '',
            'content' => '',
        ]);
        
        $response->assertSessionHasErrors(['title', 'content']);
    }
}