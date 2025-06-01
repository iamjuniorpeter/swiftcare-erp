<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index()
    {
        try {
            $inventories = Inventory::all();
            return $this->successResponse("Inventory records retrieved successfully.", $inventories);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving inventory records.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'inventory_id' => ['required', 'unique:tbl_iv_inventory,inventory_id'],
            'merchantID'   => ['required'],
            'itemID'       => ['required'],
            'warehouseID'  => ['required'],
            'quantity'     => ['required', 'numeric']
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $inventory = Inventory::create([
                    'inventory_id' => $data['inventory_id'],
                    'merchantID'   => $data['merchantID'],
                    'itemID'       => $data['itemID'],
                    'warehouseID'  => $data['warehouseID'],
                    'quantity'     => $data['quantity'],
                ]);
                return $this->successResponse("Inventory record successfully created.", $inventory);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating inventory record.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $inventory = Inventory::find($id);
            if (!$inventory) {
                return $this->errorResponse("Inventory record not found.", [], 201);
            }
            return $this->successResponse("Inventory record retrieved successfully.", $inventory);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving inventory record.", $e->getMessage(), 201);
        }
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'quantity' => ['required', 'numeric']
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data, $id) {
                $inventory = Inventory::find($id);
                if (!$inventory) {
                    return $this->errorResponse("Inventory record not found.", [], 201);
                }
                $inventory->update([
                    'quantity' => $data['quantity']
                ]);
                return $this->successResponse("Inventory record successfully updated.", $inventory);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating inventory record.", $e->getMessage(), 201);
        }
    }

    public function destroy($id)
    {
        try {
            $inventory = Inventory::find($id);
            if (!$inventory) {
                return $this->errorResponse("Inventory record not found.", [], 201);
            }
            DB::transaction(function () use ($inventory) {
                $inventory->delete();
            });
            return $this->successResponse("Inventory record successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting inventory record.", $e->getMessage(), 201);
        }
    }
}
