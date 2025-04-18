<?php

namespace App\Services;

use App\Interfaces\ItemInterFace;
use App\Interfaces\WarehouseTransactionInterface;
use App\Interfaces\WarehouseTransactionTypeInterface;
use App\Models\Item;
use App\Models\WarehouseTransaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

final class WarehouseTransactionService
{

    private const INBOUND_TYPES = ['in', 'adjustment in'];
    private const OUTBOUND_TYPES = ['out', 'adjustment out'];

    public function __construct(
        protected readonly WarehouseTransactionInterface $warehouseTransactionInterface,
        protected readonly WarehouseTransactionTypeInterface $warehouseTransactionTypeInterface,
        protected readonly ItemInterFace $itemInterFace
    ) {}

    /**
     * getAll Warehouse Transaction
     *
     * @return LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        return $this->warehouseTransactionInterface->getAll($request);
    }

    /**
     * store Warehouse Transaction
     *
     * @param  Request $request
     * @return Item
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();


            // create the main transaction 
            $warehouseTransaction = $this->createWarehouseTransaction($request);

            // get transaction type 
            $transaction_type = $this->warehouseTransactionTypeInterface->getOne($request->input('transaction_type_id'));


            $this->processWarehouseTransactionDetail($request->input('items', []), $transaction_type->name, $warehouseTransaction);

            DB::commit();
            return $warehouseTransaction;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    /**
     * getOne
     *
     * @param  string $id
     * @return Item
     */
    public function getOne(string $id): WarehouseTransaction
    {
        return $this->warehouseTransactionInterface->getOne($id);
    }


    /**
     * delete
     *
     * @param  string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->warehouseTransactionInterface->delete($id);
    }


    /**
     * createWarehouseTransaction
     *
     * @param  Request $request
     * @return WarehouseTransaction
     */
    private function createWarehouseTransaction(Request $request): WarehouseTransaction
    {
        $warehouseTransactionData = $request->only(['warehouse_id', 'transaction_type_id']);

        return $this->warehouseTransactionInterface->store($warehouseTransactionData);
    }

    /**
     * processWarehouseTransactionDetail
     *
     * @param  array $data
     * @param  string $type
     * @param  WarehouseTransaction $warehouseTransaction
     * @return void
     */
    private function processWarehouseTransactionDetail(array $data, string $type, WarehouseTransaction $warehouseTransaction): void
    {
        foreach ($data as $item) {
            $this->createWarehouseTransactionDetail($item, $type, $warehouseTransaction);
        }
    }

    /**
     * createWarehouseTransactionDetail
     *
     * @param  array $item
     * @param  string $type
     * @param  WarehouseTransaction $warehouseTransaction
     * @return void
     */
    private function createWarehouseTransactionDetail(array $item, string $type, WarehouseTransaction $warehouseTransaction)
    {

        $TransactionData = $this->prepareWarehouseTransactionData($item, $warehouseTransaction->id);
        // check type if in or out
        if (in_array($type, static::INBOUND_TYPES, true)) {

            $this->createInTransaction($TransactionData, $warehouseTransaction);
        } else if (in_array($type, static::OUTBOUND_TYPES, true)) {
            // validate stock available  
            $this->checkQuantityInStock($item['item_id'], $item['quantity']);

            $this->createOutTransaction($TransactionData, $warehouseTransaction);
        }
    }


    /**
     * createInTransaction
     *
     * @param  array $inTransactionData
     * @param  WarehouseTransaction $warehouseTransaction
     * @return void
     */
    private function createInTransaction(array $TransactionData, WarehouseTransaction $warehouseTransaction)
    {
        $warehouseTransaction->inTransactions()->create($TransactionData);
    }

    /**
     * createOutTransaction
     *
     * @param  array $inTransactionData
     * @param  WarehouseTransaction $warehouseTransaction
     * @return void
     */
    private function createOutTransaction(array $TransactionData, WarehouseTransaction $warehouseTransaction)
    {

        $warehouseTransaction->outTransactions()->create($TransactionData);
    }

    /**
     * checkQuantityInStock
     *
     * @param  string $item_id
     * @param  int $quantity
     * @return void
     */
    private function checkQuantityInStock(string $item_id, int $quantity): void
    {
        // call StockService 
        $stockService = app(StockService::class);
        //  get quantities 
        $stock = $stockService->calculateStock($item_id);
        //  if not available in stock 
        if ($quantity > $stock['remaining']) {
            $item = $this->itemInterFace->getOne($item_id);
            throw new \App\Exceptions\InsufficientStockException('The number of the requested product is greater than the number in the warehouse.' . $item->name);
        }
    }

    /**
     * prepareWarehouseTransactionData
     *
     * @param  array $item
     * @param  string $warehouseTransaction_id
     * @return array
     */
    private function prepareWarehouseTransactionData(array $item, string $warehouseTransaction_id): array
    {
        return [
            'item_id' => $item['item_id'],
            'quantity' => $item['quantity'],
            'comment' => $item['comment'] ?? '',
            'warehouse_transaction_id' => $warehouseTransaction_id
        ];
    }
}
