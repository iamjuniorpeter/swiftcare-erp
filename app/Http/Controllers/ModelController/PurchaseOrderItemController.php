<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrderItem;
use App\Models\Item;
use App\Models\PurchaseOrder;
use Illuminate\Support\Str;

class PurchaseOrderItemController extends Controller
{
    public function index()
    {
        $items = PurchaseOrderItem::with(['purchaseOrder', 'item'])->latest()->get();
        return view('purchase_order_items.index', compact('items'));
    }

    public function create($po_id)
    {
        //$po = PurchaseOrder::where('po_id', $po_id)->firstOrFail();
        $po_items = PurchaseOrderItem::where('poID', $po_id)->get();
        $items = Item::all();

        return view('purchase_order_items.create', [
            //'purchaseOrders' => $po,
            'po_id' => $po_id,
            'items' => $items,
            'purchaseOrderItems' => $po_items
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'po_id' => 'required',
            'itemID' => 'required',
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        PurchaseOrderItem::create([
            'poi_id' => Str::uuid(),
            'poID' => $request->po_id,
            'itemID' => $request->itemID,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
        ]);

        return $this->successResponse("Item added to purchase order successfully.");
    }

    public function show($id)
    {
        $item = PurchaseOrderItem::with(['purchaseOrder', 'item'])->where('poi_id', $id)->firstOrFail();
        return view('purchase_order_items.show', compact('item'));
    }

    public function edit($poi_id)
    {
        $po_item = PurchaseOrderItem::where('poi_id', $poi_id)->firstOrFail();
        $items = Item::all();

        return view('purchase_order_items.edit', [
            //'purchaseOrders' => $po,
            'poi_id' => $poi_id,
            'items' => $items,
            'purchaseOrderItem' => $po_item
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'po_id' => 'required',
            'itemID' => 'required',
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $item = PurchaseOrderItem::where('poi_id', $id)->firstOrFail();

        $item->update([
            'itemID' => $request->itemID,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
        ]);

        return $this->successResponse("Purchase order item updated successfully.", $item);
    }

    public function destroy($id)
    {
        $item = PurchaseOrderItem::where('poi_id', $id)->firstOrFail();
        $item->delete();

        return redirect()->route('purchase_order_items.index')->with('success', 'Purchase order item deleted.');
    }
}
