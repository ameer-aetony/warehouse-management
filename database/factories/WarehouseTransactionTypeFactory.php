<?php

namespace Database\Factories;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WarehouseTransactionType>
 */
class WarehouseTransactionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $validTypes = ['in', 'out', 'adjustment in', 'adjustment out'];
        return [

                'name' => Arr::random($validTypes),
                'created_at' => now(),
                'updated_at' => now(),

        ];
    }
}
