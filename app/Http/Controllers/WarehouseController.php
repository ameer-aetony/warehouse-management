<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Models\Warehouse;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends BaseController
{
    public function __construct(protected readonly WarehouseService $warehouseService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->warehouseService->getAll();
        return $this->successResponse(['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseRequest $request)
    {

        return $this->successResponse($this->warehouseService->store($request), 'warehouse Created successful', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->warehouseService->getOne($id);
        return $this->successResponse(['item' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        return $this->successResponse($this->warehouseService->update($request, $id), 'warehouse updated successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        return $this->successResponse($this->warehouseService->delete($id), 'warehouse deleted successful', 204);
    }
}
