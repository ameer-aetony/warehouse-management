<?php

namespace App\Repositories;


use App\Interfaces\WarehouseInterface;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class WarehouseRepository implements WarehouseInterface
{
    public function __construct(private readonly Warehouse $model) {}

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
     * @return Warehouse
     */
    public function getOne(string $id): Warehouse
    {
        $category = $this->model->find($id);
        if (!$category) throw new \Exception('Warehouse id not found');
        return $category;
    }

    /**
     * store
     *
     * @param  Request $request
     * @return Warehouse
     */
    public function store(Request $request): Warehouse
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
        $category = $this->getOne($id);
        return $category->update($request->all());
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
