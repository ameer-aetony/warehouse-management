<?php

namespace App\Services;

use App\Interfaces\WarehouseInterface;
use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class WarehouseService
{
    public function __construct(protected readonly WarehouseInterface $warehouseInterface) {}

    /**
     * getAll
     *
     * @return LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        return $this->warehouseInterface->getAll($request);
    }

    /**
     * store
     *
     * @param  Request $request
     * @return Item
     */
    public function store(Request $request): Warehouse
    {
        return $this->warehouseInterface->store($request);
    }


    /**
     * getOne
     *
     * @param  string $id
     * @return Item
     */
    public function getOne(string $id): Warehouse
    {
        return $this->warehouseInterface->getOne($id);
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
        return $this->warehouseInterface->update($request, $id);
    }

    /**
     * delete
     *
     * @param  string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->warehouseInterface->delete($id);
    }
}
