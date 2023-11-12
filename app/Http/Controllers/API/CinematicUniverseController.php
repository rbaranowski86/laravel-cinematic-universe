<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\CinematicUniverseContract;
use App\Http\Requests\StoreCinematicUniverseRequest;
use App\Http\Requests\UpdateCinematicUniverseRequest;
use App\Http\Resources\CinematicUniverseResource;

class CinematicUniverseController extends Controller
{
    protected $cinematicUniverseService;

    public function __construct(CinematicUniverseContract $cinematicUniverseService)
    {
        $this->cinematicUniverseService = $cinematicUniverseService;
    }

    public function index()
    {
        $cinematicUniverses = $this->cinematicUniverseService->getAll();
        return CinematicUniverseResource::collection($cinematicUniverses);
    }

    public function store(StoreCinematicUniverseRequest $request)
    {
        $cinematicUniverse = $this->cinematicUniverseService->create($request->validated());
        return new CinematicUniverseResource($cinematicUniverse);
    }

    public function show($id)
    {
        $cinematicUniverse = $this->cinematicUniverseService->findById($id);
        return new CinematicUniverseResource($cinematicUniverse);
    }

    public function update(UpdateCinematicUniverseRequest $request, $id)
    {
        $cinematicUniverse = $this->cinematicUniverseService->update($id, $request->validated());
        return new CinematicUniverseResource($cinematicUniverse);
    }

    public function destroy($id)
    {
        $this->cinematicUniverseService->delete($id);
        return response(null, 204);
    }
}
