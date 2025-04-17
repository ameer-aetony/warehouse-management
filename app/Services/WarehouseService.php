<?php

namespace App\Services;

use App\Interfaces\WarehouseInterFace;
use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class WarehouseService
{
    public function __construct(protected readonly WarehouseInterFace $warehouseInterFace) {}

    /**
     * getAll
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->warehouseInterFace->getAll();
    }

    /**
     * store
     *
     * @param  Request $request
     * @return Item
     */
    public function store(Request $request): Warehouse
    {
        return $this->warehouseInterFace->store($request);
    }


    /**
     * getOne
     *
     * @param  string $id
     * @return Item
     */
    public function getOne(string $id): Warehouse
    {
        return $this->warehouseInterFace->getOne($id);
    }

    /**
     * update
     *
     * @param  Request $request
     * @param  string $id
     * @return bool
     */
    public function update(Request $request, string $id): bool
    {
        return $this->warehouseInterFace->update($request, $id);
    }

    /**
     * delete
     *
     * @param  string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->warehouseInterFace->delete($id);
    }
}
