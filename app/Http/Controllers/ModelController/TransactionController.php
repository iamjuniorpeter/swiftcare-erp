<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    // Display a listing of the transactions.
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    // get transaction record
    public function get($transaction_reference)
    {
        $transaction = Transaction::with(
            [
                "customer", "accountOfficer", "transactionType", "transactionMode",
                "customer.bankAccount", "customer.address", "customer.nextOfKin",
                "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                "customer.bankAccount.bank", "customer.savingsPlan.plans"
            ]
        )->where("trans_reference", $transaction_reference)
            ->get();

        return $this->successResponse("success", $transaction);
    }

    // get all transaction records
    public function getAllTransaction()
    {
        $transactions = Transaction::with(
                ["customer", "accountOfficer", "transactionType", "transactionMode", 
                "customer.bankAccount", "customer.address", "customer.nextOfKin",
                "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                "customer.bankAccount.bank", "customer.savingsPlan.plans"]
            )->orderBy("created_at", "desc")
            ->get();

        return $this->successResponse("success", $transactions);
    }

    // get all transaction records by status
    public function getTransactionByStatus($status)
    {
        if($status == "all"){
            $transactions = Transaction::with(
                [
                    "customer", "accountOfficer", "transactionType", "transactionMode", 
                    "customer.bankAccount", "customer.address", "customer.nextOfKin",
                    "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                    "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                    "customer.bankAccount.bank", "customer.savingsPlan.plans"
                ]
            )->orderBy("created_at", "desc")
            ->get();
        }else{
            $transactions = Transaction::with(
                [
                    "customer", "accountOfficer", "transactionType", "transactionMode", 
                    "customer.bankAccount", "customer.address", "customer.nextOfKin",
                    "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                    "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                    "customer.bankAccount.bank", "customer.savingsPlan.plans"
                ]
            )->where("status", $status)
            ->orderBy("created_at", "desc")
            ->get();
        }

        return $this->successResponse("success", $transactions);
    }

    // get all transaction total amount by status
    public function getTransactionTotalByStatus($status)
    {
        try {
            if ($status == "all") {
                $totalAmount = Transaction::sum('amount');
            } else {
                $totalAmount = Transaction::where('status', $status)->sum('amount');
            }

            return $this->successResponse("success", $totalAmount);
        } catch (\Exception $e) {
            // Log the error if needed
            Log::error($e->getMessage());

            // Return -1 indicating an error
            return $this->successResponse("success", "-1");
        }
    }

    // get all transaction records by status
    public function getTransactionByStatusAndAccountOfficer($status, $account_officer_id)
    {
        if ($status == "all") {
            $transactions = Transaction::with(
                [
                    "customer", "accountOfficer", "transactionType", "transactionMode",
                    "customer.bankAccount", "customer.address", "customer.nextOfKin",
                    "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                    "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                    "customer.bankAccount.bank", "customer.savingsPlan.plans"
                ]
            )->where("account_officerID", $account_officer_id)
            ->orderBy("created_at", "desc")
                ->get();
        } else {
            $transactions = Transaction::with(
                [
                    "customer", "accountOfficer", "transactionType", "transactionMode",
                    "customer.bankAccount", "customer.address", "customer.nextOfKin",
                    "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                    "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                    "customer.bankAccount.bank", "customer.savingsPlan.plans"
                ]
            )->where("status", $status)
                ->where("account_officerID", $account_officer_id)
                ->orderBy("created_at", "desc")
                ->get();
        }

        return $this->successResponse("success", $transactions);
    }

    // get all transaction total amount by status
    public function getTransactionTotalByStatusAndAccountOfficer($status, $account_officer_id)
    {
        try {
            if ($status == "all") {
                $totalAmount = Transaction::where("account_officerID", $account_officer_id)->sum('amount');
            } else {
                $totalAmount = Transaction::where('status', $status)->where("account_officerID", $account_officer_id)->sum('amount');
            }

            return $this->successResponse("success",
                $totalAmount
            );
        } catch (\Exception $e) {
            // Log the error if needed
            Log::error($e->getMessage());

            // Return -1 indicating an error
            return $this->successResponse("success",
                "-1"
            );
        }
    }

    // get all transaction records by status
    public function getTransactionByStatusAndTransactionDate($status, $date_from, $date_to)
    {
        if ($status == "all") {
            $transactions = Transaction::with(
                [
                    "customer", "accountOfficer", "transactionType", "transactionMode",
                    "customer.bankAccount", "customer.address", "customer.nextOfKin",
                    "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                    "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                    "customer.bankAccount.bank", "customer.savingsPlan.plans"
                ]
            )->whereBetween("created_at", [$date_from, $date_to])
            ->orderBy("created_at", "desc")
                ->get();
        } else {
            $transactions = Transaction::with(
                [
                    "customer", "accountOfficer", "transactionType", "transactionMode",
                    "customer.bankAccount", "customer.address", "customer.nextOfKin",
                    "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                    "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                    "customer.bankAccount.bank", "customer.savingsPlan.plans"
                ]
            )->where("status", $status)
                ->whereBetween("created_at", [$date_from, $date_to])
                ->orderBy("created_at", "desc")
                ->get();
        }

        return $this->successResponse("success", $transactions);
    }

    // get all transaction total amount by status
    public function getTransactionTotalByStatusAndTransactionDate($status, $date_from, $date_to)
    {
        try {
            if ($status == "all") {
                $totalAmount = Transaction::whereBetween("created_at", [$date_from, $date_to])->sum('amount');
            } else {
                $totalAmount = Transaction::where('status', $status)->whereBetween("created_at", [$date_from, $date_to])->sum('amount');
            }

            return $this->successResponse(
                "success",
                $totalAmount
            );
        } catch (\Exception $e) {
            // Log the error if needed
            Log::error($e->getMessage());

            // Return -1 indicating an error
            return $this->successResponse(
                "success",
                "-1"
            );
        }
    }


    // get all transaction records by transaction type
    public function getTransactionByType($trans_type)
    {
        $trans_type = strtolower($trans_type);

        if ($trans_type == "debit") {
            $transactions = Transaction::with(
                [
                    "customer", "accountOfficer", "transactionType", "transactionMode",
                    "customer.bankAccount", "customer.address", "customer.nextOfKin",
                    "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                    "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                    "customer.bankAccount.bank", "customer.savingsPlan.plans"
                ]
            )->whereHas("transactionType", function ($query) {
                $query->where("code", "DR");
            })
            ->orderBy("created_at", "desc")
            ->get();
        } elseif ($trans_type == "credit") {
            $transactions = Transaction::with(
                [
                    "customer", "accountOfficer", "transactionType", "transactionMode",
                    "customer.bankAccount", "customer.address", "customer.nextOfKin",
                    "customer.savingsPlan", "customer.accountOfficer", "customer.zone",
                    "customer.stateOfOrigin", "customer.lgaOfOrigin", "customer.address.stateOfResidence",
                    "customer.bankAccount.bank", "customer.savingsPlan.plans"
                ]
            )->whereHas("transactionType", function ($query) {
                $query->where("code", "CR");
            })
            ->orderBy("created_at", "desc")
            ->get();
        }else{
            $transactions = [];
        }

        return $this->successResponse("success", $transactions);
    }

    // Show the form for creating a new transaction.
    public function create()
    {
        return view('transactions.create');
    }

    // Store a newly created transaction in the database.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'trans_reference' => 'required|max:300',
            'customer_accountID' => 'required|max:50',
            'account_officerID' => 'required|max:50',
            'trans_typeID' => 'required|exists:tbl_trans_type,sn',
            'amount' => 'required|numeric',
            'description' => 'nullable',
        ]);

        Transaction::create($validatedData);
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    // Display the specified transaction.
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    // Show the form for editing the specified transaction.
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    // Update the specified transaction in the database.
    public function update(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'trans_reference' => 'required|max:300',
            'customer_accountID' => 'required|max:50',
            'account_officerID' => 'required|max:50',
            'trans_typeID' => 'required|exists:tbl_trans_type,sn',
            'amount' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $transaction->update($validatedData);
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    // Remove the specified transaction from the database.
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    // Report: Transactions by customer
    public function transactionsByCustomer($customerId)
    {
        // Logic to retrieve transactions by customer goes here
        return view('transactions.reports.transactions_by_customer');
    }

    // Report: Transactions by staff
    public function transactionsByStaff($staffId)
    {
        $transactions = Transaction::where('account_officerID', $staffId)->get();
        return view('transactions.reports.transactions_by_staff', compact('transactions'));
    }

    // Report: Transactions by month
    public function transactionsByMonth($month)
    {
        $transactions = Transaction::whereMonth('created_at', $month)->get();
        return view('transactions.reports.transactions_by_month', compact('transactions'));
    }

    // Report: Transactions by period
    public function transactionsByPeriod($startPeriod, $endPeriod)
    {
        $transactions = Transaction::whereBetween('created_at', [$startPeriod, $endPeriod])->get();
        return view('transactions.reports.transactions_by_period', compact('transactions'));
    }

    // Report: Transactions by year
    public function transactionsByYear($year)
    {
        $transactions = Transaction::whereYear('created_at', $year)->get();
        return view('transactions.reports.transactions_by_year', compact('transactions'));
    }

    // Report: Transactions by transaction type
    public function transactionsByType($typeId)
    {
        $transactions = Transaction::where('trans_typeID', $typeId)->get();
        return view('transactions.reports.transactions_by_type', compact('transactions'));
    }

    // Report: Transactions by mode of transaction
    public function transactionsByMode($mode)
    {
        $transactions = Transaction::where('mode_of_transaction', $mode)->get();
        return view('transactions.reports.transactions_by_mode', compact('transactions'));
    }

}
