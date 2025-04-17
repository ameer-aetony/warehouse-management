<?php

namespace App\Repositories;

use App\Interfaces\WarehouseTransactionInterface;
use App\Interfaces\WarehouseTransactionTypeInterface;
use App\Models\WarehouseTransaction;
use App\Models\WarehouseTransactionType;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class WarehouseTransactionRepository implements WarehouseTransactionInterface
{
    public function __construct(private readonly WarehouseTransaction $model) {}

    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->model->with(['warehouse:id,name,location','transactionType:id,name','inTransactions.item:id,name,commercial_name,category_id','outTransactions.item:id,name,commercial_name,category_id'])->latest()->paginate();
    }
   
    /**
     * getOne
     *
     * @param  int $id
     * @return WarehouseTransaction
     */
    public function getOne(string $id): WarehouseTransaction
    {
        $warehouseTransaction = $this->model->with(['warehouse:id,name,location','transactionType:id,name','inTransactions.item:id,name,commercial_name,category_id','outTransactions.item:id,name,commercial_name,category_id'])->find($id);
        if (!$warehouseTransaction) throw new \Exception('warehouse transaction  id not found');
        return $warehouseTransaction;
    }

    /**
     * store
     *
     * @param  array $request
     * @return WarehouseTransaction
     */
    public function store(array $request): WarehouseTransaction
    {
        return $this->model->create($request);
    }

    /**
     * delete
     *
     * @param  int $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $warehouseTransaction = $this->getOne($id);
        return $warehouseTransaction->delete($id);
    }
}
