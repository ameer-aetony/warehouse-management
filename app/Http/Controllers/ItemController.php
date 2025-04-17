<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Services\ItemService;
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
            $category = $this->itemService->getOne($id);
            return $this->successResponse(['item' => $category]);
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
