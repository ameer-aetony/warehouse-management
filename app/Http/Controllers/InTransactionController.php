<?php

namespace App\Http\Controllers;

use App\Interfaces\InTransactionInterface;
use Illuminate\Http\Request;

class InTransactionController extends BaseController
{
    public function __construct(protected readonly InTransactionInterface $inTransactionInterface) {}
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        try {

            $inTransactions =   $this->inTransactionInterface->getAll();
            return $this->successResponse(['inTransactions' => $inTransactions]);
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
            return  $this->inTransactionInterface->delete($id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
