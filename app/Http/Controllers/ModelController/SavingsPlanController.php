<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\SavingsPlan;
use Illuminate\Http\Request;

class SavingsPlanController extends Controller
{
    // Display a listing of the savings plans.
    public function index()
    {
        $savingsPlans = SavingsPlan::all();
        return view('savings_plans.index', compact('savingsPlans'));
    }

    // Display active customers.
    public function activePlans()
    {
        $savings_plan = SavingsPlan::where("status", "Active")->get();

        return $this->successResponse(
            "success",
            $savings_plan
        );
    }

    // Show the form for creating a new savings plan.
    public function create()
    {
        return view('savings_plans.create');
    }

    // Store a newly created savings plan in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plan_name' => 'required|max:150',
            'code' => 'required|max:50|unique:savings_plans',
        ]);

        SavingsPlan::create($validatedData);
        return redirect()->route('savings_plans.index')->with('success', 'Savings plan created successfully.');
    }

    // Display the specified savings plan.
    public function show(SavingsPlan $savingsPlan)
    {
        return view('savings_plans.show', compact('savingsPlan'));
    }

    // Show the form for editing the specified savings plan.
    public function edit(SavingsPlan $savingsPlan)
    {
        return view('savings_plans.edit', compact('savingsPlan'));
    }

    // Update the specified savings plan in storage.
    public function update(Request $request, SavingsPlan $savingsPlan)
    {
        $validatedData = $request->validate([
            'plan_name' => 'required|max:150',
            'code' => 'required|max:50|unique:savings_plans,code,' . $savingsPlan->id,
        ]);

        $savingsPlan->update($validatedData);
        return redirect()->route('savings_plans.index')->with('success', 'Savings plan updated successfully.');
    }

    // Remove the specified savings plan from storage.
    public function destroy(SavingsPlan $savingsPlan)
    {
        $savingsPlan->delete();
        return redirect()->route('savings_plans.index')->with('success', 'Savings plan deleted successfully.');
    }

    // Generate a report of savings plans by name
    public function savingsPlansByName($name)
    {
        $savingsPlans = SavingsPlan::where('plan_name', 'like', '%' . $name . '%')->get();
        return view('savings_plans.reports.by_name', compact('savingsPlans'));
    }

    // Generate a report of savings plans by code
    public function savingsPlansByCode($code)
    {
        $savingsPlans = SavingsPlan::where('code', $code)->get();
        return view('savings_plans.reports.by_code', compact('savingsPlans'));
    }
}
