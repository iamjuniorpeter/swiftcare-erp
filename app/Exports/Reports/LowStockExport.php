<?php

namespace App\Exports\Reports;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\SalesOrderItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LowStockExport implements FromView
{
    public function view(): View
    {
        $items = Item::with(['batches.usages'])->get();

        $lowStockItems = $items->map(function ($item) {
            $totalStocked = $item->batches->sum('quantity');
            $totalUsed = $item->batches->flatMap(function ($batch) {
                return $batch->usages;
            })->sum('quantity');
            $available = $totalStocked - $totalUsed;

            $item->current_stock = $available;

            return $item;
        })->filter(fn($item) => $item->current_stock <= $item->reorder_level);

        return view('reports.exports.low_stock', compact('lowStockItems'));
    }
}
