<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    public function index()
    {
        try {
            $orders = SalesOrder::all();
            return $this->successResponse("Sales orders retrieved successfully.", $orders);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving sales orders.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'so_id'      => ['required', 'unique:tbl_iv_sales_orders,so_id'],
            'merchantID' => ['required'],
            'customerID' => ['required'],
            'order_date' => ['required', 'date'],
            // Additional fields are optional.
            'so_number'             => ['sometimes'],
            'status'                => ['sometimes'],
            'billing_address'       => ['sometimes'],
            'shipping_address'      => ['sometimes'],
            'payment_method'        => ['sometimes'],
            'payment_status'        => ['sometimes'],
            'invoice_number'        => ['sometimes'],
            'discount_amount'       => ['sometimes', 'numeric'],
            'tax_amount'            => ['sometimes', 'numeric'],
            'total_amount'          => ['sometimes', 'numeric'],
            'delivery_method'       => ['sometimes'],
            'tracking_number'       => ['sometimes'],
            'expected_delivery_date' => ['sometimes', 'date'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data) {
                $order = SalesOrder::create([
                    'so_id'                 => $data['so_id'],
                    'merchantID'            => $data['merchantID'],
                    'customerID'            => $data['customerID'],
                    'order_date'            => $data['order_date'],
                    'so_number'             => $data['so_number'] ?? null,
                    'status'                => $data['status'] ?? 'pending',
                    'billing_address'       => $data['billing_address'] ?? null,
                    'shipping_address'      => $data['shipping_address'] ?? null,
                    'payment_method'        => $data['payment_method'] ?? null,
                    'payment_status'        => $data['payment_status'] ?? 'pending',
                    'invoice_number'        => $data['invoice_number'] ?? null,
                    'discount_amount'       => $data['discount_amount'] ?? 0,
                    'tax_amount'            => $data['tax_amount'] ?? 0,
                    'total_amount'          => $data['total_amount'] ?? 0,
                    'delivery_method'       => $data['delivery_method'] ?? null,
                    'tracking_number'       => $data['tracking_number'] ?? null,
                    'expected_delivery_date' => $data['expected_delivery_date'] ?? null,
                    'created_at'            => now(),
                ]);
                return $this->successResponse("Sales order successfully created.", $order);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating sales order.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $order = SalesOrder::find($id);
            if (!$order) {
                return $this->errorResponse("Sales order not found.", [], 201);
            }
            return $this->successResponse("Sales order retrieved successfully.", $order);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving sales order.", $e->getMessage(), 201);
        }
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'customerID'             => ['required'],
            'order_date'             => ['required', 'date'],
            // Optional fields follow:
            'status'                => ['sometimes'],
            'billing_address'       => ['sometimes'],
            'shipping_address'      => ['sometimes'],
            'payment_method'        => ['sometimes'],
            'payment_status'        => ['sometimes'],
            'invoice_number'        => ['sometimes'],
            'discount_amount'       => ['sometimes', 'numeric'],
            'tax_amount'            => ['sometimes', 'numeric'],
            'total_amount'          => ['sometimes', 'numeric'],
            'delivery_method'       => ['sometimes'],
            'tracking_number'       => ['sometimes'],
            'expected_delivery_date' => ['sometimes', 'date'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data, $id) {
                $order = SalesOrder::find($id);
                if (!$order) {
                    return $this->errorResponse("Sales order not found.", [], 201);
                }
                $order->update([
                    'customerID'             => $data['customerID'],
                    'order_date'             => $data['order_date'],
                    'status'                 => $data['status'] ?? $order->status,
                    'billing_address'        => $data['billing_address'] ?? $order->billing_address,
                    'shipping_address'       => $data['shipping_address'] ?? $order->shipping_address,
                    'payment_method'         => $data['payment_method'] ?? $order->payment_method,
                    'payment_status'         => $data['payment_status'] ?? $order->payment_status,
                    'invoice_number'         => $data['invoice_number'] ?? $order->invoice_number,
                    'discount_amount'        => $data['discount_amount'] ?? $order->discount_amount,
                    'tax_amount'             => $data['tax_amount'] ?? $order->tax_amount,
                    'total_amount'           => $data['total_amount'] ?? $order->total_amount,
                    'delivery_method'        => $data['delivery_method'] ?? $order->delivery_method,
                    'tracking_number'        => $data['tracking_number'] ?? $order->tracking_number,
                    'expected_delivery_date' => $data['expected_delivery_date'] ?? $order->expected_delivery_date,
                    'updated_at'             => now(),
                ]);
                return $this->successResponse("Sales order successfully updated.", $order);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating sales order.", $e->getMessage(), 201);
        }
    }

    public function destroy($id)
    {
        try {
            $order = SalesOrder::find($id);
            if (!$order) {
                return $this->errorResponse("Sales order not found.", [], 201);
            }
            DB::transaction(function () use ($order) {
                $order->delete();
            });
            return $this->successResponse("Sales order successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting sales order.", $e->getMessage(), 201);
        }
    }
}
