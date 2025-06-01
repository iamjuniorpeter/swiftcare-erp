<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\SalesOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderItemController extends Controller
{
    public function index()
    {
        try {
            $items = SalesOrderItem::all();
            return $this->successResponse("Sales order items retrieved successfully.", $items);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving sales order items.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'soi_id'    => ['required', 'unique:tbl_iv_sales_order_items,soi_id'],
            'soID'      => ['required'],
            'itemID'    => ['required'],
            'quantity'  => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data) {
                $item = SalesOrderItem::create([
                    'soi_id'    => $data['soi_id'],
                    'soID'      => $data['soID'],
                    'itemID'    => $data['itemID'],
                    'quantity'  => $data['quantity'],
                    'unit_price' => $data['unit_price'],
                ]);
                return $this->successResponse("Sales order item successfully created.", $item);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating sales order item.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $item = SalesOrderItem::find($id);
            if (!$item) {
                return $this->errorResponse("Sales order item not found.", [], 201);
            }
            return $this->successResponse("Sales order item retrieved successfully.", $item);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving sales order item.", $e->getMessage(), 201);
        }
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'quantity'   => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data, $id) {
                $item = SalesOrderItem::find($id);
                if (!$item) {
                    return $this->errorResponse("Sales order item not found.", [], 201);
                }
                $item->update([
                    'quantity'   => $data['quantity'],
                    'unit_price' => $data['unit_price'],
                ]);
                return $this->successResponse("Sales order item successfully updated.", $item);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating sales order item.", $e->getMessage(), 201);
        }
    }

    public function destroy($id)
    {
        try {
            $item = SalesOrderItem::find($id);
            if (!$item) {
                return $this->errorResponse("Sales order item not found.", [], 201);
            }
            DB::transaction(function () use ($item) {
                $item->delete();
            });
            return $this->successResponse("Sales order item successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting sales order item.", $e->getMessage(), 201);
        }
    }
}
