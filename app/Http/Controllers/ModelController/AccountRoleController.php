<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\AccountRole;
use Illuminate\Http\Request;

class AccountRoleController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $accountRoles = AccountRole::all();
        return view('accountRoles.index', compact('accountRoles'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('accountRoles.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required|unique:account_roles|max:255',
        ]);

        AccountRole::create($validatedData);
        return redirect()->route('accountRoles.index')->with('success', 'Account Role created successfully.');
    }

    // Display the specified resource.
    public function show(AccountRole $accountRole)
    {
        return view('accountRoles.show', compact('accountRole'));
    }

    // Show the form for editing the specified resource.
    public function edit(AccountRole $accountRole)
    {
        return view('accountRoles.edit', compact('accountRole'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, AccountRole $accountRole)
    {
        $validatedData = $request->validate([
            'role' => 'required|unique:account_roles|max:255',
        ]);

        $accountRole->update($validatedData);
        return redirect()->route('accountRoles.index')->with('success', 'Account Role updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(AccountRole $accountRole)
    {
        $accountRole->delete();
        return redirect()->route('accountRoles.index')->with('success', 'Account Role deleted successfully.');
    }

    // Report: Total number of account roles
    public function totalRoles()
    {
        $totalRoles = AccountRole::count();
        return view('accountRoles.reports.totalRoles', compact('totalRoles'));
    }

    // Report: Account roles with specific conditions
    public function rolesWithConditions(Request $request)
    {
        $condition = $request->input('condition');
        $accountRoles = AccountRole::where('condition_field', $condition)->get();
        return view('accountRoles.reports.rolesWithConditions', compact('accountRoles'));
    }

    // Report: List of account roles created this month
    public function rolesCreatedThisMonth()
    {
        $rolesCreatedThisMonth = AccountRole::whereMonth('created_at', now()->month)->get();
        return view('accountRoles.reports.rolesCreatedThisMonth', compact('rolesCreatedThisMonth'));
    }

    // Report: List of account roles created by specific user
    public function rolesCreatedByUser($userId)
    {
        $rolesCreatedByUser = AccountRole::where('created_by', $userId)->get();
        return view('accountRoles.reports.rolesCreatedByUser', compact('rolesCreatedByUser'));
    }

    // Add more report methods as needed...
}
