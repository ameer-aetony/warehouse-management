<?php

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;

class GenerateItemCodes extends Command
{
    protected $signature = 'items:generate-code';
    protected $description = 'generate codes for existing items';

    public function handle()
    {
        $items = Item::all();
        foreach ($items as $item) {
            if (!$item->code) {
                $code = $this->generateItemCode($item);
                $item->code = $code;
                $item->save();
            }
        }
        return;
    }

    protected function generateItemCode(Item $item): string
    {

        $nameCharacter = strtoupper(substr($item->name, 0, 1));
        $category = $item->category;
        $categoryCharacter = strtoupper(substr($category->name, 0, 1) . substr($category->name, -1));

        $commercialCharacter = strtoupper(substr($item->commercial_name, 0, 1));

        $lengthCommercialCharacter = strlen($item->commercial_name);

        return $nameCharacter . $categoryCharacter . $commercialCharacter . '00' . $lengthCommercialCharacter;
    }
}
