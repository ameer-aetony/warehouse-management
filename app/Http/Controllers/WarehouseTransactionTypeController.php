<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseTransactionTypeRequest;
use App\Services\WarehouseTransactionTypeService;
use Illuminate\Http\Request;

class WarehouseTransactionTypeController extends BaseController
{
    public function __construct(protected readonly WarehouseTransactionTypeService $warehouseTransactionTypeService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $warehouse_transaction_types = $this->warehouseTransactionTypeService->getAll();
            return $this->successResponse(['warehouse_transaction_types' => $warehouse_transaction_types]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseTransactionTypeRequest $request)
    {
        try {
            return $this->successResponse($this->warehouseTransactionTypeService->store($request), 'warehouse transaction type Created successful', 201);
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
            $warehouse_transaction_type = $this->warehouseTransactionTypeService->getOne($id);
            return $this->successResponse(['warehouse_transaction_type' => $warehouse_transaction_type]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarehouseTransactionTypeRequest $request, string $id)
    {
        try {
            return $this->successResponse($this->warehouseTransactionTypeService->update($request, $id), 'warehouse transaction type updated successful');
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
            return $this->successResponse($this->warehouseTransactionTypeService->delete($id), 'warehouse transaction type deleted successful', 204);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
