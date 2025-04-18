<?php

namespace App\Services;

use App\Interfaces\ItemCategoryInterface;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class ItemCategoryService
{
    public function __construct(protected readonly ItemCategoryInterface $itemCategoryInterFace) {}

    /**
     * get all items category
     *
     * @return LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        return $this->itemCategoryInterFace->getAll($request);
    }

    /**
     * store items category
     *
     * @param  Request $request
     * @return ItemCategory
     */
    public function store(Request $request): ItemCategory
    {
        return $this->itemCategoryInterFace->store($request);
    }

    /**
     * get One items category
     *
     * @param  string $id
     * @return ItemCategory
     */
    public function getOne(string $id): ItemCategory
    {
        return $this->itemCategoryInterFace->getOne($id);
    }

    /**
     * update items category
     *
     * @param  Request $request
     * @param  string $id
     * @return bool
     */
    public function update(Request $request, string $id): bool
    {
        return $this->itemCategoryInterFace->update($request, $id);
    }

    /**
     * delete items category
     *
     * @param  Request $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->itemCategoryInterFace->delete($id);
    }
}
