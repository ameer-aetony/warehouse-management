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
        return $this->model->latest()->paginate();
    }

    /**
     * getOne
     *
     * @param  int $id
     * @return OutTransaction
     */
    public function getOne(string $id): OutTransaction
    {
        $category = $this->model->find($id);
        if (!$category) throw new \Exception('warehouse transaction  id not found');
        return $category;
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
