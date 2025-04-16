<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutTransaction extends Model
{
    use HasFactory;
    
    protected $fillable = ['item_id', 'quantity', 'warehouse_transaction_id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function warehouseTransaction()
    {
        return $this->belongsTo(WarehouseTransaction::class);
    }
}
