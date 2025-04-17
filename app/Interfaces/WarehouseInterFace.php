<?php

namespace App\Interfaces;

use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface WarehouseInterFace
{

    public function getAll(): LengthAwarePaginator;

    public function getOne(string $id): Warehouse;

    public function store(Request $request): Warehouse;

    public function update(Request $request,string $id): bool;

    public function delete(string $id): bool;
}
