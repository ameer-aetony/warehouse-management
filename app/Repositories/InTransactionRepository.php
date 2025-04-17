<?php

namespace App\Repositories;

use App\Interfaces\InTransactionInterface;
use App\Models\InTransaction;
use App\Models\WarehouseTransaction;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class InTransactionRepository implements InTransactionInterface
{
    public function __construct(private readonly InTransaction $model) {}

    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->model->with(['item','warehouseTransaction.transactionType'])->latest()->paginate();
    }

    /**
     * getOne
     *
     * @param  int $id
     * @return InTransaction
     */
    public function itemIncome(string $id): InTransaction
    {
        $inTransaction = $this->model->with(['item','warehouseTransaction.transactionType'])->find($id);
        if (!$inTransaction) throw new \Exception('int transaction  id not found');
        return $inTransaction;
    }

    /**
     * store
     *
     * @param  array $request
     * @return InTransaction
     */
    public function store(array $request): InTransaction
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
        $inTransaction = $this->model->find($id);
        return $inTransaction->delete($id);
    }
    
    /**
     * getAllIncoming
     *
     * @param  string $id
     * @return int
     */
    public function getAllIncoming(string $id): int
    {
        return  $this->model->where('item_id', $id)->sum('quantity');
    }
}
