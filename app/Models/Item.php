<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name','commercial_name','price','category_id'];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
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
