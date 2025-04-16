<?php

namespace App\Repositories;

use App\Interfaces\ItemCategoryInterFace;
use App\Models\ItemCategory;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class ItemCategoryRepository implements ItemCategoryInterFace
{
    public function __construct(private readonly ItemCategory $model) {}

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
     * @return ItemCategory
     */
    public function getOne(string $id): ItemCategory
    {
        $category = $this->model->find($id);
        if (!$category) throw new \Exception('category id not found');
        return $category;
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return ItemCategory
     */
    public function store(Request $request): ItemCategory
    {
        return $this->model->create($request->all());
    }

    /**
     * update
     *
     * @param  int $id
     * @param  mixed $request
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
