<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerSavingsPlan;

class CustomerSavingsPlanController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $customerSavingsPlans = CustomerSavingsPlan::all();
        return view('customer_savings_plans.index', compact('customerSavingsPlans'));
    }

    // Generate a report of customer savings plans by customer account ID
    public function getCustomerSavingsPlansByAccountID($accountID)
    {
        $customerSavingsPlans = CustomerSavingsPlan::where('customer_accountID', $accountID)->with(['plans'])->get();
        return $this->successResponse("success", $customerSavingsPlans);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('customer_savings_plans.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_accountID' => 'required|max:50',
            'savings_planID' => 'required|integer',
            // Add validation rules for other fields as needed
        ]);

        CustomerSavingsPlan::create($validatedData);
        return redirect()->route('customer_savings_plans.index')->with('success', 'Customer savings plan created successfully.');
    }

    // Display the specified resource.
    public function show(CustomerSavingsPlan $customerSavingsPlan)
    {
        return view('customer_savings_plans.show', compact('customerSavingsPlan'));
    }

    // Show the form for editing the specified resource.
    public function edit(CustomerSavingsPlan $customerSavingsPlan)
    {
        return view('customer_savings_plans.edit', compact('customerSavingsPlan'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, CustomerSavingsPlan $customerSavingsPlan)
    {
        $validatedData = $request->validate([
            'customer_accountID' => 'required|max:50',
            'savings_planID' => 'required|integer',
            // Add validation rules for other fields as needed
        ]);

        $customerSavingsPlan->update($validatedData);
        return redirect()->route('customer_savings_plans.index')->with('success', 'Customer savings plan updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(CustomerSavingsPlan $customerSavingsPlan)
    {
        $customerSavingsPlan->delete();
        return redirect()->route('customer_savings_plans.index')->with('success', 'Customer savings plan deleted successfully.');
    }

    // Generate a report of customer savings plans by customer account ID
    public function customerSavingsPlansByAccountID($accountID)
    {
        $customerSavingsPlans = CustomerSavingsPlan::where('customer_accountID', $accountID)->get();
        return view('customer_savings_plans.reports.by_account_id', compact('customerSavingsPlans'));
    }

    // Generate a report of customer savings plans by savings plan ID
    public function customerSavingsPlansBySavingsPlanID($savingsPlanID)
    {
        $customerSavingsPlans = CustomerSavingsPlan::where('savings_planID', $savingsPlanID)->get();
        return view('customer_savings_plans.reports.by_savings_plan_id', compact('customerSavingsPlans'));
    }

    // Generate a report of customer savings plans by date range
    public function customerSavingsPlansByDateRange(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $customerSavingsPlans = CustomerSavingsPlan::whereBetween('created_at', [$validatedData['start_date'], $validatedData['end_date']])->get();
        return view('customer_savings_plans.reports.by_date_range', compact('customerSavingsPlans'));
    }

    //update savings plan balance
    public function updateBalance($customer_id, $savings_plan_id, $amount)
    {
        $record = CustomerSavingsPlan::where('customer_accountID', $customer_id)
            ->where('savings_planID', $savings_plan_id)
            ->where('status', 'Active')
            ->first();

        if ($record) {
            $update_query = [
                'balance' => $amount,
                'updated_at' => now(),
            ];

            $record->update($update_query);
            return $this->successResponse("Balance updated successfully");
        } else {
            return $this->errorResponse("Record not found for customer_id: $customer_id and savings_plan_id: $savings_plan_id", [], 404);
        }
    }



}
