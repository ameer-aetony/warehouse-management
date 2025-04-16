<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name','commercial_name','price','category_id'];

    public function category()
    {
        $this->belongsTo(ItemCategory::class, 'category_id');
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
