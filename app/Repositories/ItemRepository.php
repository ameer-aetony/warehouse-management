<?php

namespace App\Repositories;

use App\Interfaces\ItemCategoryInterFace;
use App\Interfaces\ItemInterFace;
use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class ItemRepository implements ItemInterFace
{
    public function __construct(private readonly Item $model) {}

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
     * @return Item
     */
    public function getOne(string $id): Item
    {
        $category = $this->model->find($id);
        if (!$category) throw new \Exception('item id not found');
        return $category;
    }

    /**
     * store
     *
     * @param  Request $request
     * @return Item
     */
    public function store(Request $request): Item
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
