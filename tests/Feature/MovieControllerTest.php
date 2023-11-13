<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Movie;
use App\Models\CinematicUniverse;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $response = $this->get('/api/movies');

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $cinematicUniverse = CinematicUniverse::factory()->create();
        $data = [
            'title' => 'New Movie',
            'releaseDate' => '2021-01-01',
            'director' => 'John Doe',
            'boxOfficeEarnings' => 1000000,
            'cinematic_universe_id' => $cinematicUniverse->id,
        ];

        $response = $this->post('/api/movies', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('movies', $data);
    }

    public function test_show()
    {
        $movie = Movie::factory()->create();

        $response = $this->get('/api/movies/' . $movie->id);

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $movie = Movie::factory()->create();
        $updateData = ['title' => 'Updated Title'];

        $response = $this->put('/api/movies/' . $movie->id, $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('movies', array_merge(['id' => $movie->id], $updateData));
    }

    public function test_destroy()
    {
        $movie = Movie::factory()->create();

        $response = $this->delete('/api/movies/' . $movie->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
    }
    public function test_fetch_movies_by_universe_id()
    {
        $universe = CinematicUniverse::factory()->create();
        $movies = Movie::factory()->count(5)->create(['cinematic_universe_id' => $universe->id]);
        $otherMovies = Movie::factory()->count(5)->create(); // Movies not related to the universe

        $response = $this->getJson("/api/movies?universeId={$universe->id}");

        $response->assertOk();
        $fetchedMovies = $response->json('data');

        $this->assertCount(5, $fetchedMovies);
        foreach ($fetchedMovies as $fetchedMovie) {
            $this->assertEquals($universe->id, $fetchedMovie['cinematic_universe_id']);
        }
    }
}
