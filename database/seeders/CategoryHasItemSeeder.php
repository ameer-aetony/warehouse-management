<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemCategory;
use Database\Factories\ItemFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryHasItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemCategory::factory()->count(3)
        ->has(
            Item::factory()->count(30), 
            'items' 
        )->create();
    }
}
