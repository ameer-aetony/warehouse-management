<?php

namespace App\Repositories;


use App\Interfaces\ItemInterFace;
use App\Models\Item;

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
        return $this->model->with('category')->latest()->paginate();
    }

    /**
     * getOne
     *
     * @param  int $id
     * @return Item
     */
    public function getOne(string $id): Item
    {
        $item = $this->model->with('category')->find($id);
        if (!$item) throw new \Exception('item id not found');
        return $item;
    }

    public function getItemMovement(string $id): Item
    {
        return $this->getOne($id)->load([
            'inTransactions' => function ($query) {
                $query->select('id', 'item_id', 'quantity', 'warehouse_transaction_id')
                    ->with(['warehouseTransaction.transactionType:id,name']);
            },
            'outTransactions' => function ($query) {
                $query->select('id', 'item_id', 'quantity', 'warehouse_transaction_id')
                    ->with(['warehouseTransaction.transactionType:id,name']);
            }
        ]);
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
    public function update(Request $request, string $id): bool
    {
        $item = $this->getOne($id);
        return $item->update($request->all());
    }

    /**
     * delete
     *
     * @param  int $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $item = $this->getOne($id);
        return $item->delete($id);
    }

    /**
     * reverseCodeToItem
     *
     * @param  string $itemChar
     * @param  string $categoryChar
     * @param  string $commercialChar
     * @param  int $lengthCommercialChar
     * 
     */
    public function reverseCodeToItem(string $itemChar, string $categoryChar, string $commercialChar, int $lengthCommercialChar)
    {
        $categoryCharArray = str_split($categoryChar);

        return $this->model->where('name', 'like', $itemChar . '%')
            ->where('commercial_name', 'like', $commercialChar . '%')
            ->whereHas('category', function ($q) use ($categoryCharArray) {
                $q->where('name', 'like', $categoryCharArray[0] . '%')
                    ->where('name', 'like', '%' . $categoryCharArray[1]);
            })->whereRaw('LENGTH(commercial_name) = ' . $lengthCommercialChar)->first();
    }
}
