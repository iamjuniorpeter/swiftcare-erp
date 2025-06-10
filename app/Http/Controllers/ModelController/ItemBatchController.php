<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemBatchController extends Controller
{
    public function create($itemSn)
    {
        $item = Item::where('item_id', $itemSn)->firstOrFail();
        $item_batches = ItemBatch::where('itemID', $itemSn)->with(['warehouse', 'supplier'])->get();
        $location_list =  $this->loadWarehousesIntoCombo();
        $supplier_list =  $this->loadSupplierIntoCombo();
        $status_list =  $this->loadStatusIntoCombo();

        return view('item_batches.create', [
            'item' => $item,
            'item_sn' => $itemSn,
            'item_id' => $item->item_id,
            'item_batches' => $item_batches,
            'location_list' => $location_list,
            'status_list' => $status_list,
            'supplier_list' => $supplier_list
        ]);
    }

    public function index()
    {
        try {
            $batches = ItemBatch::all();
            return $this->successResponse("Item batches retrieved successfully.", $batches);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving item batches.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'item_id'       => ['required'],
            //'batch_number' => ['required', 'unique:tbl_item_batches,batch_number'],
            'location'  => ['required'],
            'expiry_date'  => ['sometimes', 'date'],
            'quantity'     => ['required', 'numeric'],
            'supplier'  => ['sometimes'],
            'status'  => ['sometimes'],
            'remark'  => ['sometimes'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data) {
                $batch = ItemBatch::create([
                    'itemID'       => $data['item_id'],
                    'batch_number' => $this->generateBatchNumber(), //$data['batch_number'],
                    'warehouseID'  => $data['location'],
                    'expiry_date'  => $data['expiry_date'] ?? NULL,
                    'quantity'     => $data['quantity'],
                    'supplierID'     => $data['supplier'] ?? NULL,
                    'status'     => $data['status'] ?? NULL,
                    'notes'     => $data['remark'] ?? NULL,
                ]);

                $movement_ref = $this->generateAccountId(10);

                StockMovement::create([
                    'item_id' => $batch->itemID,
                    'batch_id' => $batch->batch_number,
                    'movement_type' => 'in',
                    'quantity' => $batch->quantity,
                    'movement_date' => now(),
                    'reference' => $movement_ref,
                    'location_id' => $batch->warehouseID,
                    'created_by' => Auth::user()->accountID,
                    'created_at' => now()
                ]);

                // return redirect()
                //     ->route('item_batches.create', $data['item_id'])
                //     ->with('success', 'Item Batch created successfully.');
                return $this->successResponse("Item batch successfully created.", $batch);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating item batch.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $batch = ItemBatch::find($id);
            if (!$batch) {
                return $this->errorResponse("Item batch not found.", [], 201);
            }
            return $this->successResponse("Item batch retrieved successfully.", $batch);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving item batch.", $e->getMessage(), 201);
        }
    }

    // EDIT: Show form to update an existing batch
    public function edit($batchSn)
    {
        $batch = ItemBatch::with(['item', 'warehouse'])->where('sn', $batchSn)->firstOrFail();
        $location_list =  $this->loadWarehousesIntoCombo($batch->warehouseID);
        $supplier_list =  $this->loadSupplierIntoCombo($batch->supplierID);
        $status_list =  $this->loadStatusIntoCombo($batch->status);

        return view('item_batches.edit', [
            'batch' => $batch,
            'item' => $batch->item,
            'location_list' => $location_list,
            'status_list' => $status_list,
            'supplier_list' => $supplier_list
        ]);
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'quantity'    => ['required', 'numeric'],
            'expiry_date' => ['sometimes', 'date'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data, $id) {
                $batch = ItemBatch::find($id);
                if (!$batch) {
                    return $this->errorResponse("Item batch not found.", [], 201);
                }
                $batch->update([
                    'quantity'    => $data['quantity'],
                    'expiry_date' => $data['expiry_date'] ?? $batch->expiry_date,
                ]);
                return $this->successResponse("Item batch successfully updated.", $batch);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating item batch.", $e->getMessage(), 201);
        }
    }

    public function destroy($id)
    {
        try {
            $batch = ItemBatch::find($id);
            if (!$batch) {
                return $this->errorResponse("Item batch not found.", [], 201);
            }
            DB::transaction(function () use ($batch) {
                $batch->delete();
            });
            return $this->successResponse("Item batch successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting item batch.", $e->getMessage(), 201);
        }
    }
}
