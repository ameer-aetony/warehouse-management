<?php
namespace App\Repositories;

use App\Models\WarehouseTransaction;
use Illuminate\Support\Facades\DB;

class WarehouseTransactionRepository implements WarehouseTransactionRepositoryInterface
{
    protected $inTransactionRepo;
    protected $outTransactionRepo;

    public function __construct(InTransactionRepositoryInterface $inTransactionRepo, OutTransactionRepositoryInterface $outTransactionRepo)
    {
        $this->inTransactionRepo = $inTransactionRepo;
        $this->outTransactionRepo = $outTransactionRepo;
    }

    public function createTransaction($data)
    {
        DB::beginTransaction();

        try {
            $transaction = WarehouseTransaction::create([
                'warehouse_id' => $data['warehouse_id'],
                'transaction_type_id' => $data['transaction_type_id'],
                'code' => 'TRX-' . time(),
            ]);

            foreach ($data['items'] as $item) {
                $this->saveTransactionItem($transaction->id, $item, $data['transaction_type_id']);
            }

            DB::commit();
            return $transaction;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function saveTransactionItem($transactionId, $item, $transactionTypeId)
    {
        $data = [
            'item_id' => $item['item_id'],
            'quantity' => $item['quantity'],
            'warehouse_transaction_id' => $transactionId,
        ];

        if ($transactionTypeId == 1) { // Incoming transaction
            $this->inTransactionRepo->create($data);
        } elseif ($transactionTypeId == 2) { // Outgoing transaction
            $this->outTransactionRepo->create($data);
        }
    }
}