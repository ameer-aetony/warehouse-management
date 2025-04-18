<?php

namespace App\Services;

use App\Interfaces\InTransactionInterface;
use App\Interfaces\OutTransactionInterface;

class StockService
{
    public function __construct(
        private InTransactionInterface $inTransaction,
        private OutTransactionInterface $outTransaction
    ) {}
    
    
    /**
     * calculateStock display the item quantity income and outcome in  warehouse
     *
     * @param  string $itemId
     * @return array
     */
    public  function calculateStock(string $itemId): array
    {
      
        return [
         
            'in_stock' => $this->inTransaction->getAllIncoming($itemId),
            'out_stock' => $this->outTransaction->getAllOutcoming($itemId),
            'remaining' => $this->inTransaction->getAllIncoming($itemId) - $this->outTransaction->getAllOutcoming($itemId)
        ];
    }
    
    /**
     * getMovementItem to view item movements in a warehouse
     *
     * @param  string $itemId
     * @return array
     */
    public function getMovementItem(string $itemId): array
    {
        return [
            'total_in' => $this->inTransaction->itemIncome($itemId),
            'total_out' => $this->outTransaction->itemOutcome($itemId),
        ];
    }
}
