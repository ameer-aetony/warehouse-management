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
        return $this->model->with(['warehouse','transactionType','inTransactions.item','outTransactions.item'])->latest()->paginate();
    }
       
    /**
     * getOne
     *
     * @param  int $id
     * @return WarehouseTransaction
     */
    public function getOne(string $id): WarehouseTransaction
    {
        $category = $this->model->with(['warehouse','transactionType','inTransactions.item','outTransactions.item'])->find($id);
        if (!$category) throw new \Exception('warehouse transaction  id not found');
        return $category;
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
        $category = $this->getOne($id);
        return $category->delete($id);
    }
}
