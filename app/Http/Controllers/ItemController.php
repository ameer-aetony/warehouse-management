<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Services\ItemService;
use App\Services\StockService;
use Illuminate\Http\Request;

class ItemController extends BaseController
{

    public function __construct(protected readonly ItemService $itemService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $items = $this->itemService->getAll();
            return $this->successResponse(['items' => $items]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        try {
            return $this->successResponse($this->itemService->store($request), 'Items Created successful', 201);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $item = $this->itemService->getOne($id);
            return $this->successResponse(['item' => $item]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * get movements item.
     */
    public function itemMovement(string $id)
    {
        try {
            $movements = $this->itemService->getItemMovement($id);
            return $this->successResponse(['movements' => $movements]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function itemInventory(string $id)
    {
        try {
            $stockService = app(StockService::class);
            $stock = $stockService->calculateStock($id);

            return $this->successResponse(['total_income' => $stock['in_stock'], 'total_outcome' => $stock['out_stock'], 'remaining' => $stock['remaining']]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {
        try {
            return $this->successResponse($this->itemService->update($request, $id), 'Items updated successful');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function reverseCode(string $code)
    {
        try {
            $item = $this->itemService->reverseCodeToItem($code);

            return $this->successResponse(['item name'=>$item->name,'category'=>$item->category->name,'commercial name'=>$item->commercial_name]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
            
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return $this->successResponse($this->itemService->delete($id), 'Items deleted successful', 204);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
