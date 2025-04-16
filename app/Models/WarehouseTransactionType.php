<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseTransactionType extends Model
{
    protected $fillable = ['name'];

    public function transactions()
    {
        return $this->hasMany(WarehouseTransaction::class);
    }
}
