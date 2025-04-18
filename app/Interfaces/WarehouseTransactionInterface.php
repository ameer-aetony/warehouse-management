<?php

namespace App\Interfaces;


use App\Models\Warehouse;
use App\Models\WarehouseTransaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface WarehouseTransactionInterface
{

    public function getAll(Request $request): LengthAwarePaginator;

    public function getOne(string $id): WarehouseTransaction;

    public function store(array $request): WarehouseTransaction;

    public function delete(string $id): bool;
}
