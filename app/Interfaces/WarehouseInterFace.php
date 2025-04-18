<?php

namespace App\Interfaces;


use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface WarehouseInterface
{

    public function getAll(Request $request): LengthAwarePaginator;

    public function getOne(string $id): Warehouse;

    public function store(Request $request): Warehouse;

    public function update(Request $request,string $id): bool;

    public function delete(string $id): bool;
}
