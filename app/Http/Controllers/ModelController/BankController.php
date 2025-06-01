<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * get all Banks
     */
    public function getAllBanks()
    {
        $records = Bank::all();

        return $this->successResponse("success", $records);
    }

    /**
     * get all active banks
     */
    public function getActiveBank($today_only = 'N')
    {
        $records = Bank::where('status', 'active')->orderBy("created_at", "desc")->get();

        return $this->successResponse("success", $records);
    }


    /**
     * get bank by ID
     */
    public function getBankById($bank_id)
    {
        $records = Bank::where('id', $bank_id)->orderBy("created_at", "desc")->get();

        return $this->successResponse("success", $records);
    }
    
    // Display a listing of the resource.
    public function index()
    {
        $banks = Bank::all();
        return view('banks.index', compact('banks'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('banks.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bank_name' => 'required|unique:banks|max:150',
            'branch' => 'required|max:50',
            'sort_code' => 'max:15',
            'status' => 'required|max:20',
        ]);

        Bank::create($validatedData);
        return redirect()->route('banks.index')->with('success', 'Bank created successfully.');
    }

    // Display the specified resource.
    public function show(Bank $bank)
    {
        return view('banks.show', compact('bank'));
    }

    // Show the form for editing the specified resource.
    public function edit(Bank $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Bank $bank)
    {
        $validatedData = $request->validate([
            'bank_name' => 'required|unique:banks|max:150',
            'branch' => 'required|max:50',
            'sort_code' => 'max:15',
            'status' => 'required|max:20',
        ]);

        $bank->update($validatedData);
        return redirect()->route('banks.index')->with('success', 'Bank updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect()->route('banks.index')->with('success', 'Bank deleted successfully.');
    }

    // Report: List of active banks
    public function activeBanks()
    {
        $activeBanks = Bank::where('status', 'Active')->get();
        return view('banks.reports.activeBanks', compact('activeBanks'));
    }

    // Report: List of inactive banks
    public function inactiveBanks()
    {
        $inactiveBanks = Bank::where('status', 'Inactive')->get();
        return view('banks.reports.inactiveBanks', compact('inactiveBanks'));
    }

    // Report: List of banks with branches in a specific city
    public function banksInCity($city)
    {
        $banksInCity = Bank::where('branch', 'like', '%' . $city . '%')->get();
        return view('banks.reports.banksInCity', compact('banksInCity', 'city'));
    }

    // Add more report methods as needed...
}
