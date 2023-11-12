<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\ActorContract;
use App\Http\Requests\StoreActorRequest;
use App\Http\Requests\UpdateActorRequest;
use App\Http\Resources\ActorResource;

class ActorController extends Controller
{
    protected $actorService;

    public function __construct(ActorContract $actorService)
    {
        $this->actorService = $actorService;
    }

    public function index()
    {
        $actors = $this->actorService->getAll();
        return ActorResource::collection($actors);
    }

    public function store(StoreActorRequest $request)
    {
        $actor = $this->actorService->create($request->validated());
        return new ActorResource($actor);
    }

    public function show($id)
    {
        $actor = $this->actorService->findById($id);
        return new ActorResource($actor);
    }

    public function update(UpdateActorRequest $request, $id)
    {
        $actor = $this->actorService->update($id, $request->validated());
        return new ActorResource($actor);
    }

    public function destroy($id)
    {
        $this->actorService->delete($id);
        return response(null, 204);
    }
}
