<?php

namespace App\Exports\Reports;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\SalesOrderItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InventoryValuationExport implements FromView
{
    public function view(): View
    {
        $items = Item::with(['batches.usages'])->get();

        $items = $items->map(function ($item) {
            $totalStocked = $item->batches->sum('quantity');
            $totalUsed = $item->batches->flatMap(function ($batch) {
                return $batch->usages;
            })->sum('quantity');
            $available = $totalStocked - $totalUsed;

            $item->inventory_value = $available * $item->cost_price;

            return $item;
        });

        return view('reports.exports.inventory_valuation', compact('items'));
    }
}
