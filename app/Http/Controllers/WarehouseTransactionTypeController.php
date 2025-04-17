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
        $warehouse_transaction_types = $this->warehouseTransactionTypeService->getAll();
        return $this->successResponse(['warehouse_transaction_types' => $warehouse_transaction_types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseTransactionTypeRequest $request)
    {

        return $this->successResponse($this->warehouseTransactionTypeService->store($request), 'warehouse transaction type Created successful', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warehouse_transaction_type = $this->warehouseTransactionTypeService->getOne($id);
        return $this->successResponse(['warehouse_transaction_type' => $warehouse_transaction_type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarehouseTransactionTypeRequest $request, string $id)
    {

        return $this->successResponse($this->warehouseTransactionTypeService->update($request, $id), 'warehouse transaction type updated successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        return $this->successResponse($this->warehouseTransactionTypeService->delete($id), 'warehouse transaction type deleted successful', 204);
    }
}
