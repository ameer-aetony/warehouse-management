<?php

namespace App\Services;

use App\Interfaces\WarehouseTransactionTypeInterface;
use App\Models\Item;

use App\Models\WarehouseTransactionType;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class WarehouseTransactionTypeService
{
    public function __construct(protected readonly WarehouseTransactionTypeInterface $warehouseTransactionTypeInterface) {}

    /**
     * getAll
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->warehouseTransactionTypeInterface->getAll();
    }

    /**
     * store
     *
     * @param  Request $request
     * @return Item
     */
    public function store(Request $request): WarehouseTransactionType
    {
        return $this->warehouseTransactionTypeInterface->store($request);
    }


    /**
     * getOne
     *
     * @param  string $id
     * @return Item
     */
    public function getOne(string $id): WarehouseTransactionType
    {
        return $this->warehouseTransactionTypeInterface->getOne($id);
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
        return $this->warehouseTransactionTypeInterface->update($request, $id);
    }

    /**
     * delete
     *
     * @param  string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->warehouseTransactionTypeInterface->delete($id);
    }
}
