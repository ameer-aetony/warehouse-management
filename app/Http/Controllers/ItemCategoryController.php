<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCategoryRequest;
use App\Interfaces\ItemCategoryInterface;
use App\Services\ItemCategoryService;
use Illuminate\Http\Request;

class ItemCategoryController extends BaseController
{
    public function __construct(protected readonly ItemCategoryService $itemCategoryService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $categories = $this->itemCategoryService->getAll($request);
            return $this->successResponse(['categories' => $categories]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemCategoryRequest $request)
    {
        try {
            return $this->successResponse($this->itemCategoryService->store($request), 'Category Created successful', 201);
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
            $category = $this->itemCategoryService->getOne($id);
            return $this->successResponse(['category' => $category]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemCategoryRequest $request, string $id)
    {
        try {
            return $this->successResponse($this->itemCategoryService->update($request, $id), 'Category updated successful');
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
            return $this->successResponse($this->itemCategoryService->delete($id), 'Category deleted successful', 204);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
