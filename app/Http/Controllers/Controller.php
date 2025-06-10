<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ModelController\BankController;
use App\Http\Controllers\ModelController\StateController;
use App\Http\Controllers\ModelController\CustomerController;
use App\Http\Controllers\ModelController\CustomerSavingsPlanController;
use App\Http\Controllers\ModelController\SavingsPlanController;
use App\Http\Controllers\ModelController\StaffController;
use App\Http\Controllers\ModelController\TransactionModeController;
use App\Http\Controllers\ModelController\TransactionTypeController;
use App\Http\Controllers\ModelController\ZoneController;
use App\Models\ItemBatch;
use App\Models\Category;
use App\Models\Warehouse;
use App\Models\Unit;
use App\Models\Supplier;
use Carbon\Carbon;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Validate incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateData(array $data, array $rules)
    {
        return Validator::make($data, $rules);
    }

    /**
     * Format and return error response
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorResponse($message, $dev_info = null, $code = 201): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'developer_info' => $dev_info
        ], $code);
    }

    /**
     * Format and return success response
     *
     * @param  string  $message
     * @param  array|string  $data
     * @param  int  $code
     * @return JsonResponse
     */
    protected function successResponse($message = '', $data = '', $code = 200): JsonResponse
    {
        $response = ['status' => 'success'];

        if ($message != '') {
            $response['message'] = $message;
        }

        if ($data != '') {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    protected function generateAccountId($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    protected function generateUniqueId($ref = "", $limit = 6)
    {
        return $ref . "-" . substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function generateUuid()
    {
        $uuid = Uuid::uuid4()->toString();

        return $uuid;
    }

    public function getDateTimeReference()
    {
        $microtime = microtime(true);
        $timestamp = floor($microtime);
        $milliseconds = round(($microtime - $timestamp) * 1000);

        $dateTimeString = date('YmdHis', $timestamp) . '' . str_pad($milliseconds, 3, '0', STR_PAD_LEFT);
        return $dateTimeString;
    }

    public function generateBatchNumber(): string
    {
        $prefix = 'BAT-' . now()->format('Ym'); // e.g., BAT-202504

        // Find the most recent batch with this prefix
        $lastBatch = ItemBatch::where('batch_number', 'like', "$prefix-%")
            ->orderBy('batch_number', 'desc')
            ->first();

        $lastSerial = 0;

        if ($lastBatch) {
            $parts = explode('-', $lastBatch->batch_number);
            $lastSerial = (int) end($parts); // Get last 5-digit number
        }

        $nextSerial = str_pad($lastSerial + 1, 5, '0', STR_PAD_LEFT);

        $batchNumber = "$prefix-$nextSerial";

        // Just in case — ensure it's not duplicated
        while (ItemBatch::where('batch_number', $batchNumber)->exists()) {
            $lastSerial++;
            $nextSerial = str_pad($lastSerial + 1, 5, '0', STR_PAD_LEFT);
            $batchNumber = "$prefix-$nextSerial";
        }

        return $batchNumber;
    }


    protected function formatDateTime($dbdate)
    {
        if ($dbdate == '' || is_null($dbdate)) {
            return 'N/A';
        }
        $time = strtotime($dbdate);

        $r = date("M d, Y", $time);

        if (strlen($dbdate) > 10) {
            $r = date("M d, Y @g:i:sa", $time);
        }

        return $r;
    }

    protected function formatDate($dbdate)
    {
        if ($dbdate == '' || is_null($dbdate)) {
            return 'N/A';
        }
        $time = strtotime($dbdate);

        $r = date("M d, Y", $time);

        if (strlen($dbdate) > 10) {
            $r = date("M d, Y", $time);
        }

        return $r;
    }

    protected function formatTime($dbtime)
    {
        if ($dbtime == '' || is_null($dbtime)) {
            return 'N/A';
        }
        $time = strtotime($dbtime);

        $r = date("H:s a", $time);

        if (strlen($dbtime) > 8) {
            $r = date("H:s a", $time);
        }

        return $r;
    }

    public function formatAmount($number, $decimal_places = 2)
    {
        // return number_format($number, 2, '.', ',');
        return number_format($number, $decimal_places, '.', ',');
    }

    public function getCurrentDate()
    {
        $date = Carbon::now();
        return $date->toDateString();
    }

    public function getCurrentDateTime()
    {
        $date_time = Carbon::now();
        return $date_time->toDateTimeString();
    }

    public function getCurrentTime()
    {
        $date_time = Carbon::now();
        return $date_time->toTimeString();
    }

    public function getStatusBadge($status = null)
    {
        $status_label = "";
        switch (strtolower($status)) {
            case 'pending':
            case 'partial':
            case 'low stock':
                $status_label = "<span class='badge badge-warning'>" . ucwords($status) . "</span>";
                break;

            case 'available':
            case 'approved':
            case 'fulfilled':
            case 'paid':
            case 'active':
            case 'in stock':
                $status_label = "<span class='badge badge-success'>" . ucwords($status) . "</span>";
                break;

            case 'declined':
            case 'cancelled':
            case 'inactive':
            case 'out of stock':
            case 'overdue':
                $status_label = "<span class='badge badge-danger'>" . ucwords($status) . "</span>";
                break;

            case 'draft':
            case 'other':
                $status_label = "<span class='badge badge-info'>" . ucwords($status) . "</span>";
                break;

            default:
                $status_label = "<span class='badge badge-secondary'>Unknown</span>";
                break;
        }

        return $status_label;
    }


    public function generateUniqueNumber()
    {
        $timestamp = now()->format('YmdHis');
        $randomNumber = Str::random(6);
        $uniqueNumber = $timestamp . $randomNumber;

        return $uniqueNumber;
    }

    public function calculateAge($dateOfBirth)
    {
        // Convert the date of birth to a DateTime object
        $dob = new DateTime($dateOfBirth);

        // Get the current date
        $currentDate = new DateTime();

        // Calculate the interval between the two dates
        $age = $currentDate->diff($dob);

        // Extract the years from the interval
        $years = $age->y;

        return $years;
    }

    public function loadGenderIntoCombo($param_cat = "")
    {
        $list =  [
            ["name" => "Male"],
            ["name" => "Female"]
        ];

        // Convert the array of associative arrays to an array of objects
        $list_of_objects = array_map(function ($item) {
            return (object)$item;
        }, $list);

        $cmb_list = "<option value='-1'>Select Gender</option>";

        foreach ($list_of_objects as $gender) {
            if ($gender->name == $param_cat) {
                $cmb_list .= "<option value='" . $gender->name . "' selected='selected'>" . $gender->name . " </option>";
            } else {
                $cmb_list .= "<option value='" . $gender->name . "'>" . $gender->name . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadMaritalStatusIntoCombo($param_cat = "")
    {
        $list =  [
            ["name" => "Married"],
            ["name" => "Single"],
            ["name" => "DIvorced"],
            ["name" => "Widowed"]
        ];

        // Convert the array of associative arrays to an array of objects
        $list_of_objects = array_map(function ($item) {
            return (object)$item;
        }, $list);

        $cmb_list = "<option value='-1'>Select Marital Status</option>";

        foreach ($list_of_objects as $marital_status) {
            if ($marital_status->name == $param_cat) {
                $cmb_list .= "<option value='" . $marital_status->name . "' selected='selected'>" . $marital_status->name . " </option>";
            } else {
                $cmb_list .= "<option value='" . $marital_status->name . "'>" . $marital_status->name . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadActiveCustomersIntoCombo($param_cat = "")
    {
        $customer_obj = new CustomerController;
        $customer_list = $customer_obj->activeCustomers()->getData()->data;

        if (count($customer_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Customer</option>";

        foreach ($customer_list as $customer) {
            if ($customer->account_id == $param_cat) {
                $cmb_list .= "<option value='" . $customer->account_id . "' selected='selected'>" . strtoupper($customer->surname) . " " . $customer->other_names . " - " . $customer->account_no . " </option>";
            } else {
                $cmb_list .= "<option value='" . $customer->account_id . "'>" . strtoupper($customer->surname) . " " . $customer->other_names . " - " . $customer->account_no . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadStatesIntoCombo($param_cat = "")
    {
        $state_obj = new StateController;
        $state_list = $state_obj->getAllState()->getData()->data;

        if (count($state_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select State</option>";

        foreach ($state_list as $state) {
            if ($state->sn == $param_cat) {
                $cmb_list .= "<option value='" . $state->sn . "' selected='selected'>" . $state->state_name . "  </option>";
            } else {
                $cmb_list .= "<option value='" . $state->sn . "'>" . $state->state_name . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadBanksIntoCombo($param_cat = "")
    {
        $bank_obj = new BankController();
        $bank_record = $bank_obj->getAllBanks()->getData()->data;

        if (count($bank_record) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Bank</option>";

        foreach ($bank_record as $bank) {
            if ($bank->sn == $param_cat) {
                $cmb_list .= "<option value='" . $bank->sn . "' selected='selected'> " . $bank->bank_name . " </option>";
            } else {
                $cmb_list .= "<option value='" . $bank->sn . "'> " . $bank->bank_name . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadActiveZonesIntoCombo($param_cat = "")
    {
        $zone_obj = new ZoneController();
        $zone_record = $zone_obj->getActiveZones()->getData()->data;

        if (count($zone_record) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Zone</option>";

        foreach ($zone_record as $zone) {
            if ($zone->sn == $param_cat) {
                $cmb_list .= "<option value='" . $zone->sn . "' selected='selected'> " . $zone->zone_name . " </option>";
            } else {
                $cmb_list .= "<option value='" . $zone->sn . "'> " . $zone->zone_name . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadStaffActiveCustomersIntoCombo($staff_id, $param_cat = "")
    {
        $customer_obj = new CustomerController;
        $customer_list = $customer_obj->staffActiveCustomers($staff_id)->getData()->data;

        if (count($customer_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Customer</option>";

        foreach ($customer_list as $customer) {
            if ($customer->account_id == $param_cat) {
                $cmb_list .= "<option value='" . $customer->account_id . "' selected='selected'>" . strtoupper($customer->surname) . " " . $customer->other_names . " - " . $customer->account_no . " </option>";
            } else {
                $cmb_list .= "<option value='" . $customer->account_id . "'>" . strtoupper($customer->surname) . " " . $customer->other_names . " - " . $customer->account_no . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadTransactionTypeIntoCombo($param_cat = "")
    {
        $transaction_type_obj = new TransactionTypeController;
        $transaction_type_list = $transaction_type_obj->get()->getData()->data;

        if (count($transaction_type_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Transaction Type</option>";

        foreach ($transaction_type_list as $transaction_type) {
            if ($transaction_type->sn == $param_cat) {
                $cmb_list .= "<option value='" . $transaction_type->sn . "' selected='selected'>" . $transaction_type->trans_type . " </option>";
            } else {
                $cmb_list .= "<option value='" . $transaction_type->sn . "'>" . $transaction_type->trans_type . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadTransactionModeIntoCombo($param_cat = "")
    {
        $transaction_mode_obj = new TransactionModeController;
        $transaction_mode_list = $transaction_mode_obj->get()->getData()->data;

        if (count($transaction_mode_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Transaction Mode</option>";

        foreach ($transaction_mode_list as $transaction_mode) {
            if ($transaction_mode->sn == $param_cat) {
                $cmb_list .= "<option value='" . $transaction_mode->sn . "' selected='selected'>" . $transaction_mode->trans_mode . " </option>";
            } else {
                $cmb_list .= "<option value='" . $transaction_mode->sn . "'>" . $transaction_mode->trans_mode . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadActiveStaffIntoCombo($param_cat = "")
    {
        $staff_obj = new StaffController;
        $staff_list = $staff_obj->activeStaff()->getData()->data;

        if (count($staff_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Staff</option>";

        foreach ($staff_list as $staff) {
            if ($staff->account_id == $param_cat) {
                $cmb_list .= "<option value='" . $staff->account_id . "' selected='selected'> " . strtoupper($staff->surname) . " " . $staff->first_name . " " . $staff->other_names . " </option>";
            } else {
                $cmb_list .= "<option value='" . $staff->account_id . "'>" . strtoupper($staff->surname) . " " . $staff->first_name . " " . $staff->other_names . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadActiveSavingsPlanIntoCombo($param_cat = "")
    {
        $savings_plan_obj = new SavingsPlanController;
        $savings_plan_list = $savings_plan_obj->activePlans()->getData()->data;

        if (count($savings_plan_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Savings Plan</option>";

        foreach ($savings_plan_list as $savings_plan) {
            if ($savings_plan->sn == $param_cat) {
                $cmb_list .= "<option value='" . $savings_plan->sn . "' selected='selected'>  " . $savings_plan->plan_name . "  (NGN " . formatAmount($savings_plan->amount) . ")</option>";
            } else {
                $cmb_list .= "<option value='" . $savings_plan->sn . "'> " . $savings_plan->plan_name . "  (NGN " . formatAmount($savings_plan->amount) . ") </option>";
            }
        }

        return $cmb_list;
    }

    public function loadCustomerActiveSavingsPlanIntoCombo($customer_id, $param_cat = "")
    {
        $savings_plan_obj = new CustomerSavingsPlanController;
        $savings_plan_list = $savings_plan_obj->getCustomerSavingsPlansByAccountID($customer_id)->getData()->data;

        if (count($savings_plan_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Savings Plan</option>";
        foreach ($savings_plan_list as $savings_plan) {
            $savings_plan = $savings_plan->plans;
            if ($savings_plan->sn == $param_cat) {
                $cmb_list .= "<option value='" . $savings_plan->sn . "' selected='selected'>  " . $savings_plan->plan_name . "  (NGN " . formatAmount($savings_plan->amount) . ")</option>";
            } else {
                $cmb_list .= "<option value='" . $savings_plan->sn . "'> " . $savings_plan->plan_name . "  (NGN " . formatAmount($savings_plan->amount) . ") </option>";
            }
        }

        return $cmb_list;
    }

    public function loadCategoryIntoCombo($param_cat = "")
    {
        $merchant_id = Auth::user()->accountID;
        $category_list = Category::where(function ($query) use ($merchant_id) {
            $query->where('merchantID', $merchant_id)
                  ->orWhereNull('merchantID')
                  ->orWhere('merchantID', '');
        })->get();

        if (count($category_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Category</option>";

        foreach ($category_list as $category) {
            if ($category->sn == $param_cat) {
                $cmb_list .= "<option value='" . $category->sn . "' selected='selected'>" . $category->name . " </option>";
            } else {
                $cmb_list .= "<option value='" . $category->sn . "'>" . $category->name . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadSubCategoryIntoCombo($category_id = "", $param_cat = "")
    {
        if ($category_id == "") {
            return "<option value='-1'>No Data Available</option>";
        }

        $merchant_id = Auth::user()->accountID;
        $category_list = SubCategory::where(function ($query) use ($merchant_id) {
            $query->where('merchantID', $merchant_id)
                  ->orWhereNull('merchantID')
                  ->orWhere('merchantID', '');
        })
        ->where('categoryID', $category_id)
        ->get();

        if (count($category_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Sub Category</option>";

        foreach ($category_list as $category) {
            if ($category->sn == $param_cat) {
                $cmb_list .= "<option value='" . $category->sn . "' selected='selected'>" . $category->name . " </option>";
            } else {
                $cmb_list .= "<option value='" . $category->sn . "'>" . $category->name . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadWarehousesIntoCombo($param_cat = "")
    {
        $merchant_id = Auth::user()->accountID;
        $warehouse_list = Warehouse::where(function ($query) use ($merchant_id) {
            $query->where('merchantID', $merchant_id)
                  ->orWhereNull('merchantID')
                  ->orWhere('merchantID', '');
        })
        ->get();

        if (count($warehouse_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Location</option>";

        foreach ($warehouse_list as $warehouse) {
            if ($warehouse->warehouse_id == $param_cat) {
                $cmb_list .= "<option value='" . $warehouse->warehouse_id . "' selected='selected'>" . $warehouse->name . " </option>";
            } else {
                $cmb_list .= "<option value='" . $warehouse->warehouse_id . "'>" . $warehouse->name . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadUnitsIntoCombo($param_cat = "")
    {
        $merchant_id = Auth::user()->accountID;
        $unit_list = Unit::where(function ($query) use ($merchant_id) {
            $query->where('merchantID', $merchant_id)
                  ->orWhereNull('merchantID')
                  ->orWhere('merchantID', '');
        })
        ->get();

        if (count($unit_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Unit</option>";

        foreach ($unit_list as $unit) {
            if ($unit->sn == $param_cat) {
                $cmb_list .= "<option value='" . $unit->sn . "' selected='selected'>" . $unit->unit_name . " </option>";
            } else {
                $cmb_list .= "<option value='" . $unit->sn . "'>" . $unit->unit_name . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadStatusIntoCombo($param_cat = "")
    {
        $list =  [
            ["name" => "active"],
            ["name" => "inactive"]
        ];

        // Convert the array of associative arrays to an array of objects
        $list_of_objects = array_map(function ($item) {
            return (object)$item;
        }, $list);

        $cmb_list = "<option value='-1'>Select Status</option>";

        foreach ($list_of_objects as $status) {
            if (strtolower($status->name) == strtolower($param_cat)) {
                $cmb_list .= "<option value='" . $status->name . "' selected='selected'>" . ucwords($status->name) . " </option>";
            } else {
                $cmb_list .= "<option value='" . $status->name . "'>" . ucwords($status->name) . " </option>";
            }
        }

        return $cmb_list;
    }

    public function loadSupplierIntoCombo($param_cat = "")
    {
        $merchant_id = Auth::user()->accountID;
        $supplier_list = Supplier::where(function ($query) use ($merchant_id) {
            $query->where('merchantID', $merchant_id)
                  ->orWhereNull('merchantID')
                  ->orWhere('merchantID', '');
        })
        ->get();

        if (count($supplier_list) < 1) {
            return "<option value='-1'>No Data Available</option>";
        }

        $cmb_list = "<option value='-1'>Select Supplier</option>";

        foreach ($supplier_list as $supplier) {
            if ($supplier->supplier_id == $param_cat) {
                $cmb_list .= "<option value='" . $supplier->supplier_id . "' selected='selected'>" . $supplier->name . " </option>";
            } else {
                $cmb_list .= "<option value='" . $supplier->supplier_id . "'>" . $supplier->name . " </option>";
            }
        }

        return $cmb_list;
    }

    //update customer savings plan balance
    public function updateCustomerBalance($trans_type_id, $customer_id, $savings_plan_id, $amount)
    {
        $customer_obj = new CustomerController;
        $customer_savings_plan_obj = new CustomerSavingsPlanController;
        $transaction_type_obj = new TransactionTypeController;

        $trans_type_record = $transaction_type_obj->getById($trans_type_id)->getData();
        $new_balance = 0;

        if (count($trans_type_record->data) > 0) {
            $trans_type = $trans_type_record->data[0]->code;

            $current_balance_record = $customer_obj->getCustomerPlanBalance($customer_id, $savings_plan_id)->getData()->data;

            if ($current_balance_record != NULL) {
                $current_balance = $current_balance_record;
                if ($trans_type == "CR") {
                    $new_balance = $current_balance + $amount;
                } elseif ($trans_type == "DR") {
                    $new_balance = $current_balance - $amount;
                } else {
                    $new_balance = $current_balance;
                }

                $result = $customer_savings_plan_obj->updateBalance($customer_id, $savings_plan_id, $new_balance)->getData();
                //dd($result->status);
                if ($result->status == "success") {
                    return $this->successResponse("Balance updated successfully");
                } else {
                    return $this->errorResponse("Oops! Something went wrong. Request Timed out", $result, 201);
                }
            } else {
                return $this->errorResponse("Oops! Unable to retrieve customer record. Try again.", $current_balance_record, 201);
            }
        } else {
            return $this->errorResponse("Oops! Verifiction failed to complete. Try again.", $trans_type_record, 201);
        }
    }
}
