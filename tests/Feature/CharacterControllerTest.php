<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Character;
use App\Models\Movie;

class CharacterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $response = $this->get('/api/characters');

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $movie = Movie::factory()->create();
        $data = [
            'name' => 'New Character',
            'alias' => 'New Alias',
            'superpowers' => 'Super strength',
            'firstAppearance' => '2023-01-01',
            'movie_id' => $movie->id,
        ];

        $response = $this->post('/api/characters', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('characters', $data);
    }

    public function test_show()
    {
        $character = Character::factory()->create();

        $response = $this->get('/api/characters/' . $character->id);

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $character = Character::factory()->create();
        $updateData = ['name' => 'Updated Character'];

        $response = $this->put('/api/characters/' . $character->id, $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('characters', array_merge(['id' => $character->id], $updateData));
    }

    public function test_destroy()
    {
        $character = Character::factory()->create();

        $response = $this->delete('/api/characters/' . $character->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('characters', ['id' => $character->id]);
    }

    public function test_fetch_characters_by_movie_id()
    {
        $movie = Movie::factory()->create();
        $characters = Character::factory()->count(5)->create(['movie_id' => $movie->id]);
        $otherCharacters = Character::factory()->count(5)->create(); // Characters not related to the movie

        $response = $this->getJson("/api/characters?movieId={$movie->id}");

        $response->assertOk();
        $fetchedCharacters = $response->json('data');

        $this->assertCount(5, $fetchedCharacters);
        foreach ($fetchedCharacters as $fetchedCharacter) {
            $this->assertEquals($movie->id, $fetchedCharacter['movie_id']);
        }
    }

}
