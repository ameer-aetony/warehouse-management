<?php

namespace App\Services;

use App\Interfaces\ItemInterFace;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final class ItemService
{
    public function __construct(protected readonly ItemInterFace $itemInterFace) {}

    /**
     * getAll
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->itemInterFace->getAll();
    }

    public function getItemMovement(string $id)
    {
        return $this->itemInterFace->getItemMovement($id);
    }

    /**
     * store
     *
     * @param  Request $request
     * @return Item
     */
    public function store(Request $request): Item
    {
        return $this->itemInterFace->store($request);
    }


    /**
     * getOne
     *
     * @param  string $id
     * @return Item
     */
    public function getOne(string $id): Item
    {
        return $this->itemInterFace->getOne($id);
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
        return $this->itemInterFace->update($request, $id);
    }

    /**
     * delete
     *
     * @param  string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->itemInterFace->delete($id);
    }
}
