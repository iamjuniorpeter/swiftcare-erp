<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $accountTypes = AccountType::all();
        return view('accountTypes.index', compact('accountTypes'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('accountTypes.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_name' => 'required|unique:account_types|max:255',
        ]);

        AccountType::create($validatedData);
        return redirect()->route('accountTypes.index')->with('success', 'Account Type created successfully.');
    }

    // Display the specified resource.
    public function show(AccountType $accountType)
    {
        return view('accountTypes.show', compact('accountType'));
    }

    // Show the form for editing the specified resource.
    public function edit(AccountType $accountType)
    {
        return view('accountTypes.edit', compact('accountType'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, AccountType $accountType)
    {
        $validatedData = $request->validate([
            'type_name' => 'required|unique:account_types|max:255',
        ]);

        $accountType->update($validatedData);
        return redirect()->route('accountTypes.index')->with('success', 'Account Type updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(AccountType $accountType)
    {
        $accountType->delete();
        return redirect()->route('accountTypes.index')->with('success', 'Account Type deleted successfully.');
    }

    // Report: Total number of account types
    public function totalTypes()
    {
        $totalTypes = AccountType::count();
        return view('accountTypes.reports.totalTypes', compact('totalTypes'));
    }

    // Report: Account types with specific conditions
    public function typesWithConditions(Request $request)
    {
        $condition = $request->input('condition');
        $accountTypes = AccountType::where('condition_field', $condition)->get();
        return view('accountTypes.reports.typesWithConditions', compact('accountTypes'));
    }

    // Report: List of account types created this month
    public function typesCreatedThisMonth()
    {
        $typesCreatedThisMonth = AccountType::whereMonth('created_at', now()->month)->get();
        return view('accountTypes.reports.typesCreatedThisMonth', compact('typesCreatedThisMonth'));
    }

    // Report: List of account types created by specific user
    public function typesCreatedByUser($userId)
    {
        $typesCreatedByUser = AccountType::where('created_by', $userId)->get();
        return view('accountTypes.reports.typesCreatedByUser', compact('typesCreatedByUser'));
    }

    // Add more report methods as needed...
}
