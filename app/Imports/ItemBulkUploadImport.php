<?php

namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ItemBulkUploadImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Skip header manually if not using heading row concern
        $rows->skip(1)->each(function ($row) {
            Item::create([
                'item_id' => $this->generateUniqueId("ITM", 8),
                'merchantID' => auth()->user()->accountID,
                'item_code' => $this->generateUniqueId("CODE", 8),
                'name' => $row[0],
                'description' => $row[1] ?? null,
                'categoryID' => $row[2],
                'unitID' => $row[3],
                'cost_price' => $row[4] ?? 0,
                'selling_price' => $row[5] ?? 0,
                'reorder_level' => $row[6] ?? 0,
                'status' => $row[7] ?? 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }

    protected function generateUniqueId($ref = "", $limit = 6)
    {
        return $ref . "-" . substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
