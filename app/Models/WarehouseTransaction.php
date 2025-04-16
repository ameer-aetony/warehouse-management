<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseTransaction extends Model
{
    use HasFactory;
    
    protected $fillable = ['code', 'warehouse_id', 'transaction_type_id'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(WarehouseTransactionType::class);
    }

    public function inTransactions()
    {
        return $this->hasMany(InTransaction::class);
    }

    public function outTransactions()
    {
        return $this->hasMany(OutTransaction::class);
    }
}
