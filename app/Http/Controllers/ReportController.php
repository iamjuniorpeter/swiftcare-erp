<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\InventoryReportExport;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GenericReportExport;
use App\Exports\Reports\StockSummaryExport;
use App\Exports\Reports\LowStockExport;
use App\Exports\Reports\StockMovementExport;
use App\Exports\Reports\TopMovingItemsExport;
use App\Exports\Reports\SlowMovingItemsExport;
use App\Exports\Reports\InventoryValuationExport;
use App\Exports\ImportUploadHistoryExport;
use App\Models\Item;
use App\Models\SalesOrderItem;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function download(Request $request)
    {
        $reportType = $request->input('report_type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        switch ($reportType) {
            case 'inventory':
                return Excel::download(new InventoryReportExport($startDate, $endDate), 'inventory-report.xlsx');

                // case 'sales':
                //return Excel::download(new SalesReportExport($startDate, $endDate), 'sales-report.xlsx');

                // Add more case statements for other report types.

            default:
                return back()->with('error', 'Invalid report type selected.');
        }
    }

    public function export(Request $request)
    {
        $reportType = $request->query('report_type');

        if (!$reportType) {
            return redirect()->back()->with('error', 'Please select a report type first.');
        }

        $data = $this->getReportData($reportType, $request);

        $filename = 'Report_' . ucfirst(str_replace('_', '', $reportType)) . '_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new GenericReportExport($data['records'], $reportType), $filename);
    }

    public function generateDownload(Request $request)
    {
        $reportType = $request->input('report_type');

        $fileName = match ($reportType) {
            'stock_summary' => 'Stock_Summary_Report_' . now()->format('YmdHis') . '.xlsx',
            'low_stock' => 'Low_Stock_Report_' . now()->format('YmdHis') . '.xlsx',
            'stock_movement' => 'Stock_Movement_Report_' . now()->format('YmdHis') . '.xlsx',
            'top_moving' => 'Top_Moving_Items_Report_' . now()->format('YmdHis') . '.xlsx',
            'slow_moving' => 'Slow_Moving_Items_Report_' . now()->format('YmdHis') . '.xlsx',
            'inventory_valuation' => 'Inventory_Valuation_Report_' . now()->format('YmdHis') . '.xlsx',
            'import_upload' => 'Import_Upload_History_Report_' . now()->format('YmdHis') . '.xlsx',
            default => 'Report_' . now()->format('YmdHis') . '.xlsx',
        };

        $exportClass = match ($reportType) {
            'stock_summary' => new StockSummaryExport($request),
            'low_stock' => new LowStockExport($request),
            'stock_movement' => new StockMovementExport($request),
            'top_moving' => new TopMovingItemsExport($request),
            'slow_moving' => new SlowMovingItemsExport($request),
            'inventory_valuation' => new InventoryValuationExport($request),
            //'import_upload' => new ImportUploadHistoryExport($request),
            default => null,
        };

        if ($exportClass) {
            return Excel::download($exportClass, $fileName);
        } else {
            return back()->with('error', 'Invalid report type selected.');
        }
    }

    // public function generate(Request $request)
    // {
    //     $reportType = $request->input('report_type');
    //     $report_period = 'for All Time';

    //     if ($request->start_date || $request->end_date) {
    //         $start = $request->start_date ? Carbon::parse($request->start_date)->format('jS M, Y') : 'beginning';
    //         $end = $request->end_date ? Carbon::parse($request->end_date)->format('jS M, Y') : 'today';
    //         $report_period = "from {$start} to {$end}";
    //     }


    //     $data = $this->getReportData($reportType, $request); // <-- shared method
    //     $view = match ($reportType) {
    //         'stock_summary'     => 'reports.exports.stock_summary',
    //         'low_stock'         => 'reports.exports.low_stock',
    //         'stock_movement'    => 'reports.exports.stock_movement',
    //         'top_moving'        => 'reports.exports.top_moving',
    //         'slow_moving'       => 'reports.exports.slow_moving',
    //         'inventory_valuation' => 'reports.exports.inventory_valuation',
    //         'import_history'    => 'reports.exports.import_upload_history',
    //         default             => null,
    //     };

    //     if (!$view) {
    //         return back()->with('error', 'Invalid report type selected.');
    //     }

    //     return view('reports.index', [
    //         'view' => $view,
    //         'records' => $data['records'] ?? [],
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //         'report_period' => $report_period,
    //     ]);
    // }

    public function generate(Request $request)
    {

        $reportType = $request->input('report_type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $start = $startDate ? Carbon::parse($startDate)->startOfDay() : null;
        $end = $endDate ? Carbon::parse($endDate)->endOfDay() : null;

        $merchantID = auth()->user()->accountID;

        $data = [];

        switch ($reportType) {
            case 'low_stock':
                //dd('Okat');
                $data = Item::withSum('batches', 'quantity')
                ->where('merchantID', $merchantID)
                ->havingRaw('IFNULL(batches_sum_quantity, 0) <= reorder_level')
                ->get();

                $view = 'reports.partials.low_stock';

                break;

            case 'top_moving':
                $data = Item::withCount([
                    'salesOrderItems as sales_count' => function ($query) use ($start, $end) {
                        if ($start) $query->where('created_at', '>=', $start);
                        if ($end) $query->where('created_at', '<=', $end);
                    }
                ])
                ->with([
                    'salesOrderItems' => function ($query) use ($start, $end) {
                        if ($start) $query->where('created_at', '>=', $start);
                        if ($end) $query->where('created_at', '<=', $end);
                    }
                ])
                ->where('merchantID', $merchantID)
                ->get()
                ->map(function ($item) {
                    $item->total_quantity_sold = $item->salesOrderItems->sum('quantity');

                    // FIX: use item's own selling_price for total sales value
                    $item->total_sales_value = $item->total_quantity_sold * $item->selling_price;

                    return $item;
                })
                ->sortByDesc('total_quantity_sold')
                ->take(10)
                ->values();


                $view = 'reports.partials.top_moving';
                break;

            case 'slow_moving':
                $data = Item::where('merchantID', $merchantID)
                ->with(['salesOrderItems' => function ($query) use ($start, $end) {
                    if ($start) $query->where('created_at', '>=', $start);
                    if ($end) $query->where('created_at', '<=', $end);
                }])
                ->get()
                ->map(function ($item) {
                    $item->sales_count = $item->salesOrderItems->count();
                    $item->total_quantity_sold = $item->salesOrderItems->sum('quantity');

                    // FIX: Multiply quantity by item's own selling_price
                    $item->total_sales_value = $item->total_quantity_sold * $item->selling_price;

                    return $item;
                })
                ->sortBy('sales_count') // Ascending for slow movers
                ->take(10)
                ->values();

                $view = 'reports.partials.slow_moving';
                break;

            case 'inventory_valuation':
                $data = Item::where('merchantID', $merchantID)
                    ->with(['batches' => function ($q) use ($start, $end) {
                        if ($start) $q->where('created_at', '>=', $start);
                        if ($end) $q->where('created_at', '<=', $end);
                    }])
                    ->get()
                    ->map(function ($item) {
                        $totalQty = $item->batches->sum('quantity');
                        $item->total_value = $totalQty * $item->cost_price;
                        $item->available_quantity = $totalQty;
                        return $item;
                    });
                $view = 'reports.partials.inventory_valuation';
                break;

            default:
                return back()->with('error', 'Invalid report type selected.');
        }

        return view('reports.index', compact('data', 'view'));
    }

    protected function getReportData($reportType, $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        switch ($reportType) {
            case 'stock_summary':
                $records = Item::with(['batches' => function ($q) use ($startDate, $endDate) {
                    if ($startDate) $q->where('created_at', '>=', $startDate);
                    if ($endDate) $q->where('created_at', '<=', $endDate);
                }, 'batches.usages'])->get()->map(function ($item) {
                    $stocked = $item->batches->sum('quantity');
                    $used = $item->batches->flatMap->usages->sum('quantity');
                    $available = $stocked - $used;

                    return (object)[
                        'name' => $item->name,
                        'cost_price' => $item->cost_price,
                        'quantity' => $available,
                        'status' => $available == 0
                            ? 'Out of Stock'
                            : ($available <= $item->reorder_level ? 'Low Stock' : 'In Stock')
                    ];
                });
                break;

            case 'low_stock':
                $records = Item::with(['batches' => function ($q) use ($startDate, $endDate) {
                    if ($startDate) $q->where('created_at', '>=', $startDate);
                    if ($endDate) $q->where('created_at', '<=', $endDate);
                }, 'batches.usages'])->get()->filter(function ($item) {
                    $stocked = $item->batches->sum('quantity');
                    $used = $item->batches->flatMap->usages->sum('quantity');
                    $available = $stocked - $used;

                    return $available <= $item->reorder_level;
                })->map(function ($item) {
                    $stocked = $item->batches->sum('quantity');
                    $used = $item->batches->flatMap->usages->sum('quantity');
                    $available = $stocked - $used;

                    return (object)[
                        'name' => $item->name,
                        'current_stock' => $available,
                        'reorder_level' => $item->reorder_level,
                        'suggested_reorder' => max(0, ($item->reorder_level * 2) - $available),
                        'unit' => optional($item->unit)->unit_name,
                    ];
                });
                break;

            case 'stock_movement':
                $records = SalesOrderItem::with(['item', 'salesOrder'])
                    ->when($startDate, fn($q) => $q->whereHas('salesOrder', fn($q2) => $q2->where('order_date', '>=', $startDate)))
                    ->when($endDate, fn($q) => $q->whereHas('salesOrder', fn($q2) => $q2->where('order_date', '<=', $endDate)))
                    ->latest()->get();
                break;

            case 'top_moving':
                $records = SalesOrderItem::select('itemID')
                    ->selectRaw('SUM(quantity) as total')
                    ->whereHas('salesOrder', function ($q) use ($startDate, $endDate) {
                        if ($startDate) $q->where('order_date', '>=', $startDate);
                        if ($endDate) $q->where('order_date', '<=', $endDate);
                    })
                    ->groupBy('itemID')
                    ->with('item')
                    ->orderByDesc('total')
                    ->take(10)
                    ->get();
                break;

            case 'slow_moving':
                $holdingRatePerDay = 0.01; // 1% of unit cost per day

                $items = Item::with([
                    'batches' => function ($query) use ($startDate, $endDate) {
                        if ($startDate) $query->where('created_at', '>=', $startDate);
                        if ($endDate) $query->where('created_at', '<=', $endDate);
                    },
                    'salesOrderItems' => function ($query) use ($startDate, $endDate) {
                        if ($startDate) $query->where('created_at', '>=', $startDate);
                        if ($endDate) $query->where('created_at', '<=', $endDate);
                    }
                ])->get();

                $records = $items->map(function ($item) use ($holdingRatePerDay) {
                    $stocked = $item->batches->sum('quantity');
                    $sold = $item->batches->flatMap->usages->sum('quantity');
                    $available = $stocked - $sold;

                    if ($available <= 0) return null;

                    $lastSale = $item->salesOrderItems->sortByDesc('created_at')->first();
                    $lastMovement = $lastSale?->created_at ?? $item->batches->max('created_at');

                    $daysIdle = $lastMovement ? Carbon::parse($lastMovement)->diffInDays(now()) : 0;
                    $holdingCost = $available * $item->cost_price * $daysIdle * $holdingRatePerDay;

                    return (object)[
                        'name' => $item->name,
                        'cost_price' => $item->cost_price,
                        'available_quantity' => $available,
                        'last_movement_date' => $lastMovement ? Carbon::parse($lastMovement)->toDateString() : 'N/A',
                        'days_idle' => $daysIdle,
                        'holding_cost_estimate' => round($holdingCost, 2),
                        'status' => 'Slow Moving',
                    ];
                })->filter();
                break;


            case 'inventory_valuation':
                $items = Item::with([
                    'batches' => function ($query) use ($startDate, $endDate) {
                        if ($startDate) $query->where('created_at', '>=', $startDate);
                        if ($endDate) $query->where('created_at', '<=', $endDate);
                    },
                    'category',
                    'batches.usages'
                ])->get();

                $records = $items->map(function ($item) {
                    $stocked = $item->batches->sum('quantity');
                    $used = $item->batches->flatMap->usages->sum('quantity');
                    $available = $stocked - $used;

                    return (object)[
                        'name' => $item->name,
                        'cost_price' => $item->cost_price,
                        'quantity' => $available,
                        'total_value' => $available * $item->cost_price,
                        'category_name' => $item->category->name ?? 'N/A',
                    ];
                })->filter(fn($r) => $r->quantity > 0); // Optional: hide zero-quantity rows
                break;


            // case 'import_history':
            //     $records = \App\Models\ImportLog::latest()->get(); // replace with your actual model
            //     break;

            default:
                $records = collect();
        }

        return ['records' => $records];
    }
}
