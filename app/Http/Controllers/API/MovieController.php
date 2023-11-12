<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\MovieContract;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieContract $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $movies = $this->movieService->getAll();
        return MovieResource::collection($movies);
    }

    public function store(StoreMovieRequest $request)
    {
        $movie = $this->movieService->create($request->validated());
        return new MovieResource($movie);
    }

    public function show($id)
    {
        $movie = $this->movieService->findById($id);
        return new MovieResource($movie);
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = $this->movieService->update($id, $request->validated());
        return new MovieResource($movie);
    }

    public function destroy($id)
    {
        $this->movieService->delete($id);
        return response(null, 204);
    }
}
