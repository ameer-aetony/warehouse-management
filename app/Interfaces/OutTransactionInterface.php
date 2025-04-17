<?php

namespace App\Interfaces;

use App\Models\OutTransaction;
use App\Models\Warehouse;
use App\Models\WarehouseTransaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface OutTransactionInterface
{

    public function getAll(): LengthAwarePaginator;

    public function store(array $request): OutTransaction;

    public function itemOutcome(string $id): OutTransaction;

    public function delete(string $id): bool;
    
    public function getAllOutcoming(string $id): int;
}
