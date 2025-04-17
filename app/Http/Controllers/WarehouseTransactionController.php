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
    public function index()
    {
        $warehouse_transactions = $this->warehouseTransactionService->getAll();
        return $this->successResponse(['warehouse_transactions' => $warehouse_transactions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseTransactionRequest $request)
    {

        return $this->successResponse($this->warehouseTransactionService->store($request), 'warehouse transaction Created successful', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warehouse = $this->warehouseTransactionService->getOne($id);
        return $this->successResponse(['warehouse' => $warehouse]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        return $this->successResponse($this->warehouseTransactionService->delete($id), 'warehouse transaction deleted successful', 204);
    }
}
