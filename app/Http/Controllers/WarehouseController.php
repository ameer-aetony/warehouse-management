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

        try {
            $warehouses = $this->warehouseService->getAll();
            return $this->successResponse(['warehouses' => $warehouses]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseRequest $request)
    {
        try {
            return $this->successResponse($this->warehouseService->store($request), 'warehouse Created successful', 201);
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
            $warehouse = $this->warehouseService->getOne($id);
            return $this->successResponse(['warehouse' => $warehouse]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarehouseRequest $request, string $id)
    {
        try {
            return $this->successResponse($this->warehouseService->update($request, $id), 'warehouse updated successful');
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
            return $this->successResponse($this->warehouseService->delete($id), 'warehouse deleted successful', 204);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
