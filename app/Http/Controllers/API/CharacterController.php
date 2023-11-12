<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\CharacterContract;
use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Http\Resources\CharacterResource;

class CharacterController extends Controller
{
    protected $characterService;

    public function __construct(CharacterContract $characterService)
    {
        $this->characterService = $characterService;
    }

    public function index()
    {
        $characters = $this->characterService->getAll();
        return CharacterResource::collection($characters);
    }

    public function store(StoreCharacterRequest $request)
    {
        $character = $this->characterService->create($request->validated());
        return new CharacterResource($character);
    }

    public function show($id)
    {
        $character = $this->characterService->findById($id);
        return new CharacterResource($character);
    }

    public function update(UpdateCharacterRequest $request, $id)
    {
        $character = $this->characterService->update($id, $request->validated());
        return new CharacterResource($character);
    }

    public function destroy($id)
    {
        $this->characterService->delete($id);
        return response(null, 204);
    }
}
