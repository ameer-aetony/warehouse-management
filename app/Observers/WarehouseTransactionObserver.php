<?php

namespace App\Observers;

use App\Models\WarehouseTransaction;
use Illuminate\Support\Str;
class WarehouseTransactionObserver
{

    public function creating(WarehouseTransaction $transaction)
    {
        $date = now()->format('Y-m-d');
 
        $transactionType = $transaction->transactionType->name;

        $count = WarehouseTransaction::whereDate('created_at', $date)
            ->where('transaction_type_id', $transaction->transaction_type_id)
            ->count() + 1;
        
        $transaction->code = sprintf(
            "%s-%s-%d",
            Str::upper(str_replace(' ', '', $transactionType)),
            $date,
            $count
        );
    }
}
