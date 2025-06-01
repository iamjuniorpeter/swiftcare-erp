<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemBulkTemplateExport;
use App\Imports\ItemBulkUploadImport;

class ItemController extends Controller
{
    /**
     * Display a listing of items.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $items = Item::with(['batches.usages'])->get()->map(function ($item) {
            $totalStocked = 0;
            $totalUsed = 0;

            foreach ($item->batches as $batch) {
                $totalStocked += $batch->quantity;
                $totalUsed += $batch->usages->sum('quantity');
            }

            $item->available_quantity = $totalStocked - $totalUsed;

            return $item;
        });

        return view('inventory.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new item.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('inventory.items.create');
    }

    /**
     * Store a newly created item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id'       => 'required|unique:tbl_iv_items,item_id',
            'merchantID'    => 'required',
            'item_code'     => 'required|unique:tbl_iv_items,item_code',
            'name'          => 'required',
            'description'   => 'sometimes',
            'categoryID'    => 'sometimes|exists:tbl_iv_categories,sn',
            'unitID'        => 'sometimes|exists:tbl_iv_units,sn',
            'status'        => 'sometimes|in:active,inactive',
            'cost_price'    => 'sometimes|numeric',
            'selling_price' => 'sometimes|numeric',
            'barcode'       => 'sometimes',
            'reorder_level' => 'sometimes|numeric',
        ]);

        Item::create($validated);

        return redirect()
            ->route('inventory.items.index')
            ->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified item.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('inventory.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified item.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('inventory.items.edit', compact('item'));
    }

    /**
     * Update the specified item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required',
            'description'   => 'sometimes',
            'categoryID'    => 'sometimes|exists:tbl_iv_categories,sn',
            'unitID'        => 'sometimes|exists:tbl_iv_units,sn',
            'status'        => 'sometimes|in:active,inactive',
            'cost_price'    => 'sometimes|numeric',
            'selling_price' => 'sometimes|numeric',
            'barcode'       => 'sometimes',
            'reorder_level' => 'sometimes|numeric',
        ]);

        $item->update($validated);

        return redirect()
            ->route('inventory.items.index')
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('inventory.items.index')
            ->with('success', 'Item deleted successfully.');
    }

    public function showBulkUpload()
    {
        return view('items.bulk_upload');
    }

    public function processBulkUpload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new ItemBulkUploadImport, $request->file('excel_file'));
            return redirect()->route('items.index')->with('success', 'Items uploaded successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error uploading items: ' . $e->getMessage());
        }
    }

    public function downloadBulkUploadTemplate()
    {
        return Excel::download(new ItemBulkTemplateExport, 'item_bulk_upload_template.xlsx');
    }
}
