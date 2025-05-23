<?php

namespace App\Repositories;

use App\Interfaces\ItemCategoryInterface;
use App\Models\ItemCategory;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class ItemCategoryRepository implements ItemCategoryInterface
{
    public function __construct(private readonly ItemCategory $model) {}

    /**
     * getAll
     *
     * @return array
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        return $this->model->
        when(request('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })->latest()->paginate();
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
     * @param  Request $request
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
