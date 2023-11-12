<?php

namespace App\Contracts;

interface ActorContract
{
    public function getAll();
    public function findById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}
