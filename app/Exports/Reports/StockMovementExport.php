<?php

namespace App\Exports\Reports;

use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\SalesOrderItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StockMovementExport implements FromView
{
    public function view(): View
    {
        $batches = ItemBatch::with('item')->get();

        return view('reports.exports.stock_movement', compact('batches'));
    }
}
