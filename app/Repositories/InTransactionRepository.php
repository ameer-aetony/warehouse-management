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
        return $this->model->latest()->paginate();
    }

    /**
     * getOne
     *
     * @param  int $id
     * @return InTransaction
     */
    public function getOne(string $id): InTransaction
    {
        $category = $this->model->find($id);
        if (!$category) throw new \Exception('warehouse transaction  id not found');
        return $category;
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
     * update
     *
     * @param  int $id
     * @param  array $request
     * @return bool
     */
    public function update(array $request, string $id): bool
    {
        $category = $this->getOne($id);
        return $category->update($request);
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
