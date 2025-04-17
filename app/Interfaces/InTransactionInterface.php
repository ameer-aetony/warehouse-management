<?php

namespace App\Interfaces;

use App\Models\InTransaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface InTransactionInterface
{

    public function getAll(): LengthAwarePaginator;

    public function store(array $request): InTransaction;

    public function getOne(string $id): InTransaction;

    public function update(array $request,string $id): bool;

    public function delete(string $id): bool;

    public function getAllIncoming(string $id): int;
}
