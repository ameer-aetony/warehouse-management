<?php

namespace App\Http\Controllers;

use App\Interfaces\OutTransactionInterface;
use Illuminate\Http\Request;

class OutTransactionController extends BaseController
{
    public function __construct(protected readonly OutTransactionInterface $outTransactionInterface) {}

    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        try {

            $outTransactions =   $this->outTransactionInterface->getAll();
            return $this->successResponse(['outTransactions' => $outTransactions]);
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
            return  $this->outTransactionInterface->delete($id);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
