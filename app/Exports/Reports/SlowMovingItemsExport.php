<?php

namespace App\Exports\Reports;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\SalesOrderItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SlowMovingItemsExport implements FromView
{
    public function view(): View
    {
        $items = Item::with(['batches' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->get();

        $slowMovingItems = $items->map(function ($item) {
            $lastMovement = $item->batches->sortByDesc('created_at')->first();
            $item->last_movement = $lastMovement ? $lastMovement->created_at : null;
            $item->days_idle = $lastMovement ? now()->diffInDays($lastMovement->created_at) : null;

            return $item;
        })->filter(fn($item) => $item->days_idle >= 30);

        return view('reports.exports.slow_moving', compact('slowMovingItems'));
    }
}
