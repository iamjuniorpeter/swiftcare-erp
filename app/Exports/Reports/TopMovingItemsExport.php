<?php

namespace App\Exports\Reports;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\SalesOrderItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TopMovingItemsExport implements FromView
{
    public function view(): View
    {
        $topItems = SalesOrderItem::selectRaw('itemID, SUM(quantity) as total_sold')
            ->groupBy('itemID')
            ->orderByDesc('total_sold')
            ->with('item')
            ->take(10)
            ->get();

        return view('reports.exports.top_moving', compact('topItems'));
    }
}
