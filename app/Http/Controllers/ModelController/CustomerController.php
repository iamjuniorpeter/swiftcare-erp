<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerSavingsPlan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function index()
    {

        $merchant_id = Auth::user()->accountID;

        $customers = Customer::where("merchantID", $merchant_id)->get();

        return view('customers.index', compact('customers'));

    }

    // Show the form for creating a new resource.
    public function create()
    {
        $status_list =  $this->loadStatusIntoCombo();

        return view('customers.create', compact('status_list'));
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'merchantID'  => ['required'],
            'name'        => ['required'],
            'contact_person' => ['sometimes'],
            'phone'          => ['sometimes'],
            'email'          => ['sometimes'],
            'address'        => ['sometimes'],
            'status'         => ['sometimes'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        // if user didn't supply one, generate it
        if (empty($data['customer_id'])) {
            $data['customer_id'] = $this->generateUniqueId("CUS", 8);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $customer = Customer::create([
                    'customer_id'   => $data['customer_id'],
                    'merchantID'    => $data['merchantID'],
                    'name'          => $data['name'],
                    'contact_person' => $data['contact_person'] ?? null,
                    'phone'         => $data['phone'] ?? null,
                    'email'         => $data['email'] ?? null,
                    'address'       => $data['address'] ?? null,
                    'status'        => $data['status'] ?? 'active',
                ]);
                return $this->successResponse("Customer successfully created.", $customer);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating customer.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                return $this->errorResponse("Customer not found.", [], 201);
            }
            return $this->successResponse("Customer retrieved successfully.", $customer);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving customer.", $e->getMessage(), 201);
        }
    }

    public function edit($id)
    {
        // Fetch the item (or 404)
        $customer = Customer::findOrFail($id);

        $status_list =  $this->loadStatusIntoCombo($customer->status);

        return view('customers.edit', compact('customer', 'status_list'));
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'name' => ['required'],
            'contact_person' => ['sometimes'],
            'phone'          => ['sometimes'],
            'email'          => ['sometimes', 'email'],
            'address'        => ['sometimes'],
            'status'         => ['sometimes'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data, $id) {
                $customer = Customer::find($id);
                if (!$customer) {
                    return $this->errorResponse("Customer not found.", [], 201);
                }
                $customer->update([
                    'name'          => $data['name'],
                    'contact_person' => $data['contact_person'] ?? $customer->contact_person,
                    'phone'         => $data['phone'] ?? $customer->phone,
                    'email'         => $data['email'] ?? $customer->email,
                    'address'       => $data['address'] ?? $customer->address,
                    'status'        => $data['status'] ?? $customer->status,
                ]);
                return $this->successResponse("Customer successfully updated.", $customer);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating customer.", $e->getMessage(), 201);
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                return $this->errorResponse("Customer not found.", [], 201);
            }
            DB::transaction(function () use ($customer) {
                $customer->delete();
            });
            return $this->successResponse("Customer successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting customer.", $e->getMessage(), 201);
        }
    }

    // Display a listing of the resource.
    public function getAllCustomers($status = "Active")
    {
        if ($status == "all") {
            $customers = Customer::with(['accountOfficer', 'zone', 'stateOfOrigin', 'lgaOfOrigin', 'bankAccount', 'bankAccount.bank', 'address', 'nextOfKin', 'savingsPlan', 'savingsPlan.plans'])->orderBy('created_at', 'desc')->get();
        } else {
            $customers = Customer::where('status', $status)->with(['accountOfficer', 'zone', 'stateOfOrigin', 'lgaOfOrigin', 'bankAccount', 'bankAccount.bank', 'address', 'nextOfKin', 'savingsPlan', 'savingsPlan.plans'])->orderBy('created_at', 'desc')->get();
        }


        return $this->successResponse("success", $customers);
    }

    public function get($customer_account_id)
    {
        $customer = Customer::where('account_id', $customer_account_id)->with(['accountOfficer', 'zone', 'stateOfOrigin', 'lgaOfOrigin', 'bankAccount', 'bankAccount.bank', 'address', 'nextOfKin', 'savingsPlan', 'savingsPlan.plans'])->get();

        return $this->successResponse("success", $customer);
    }

    // Display active customers.
    public function activeCustomers()
    {
        $customers = Customer::where("status", "Active")->with(['accountOfficer', 'zone', 'stateOfOrigin', 'lgaOfOrigin', 'bankAccount', 'bankAccount.bank', 'address', 'nextOfKin', 'savingsPlan', 'savingsPlan.plans'])->orderBy('created_at', 'desc')->get();

        return $this->successResponse("success", $customers);
    }

    public function staffActiveCustomers($staff_id)
    {
        $customers = Customer::where("status", "Active")->where("account_officerID", $staff_id)->with(['accountOfficer', 'zone', 'stateOfOrigin', 'lgaOfOrigin', 'bankAccount', 'bankAccount.bank', 'address', 'nextOfKin', 'savingsPlan', 'savingsPlan.plans'])->orderBy('created_at', 'desc')->get();

        return $this->successResponse("success", $customers);
    }

    // get customer all time contribution.
    public function getCustomerTotalContribution($customer_id)
    {
        $totalCreditAmount = Transaction::where('customer_accountID', $customer_id)
            ->where('status', "Approved")
            ->whereHas('transactionType', function ($query) {
                $query->where('action', 'credit');
            })
            ->sum('amount');

        return $this->successResponse(
            "success",
            ($totalCreditAmount ?? 0)
        );
    }

    // get customer all time withdrawal.
    public function getCustomerTotalWithdrawal($customer_id)
    {
        $totalDebitAmount = Transaction::where('customer_accountID', $customer_id)
            ->where('status', "Approved")
            ->whereHas('transactionType', function ($query) {
                $query->where('action', 'debit');
            })
            ->sum('amount');

        return $this->successResponse(
            "success",
            ($totalDebitAmount ?? 0)
        );
    }

    // compute customer total balance.
    public function computeCustomerTotalBalance($customer_id)
    {
        $totalCreditAmount = Transaction::where('customer_accountID', $customer_id)
            ->where('status', "Approved")
            ->whereHas('transactionType', function ($query) {
                $query->where('action', 'credit');
            })
            ->sum('amount');

        $totalDebitAmount = Transaction::where('customer_accountID', $customer_id)
            ->where('status', "Approved")
            ->whereHas('transactionType', function ($query) {
                $query->where('action', 'debit');
            })
            ->sum('amount');

        $customerBalance = ($totalCreditAmount ?? 0) - ($totalDebitAmount ?? 0);

        return $this->successResponse(
            "success",
            $customerBalance
        );
    }

    // compute customer savings plan balance.
    public function computeCustomerSavingsPlanBalance($customer_id, $savings_plan_id)
    {
        $totalCreditAmount = Transaction::where('customer_accountID', $customer_id)
            ->where('savings_planID', $savings_plan_id)
            ->where('status', "Approved")
            ->whereHas('transactionType', function ($query) {
                $query->where('action', 'credit');
            })
            ->sum('amount');

        $totalDebitAmount = Transaction::where('customer_accountID', $customer_id)
            ->where('savings_planID', $savings_plan_id)
            ->where('status', "Approved")
            ->whereHas('transactionType', function ($query) {
                $query->where('action', 'debit');
            })
            ->sum('amount');

        $customerBalance = ($totalCreditAmount ?? 0) - ($totalDebitAmount ?? 0);

        return $this->successResponse(
            "success",
            $customerBalance
        );
    }

    // get customer total balance.
    public function getCustomerTotalBalance($customer_id)
    {
        $customerBalance = CustomerSavingsPlan::where('customer_accountID', $customer_id)
            ->where('status', "Active")
            ->sum('balance');

        $customerBalance = $customerBalance ?? 0;

        return $this->successResponse(
            "success",
            $customerBalance
        );
    }

    // get customer savings plan balance.

    public function getCustomerPlanBalance($customer_id, $savings_plan_id)
    {
        $customerBalance = CustomerSavingsPlan::where('customer_accountID', $customer_id)
            ->where('savings_planID', $savings_plan_id)
            ->where('status', "Active")
            ->sum('balance');

        $customerBalance = $customerBalance ?? NULL;

        return $this->successResponse(
            "success",
            $customerBalance
        );
    }


    // Store a newly created resource in storage.
    public function store1(Request $request)
    {
        $validatedData = $request->validate([
            'account_id' => 'required|unique:customers|max:50',
            'surname' => 'required|max:150',
            'other_names' => 'max:150',
            'gender' => 'required|in:Male,Female',
            'marital_status' => 'required|in:Single,Married,Divorced,Widowed',
            'date_of_birth' => 'required|date',
            'phone_1' => 'required',
            'phone_2' => 'nullable',
            'lga_of_originID' => 'nullable|integer',
            'state_of_originID' => 'nullable|integer',
            'is_employed' => 'required|in:Y,N',
            'zoneID' => 'nullable|integer',
            'account_officerID' => 'nullable|integer',
            'mothers_maiden_name' => 'required|max:150',
            'remark' => 'nullable|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for other fields as needed
        ]);

        Customer::create($validatedData);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    // Display the specified resource.
    public function show1(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    // Show the form for editing the specified resource.
    public function edit1(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Update the specified resource in storage.
    public function update1(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'account_id' => 'required|unique:customers,account_id,' . $customer->id . '|max:50',
            'surname' => 'required|max:150',
            'other_names' => 'max:150',
            'gender' => 'required|in:Male,Female',
            'marital_status' => 'required|in:Single,Married,Divorced,Widowed',
            'date_of_birth' => 'required|date',
            'phone_1' => 'required',
            'phone_2' => 'nullable',
            'lga_of_originID' => 'nullable|integer',
            'state_of_originID' => 'nullable|integer',
            'is_employed' => 'required|in:Y,N',
            'zoneID' => 'nullable|integer',
            'account_officerID' => 'nullable|integer',
            'mothers_maiden_name' => 'required|max:150',
            'remark' => 'nullable|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for other fields as needed
        ]);

        $customer->update($validatedData);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy1(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }

    public function transactionHistory($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $transactions = $customer->transactions()->orderBy('created_at', 'desc')->get();

        return response()->json($transactions);
    }

    public function getCustomersByAccountOfficer($accountId, $status = "active")
    {
        $customers = Customer::where('account_officerID', $accountId)->where('status', $status)->with(['accountOfficer', 'zone', 'stateOfOrigin', 'lgaOfOrigin', 'bankAccount', 'bankAccount.bank', 'address', 'nextOfKin', 'savingsPlan', 'savingsPlan.plans'])->orderBy('created_at', 'desc')->get();

        return $this->successResponse("success", $customers);
    }

    public function getCustomersByStatus($status)
    {
        $customers = Customer::where('status', $status)->with(['accountOfficer', 'zone', 'stateOfOrigin', 'lgaOfOrigin', 'bankAccount', 'bankAccount.bank', 'address', 'nextOfKin', 'savingsPlan', 'savingsPlan.plans'])->orderBy('created_at', 'desc')->get();

        return $this->successResponse("success", $customers);
    }

    public function customersByMonth($month)
    {
        $customers = Customer::whereMonth('created_at', $month)->get();

        return response()->json($customers);
    }

    public function customersByPeriod($startDate, $endDate)
    {
        $customers = Customer::whereBetween('created_at', [$startDate, $endDate])->get();

        return response()->json($customers);
    }

    public function customersByYear($year)
    {
        $customers = Customer::whereYear('created_at', $year)->get();

        return response()->json($customers);
    }

    public function customersByZone($zoneId)
    {
        $customers = Customer::where('zoneID', $zoneId)->get();

        return response()->json($customers);
    }

    public function customersByState($stateId)
    {
        $customers = Customer::where('state_of_originID', $stateId)->get();

        return response()->json($customers);
    }

    public function customersByLga($lgaId)
    {
        $customers = Customer::where('lga_of_originID', $lgaId)->get();

        return response()->json($customers);
    }

    public function customersByGender($gender)
    {
        $customers = Customer::where('gender', $gender)->get();

        return response()->json($customers);
    }

    public function customersByAgeDemography($minAge, $maxAge)
    {
        $customers = Customer::whereBetween('date_of_birth', [now()->subYears($maxAge), now()->subYears($minAge)])->get();

        return response()->json($customers);
    }

    public function customersByMaritalStatus($maritalStatus)
    {
        $customers = Customer::where('marital_status', $maritalStatus)->get();

        return response()->json($customers);
    }

    public function customersByEmploymentStatus($employmentStatus)
    {
        $customers = Customer::where('is_employed', $employmentStatus)->get();

        return response()->json($customers);
    }

    public function customersBySavingsPlan($savingsPlanId)
    {
        $customers = Customer::whereHas('savingsPlans', function ($query) use ($savingsPlanId) {
            $query->where('savings_planID', $savingsPlanId);
        })->get();

        return response()->json($customers);
    }

    public function viewSavingsPlans($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $savingsPlans = $customer->savingsPlans;

        // Calculate current balance for each savings plan
        $savingsPlans->transform(function ($savingsPlan) {
            $savingsPlan->current_balance = $savingsPlan->transactions()->sum('amount');
            return $savingsPlan;
        });

        return response()->json($savingsPlans);
    }

    public function viewContributionBreakdown($customerId, $savingsPlanId)
    {
        $customer = Customer::findOrFail($customerId);
        $savingsPlan = $customer->savingsPlans()->findOrFail($savingsPlanId);
        $contributions = $savingsPlan->transactions;

        return response()->json($contributions);
    }
}
