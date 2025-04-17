<?php

namespace Database\Factories;

use App\Models\Warehouse;
use App\Models\WarehouseTransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WarehouseTransaction>
 */
class WarehouseTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {    
        return [
            'warehouse_id'=> Warehouse::factory(),
            'transaction_type_id'=> WarehouseTransactionType::factory(),
            
        ];
    }
}
