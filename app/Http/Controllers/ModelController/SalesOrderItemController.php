<?php

namespace App\Http\Controllers\ModelController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\SalesOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesOrderItemController extends Controller
{
    public function create()
    {
        $merchant_id = Auth::user()->accountID;

        $items = Item::where('merchantID', $merchant_id)
            ->with(['batches.usages'])
            ->get()
            ->map(function ($item) {
                $totalStocked = 0;
                $totalUsed = 0;

                foreach ($item->batches as $batch) {
                    $totalStocked += $batch->quantity;
                    $totalUsed += $batch->usages->sum('quantity');
                }

                $available = $totalStocked - $totalUsed;
                $item->available_quantity = $available;

                return $item;
            });

        $optionsHtml = '';

        foreach ($items as $item) {
            $optionsHtml .=
                '<option value="' .
                $item->item_id .
                '">' .
                $item->name .
                ' (Available: ' .
                $item->available_quantity .
                ')</option>';
        }

        return view('sales_order_items.create', compact('optionsHtml'));
    }

    public function index()
    {
        try {
            $items = SalesOrderItem::all();
            return $this->successResponse(
                'Sales order items retrieved successfully.',
                $items
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error retrieving sales order items.',
                $e->getMessage(),
                201
            );
        }
    }

    // public function store(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {

    //         $salesOrder = SalesOrderItem::create([

    //             'merchantID' => auth()->user()->accountID,
    //             'quantity' => $request->qty,
    //             'itemID' => $request->itemID,
    //             'customer_name' => $request->cust_name,
    //             'customer_email' => $request->cust_email,
    //         ]);

    //         foreach ($request->itemID as $item) {
    //             $remaining = $item['quantity'];

    //             $batches = ItemBatch::where('itemID', $item['itemID'])
    //                 ->where('quantity', '>', 0)
    //                 ->orderBy('created_at', 'asc')
    //                 ->get();

    //             foreach ($batches as $batch) {
    //                 if ($remaining <= 0) {
    //                     break;
    //                 }

    //                 $deduct = min($remaining, $batch->quantity);
    //                 $batch->quantity -= $deduct;
    //                 $batch->save();

    //                 DB::table('tbl_iv_sale_order_item_activity')->insert([
    //                     'merchantID' => auth()->user()->accountID,
    //                     'itemID' => $item['itemID'],
    //                     'item_batch' => $batch->batch_number,
    //                     'activity_type' => 'Stock Out',
    //                     'quantity' => $deduct,
    //                     'unit_price' => $item['unit_price'],
    //                 ]);

    //                 $remaining -= $deduct;
    //             }

    //             if ($remaining > 0) {
    //                 throw new \Exception(
    //                     'Insufficient stock for item ID: ' . $item['itemID']
    //                 );
    //             }
    //         }

    //         DB::commit();

    //         // return response()->json(
    //         //     ['message' => 'Sales order recorded successfully.'],
    //         //     201
    //         // );
    //         return $this->successResponse("Sales order item successfully created.", $item);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         //return response()->json(['error' => $e->getMessage()], 500);
    //         return $this->errorResponse("Error encountered while creating sales order item.", $e->getMessage(), 201);

    //     }

    //     //return $this->successResponse("Sales order item successfully created.", $item);

    //     //return $this->errorResponse("Error encountered while creating sales order item.", $e->getMessage(), 201);
    // }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $merchantID = auth()->user()->accountID;

            $item = [
                'itemID' => $request->itemID,
                'quantity' => $request->qty,
                'unit_price' => $request->unit_price,
            ];

            $remaining = $item['quantity'];

            $batches = ItemBatch::where('itemID', $item['itemID'])
                ->where('quantity', '>', 0)
                ->orderBy('created_at', 'asc')
                ->get();

            foreach ($batches as $batch) {
                if ($remaining <= 0) {
                    break;
                }

                $deduct = min($remaining, $batch->quantity);
                $batch->quantity -= $deduct;
                $batch->save();

                DB::table('tbl_iv_sales_order_items')->insert([
                    'soi_id' => uniqid('SOI_'),
                    'merchantID' => $merchantID,
                    'itemID' => $item['itemID'],
                    'batchID' => $batch->batch_number,
                    'quantity' => $deduct,
                    'unit_price' => $item['unit_price'],
                    'customer_name' => $request->cust_name,
                    'customer_email' => $request->cust_email,
                    'created_at' => now(),
                ]);

                DB::table('tbl_iv_sale_order_item_activity')->insert([
                    'merchantID' => $merchantID,
                    'itemID' => $item['itemID'],
                    'item_batch' => $batch->batch_number,
                    'activity_type' => 'Stock Out',
                    'quantity' => $deduct,
                    'unit_price' => $item['unit_price'],
                    'created_at' => now(),
                ]);

                $remaining -= $deduct;
            }

            if ($remaining > 0) {
                throw new \Exception(
                    'Insufficient stock for item ID: ' . $item['itemID']
                );
            }

            DB::commit();

            return $this->successResponse(
                'Sales order items successfully created.'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse(
                'Error creating sales order item.',
                $e->getMessage(),
                500
            );
        }
    }

    public function show($id)
    {
        try {
            $item = SalesOrderItem::find($id);
            if (!$item) {
                return $this->errorResponse(
                    'Sales order item not found.',
                    [],
                    201
                );
            }
            return $this->successResponse(
                'Sales order item retrieved successfully.',
                $item
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error retrieving sales order item.',
                $e->getMessage(),
                201
            );
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            'quantity' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse(
                'Kindly fill in all required fields.',
                ['errors' => $validation->errors()],
                201
            );
        }
        try {
            $result = DB::transaction(function () use ($data, $id) {
                $item = SalesOrderItem::find($id);
                if (!$item) {
                    return $this->errorResponse(
                        'Sales order item not found.',
                        [],
                        201
                    );
                }
                $item->update([
                    'quantity' => $data['quantity'],
                    'unit_price' => $data['unit_price'],
                ]);
                return $this->successResponse(
                    'Sales order item successfully updated.',
                    $item
                );
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error encountered while updating sales order item.',
                $e->getMessage(),
                201
            );
        }
    }

    public function destroy($id)
    {
        try {
            $item = SalesOrderItem::find($id);
            if (!$item) {
                return $this->errorResponse(
                    'Sales order item not found.',
                    [],
                    201
                );
            }
            DB::transaction(function () use ($item) {
                $item->delete();
            });
            return $this->successResponse(
                'Sales order item successfully deleted.'
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error encountered while deleting sales order item.',
                $e->getMessage(),
                201
            );
        }
    }
}
