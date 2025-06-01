<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        try {
            $invoices = Invoice::all();
            return $this->successResponse("Invoices retrieved successfully.", $invoices);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving invoices.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'invoice_id'  => ['required', 'unique:tbl_invoices,invoice_id'],
            'merchantID'  => ['required'],
            'invoice_date' => ['required', 'date'],
            'total_amount' => ['required', 'numeric'],
            'status'      => ['required'],
            // Optional: so_id, due_date, paid_amount
            'so_id'       => ['sometimes'],
            'due_date'    => ['sometimes', 'date'],
            'paid_amount' => ['sometimes', 'numeric'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data) {
                $invoice = Invoice::create([
                    'invoice_id'  => $data['invoice_id'],
                    'merchantID'  => $data['merchantID'],
                    'so_id'       => $data['so_id'] ?? null,
                    'invoice_date' => $data['invoice_date'],
                    'due_date'    => $data['due_date'] ?? null,
                    'total_amount' => $data['total_amount'],
                    'paid_amount' => $data['paid_amount'] ?? 0,
                    'status'      => $data['status'],
                    'created_at'  => now(),
                ]);
                return $this->successResponse("Invoice successfully created.", $invoice);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating invoice.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $invoice = Invoice::find($id);
            if (!$invoice) {
                return $this->errorResponse("Invoice not found.", [], 201);
            }
            return $this->successResponse("Invoice retrieved successfully.", $invoice);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving invoice.", $e->getMessage(), 201);
        }
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'invoice_date' => ['required', 'date'],
            'total_amount' => ['required', 'numeric'],
            'status'      => ['required'],
            // Optional: so_id, due_date, paid_amount
            'so_id'       => ['sometimes'],
            'due_date'    => ['sometimes', 'date'],
            'paid_amount' => ['sometimes', 'numeric'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data, $id) {
                $invoice = Invoice::find($id);
                if (!$invoice) {
                    return $this->errorResponse("Invoice not found.", [], 201);
                }
                $invoice->update([
                    'so_id'       => $data['so_id'] ?? $invoice->so_id,
                    'invoice_date' => $data['invoice_date'],
                    'due_date'    => $data['due_date'] ?? $invoice->due_date,
                    'total_amount' => $data['total_amount'],
                    'paid_amount' => $data['paid_amount'] ?? $invoice->paid_amount,
                    'status'      => $data['status'],
                    'updated_at'  => now(),
                ]);
                return $this->successResponse("Invoice successfully updated.", $invoice);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating invoice.", $e->getMessage(), 201);
        }
    }

    public function destroy($id)
    {
        try {
            $invoice = Invoice::find($id);
            if (!$invoice) {
                return $this->errorResponse("Invoice not found.", [], 201);
            }
            DB::transaction(function () use ($invoice) {
                $invoice->delete();
            });
            return $this->successResponse("Invoice successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting invoice.", $e->getMessage(), 201);
        }
    }
}
