<?php

namespace Tests\Feature;

use App\Models\Actor;
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
            'movie_ids' => [$movie->id],
        ];

        $response = $this->post('/api/characters', $data);

        $response->assertStatus(201);
        $character = Character::where('name', 'New Character')->firstOrFail();

        $this->assertNotNull($character);
        $this->assertEquals('New Character', $character->name);
        $this->assertEquals('New Alias', $character->alias);
        $this->assertTrue($character->movies->contains($movie->id));
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

        // Create characters and attach them to the movie
        $characters = Character::factory()->count(5)->create()->each(function ($character) use ($movie) {
            $character->movies()->attach($movie->id);
        });

        // Create other characters not related to the movie
        $otherCharacters = Character::factory()->count(5)->create();

        $response = $this->getJson("/api/characters?movieId={$movie->id}");

        $response->assertOk();
        $fetchedCharacters = $response->json('data');

        $this->assertCount(5, $fetchedCharacters);
        foreach ($fetchedCharacters as $fetchedCharacter) {
            // Fetch the character to check its movies
            $character = Character::where('characters.id', $fetchedCharacter['id'])->firstOrFail(); // specify table name
            $this->assertTrue($character->movies->contains($movie->id));
        }
    }


    public function test_character_search_functionality()
    {
        // Create a movie
        $movie = Movie::factory()->create();

        // Create characters and attach them to the movie
        $characters = Character::factory()->count(3)->create()->each(function ($character) use ($movie) {
            $character->movies()->attach($movie->id);
        });

        // Create a specific character and actor
        $specificCharacter = Character::factory()->create(['name' => 'UniqueName', 'alias' => 'UniqueAlias']);
        $specificCharacter->movies()->attach($movie->id);
        $actor = Actor::factory()->create(['character_id' => $specificCharacter->id, 'name' => 'UniqueActorName']);

        // Case 1: Search by character name
        $response = $this->getJson("/api/characters?movieId={$movie->id}&search=UniqueName");
        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
        $this->assertEquals('UniqueName', $response->json('data.0.name'));

        // Case 2: Search by character alias
        $response = $this->getJson("/api/characters?movieId={$movie->id}&search=UniqueAlias");
        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
        $this->assertEquals('UniqueAlias', $response->json('data.0.alias'));

        // Case 3: Search by actor name
        $response = $this->getJson("/api/characters?movieId={$movie->id}&search=UniqueActorName");
        $response->assertOk();
        $this->assertCount(1, $response->json('data'));
        $this->assertEquals('UniqueActorName', $response->json('data.0.actor.name'));
    }

}
