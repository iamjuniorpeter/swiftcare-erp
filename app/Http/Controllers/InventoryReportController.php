<?php

namespace App\Http\Controllers;

use App\Exports\StockSummaryExport;
use App\Exports\LowStockExport;
use App\Exports\StockMovementExport;
use App\Exports\TopMovingItemsExport;
use App\Exports\SlowMovingItemsExport;
use App\Exports\InventoryValuationExport;
use App\Exports\UploadHistoryExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InventoryReportController extends Controller
{
    public function index()
    {
        return view('inventory.reports.index');
    }

    public function export(Request $request)
    {
        $reportType = $request->report_type;

        switch ($reportType) {
            case 'stock_summary':
                return Excel::download(new StockSummaryExport($request), 'stock_summary.xlsx');
            case 'low_stock':
                return Excel::download(new LowStockExport($request), 'low_stock.xlsx');
            case 'stock_movement':
                return Excel::download(new StockMovementExport($request), 'stock_movement.xlsx');
            case 'top_moving_items':
                return Excel::download(new TopMovingItemsExport($request), 'top_moving_items.xlsx');
            case 'slow_moving_items':
                return Excel::download(new SlowMovingItemsExport($request), 'slow_moving_items.xlsx');
            case 'inventory_valuation':
                return Excel::download(new InventoryValuationExport($request), 'inventory_valuation.xlsx');
                //case 'upload_history':
                //return Excel::download(new UploadHistoryExport($request), 'upload_history.xlsx');
            default:
                return back()->with('error', 'Invalid report type selected.');
        }
    }
}
