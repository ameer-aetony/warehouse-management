<?php

namespace App\Repositories;



use App\Interfaces\WarehouseTransactionTypeInterface;

use App\Models\WarehouseTransactionType;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class WarehouseTransactionTypeRepository implements WarehouseTransactionTypeInterface
{
    public function __construct(private readonly WarehouseTransactionType $model) {}

    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->model->latest()->paginate();
    }

    /**
     * getOne
     *
     * @param  int $id
     * @return WarehouseTransactionType
     */
    public function getOne(string $id): WarehouseTransactionType
    {
   
        $warehouseTransactionType = $this->model->find($id);
        if (!$warehouseTransactionType) throw new \Exception('warehouse transaction type id not found');
        return $warehouseTransactionType;
    }

    /**
     * store
     *
     * @param  Request $request
     * @return WarehouseTransactionType
     */
    public function store(Request $request): WarehouseTransactionType
    {
        return $this->model->create($request->all());
    }

    /**
     * update
     *
     * @param  int $id
     * @param  Request $request
     * @return bool
     */
    public function update(Request $request,string $id): bool
    {
        $warehouseTransactionType = $this->getOne($id);
        return $warehouseTransactionType->update($request->all());
    }
    
    /**
     * delete
     *
     * @param  int $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $warehouseTransactionType = $this->getOne($id);
        return $warehouseTransactionType->delete($id);
    }
}
