<?php

namespace App\Interfaces;


use App\Models\Warehouse;
use App\Models\WarehouseTransactionType;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface WarehouseTransactionTypeInterface
{

    public function getAll(): LengthAwarePaginator;

    public function getOne(string $id): WarehouseTransactionType;

    public function store(Request $request): WarehouseTransactionType;

    public function update(Request $request,string $id): bool;

    public function delete(string $id): bool;
}
