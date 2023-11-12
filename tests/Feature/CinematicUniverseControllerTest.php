<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\CinematicUniverse;

class CinematicUniverseControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $response = $this->get('/api/cinematic-universes');

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $data = [
            'name' => 'New Cinematic Universe',
            'description' => 'Description of new universe',
            'foundationYear' => 2020
        ];

        $response = $this->post('/api/cinematic-universes', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('cinematic_universes', $data);
    }

    public function test_show()
    {
        $cinematicUniverse = CinematicUniverse::factory()->create();

        $response = $this->get('/api/cinematic-universes/' . $cinematicUniverse->id);

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $cinematicUniverse = CinematicUniverse::factory()->create();

        $updateData = ['name' => 'Updated Name'];

        $response = $this->put('/api/cinematic-universes/' . $cinematicUniverse->id, $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('cinematic_universes', $updateData);
    }

    public function test_destroy()
    {
        $cinematicUniverse = CinematicUniverse::factory()->create();

        $response = $this->delete('/api/cinematic-universes/' . $cinematicUniverse->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('cinematic_universes', ['id' => $cinematicUniverse->id]);
        $this->assertNull(CinematicUniverse::find($cinematicUniverse->id));
    }
}
