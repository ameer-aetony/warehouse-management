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
     * getAll items
     *
     * @return LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        return $this->itemInterFace->getAll($request);
    }

    /**
     * get item Movements
     *
     * @param  string $id
     * @return void
     */
    public function getItemMovement(string $id)
    {
        return $this->itemInterFace->getItemMovement($id);
    }

    /**
     * store item
     *
     * @param  Request $request
     * @return Item
     */
    public function store(Request $request): Item
    {
        return $this->itemInterFace->store($request);
    }


    /**
     * getOne item
     *
     * @param  string $id
     * @return Item
     */
    public function getOne(string $id): Item
    {
        return $this->itemInterFace->getOne($id);
    }

    /**
     * update item
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
     * delete item
     *
     * @param  string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->itemInterFace->delete($id);
    }

    /**
     * reverse Code To Item
     *
     * @param  string $code
     * @return Item
     */
    public function reverseCodeToItem(string $code)
    {
        if (strlen($code) < 7) throw new \Exception('invalid code');

        $itemChar = substr($code, 0, 1);   //get first char form item
        $categoryChar = substr($code, 1, 2); //get first - end char form item category
        $commercialChar = substr($code, 3, 1); //get first  char form commercial name
        $lengthCommercialChar = substr($code, 6); //get length  char commercial name

        return $this->itemInterFace->reverseCodeToItem($itemChar, $categoryChar, $commercialChar, $lengthCommercialChar);
    }
}
