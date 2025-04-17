<?php

namespace App\Interfaces;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface ItemInterFace
{

    public function getAll(): LengthAwarePaginator;

    public function getOne(string $id): Item;

    public function getItemMovement(string $id): Item;

    public function store(Request $request): Item;

    public function update(Request $request,string $id): bool;

    public function delete(string $id): bool;
}
