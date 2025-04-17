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
        $items = $this->itemService->getAll();
        return $this->successResponse(['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {

        return $this->successResponse($this->itemService->store($request), 'Items Created successful', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->itemService->getOne($id);
        return $this->successResponse(['item' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {

        return $this->successResponse($this->itemService->update($request, $id), 'Items updated successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        return $this->successResponse($this->itemService->delete($id), 'Items deleted successful', 204);
    }
}
