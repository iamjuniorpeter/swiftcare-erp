<?php

namespace App\Exports\Reports;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\SalesOrderItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StockSummaryExport implements FromView
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

            $item->quantity_on_hand = $available;
            $item->total_value = $available * $item->cost_price;
            $item->stock_status = $available == 0 ? 'Out of Stock' : ($available <= $item->reorder_level ? 'Low' : 'In Stock');

            return $item;
        });

        return view('reports.exports.stock_summary', compact('items'));
    }
}
