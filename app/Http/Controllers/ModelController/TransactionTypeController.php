<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{
    // Display a listing of the transaction types.
    public function get()
    {
        $transactionTypes = TransactionType::all();

        return $this->successResponse("success", $transactionTypes);
    }

    public function getbyId($id)
    {
        $transactionTypes = TransactionType::where("sn", $id)->get();

        return $this->successResponse("success", $transactionTypes);
    }

    // Show the form for creating a new transaction type.
    public function create()
    {
        return view('transaction_types.create');
    }

    // Store a newly created transaction type in the database.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:transaction_types|max:255',
            'description' => 'nullable',
        ]);

        TransactionType::create($validatedData);
        return redirect()->route('transaction_types.index')->with('success', 'Transaction type created successfully.');
    }

    // Display the specified transaction type.
    public function show(TransactionType $transactionType)
    {
        return view('transaction_types.show', compact('transactionType'));
    }

    // Show the form for editing the specified transaction type.
    public function edit(TransactionType $transactionType)
    {
        return view('transaction_types.edit', compact('transactionType'));
    }

    // Update the specified transaction type in the database.
    public function update(Request $request, TransactionType $transactionType)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:transaction_types,name,' . $transactionType->id . '|max:255',
            'description' => 'nullable',
        ]);

        $transactionType->update($validatedData);
        return redirect()->route('transaction_types.index')->with('success', 'Transaction type updated successfully.');
    }

    // Remove the specified transaction type from the database.
    public function destroy(TransactionType $transactionType)
    {
        $transactionType->delete();
        return redirect()->route('transaction_types.index')->with('success', 'Transaction type deleted successfully.');
    }

    // Report: Transactions by transaction type
    public function transactionsByType($typeId)
    {
        $transactionType = TransactionType::findOrFail($typeId);
        $transactions = $transactionType->transactions;
        return view('transaction_types.reports.transactions_by_type', compact('transactions', 'transactionType'));
    }

    // Report: Transaction types with the highest number of transactions
    public function mostActiveTransactionTypes()
    {
        $transactionTypes = TransactionType::withCount('transactions')->orderByDesc('transactions_count')->take(10)->get();
        return view('transaction_types.reports.most_active_transaction_types', compact('transactionTypes'));
    }

    // Report: Transaction types with the lowest number of transactions
    public function leastActiveTransactionTypes()
    {
        $transactionTypes = TransactionType::withCount('transactions')->orderBy('transactions_count')->take(10)->get();
        return view('transaction_types.reports.least_active_transaction_types', compact('transactionTypes'));
    }
}
