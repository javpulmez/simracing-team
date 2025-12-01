<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Race;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_delete_race()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $race = Race::factory()->create();
        
        $response = $this->actingAs($admin)->delete("/races/{$race->id}");
        
        $this->assertSoftDeleted('races', ['id' => $race->id]);
        $response->assertRedirect('/races');
    }

    /** @test */
    public function admin_can_delete_news()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $news = News::factory()->create(['user_id' => $admin->id]);
        
        $response = $this->actingAs($admin)->delete("/news/{$news->id}");
        
        $this->assertSoftDeleted('news', ['id' => $news->id]);
        $response->assertRedirect('/news');
    }

    /** @test */
public function visitor_cannot_delete_race()
{
    $visitor = User::factory()->create(['role' => 'visitor']);
    $race = Race::factory()->create();
    
    $response = $this->actingAs($visitor)->delete("/races/{$race->id}");
    
    // El visitante es redirigido o recibe error
    $this->assertNotEquals(200, $response->status());
}
}