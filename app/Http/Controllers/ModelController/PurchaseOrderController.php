<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\PurchaseOrderItem;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('supplier')->latest()->get();
        return view('purchase_orders.index', compact('purchaseOrders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::all();
        return view('purchase_orders.create', compact('suppliers', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'merchantID' => 'required',
            'supplier_id' => 'required',
            'delivery_address' => 'nullable|string',
            'order_date' => 'required|date',
            'payment_terms' => 'nullable|string|max:50',
            'expected_delivery_date' => 'nullable|date',
            'actual_delivery_date' => 'nullable|date',
            'shipping_details' => 'nullable|string',
            'remarks' => 'nullable|string',
            'approval_status' => 'nullable|in:pending,approved,rejected',
            'status' => 'nullable|in:pending,received,cancelled',
        ]);

        $po = new PurchaseOrder();
        $po->po_id = Str::uuid();
        $po->merchantID = $request->merchantID;
        $po->po_number = 'PO' . now()->format('YmdHis');
        $po->supplierID = $request->supplier_id;
        $po->delivery_address = $request->delivery_address;
        $po->order_date = $request->order_date;
        $po->payment_terms = $request->payment_terms;
        $po->expected_delivery_date = $request->expected_delivery_date;
        $po->actual_delivery_date = $request->actual_delivery_date;
        $po->shipping_details = $request->shipping_details;
        $po->remarks = $request->remarks;
        $po->approval_status = $request->approval_status ?? 'pending';
        $po->status = $request->status ?? 'pending';
        $po->save();

        //return redirect()->route('purchase_orders.index')->with('success', 'Purchase order created successfully.');
        return $this->successResponse("Purchase order created successfully.", $po);
    }

    public function show($po_id)
    {
        $order = PurchaseOrder::with(['supplier', 'items.item'])->where('po_id', $po_id)->firstOrFail();
        return view('purchase_orders.show', compact('order'));
    }

    public function edit($po_id)
    {
        $purchaseOrder = PurchaseOrder::with('purchaseOrderItems')->where('po_id', $po_id)->firstOrFail();
        $suppliers = Supplier::all();
        $items = Item::all();
        return view('purchase_orders.edit', compact('purchaseOrder', 'suppliers', 'items'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'merchantID' => 'required',
            'supplier_id' => 'required',
            'delivery_address' => 'nullable|string',
            'order_date' => 'required|date',
            'payment_terms' => 'nullable|string|max:50',
            'expected_delivery_date' => 'nullable|date',
            'actual_delivery_date' => 'nullable|date',
            'shipping_details' => 'nullable|string',
            'remarks' => 'nullable|string',
            'approval_status' => 'nullable|in:pending,approved,rejected',
            'status' => 'nullable|in:pending,received,cancelled',
        ]);

        $po = PurchaseOrder::where('po_id', $id)->firstOrFail();
        $po->supplierID = $request->supplier_id;
        $po->delivery_address = $request->delivery_address;
        $po->order_date = $request->order_date;
        $po->payment_terms = $request->payment_terms;
        $po->expected_delivery_date = $request->expected_delivery_date;
        $po->actual_delivery_date = $request->actual_delivery_date;
        $po->shipping_details = $request->shipping_details;
        $po->remarks = $request->remarks;
        $po->approval_status = $request->approval_status ?? 'pending';
        $po->status = $request->status ?? 'pending';
        $po->save();

        return $this->successResponse("Purchase order updated successfully.", $po);
    }

    public function destroy($po_id)
    {
        $po = PurchaseOrder::where('po_id', $po_id)->firstOrFail();
        $po->items()->delete();
        $po->delete();

        return redirect()->route('purchase_orders.index')->with('success', 'Purchase order deleted successfully.');
    }
}
