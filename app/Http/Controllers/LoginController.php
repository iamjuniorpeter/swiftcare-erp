<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ModelController\CustomerController;
use App\Http\Controllers\ModelController\TransactionController;
use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerBankAccount;
use App\Models\CustomerNok;
use App\Models\CustomerSavingsPlan;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\SalesOrderItem;
use App\Models\SalesOrderBatchItem;
use Illuminate\Support\Carbon;
use App\Models\Transaction;
use App\Models\Unit;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //
    private $logged_in_user;
    private $account_type;
    private $account_role;
    private $account_category;
    private $account_id;


    public function __construct()
    {
        $this->logged_in_user = Auth::user();
        $this->account_type = Auth::user()?->accountType?->code;
        $this->account_role = Auth::user()?->accountRole?->cde;
        $this->account_category = Auth::user()?->accountCategory?->code;
        $this->account_id = Auth::user()?->accountID;
    }

    public function index()
    {
        return view('login');
    }

    public function myDashboard()
    {
        // $customer_obj = new CustomerController;
        // $transaction_obj = new TransactionController;

        // $total_customers = count($customer_obj->activeCustomers()->getData()->data);
        // $total_withdrawals = count($transaction_obj->getTransactionByType("debit")->getData()->data);
        // $total_deposit = count($transaction_obj->getTransactionByType("credit")->getData()->data);
        // $total_transactions = $total_withdrawals + $total_deposit;
        // $active_loans = 0;
        // $pending_loans = 0;
        // $completed_loans = 0;
        // $total_customers_percent = $total_customers;
        // $total_withdrawals_percent = ($total_transactions > 0) ? formatAmount(($total_withdrawals / $total_transactions) * 100, 2) : 0;
        // $total_deposit_percent = ($total_transactions > 0) ? formatAmount(($total_deposit / $total_transactions) * 100, 2) : 0;
        // $active_loans_percent = $active_loans;
        // $pending_loans_percent = $pending_loans;
        // $completed_loans_percent = $completed_loans;

        // $params = [
        //     "total_customers" => $total_customers,
        //     "total_withdrawals" => $total_withdrawals,
        //     "total_deposit" => $total_deposit,
        //     "active_loans" => $active_loans,
        //     "pending_loans" => $pending_loans,
        //     "completed_loans" => $completed_loans,
        //     "total_customers_percent" => $total_customers_percent,
        //     "total_withdrawals_percent" => $total_withdrawals_percent,
        //     "total_deposit_percent" => $total_deposit_percent,
        //     "active_loans_percent" => $active_loans_percent,
        //     "pending_loans_percent" => $pending_loans_percent,
        //     "completed_loans_percent" => $completed_loans_percent
        // ];

        // return view('staff.dashboard')->with($params); 

        // Total items
        $totalItems = Item::count();

        // Sum quantity across batches for each item
        $itemQuantities = Item::with('batches')->get()->map(function ($item) {
            $item->total_quantity = $item->batches->sum('quantity');
            return $item;
        });

        // Low stock & out-of-stock counts
        $lowStock = $itemQuantities->where(fn($i) => $i->total_quantity > 0 && $i->total_quantity <= $i->reorder_level)->count();
        $outOfStock = $itemQuantities->where('total_quantity', 0)->count();

        // Fast moving items (example: you could base this on batch usage rate or custom logic)
        $fastMoving = SalesOrderItem::whereHas('salesOrder', function ($q) {
            $q->where('order_date', '>=', now()->subDays(30));
        })
            ->selectRaw('itemID, SUM(quantity) as total_sold')
            ->groupBy('itemID')
            ->having('total_sold', '>', 100) // adjust threshold
            ->pluck('itemID')
            ->count();

        // Low stock items list
        $lowStockItems = $itemQuantities
            ->filter(fn($i) => $i->total_quantity <= $i->reorder_level)
            ->sortBy('total_quantity')
            ->take(10);


        // Months (last 12 months)
        $months = collect(range(0, 11))->map(fn($m) => now()->subMonths($m)->format('Y-m'))->reverse();
        $monthLabels = $months->map(fn($m) => Carbon::parse($m)->format('M'));

        $stockIn = [];
        $stockOut = [];

        foreach ($months as $month) {
            $start = Carbon::parse($month)->startOfMonth();
            $end   = Carbon::parse($month)->endOfMonth();

            $stockIn[] = ItemBatch::whereBetween('created_at', [$start, $end])->sum('quantity');

            $stockOut[] = SalesOrderBatchItem::whereHas('orderItem.salesOrder', function ($q) use ($start, $end) {
                $q->whereBetween('order_date', [$start, $end]);
            })->sum('quantity');
        }

        // Reorder trends
        $reorderTrends = $months->map(function ($month) {
            $end = Carbon::parse($month)->endOfMonth();

            $items = Item::with(['batches' => function ($q) use ($end) {
                $q->where('created_at', '<=', $end);
            }])->get();

            return $items->filter(fn($item) => $item->batches->sum('quantity') <= $item->reorder_level)->count();
        });

        // Top selling products (last 3 months)
        $topSelling = SalesOrderItem::selectRaw('itemID, SUM(quantity) as total_sold')
            ->whereHas('salesOrder', fn($q) => $q->where('order_date', '>=', now()->subMonths(3)))
            ->groupBy('itemID')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('item') // assumes item() relation
            ->get();

        $topSellingLabels = $topSelling->pluck('item.name');
        $topSellingData = $topSelling->pluck('total_sold');


        return view('inventory.dashboard', [
            'stats' => [
                'totalItems'     => number_format($totalItems),
                'lowStockAlerts' => number_format($lowStock),
                'outOfStock'     => number_format($outOfStock),
                'fastMoving'     => number_format($fastMoving),
            ],
            'lowStockItems' => $lowStockItems,
            'months'            => $monthLabels,
            'stockIn'           => $stockIn,
            'stockOut'          => $stockOut,
            'reorderTrends'     => $reorderTrends,
            'topSellingLabels'  => $topSellingLabels,
            'topSellingData'    => $topSellingData,
        ]);
    }


    /**
     * Display a listing of the inventory dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function InventoryDashboard()
    {
        // Total items
        $totalItems = Item::count();

        // Sum quantity across batches for each item
        $itemQuantities = Item::with('batches')->get()->map(function ($item) {
            $item->total_quantity = $item->batches->sum('quantity');
            return $item;
        });

        // Low stock & out-of-stock counts
        $lowStock = $itemQuantities->where(fn($i) => $i->total_quantity > 0 && $i->total_quantity <= $i->reorder_level)->count();
        $outOfStock = $itemQuantities->where('total_quantity', 0)->count();

        // Fast moving items (example: you could base this on batch usage rate or custom logic)
        $fastMoving = SalesOrderItem::whereHas('salesOrder', function ($q) {
            $q->where('order_date', '>=', now()->subDays(30));
        })
            ->selectRaw('itemID, SUM(quantity) as total_sold')
            ->groupBy('itemID')
            ->having('total_sold', '>', 100) // adjust threshold
            ->pluck('itemID')
            ->count();

        // Low stock items list
        $lowStockItems = $itemQuantities
            ->filter(fn($i) => $i->total_quantity <= $i->reorder_level)
            ->sortBy('total_quantity')
            ->take(10);


        // Months (last 12 months)
        $months = collect(range(0, 11))->map(fn($m) => now()->subMonths($m)->format('Y-m'))->reverse();
        $monthLabels = $months->map(fn($m) => Carbon::parse($m)->format('M'));

        $stockIn = [];
        $stockOut = [];

        foreach ($months as $month) {
            $start = Carbon::parse($month)->startOfMonth();
            $end   = Carbon::parse($month)->endOfMonth();

            $stockIn[] = ItemBatch::whereBetween('created_at', [$start, $end])->sum('quantity');

            $stockOut[] = SalesOrderBatchItem::whereHas('orderItem.salesOrder', function ($q) use ($start, $end) {
                $q->whereBetween('order_date', [$start, $end]);
            })->sum('quantity');
        }

        // Reorder trends
        $reorderTrends = $months->map(function ($month) {
            $end = Carbon::parse($month)->endOfMonth();

            $items = Item::with(['batches' => function ($q) use ($end) {
                $q->where('created_at', '<=', $end);
            }])->get();

            return $items->filter(fn($item) => $item->batches->sum('quantity') <= $item->reorder_level)->count();
        });

        // Top selling products (last 3 months)
        $topSelling = SalesOrderItem::selectRaw('itemID, SUM(quantity) as total_sold')
            ->whereHas('salesOrder', fn($q) => $q->where('order_date', '>=', now()->subMonths(3)))
            ->groupBy('itemID')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('item') // assumes item() relation
            ->get();

        $topSellingLabels = $topSelling->pluck('item.name');
        $topSellingData = $topSelling->pluck('total_sold');


        return view('inventory.dashboard', [
            'stats' => [
                'totalItems'     => number_format($totalItems),
                'lowStockAlerts' => number_format($lowStock),
                'outOfStock'     => number_format($outOfStock),
                'fastMoving'     => number_format($fastMoving),
            ],
            'lowStockItems' => $lowStockItems,
            'months'            => $monthLabels,
            'stockIn'           => $stockIn,
            'stockOut'          => $stockOut,
            'reorderTrends'     => $reorderTrends,
            'topSellingLabels'  => $topSellingLabels,
            'topSellingData'    => $topSellingData,
        ]);
    }

    /**
     * Display a listing of the inventory items.
     *
     * @return \Illuminate\View\View
     */
    public function InventoryIndex()
    {
        $inventory = Inventory::all();
        return view('inventory.index', compact('inventory'));
    }

    /**
     * Show the form for creating a new inventory record.
     *
     * @return \Illuminate\View\View
     */
    public function InventoryCreate()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created inventory record in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function InventoryStore(Request $request)
    {
        // Validate the incoming request data.
        $validated = $request->validate([
            'inventory_id' => 'required|unique:tbl_iv_inventory,inventory_id',
            'merchantID'   => 'required',
            'itemID'       => 'required',
            'warehouseID'  => 'required',
            'quantity'     => 'required|numeric',
        ]);

        // Create the new inventory record.
        Inventory::create($validated);

        // Redirect back to the inventory list with a success message.
        return redirect()->route('inventory.inventory.index')
            ->with('success', 'Inventory record created successfully.');
    }

    /**
     * Display the specified inventory record.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function InventoryShow($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventory.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified inventory record.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function InventoryEdit($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * Update the specified inventory record in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function InventoryUpdate(Request $request, $id)
    {
        // Validate the incoming request; you may include more fields if needed.
        $validated = $request->validate([
            'quantity' => 'required|numeric',
            // Add any other fields that need to be updated.
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->update($validated);

        return redirect()->route('inventory.inventory.index')
            ->with('success', 'Inventory record updated successfully.');
    }

    /**
     * Remove the specified inventory record from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function InventoryDestroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventory.inventory.index')
            ->with('success', 'Inventory record deleted successfully.');
    }



    public function ItemIndex()
    {
        $merchant_id = Auth::user()->accountID;

        $items = Item::where("merchantID", $merchant_id)->with(['batches.usages'])->get()->map(function ($item) {
            $totalStocked = 0;
            $totalUsed = 0;

            foreach ($item->batches as $batch) {
                $totalStocked += $batch->quantity;
                $totalUsed += $batch->usages->sum('quantity');
            }

            $item->available_quantity = $totalStocked - $totalUsed;

            return $item;
        });

        return view('items.index', compact('items'));
    }

    public function ItemCreate()
    {
        $merchant_id = Auth::user()->accountID;

        $categories = Category::where("merchantID", $merchant_id)->get();
        $units      = Unit::where("merchantID", $merchant_id)->get();
        $locations      = Warehouse::where("merchantID", $merchant_id)->get();
        return view('items.create', compact('categories', 'units', 'locations'));
    }

    public function ItemStore(Request $request)
    {
        $data  = $request->all();
        $rules = [
            //'item_id'      => ['required', 'unique:tbl_iv_items,item_id'],
            'merchantID'   => ['required'],
            //'item_code'    => ['required', 'unique:tbl_iv_items,item_code'],
            'name'         => ['required'],
            'description'  => ['sometimes'],
            'categoryID'   => ['sometimes'],
            'unitID'       => ['sometimes'],
            'status'       => ['sometimes'],
            'cost_price'   => ['sometimes', 'numeric'],
            'selling_price' => ['sometimes', 'numeric'],
            'barcode'      => ['sometimes'],
            'reorder_level' => ['sometimes', 'numeric'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        // if user didn't supply one, generate it
        if (empty($data['item_id'])) {
            $data['item_id'] = $this->generateUniqueId("ITM", 8);
        }

        // if user didn't supply one, generate it
        if (empty($data['item_code'])) {
            $data['item_code'] = $this->generateUniqueId("CODE", 8);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $item = Item::create([
                    'item_id'       => $data['item_id'],
                    'merchantID'    => $data['merchantID'],
                    'item_code'     => $data['item_code'],
                    'name'          => $data['name'],
                    'description'   => $data['description'] ?? null,
                    'categoryID'    => $data['categoryID'] ?? null,
                    'unitID'        => $data['unitID'] ?? null,
                    'status'        => $data['status'] ?? 'active',
                    'cost_price'    => $data['cost_price'] ?? 0,
                    'selling_price' => $data['selling_price'] ?? 0,
                    'barcode'       => $data['barcode'] ?? null,
                    'reorder_level' => $data['reorder_level'] ?? 0,
                ]);
                return $this->successResponse("Item successfully created.", $item);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating item.", $e->getMessage(), 201);
        }
    }

    public function ItemShow($id)
    {
        try {
            $item = Item::find($id);
            if (!$item) {
                return $this->errorResponse("Item not found.", [], 201);
            }
            return $this->successResponse("Item retrieved successfully.", $item);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving item.", $e->getMessage(), 201);
        }
    }

    public function ItemUpdate(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'name'         => ['required'],
            'description'  => ['sometimes'],
            'categoryID'   => ['sometimes'],
            'unitID'       => ['sometimes'],
            'status'       => ['sometimes'],
            'cost_price'   => ['sometimes', 'numeric'],
            'selling_price' => ['sometimes', 'numeric'],
            'barcode'      => ['sometimes'],
            'reorder_level' => ['sometimes', 'numeric'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data, $id) {
                $item = Item::find($id);
                if (!$item) {
                    return $this->errorResponse("Item not found.", [], 201);
                }
                $item->update([
                    'name'          => $data['name'],
                    'description'   => $data['description'] ?? $item->description,
                    'categoryID'    => $data['categoryID'] ?? $item->categoryID,
                    'unitID'        => $data['unitID'] ?? $item->unitID,
                    'status'        => $data['status'] ?? $item->status,
                    'cost_price'    => $data['cost_price'] ?? $item->cost_price,
                    'selling_price' => $data['selling_price'] ?? $item->selling_price,
                    'barcode'       => $data['barcode'] ?? $item->barcode,
                    'reorder_level' => $data['reorder_level'] ?? $item->reorder_level,
                ]);
                return $this->successResponse("Item successfully updated.", $item);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating item.", $e->getMessage(), 201);
        }
    }

    public function ItemEdit($id)
    {
        // Fetch the item (or 404)
        $item = Item::findOrFail($id);

        // Lookup lists for dropdowns
        $categories = Category::all();
        $units      = Unit::all();

        // Return the edit view with data
        return view('items.edit', compact('item', 'categories', 'units'));
    }

    public function ItemDestroy($id)
    {
        try {
            $item = Item::find($id);
            if (!$item) {
                return $this->errorResponse("Item not found.", [], 201);
            }
            DB::transaction(function () use ($item) {
                $item->delete();
            });
            return $this->successResponse("Item successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting item.", $e->getMessage(), 201);
        }
    }

    public function myAppointment()
    {
        $customer_obj = new CustomerController;
        $transaction_obj = new TransactionController;

        $total_customers = count($customer_obj->activeCustomers()->getData()->data);
        $total_withdrawals = count($transaction_obj->getTransactionByType("debit")->getData()->data);
        $total_deposit = count($transaction_obj->getTransactionByType("credit")->getData()->data);
        $total_transactions = $total_withdrawals + $total_deposit;
        $active_loans = 0;
        $pending_loans = 0;
        $completed_loans = 0;
        $total_customers_percent = $total_customers;
        $total_withdrawals_percent = ($total_transactions > 0) ? formatAmount(($total_withdrawals / $total_transactions) * 100, 2) : 0;
        $total_deposit_percent = ($total_transactions > 0) ? formatAmount(($total_deposit / $total_transactions) * 100, 2) : 0;
        $active_loans_percent = $active_loans;
        $pending_loans_percent = $pending_loans;
        $completed_loans_percent = $completed_loans;

        $params = [
            "total_customers" => $total_customers,
            "total_withdrawals" => $total_withdrawals,
            "total_deposit" => $total_deposit,
            "active_loans" => $active_loans,
            "pending_loans" => $pending_loans,
            "completed_loans" => $completed_loans,
            "total_customers_percent" => $total_customers_percent,
            "total_withdrawals_percent" => $total_withdrawals_percent,
            "total_deposit_percent" => $total_deposit_percent,
            "active_loans_percent" => $active_loans_percent,
            "pending_loans_percent" => $pending_loans_percent,
            "completed_loans_percent" => $completed_loans_percent
        ];

        return view('staff.book-appointment')->with($params);
    }

    public function myWallet()
    {
        $customer_obj = new CustomerController;
        $transaction_obj = new TransactionController;

        $total_customers = count($customer_obj->activeCustomers()->getData()->data);
        $total_withdrawals = count($transaction_obj->getTransactionByType("debit")->getData()->data);
        $total_deposit = count($transaction_obj->getTransactionByType("credit")->getData()->data);
        $total_transactions = $total_withdrawals + $total_deposit;
        $active_loans = 0;
        $pending_loans = 0;
        $completed_loans = 0;
        $total_customers_percent = $total_customers;
        $total_withdrawals_percent = ($total_transactions > 0) ? formatAmount(($total_withdrawals / $total_transactions) * 100, 2) : 0;
        $total_deposit_percent = ($total_transactions > 0) ? formatAmount(($total_deposit / $total_transactions) * 100, 2) : 0;
        $active_loans_percent = $active_loans;
        $pending_loans_percent = $pending_loans;
        $completed_loans_percent = $completed_loans;

        $params = [
            "total_customers" => $total_customers,
            "total_withdrawals" => $total_withdrawals,
            "total_deposit" => $total_deposit,
            "active_loans" => $active_loans,
            "pending_loans" => $pending_loans,
            "completed_loans" => $completed_loans,
            "total_customers_percent" => $total_customers_percent,
            "total_withdrawals_percent" => $total_withdrawals_percent,
            "total_deposit_percent" => $total_deposit_percent,
            "active_loans_percent" => $active_loans_percent,
            "pending_loans_percent" => $pending_loans_percent,
            "completed_loans_percent" => $completed_loans_percent
        ];

        return view('staff.wallet')->with($params);
    }

    public function addTransaction()
    {
        $customers_list = [];
        $account_type = Auth::user()?->accountType?->code;
        $account_id = Auth::user()?->accountID;

        if ($account_type == "admin") {
            $customers_list = $this->loadActiveCustomersIntoCombo();
        } else {
            $customers_list = $this->loadStaffActiveCustomersIntoCombo($account_id);
        }

        $transaction_type_list = $this->loadTransactionTypeIntoCombo();
        $transaction_mode_list = $this->loadTransactionModeIntoCombo();
        $staff_list = $this->loadActiveStaffIntoCombo();
        //$savings_plan_list = $this->loadActiveSavingsPlanIntoCombo();
        $savings_plan_list = "";

        $params = [
            "customers_list" => $customers_list,
            "transaction_type_list" => $transaction_type_list,
            "transaction_mode_list" => $transaction_mode_list,
            "staff_list" => $staff_list,
            "savings_plan_list" => $savings_plan_list,
        ];

        return view('staff.add-transaction')->with($params);
    }

    public function editTransaction($transaction_reference)
    {
        $transaction_obj = new TransactionController;
        $transaction_record = $transaction_obj->get($transaction_reference)->getData()->data;
        //dd($transaction_record);

        if (count($transaction_record) < 1) {
            return $this->errorResponse("Oops!!! Invalid Request: ", ['errors' => $transaction_record], 201);
        }

        $transaction_record = $transaction_record[0];

        if ($transaction_record->status == "pending" || $transaction_record->status == "rejected" || $transaction_record->status == "approved") {
            return Redirect::route('transaction.view', 'pending');
        }

        $customers_list = [];
        $account_type = Auth::user()?->accountType?->code;
        $account_id = Auth::user()?->accountID;

        if ($account_type == "admin") {
            $customers_list = $this->loadActiveCustomersIntoCombo($transaction_record->customer_accountID);
        } else {
            $customers_list = $this->loadStaffActiveCustomersIntoCombo($account_id, $transaction_record->customer_accountID);
        }

        $transaction_type_list = $this->loadTransactionTypeIntoCombo($transaction_record->trans_typeID);
        $transaction_mode_list = $this->loadTransactionModeIntoCombo($transaction_record->trans_modeID);
        $staff_list = $this->loadActiveStaffIntoCombo($transaction_record->account_officerID);
        $savings_plan_list = $this->loadActiveSavingsPlanIntoCombo($transaction_record->savings_planID);
        //$savings_plan_list = "";

        $params = [
            "customers_list" => $customers_list,
            "transaction_type_list" => $transaction_type_list,
            "transaction_mode_list" => $transaction_mode_list,
            "staff_list" => $staff_list,
            "savings_plan_list" => $savings_plan_list,
            "record" => $transaction_record,
        ];

        return view('staff.edit-transaction')->with($params);
    }

    public function viewTransaction($status)
    {
        $transaction_obj = new TransactionController();
        $transaction_records = [];
        $logged_in_user = Auth::user();
        $account_type = Auth::user()?->accountType?->code;
        $account_id = Auth::user()?->accountID;
        $staff_list = $this->loadActiveStaffIntoCombo();

        if ($account_type == "admin") {
            $transaction_records = $transaction_obj->getTransactionByStatus(strtolower($status))->getData()->data;
            $total_amount = $transaction_obj->getTransactionTotalByStatus(strtolower($status))->getData()->data;
        } else {
            $transaction_records = $transaction_obj->getTransactionByStatusAndAccountOfficer(strtolower($status), $account_id)->getData()->data;
            $total_amount = $transaction_obj->getTransactionTotalByStatusAndAccountOfficer(strtolower($status), $account_id)->getData()->data;
        }

        $params = [
            "status" => ucwords($status),
            "transaction_records" => $transaction_records,
            "total_amount" => $total_amount,
            "staff_list" => $staff_list,
            "logged_in_user" => $logged_in_user
        ];

        //dd($totalAmount);

        return view('staff.view-transaction')->with($params);
    }

    public function filterTransaction(Request $request)
    {

        $data = $request->all();
        //dd($data);
        $rules = [
            'filter_type' =>  ['required'],
            'account_officer' =>  ['sometimes'],
            'date_from' =>  ['sometimes'],
            'date_to' =>  ['sometimes'],
            'status' =>  ['required'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        $filter_type = $data['filter_type'];
        $account_officer = $data['account_officer'] ?? "";
        $date_from = $data['date_from'] ?? "";
        $date_to = $data['date_to'] ?? "";
        $status = $data["status"];

        $transaction_obj = new TransactionController();

        $logged_in_user = Auth::user();
        $account_type = Auth::user()?->accountType?->code;
        $account_id = Auth::user()?->accountID;
        $staff_list = $this->loadActiveStaffIntoCombo();

        switch ($filter_type) {
            case 'account-officer':
                $transaction_records = $transaction_obj->getTransactionByStatusAndAccountOfficer(strtolower($status), $account_officer)->getData()->data;
                // Calculate the sum total of the amount
                $total_amount = $transaction_obj->getTransactionTotalByStatusAndAccountOfficer(strtolower($status), $account_officer)->getData()->data;

                break;

            case 'transaction-date':
                $transaction_records = $transaction_obj->getTransactionByStatusAndTransactionDate(strtolower($status), $date_from, $date_to)->getData()->data;
                // Calculate the sum total of the amount
                $total_amount = $transaction_obj->getTransactionTotalByStatusAndTransactionDate(strtolower($status), $date_from, $date_to)->getData()->data;

                break;

            default:
                if ($account_type == "admin") {
                    $transaction_records = $transaction_obj->getTransactionByStatus(strtolower($status))->getData()->data;
                    $total_amount = $transaction_obj->getTransactionTotalByStatus(strtolower($status))->getData()->data;
                } else {
                    $transaction_records = $transaction_obj->getTransactionByStatusAndAccountOfficer(strtolower($status), $account_id)->getData()->data;
                    $total_amount = $transaction_obj->getTransactionTotalByStatusAndAccountOfficer(strtolower($status), $account_id)->getData()->data;
                }
                break;
        }

        $params = [
            "status" => ucwords($status),
            "account_officer" => $account_officer,
            "transaction_records" => $transaction_records,
            "total_amount" => $total_amount,
            "staff_list" => $staff_list,
            "logged_in_user" => $logged_in_user
        ];

        //dd($totalAmount);

        return view('staff.view-transaction')->with($params);
    }

    public function saveTransaction(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $rules = [
            'customer_account' =>  ['required'],
            'trans_type' =>  ['required'],
            'trans_mode' =>  ['required'],
            'savings_plan' =>  ['required'],
            'amount' =>  ['required'],
            'description' =>  ['sometimes'],
            'account_officer' =>  ['required'],
            'action' =>  ['required'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        $customer_account = $data['customer_account'];
        $trans_type = $data["trans_type"];
        $trans_mode = $data["trans_mode"];
        $savings_plan = $data["savings_plan"];
        $amount = $data["amount"];
        $description = $data['description'] ?? NULL;
        $account_officer = $data['account_officer'];
        $action = $data['action'];
        $status = "pending";
        $trans_reference = $this->generateUuid();

        $payment_insert_query = [
            'trans_reference' => $trans_reference,
            'customer_accountID' => $customer_account,
            'trans_typeID' => $trans_type,
            'trans_modeID' => $trans_mode,
            'savings_planID' => $savings_plan,
            'amount' => $amount,
            'status' => $status,
            'description' => $description,
            'account_officerID' => $account_officer,
            'created_at' => now(),
        ];

        if (strtolower($action) == "edit") {
            $payment_insert_query = [
                'customer_accountID' => $customer_account,
                'trans_typeID' => $trans_type,
                'trans_modeID' => $trans_mode,
                'savings_planID' => $savings_plan,
                'amount' => $amount,
                'status' => $status,
                'description' => $description,
                'account_officerID' => $account_officer,
                'updated_at' => now(),
            ];

            $trans_reference = $data['trans_reference'];
        }

        try {

            $transactionResult = DB::transaction(function () use (
                $action,
                $trans_reference,
                $payment_insert_query,
                $trans_type,
                $customer_account,
                $savings_plan,
                $amount,
            ) {

                if (strtolower($action) == "add") {
                    Transaction::insert($payment_insert_query);
                } elseif (strtolower($action) == "edit") {
                    Transaction::where('trans_reference', $trans_reference)
                        ->update($payment_insert_query);
                    // $transaction = Transaction::where('trans_reference', $trans_reference)->first();

                    // if ($transaction) {
                    //     // Update the attributes of the transaction
                    //     $transaction->fill($payment_insert_query);

                    //     // Save the changes to the database
                    //     $transaction->save();
                    // } else {
                    //     return $this->errorResponse("Invalid Request. Process Terminated", "", 201);
                    // }
                } else {
                    return $this->errorResponse("Invalid Request. Contact Administrator", "", 201);
                }

                return $this->successResponse("Request successfully saved");

                // $response = $this->updateCustomerBalance($trans_type, $customer_account, $savings_plan, $amount)->getData();
                // //dd($response);
                // if($response->status == "success"){         
                //     return $this->successResponse("Request successfully saved");
                // }else{
                //     return $this->errorResponse("Something went wrong. Request Timed out", $response, 201);
                // }
            });

            return $transactionResult;
        } catch (\Exception $e) {
            // Error occurred while inserting records
            $errorMessage = $e->getMessage();
            //dd($errorMessage);
            // Handle the error notification to the user
            return $this->errorResponse("Error encountered while saving record", $errorMessage, 201);
        }
    }

    public function updateTransactionStatus($transaction_reference, $status)
    {
        $transaction_obj = new TransactionController;
        $transaction_record = $transaction_obj->get($transaction_reference)->getData()->data;
        //dd($transaction_record);

        if (count($transaction_record) < 1) {
            return $this->errorResponse("Oops!!! No record found: ", ['errors' => $transaction_record], 201);
        }

        $record_to_update = [
            "status" => $status
        ];

        try {

            $transactionResult = DB::transaction(function () use (
                $status,
                $transaction_reference,
                $record_to_update,
            ) {
                $updatedRecord = tap(
                    Transaction::where('trans_reference', $transaction_reference)->first(),
                    function ($transaction) use ($record_to_update) {
                        $transaction->update($record_to_update);
                    }
                );


                if (strtolower($status) == "approved") {
                    CustomerSavingsPlan::where('customer_accountID', $updatedRecord->customer_accountID)
                        ->where('savings_planID', $updatedRecord->savings_planID)
                        ->increment('balance', $updatedRecord->amount);
                }

                return $this->successResponse("Request successfully saved");
            });

            return $transactionResult;
        } catch (\Exception $e) {
            // Error occurred while inserting records
            $errorMessage = $e->getMessage();
            //dd($errorMessage);
            // Handle the error notification to the user
            return $this->errorResponse("Error encountered while saving record", $errorMessage, 201);
        }
    }

    public function updateBulkTransactionStatus(Request $request)
    {
        $transaction_obj = new TransactionController;

        // Validate request
        $request->validate([
            'selectedTransactions' => 'required|array',
            'status' => 'required'
        ]);

        $transaction_references = $request->selectedTransactions;
        $transaction_status = $request->status;

        $record_to_update = [
            "status" => $transaction_status
        ];

        try {
            foreach ($transaction_references as $transactionId) {
                $transaction_record = $transaction_obj->get($transactionId)->getData()->data;
                //dd($transaction_record);

                if (count($transaction_record) < 1) {
                    continue;
                }

                Transaction::where('trans_reference', $transactionId)->update($record_to_update);
            }

            return $this->successResponse("Request successfully saved");
        } catch (\Exception $e) {
            // Error occurred while inserting records
            $errorMessage = $e->getMessage();
            //dd($errorMessage);
            // Handle the error notification to the user
            return $this->errorResponse("Error encountered while saving record", $errorMessage, 201);
        }
    }

    public function getCustomerSavingsPlan($customer_id)
    {
        $response = $this->loadCustomerActiveSavingsPlanIntoCombo($customer_id);
        return $this->successResponse($response);
    }

    public function addCustomer()
    {
        $account_type = Auth::user()?->accountType?->code;
        $account_id = Auth::user()?->accountID;

        $staff_list = $this->loadActiveStaffIntoCombo();
        $state_list = $this->loadStatesIntoCombo();
        $bank_list = $this->loadBanksIntoCombo();
        $savings_plan_list = $this->loadActiveSavingsPlanIntoCombo();
        $zone_list = $this->loadActiveZonesIntoCombo();
        $gender_list = $this->loadGenderIntoCombo();
        $marital_status_list = $this->loadMaritalStatusIntoCombo();

        $params = [
            "gender_list" => $gender_list,
            "marital_status_list" => $marital_status_list,
            "staff_list" => $staff_list,
            "zone_list" => $zone_list,
            "states_list" => $state_list,
            "banks_list" => $bank_list,
            "savings_plans_list" => $savings_plan_list,
            "customer_record" => null,
            "user_action" => "add",
        ];

        return view('customer.add-customer')->with($params);
    }

    public function viewCustomer($status)
    {
        $customer_obj = new CustomerController;
        $customer_records = [];
        $logged_in_user = Auth::user();
        $account_type = Auth::user()?->accountType?->code;
        $account_id = Auth::user()?->accountID;
        $staff_list = $this->loadActiveStaffIntoCombo();
        $sta = "";

        switch ($status) {
            case 'all':
                $sta = "all";
                break;

            case 'in-progress':
                $sta = "pending";
                break;

            case 'confirmed':
                $sta = "active";
                break;

            default:
                $sta = $status;
                break;
        }

        if ($account_type == "admin") {
            $customer_records = $customer_obj->getAllCustomers(strtolower($sta))->getData()->data;
        } else {
            $customer_records = $customer_obj->getCustomersByAccountOfficer($account_id, strtolower($sta))->getData()->data;
        }

        $params = [
            "status" => ucwords($status),
            "customer_records" => $customer_records,
            "staff_list" => $staff_list,
            "total_customers" => count($customer_records),
            "logged_in_user" => $logged_in_user
        ];

        //dd($params);

        return view('customer.view-customer')->with($params);
    }

    public function saveCustomer(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $rules = [
            'formUpdate' => ['required'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        $form_update = $data['formUpdate'];
        $action = $data['action'];
        $model = null;

        switch ($form_update) {
            case 'personal-data':
                $rules = [
                    'account_no' =>  ['required'],
                    'old_account_no' =>  ['sometimes'],
                    'surname' =>  ['required'],
                    'other_names' =>  ['required'],
                    'phone_1' =>  ['required'],
                    'phone_2' =>  ['sometimes'],
                    'gender' =>  ['required'],
                    'marital_status' =>  ['required'],
                    'date_of_birth' =>  ['required'],
                    'mothers_maiden_name' =>  ['sometimes'],
                    'state_of_originID' =>  ['sometimes'],
                    'lga_of_originID' =>  ['sometimes'],
                    'account_officerID' =>  ['required'],
                    'remark' =>  ['sometimes'],
                    'is_employed' =>  ['required'],
                    'zoneID' =>  ['required'],
                    'avatar' =>  ['sometimes'],
                ];

                $validation = $this->validateData($data, $rules);

                if ($validation->fails()) {
                    return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
                }

                $customer_account_id = $data['customer_account_id'] ?? $this->generateUuid();
                $account_no = $data["account_no"];
                $old_account_no = $data["old_account_no"];
                $surname = $data["surname"];
                $other_names = $data["other_names"];
                $phone_1 = $data['phone_1'];
                $phone_2 = $data['phone_2'] ?? NULL;
                $gender = $data['gender'];
                $marital_status = $data['marital_status'];
                $date_of_birth = $data['date_of_birth'];
                $mothers_maiden_name = $data['mothers_maiden_name'] ?? NULL;
                $state_of_originID = $data['state_of_originID'] ?? NULL;
                $lga_of_originID = $data['lga_of_originID'] ?? NULL;
                $account_officerID = $data['account_officerID'];
                $remark = $data['remark'];
                $is_employed = $data['is_employed'];
                $zoneID = $data['zoneID'] ?? NULL;
                $avatar = $data['avatar'] ?? NULL;
                $action = $data['action'];
                $status = $data['status'];

                $customer_insert_query = [
                    'account_id' => $customer_account_id,
                    'account_no' => $account_no,
                    'old_account_no' => $old_account_no,
                    'surname' => $surname,
                    'other_names' => $other_names,
                    'phone_1' => $phone_1,
                    'phone_2' => $phone_2,
                    'gender' => $gender,
                    'marital_status' => $marital_status,
                    'date_of_birth' => $date_of_birth,
                    'mothers_maiden_name' => $mothers_maiden_name,
                    'state_of_originID' => $state_of_originID,
                    'lga_of_originID' => $lga_of_originID,
                    'account_officerID' => $account_officerID,
                    'remark' => $remark,
                    'is_employed' => $is_employed,
                    'zoneID' => $zoneID,
                    'avatar' => $avatar,
                    'status' => "Pending",
                    'created_at' => now(),
                ];

                if (strtolower($action) == "edit") {
                    $customer_insert_query = [
                        'account_no' => $account_no,
                        'old_account_no' => $old_account_no,
                        'surname' => $surname,
                        'other_names' => $other_names,
                        'phone_1' => $phone_1,
                        'phone_2' => $phone_2,
                        'gender' => $gender,
                        'marital_status' => $marital_status,
                        'date_of_birth' => $date_of_birth,
                        'mothers_maiden_name' => $mothers_maiden_name,
                        'state_of_originID' => $state_of_originID,
                        'lga_of_originID' => $lga_of_originID,
                        'account_officerID' => $account_officerID,
                        'remark' => $remark,
                        'is_employed' => $is_employed,
                        'zoneID' => $zoneID,
                        'avatar' => $avatar,
                        'status' => $status,
                        'updated_at' => now(),
                    ];

                    $customer_id = $data['customer_account_id'];
                }

                $model = new Customer;

                break;

            case 'contact-data':
                $rules = [
                    'house_no' =>  ['required'],
                    'state_of_residenceID' =>  ['required'],
                    'city' =>  ['required'],
                    'postal_code' =>  ['required'],
                    'residential_address' =>  ['required'],
                    'major_landmark' =>  ['sometimes'],
                    'business_address' =>  ['sometimes'],
                    'customer_account_id' =>  ['required'],
                ];

                $validation = $this->validateData($data, $rules);

                if ($validation->fails()) {
                    return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
                }

                $house_no = $data['house_no'];
                $state_of_residence = $data["state_of_residenceID"];
                $city = $data["city"];
                $postal_code = $data["postal_code"];
                $residential_address = $data["residential_address"];
                $major_landmark = $data['major_landmark'];
                $business_address = $data['business_address'] ?? NULL;
                $customer_account_id = $data['customer_account_id'];

                $customer_insert_query = [
                    'customer_accountID' => $customer_account_id,
                    'house_no' => $house_no,
                    'state_of_residenceID' => $state_of_residence,
                    'city' => $city,
                    'residential_address' => $residential_address,
                    'postal_code' => $postal_code,
                    'major_landmark' => $major_landmark,
                    'business_address' => $business_address,
                    'created_at' => now(),
                ];

                if (strtolower($action) == "edit") {
                    $customer_insert_query = [
                        'house_no' => $house_no,
                        'state_of_residenceID' => $state_of_residence,
                        'city' => $city,
                        'residential_address' => $residential_address,
                        'postal_code' => $postal_code,
                        'major_landmark' => $major_landmark,
                        'business_address' => $business_address,
                        'updated_at' => now(),
                    ];

                    $customer_id = $data['customer_account_id'];
                }

                $model = new CustomerAddress;

                break;


            case 'bank-account-data':
                $rules = [
                    'bankID' =>  ['required'],
                    'account_number' =>  ['required'],
                    'account_name' =>  ['required'],
                    'customer_account_id' =>  ['required'],
                ];

                $validation = $this->validateData($data, $rules);

                if ($validation->fails()) {
                    return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
                }

                $bank_id = $data['bankID'];
                $account_number = $data["account_number"];
                $account_name = $data["account_name"];
                $customer_account_id = $data['customer_account_id'];

                $customer_insert_query = [
                    'customer_accountID' => $customer_account_id,
                    'bankID' => $bank_id,
                    'account_number' => $account_number,
                    'account_name' => $account_name,
                    'created_at' => now(),
                ];

                if (strtolower($action) == "edit") {
                    $customer_insert_query = [
                        'bankID' => $bank_id,
                        'account_number' => $account_number,
                        'account_name' => $account_name,
                        'updated_at' => now(),
                    ];

                    $customer_id = $data['customer_account_id'];
                }

                $model = new CustomerBankAccount;

                break;


            case 'savings-plan-data':
                $rules = [
                    'savings_planID' =>  ['required'],
                    'status' =>  ['required'],
                    'customer_account_id' =>  ['required'],
                ];

                $validation = $this->validateData($data, $rules);

                if ($validation->fails()) {
                    return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
                }

                $savings_plan_id = $data['savings_planID'];
                $status = $data["status"];
                $customer_account_id = $data['customer_account_id'];

                $customer_insert_query = [
                    'customer_accountID' => $customer_account_id,
                    'savings_planID' => $savings_plan_id,
                    'status' => $status,
                    'balance' => 0,
                    'created_at' => now(),
                ];

                if (strtolower($action) == "edit") {
                    $customer_insert_query = [
                        'savings_planID' => $savings_plan_id,
                        'status' => $status,
                        'updated_at' => now(),
                    ];

                    $customer_id = $data['customer_account_id'];
                }

                $model = new CustomerSavingsPlan;

                break;


            case 'nok-data':
                $rules = [
                    'relationship' =>  ['required'],
                    'surname' =>  ['required'],
                    'other_names' =>  ['required'],
                    'phone_number' =>  ['required'],
                    'contact_address' =>  ['required'],
                    'customer_account_id' =>  ['required'],
                ];

                $validation = $this->validateData($data, $rules);

                if ($validation->fails()) {
                    return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
                }

                $customer_account_id = $data['customer_account_id'];
                $relationship = $data["relationship"];
                $surname = $data["surname"];
                $other_names = $data["other_names"];
                $phone_number = $data['phone_number'];
                $contact_address = $data['contact_address'];

                $customer_insert_query = [
                    'customer_accountID' => $customer_account_id,
                    'relationship' => $relationship,
                    'surname' => $surname,
                    'other_names' => $other_names,
                    'phone_number' => $phone_number,
                    'contact_address' => $contact_address,
                    'created_at' => now(),
                ];

                if (strtolower($action) == "edit") {
                    $customer_insert_query = [
                        'relationship' => $relationship,
                        'surname' => $surname,
                        'other_names' => $other_names,
                        'phone_number' => $phone_number,
                        'contact_address' => $contact_address,
                        'updated_at' => now(),
                    ];

                    $customer_id = $data['customer_account_id'];
                }

                $model = new CustomerNok;

                break;

            default:
                # code...
                break;
        }

        try {

            $transactionResult = DB::transaction(function () use (
                $action,
                $customer_account_id,
                $customer_insert_query,
                $model,
                $form_update,
            ) {

                if (strtolower($action) == "add") {
                    $model::insert($customer_insert_query);
                } elseif (strtolower($action) == "edit") {
                    $model::where('account_id', $customer_account_id)->update($customer_insert_query);
                } else {
                    return $this->errorResponse("Invalid Request. Contact Administrator", "", 201);
                }

                if ($form_update == "personal-data") {
                    return $this->successResponse(
                        "Request successfully saved",
                        [
                            "__id" => $customer_account_id
                        ]
                    );
                }

                return $this->successResponse("Request successfully saved");
            });

            return $transactionResult;
        } catch (\Exception $e) {
            // Error occurred while inserting records
            $errorMessage = $e->getMessage();
            //dd($errorMessage);
            // Handle the error notification to the user
            return $this->errorResponse("Error encountered while saving record", $errorMessage, 201);
        }
    }

    public function editCustomer($customer_account_id)
    {
        $customer_obj = new CustomerController;
        $customer_record = $customer_obj->get($customer_account_id)->getData()->data;
        //dd($customer_record);

        if (count($customer_record) < 1) {
            return $this->errorResponse("Oops!!! Invalid Request: ", ['errors' => $customer_record], 201);
        }

        $customer_record = $customer_record[0];

        if ($customer_record->status == "pending" || $customer_record->status == "rejected" || $customer_record->status == "approved") {
            return Redirect::route('customer.view', 'pending');
        }

        $account_type = Auth::user()?->accountType?->code;
        $account_id = Auth::user()?->accountID;

        $staff_list = $this->loadActiveStaffIntoCombo($customer_record?->account_officerID);
        $state_list = $this->loadStatesIntoCombo($customer_record?->state_of_originID);
        $bank_list = $this->loadBanksIntoCombo($customer_record?->bank_account?->bankID);
        $savings_plan_list = $this->loadCustomerActiveSavingsPlanIntoCombo($customer_record?->account_id); //$customer_record?->savings_plan?->savings_planID
        $zone_list = $this->loadActiveZonesIntoCombo($customer_record?->zoneID);
        $gender_list = $this->loadGenderIntoCombo($customer_record?->gender);
        $marital_status_list = $this->loadMaritalStatusIntoCombo($customer_record?->marital_status);

        $params = [
            "gender_list" => $gender_list,
            "marital_status_list" => $marital_status_list,
            "staff_list" => $staff_list,
            "zone_list" => $zone_list,
            "states_list" => $state_list,
            "banks_list" => $bank_list,
            "savings_plans_list" => $savings_plan_list,
            "customer_record" => $customer_record,
            "user_action" => "edit"
        ];

        //dd($params);

        return view('customer.add-customer')->with($params);
    }

    public function updateCustomerStatus($customer_account_id, $status)
    {
        $customer_obj = new CustomerController;
        $customer_record = $customer_obj->get($customer_account_id)->getData()->data;
        //dd($customer_record);

        if (count($customer_record) < 1) {
            return $this->errorResponse("Oops!!! No record found: ", ['errors' => $customer_record], 201);
        }

        switch (strtolower($status)) {
            case 'approved':
                $status = "Active";
                break;

            case 'flagged':
                $status = "Flagged";
                break;

            default:
                $status = "Flagged";
                break;
        }

        $record_to_update = [
            "status" => $status
        ];

        try {

            $transactionResult = DB::transaction(function () use (
                $status,
                $customer_account_id,
                $record_to_update,
            ) {
                $updatedRecord = tap(
                    Customer::where('trans_reference', $customer_account_id)->first(),
                    function ($transaction) use ($record_to_update) {
                        $transaction->update($record_to_update);
                    }
                );

                return $this->successResponse("Request successfully saved");
            });

            return $transactionResult;
        } catch (\Exception $e) {
            // Error occurred while inserting records
            $errorMessage = $e->getMessage();
            //dd($errorMessage);
            // Handle the error notification to the user
            return $this->errorResponse("Error encountered while saving record", $errorMessage, 201);
        }
    }

    public function updateBulkCustomerStatus(Request $request)
    {
        $customer_obj = new CustomerController;

        // Validate request
        $request->validate([
            'selectedTransactions' => 'required|array',
            'status' => 'required'
        ]);

        $customer_ids = $request->selectedTransactions;
        $customer_status = $request->status;

        switch (strtolower($customer_status)) {
            case 'approved':
                $customer_status = "Active";
                break;

            case 'flagged':
                $customer_status = "Flagged";
                break;

            default:
                $customer_status = "Flagged";
                break;
        }

        $record_to_update = [
            "status" => $customer_status
        ];

        try {
            foreach ($customer_ids as $customerId) {
                $transaction_record = $customer_obj->get($customerId)->getData()->data;
                //dd($transaction_record);

                if (count($transaction_record) < 1) {
                    continue;
                }

                Customer::where('account_id', $customerId)->update($record_to_update);
            }

            return $this->successResponse("Request successfully saved");
        } catch (\Exception $e) {
            // Error occurred while inserting records
            $errorMessage = $e->getMessage();
            //dd($errorMessage);
            // Handle the error notification to the user
            return $this->errorResponse("Error encountered while saving record", $errorMessage, 201);
        }
    }

    public function authenticate(Request $request)
    {
        $data = $request->all();
        //dd($data);
        $rules = [
            'username' =>  ['required', 'string'],
            'password' =>  ['required', 'string']
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields", ['errors' => $validation->errors()], 201);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return $this->successResponse("Login Successful", ["redirect" => route("dashboard")], 200);
        } else {
            // Authentication failed
            return $this->errorResponse("Invalid username / passsword provided", [], 201);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout the currently authenticated user

        $request->session()->invalidate(); // Invalidate the session

        $request->session()->regenerateToken(); // Regenerate the CSRF token

        // Redirect to the login page or any other page after logout
        return redirect('/')->with([
            'message' => 'You have been logged out!',
            'status' => 'success',
        ]);
    }

    public function dashboard()
    {

        $redirect_url = "logout";

        if (Auth::check()) {
            $account_type = strtolower(Auth::user()->accountType->account_type);

            if ($account_type == "hcp") {
                $redirect_url = "hcp-dashboard";
            } elseif ($account_type == "staff") {
                $role = Auth::user()->accountCategory->code;

                switch (strtolower($role)) {
                    case 'ict':
                        $redirect_url = 'ict-dashboard';
                        break;

                    case 'bcr':
                        $redirect_url = 'bcr-dashboard';
                        break;

                    case 'managers':
                    case 'nurse':
                        $redirect_url = 'state-dashboard';
                        break;

                    case 'cc':
                        $redirect_url = 'cc-dashboard';
                        break;

                    case 'accounts':
                        $redirect_url = 'accounts-dashboard';
                        break;

                    case 'prm':
                        $redirect_url = 'prm-dashboard';
                        break;

                    case 'hr':
                        $redirect_url = 'hr-dashboard';
                        break;

                    case 'vhs':
                        $redirect_url = 'vhs-dashboard';
                        break;

                    case 'audit':
                        $redirect_url = 'audit-dashboard';
                        break;

                    case 'md':
                        $redirect_url = 'md-dashboard';
                        break;

                    default:
                        $redirect_url = "logout";
                        break;
                }
            } else {
                // Handle other roles or set a default route
                $redirect_url = "logout";
            }

            return redirect()->route($redirect_url);
        } else {
            return redirect()->route($redirect_url);
        }
    }

    public function passwordrecovery(Request $request)
    {
        return view('password-recovery');
    }

    public function resetpassword(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email']
        ]);

        return back()->with([
            'message' => 'Please check your mail for further instruction.',
            'status' => 'success',
        ]);
    }

    public function errorPage()
    {
        return view('error-404');
    }
}
