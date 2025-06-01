<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display a listing of the users.
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new user.
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:150',
            'password' => 'required|max:300',
            'accountID' => 'required|max:50',
            'account_categoryID' => 'required|integer',
            'account_typeID' => 'required|integer',
            'account_roleID' => 'required|integer',
            // Add validation rules for other fields as needed
        ]);

        User::create($validatedData);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Display the specified user.
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show the form for editing the specified user.
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the specified user in the database.
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:150',
            'password' => 'required|max:300',
            'accountID' => 'required|max:50',
            'account_categoryID' => 'required|integer',
            'account_typeID' => 'required|integer',
            'account_roleID' => 'required|integer',
            // Add validation rules for other fields as needed
        ]);

        $user->update($validatedData);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from the database.
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    // Report: Users by account category
    public function usersByAccountCategory($categoryId)
    {
        $users = User::where('account_categoryID', $categoryId)->get();
        return view('users.reports.users_by_account_category', compact('users', 'categoryId'));
    }

    // Report: Users by account type
    public function usersByAccountType($typeId)
    {
        $users = User::where('account_typeID', $typeId)->get();
        return view('users.reports.users_by_account_type', compact('users', 'typeId'));
    }

    // Report: Users by account role
    public function usersByAccountRole($roleId)
    {
        $users = User::where('account_roleID', $roleId)->get();
        return view('users.reports.users_by_account_role', compact('users', 'roleId'));
    }
}
