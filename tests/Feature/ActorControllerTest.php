<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Actor;
use App\Models\Character;

class ActorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $response = $this->get('/api/actors');

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $character = Character::factory()->create();
        $data = [
            'name' => 'New Actor',
            'dateOfBirth' => '1990-01-01',
            'nationality' => 'American',
            'character_id' => $character->id,
        ];

        $response = $this->post('/api/actors', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('actors', $data);
    }

    public function test_show()
    {
        $actor = Actor::factory()->create();

        $response = $this->get('/api/actors/' . $actor->id);

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $actor = Actor::factory()->create();
        $updateData = ['name' => 'Updated Actor'];

        $response = $this->put('/api/actors/' . $actor->id, $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('actors', array_merge(['id' => $actor->id], $updateData));
    }

    public function test_destroy()
    {
        $actor = Actor::factory()->create();

        $response = $this->delete('/api/actors/' . $actor->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('actors', ['id' => $actor->id]);
    }
}
