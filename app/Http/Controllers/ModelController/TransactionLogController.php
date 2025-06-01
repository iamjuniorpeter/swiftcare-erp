<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionLogController extends Controller
{
    public function index()
    {
        try {
            $logs = TransactionLog::all();
            return $this->successResponse("Transaction logs retrieved successfully.", $logs);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving transaction logs.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'merchantID'       => ['required'],
            'itemID'           => ['required'],
            'warehouseID'      => ['required'],
            'transaction_type' => ['required'],
            'quantity'         => ['required', 'numeric'],
            'reference'        => ['sometimes'],
            'remarks'          => ['sometimes'],
            'created_by'       => ['sometimes'],
            // 'transaction_date', 'document_type', 'document_id' are optional
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $log = TransactionLog::create([
                    'merchantID'       => $data['merchantID'],
                    'itemID'           => $data['itemID'],
                    'warehouseID'      => $data['warehouseID'],
                    'transaction_type' => $data['transaction_type'],
                    'quantity'         => $data['quantity'],
                    'reference'        => $data['reference'] ?? null,
                    'remarks'          => $data['remarks'] ?? null,
                    'created_by'       => $data['created_by'] ?? null,
                    'transaction_date' => $data['transaction_date'] ?? now(),
                    'document_type'    => $data['document_type'] ?? null,
                    'document_id'      => $data['document_id'] ?? null,
                ]);
                return $this->successResponse("Transaction log successfully created.", $log);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating transaction log.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $log = TransactionLog::find($id);
            if (!$log) {
                return $this->errorResponse("Transaction log not found.", [], 201);
            }
            return $this->successResponse("Transaction log retrieved successfully.", $log);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving transaction log.", $e->getMessage(), 201);
        }
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'transaction_type' => ['required'],
            'quantity'         => ['required', 'numeric'],
            // Other fields are optional
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data, $id) {
                $log = TransactionLog::find($id);
                if (!$log) {
                    return $this->errorResponse("Transaction log not found.", [], 201);
                }
                $log->update([
                    'transaction_type' => $data['transaction_type'],
                    'quantity'         => $data['quantity'],
                    'reference'        => $data['reference'] ?? $log->reference,
                    'remarks'          => $data['remarks'] ?? $log->remarks,
                    'created_by'       => $data['created_by'] ?? $log->created_by,
                    'transaction_date' => $data['transaction_date'] ?? $log->transaction_date,
                    'document_type'    => $data['document_type'] ?? $log->document_type,
                    'document_id'      => $data['document_id'] ?? $log->document_id,
                ]);
                return $this->successResponse("Transaction log successfully updated.", $log);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating transaction log.", $e->getMessage(), 201);
        }
    }

    public function destroy($id)
    {
        try {
            $log = TransactionLog::find($id);
            if (!$log) {
                return $this->errorResponse("Transaction log not found.", [], 201);
            }
            DB::transaction(function () use ($log) {
                $log->delete();
            });
            return $this->successResponse("Transaction log successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting transaction log.", $e->getMessage(), 201);
        }
    }
}
