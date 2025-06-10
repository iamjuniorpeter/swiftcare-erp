<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemBulkTemplateExport;
use App\Imports\ItemBulkUploadImport;

class ItemController extends Controller
{
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

        $category_list = $this->loadCategoryIntoCombo();
        $sub_category_list = $this->loadSubCategoryIntoCombo();
        $unit_list =  $this->loadUnitsIntoCombo();
        $location_list =  $this->loadWarehousesIntoCombo();
        $status_list =  $this->loadStatusIntoCombo();

        return view('items.create', compact('category_list', 'sub_category_list', 'unit_list', 'location_list', 'status_list'));
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
            'subCategoryID'   => ['sometimes'],
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
                    'subCategoryID'    => $data['subCategoryID'] ?? null,
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
            'subCategoryID'   => ['sometimes'],
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
                    'subCategoryID'    => $data['subCategoryID'] ?? $item->subCategoryID,
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
        $merchant_id = Auth::user()->accountID;

        $category_list = $this->loadCategoryIntoCombo($item->categoryID);
        $sub_category_list = $this->loadSubCategoryIntoCombo($item->subCategoryID);
        $unit_list =  $this->loadUnitsIntoCombo($item->unitID);
        $location_list =  $this->loadWarehousesIntoCombo($item->warehouseID);
        $status_list =  $this->loadStatusIntoCombo($item->status);

        return view('items.edit', compact('item', 'category_list', 'sub_category_list', 'unit_list', 'location_list', 'status_list'));

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
