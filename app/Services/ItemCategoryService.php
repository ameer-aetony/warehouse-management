<?php

namespace App\Services;

use App\Interfaces\ItemCategoryInterface;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class ItemCategoryService
{
    public function __construct(protected readonly ItemCategoryInterface $itemCategoryInterface) {}

    /**
     * getAll
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->itemCategoryInterface->getAll();
    }

    /**
     * store
     *
     * @param  Request $request
     * @return ItemCategory
     */
    public function store(Request $request): ItemCategory
    {
        return $this->itemCategoryInterface->store($request);
    }

    /**
     * getOne
     *
     * @param  string $id
     * @return ItemCategory
     */
    public function getOne(string $id): ItemCategory
    {
        return $this->itemCategoryInterface->getOne($id);
    }

    /**
     * update
     *
     * @param  Request $request
     * @param  string $id
     * @return bool
     */
    public function update(Request $request, string $id): bool
    {
        return $this->itemCategoryInterface->update($request, $id);
    }

    /**
     * delete
     *
     * @param  Request $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->itemCategoryInterface->delete($id);
    }
}
