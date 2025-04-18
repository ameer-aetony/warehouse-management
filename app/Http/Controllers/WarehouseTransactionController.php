<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseTransactionRequest;
use App\Services\WarehouseTransactionService;
use Illuminate\Http\Request;

class WarehouseTransactionController extends BaseController
{
    public function __construct(protected readonly WarehouseTransactionService  $warehouseTransactionService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     
           
            $warehouse_transactions = $this->warehouseTransactionService->getAll($request);
            return $this->successResponse(['warehouse_transactions' => $warehouse_transactions]);
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseTransactionRequest $request)
    {
        try {
            return $this->successResponse($this->warehouseTransactionService->store($request), 'warehouse transaction Created successful', 201);
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
            $warehouse = $this->warehouseTransactionService->getOne($id);
            return $this->successResponse(['warehouse' => $warehouse]);
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
            return $this->successResponse($this->warehouseTransactionService->delete($id), 'warehouse transaction deleted successful', 204);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
