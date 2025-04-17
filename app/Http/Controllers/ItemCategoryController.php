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
    public function index()
    {
        $categories = $this->itemCategoryService->getAll();
        return $this->successResponse(['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemCategoryRequest $request)
    {
        
        return $this->successResponse($this->itemCategoryService->store($request), 'Category Created successful',201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->itemCategoryService->getOne($id);
        return $this->successResponse(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemCategoryRequest $request, string $id)
    {

        return $this->successResponse($this->itemCategoryService->update($request,$id), 'Category updated successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        return $this->successResponse($this->itemCategoryService->delete($id), 'Category deleted successful',204);
    }
}
