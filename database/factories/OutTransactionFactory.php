<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\WarehouseTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OutTransaction>
 */
class OutTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'warehouse_transaction_id' => WarehouseTransaction::factory(),
            'item_id' => Item::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'comment' => $this->faker->sentence(),
        ];
    }
}
