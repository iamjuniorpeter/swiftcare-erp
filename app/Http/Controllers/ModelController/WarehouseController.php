<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\Warehouse;
use App\Models\WarehouseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    public function create()
    {
        $merchant_id = Auth::user()->accountID;

        $warehouses = Warehouse::where("merchantID", $merchant_id)->with(['warehouseType'])->get();
        $warehouse_types = WarehouseType::where("merchantID", $merchant_id)->get();

        return view('warehouses.create', compact('warehouses', 'warehouse_types'));
    }

    public function index()
    {
        $merchant_id = Auth::user()->accountID;

        try {
            $warehouses = Warehouse::where("merchantID", $merchant_id)->get();
            return $this->successResponse("Warehouses retrieved successfully.", $warehouses);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving warehouses.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            //'warehouse_id' => ['required', 'unique:tbl_iv_warehouses,warehouse_id'],
            'merchantID'   => ['required'],
            'name'         => ['required'],
            'type'         => ['required'],
            'location'     => ['sometimes'],
            'contact_person' => ['sometimes'],
            'phone'        => ['sometimes'],
            'email'        => ['sometimes', 'email'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        // if user didn't supply one, generate it
        if (empty($data['warehouse_id'])) {
            $data['warehouse_id'] = $this->generateUniqueId("WH", 8);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $warehouse = Warehouse::create([
                    'warehouse_id' => $data['warehouse_id'],
                    'merchantID'   => $data['merchantID'],
                    'name'         => ucwords($data['name']),
                    'typeID'         => $data['type'],
                    'location'     => $data['location'] ?? null,
                    'contact_person' => $data['contact_person'] ?? null,
                    'phone'        => $data['phone'] ?? null,
                    'email'        => $data['email'] ?? null,
                ]);
                return $this->successResponse("Warehouse successfully created.", $warehouse);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating warehouse.", $e->getMessage(), 201);
        }
    }

    public function storeType(Request $request)
    {
        $data  = $request->all();
        $rules = [
            //'warehouse_id' => ['required', 'unique:tbl_iv_warehouses,warehouse_id'],
            'merchantID'   => ['required'],
            'name'         => ['required'],
            'code'     => ['required'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $warehouse = WarehouseType::create([
                    'merchantID'   => $data['merchantID'],
                    'name'         => ucwords($data['name']),
                    'code'     => $data['code'] ?? null,
                ]);
                return $this->successResponse("Warehouse Type successfully created.", $warehouse);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating warehouse type.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $warehouse = Warehouse::find($id);
            if (!$warehouse) {
                return $this->errorResponse("Warehouse not found.", [], 201);
            }
            return $this->successResponse("Warehouse retrieved successfully.", $warehouse);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving warehouse.", $e->getMessage(), 201);
        }
    }

    public function edit($id)
    {
        $merchant_id = Auth::user()->accountID;
        $warehouse = Warehouse::findOrFail($id);
        $warehouse_types = WarehouseType::where("merchantID", $merchant_id)->get();

        return view('warehouses.edit', compact('warehouse', 'warehouse_types'));
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'name'         => ['required'],
            'location'     => ['sometimes'],
            'contact_person' => ['sometimes'],
            'phone'        => ['sometimes'],
            'email'        => ['sometimes', 'email'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data, $id) {
                $warehouse = Warehouse::find($id);
                if (!$warehouse) {
                    return $this->errorResponse("Warehouse not found.", [], 201);
                }
                $warehouse->update([
                    'name'         => $data['name'],
                    'location'     => $data['location'] ?? $warehouse->location,
                    'contact_person' => $data['contact_person'] ?? $warehouse->contact_person,
                    'phone'        => $data['phone'] ?? $warehouse->phone,
                    'email'        => $data['email'] ?? $warehouse->email,
                ]);
                return $this->successResponse("Warehouse successfully updated.", $warehouse);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating warehouse.", $e->getMessage(), 201);
        }
    }

    public function destroy($id)
    {
        try {
            $warehouse = Warehouse::find($id);
            if (!$warehouse) {
                return $this->errorResponse("Warehouse not found.", [], 201);
            }
            DB::transaction(function () use ($warehouse) {
                $warehouse->delete();
            });
            return $this->successResponse("Warehouse successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting warehouse.", $e->getMessage(), 201);
        }
    }
}
