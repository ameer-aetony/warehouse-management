<?php

namespace App\Interfaces;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface ItemCategoryInterface
{

    public function getAll(): LengthAwarePaginator;

    public function getOne(string $id): ItemCategory;

    public function store(Request $request): ItemCategory;

    public function update(Request $request,string $id): bool;

    public function delete(string $id): bool;
}
