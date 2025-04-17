<?php

namespace App\Repositories;

use App\Interfaces\OutTransactionInterface;
use App\Models\OutTransaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class OutTransactionRepository implements OutTransactionInterface
{
    public function __construct(private readonly OutTransaction $model) {}

    /**
     * getAll
     *
     * @return array
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->model->with(['item', 'warehouseTransaction.transactionType'])->latest()->paginate();
    }

    /**
     * getOne
     *
     * @param  int $id
     * @return OutTransaction
     */
    public function itemOutcome(string $id): OutTransaction
    {
        $outTransaction = $this->model->with(['item', 'warehouseTransaction.transactionType'])->find($id);
        if (!$outTransaction) throw new \Exception('out transaction  id not found');
        return $outTransaction;
    }

    /**
     * store
     *
     * @param  array $request
     * @return OutTransaction
     */
    public function store(array $request): OutTransaction
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
        $outTransaction = $this->model->find($id);
        return $outTransaction->delete($id);
    }

    /**
     * getAllOutcoming
     *
     * @param  string $id
     * @return int
     */
    public function getAllOutcoming(string $id): int
    {
        return  $this->model->where('item_id', $id)->sum('quantity');
    }
}
