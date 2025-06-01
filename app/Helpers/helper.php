<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ModelController\CustomerController;

function getStatusBadge($status = null)
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

function counterBadge($counter)
{
    $status_label = "";
    switch ($counter) {
        case $counter < 90:
            $status_label = "<span class='badge badge-warning'> " . $counter . " </span>";
            break;

        case $counter >= 90 && $counter < 150:
            $status_label = "<span class='badge badge-success'> " . $counter . " </span>";
            break;

        case $counter >= 150:
            $status_label = "<span class='badge badge-danger'> " . $counter . " </span>";
            break;

        default:
            $status_label = "<span class='badge badge-primary'> N/A </span>";
            break;
    }

    return $status_label;
}

function daysCounter($created_at)
{
    $createdAtDate = Carbon::parse($created_at);
    $currentDate = Carbon::now();
    $daysSinceCreation  = $currentDate->diffInDays($createdAtDate);
    return $daysSinceCreation;
}

function getCurrentCalender($param)
{
    $currentMonth = (int) date('n'); // Get the current month as an integer (1-12)
    $currentYear = date('Y'); // Get the current year

    switch ($param) {
        case 'month':
            return $currentMonth;
            break;
        case 'year':
            return $currentYear;
            break;
        default:
            break;
    }
}

function monthNames()
{
    $monthNames = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];

    return $monthNames;
}

function formatDateTime($dbdate)
{
    if ($dbdate == '' || is_null($dbdate)) {
        return 'N/A';
    }

    $datetime = new DateTime($dbdate, new DateTimeZone('UTC'));
    $datetime->setTimezone(new DateTimeZone('Europe/Paris')); // Set the desired timezone (GMT+1)

    $formattedDate = $datetime->format("M d, Y @g:i:sa");
    return $formattedDate;
}

function formatDate($dbdate)
{
    if ($dbdate == '' || is_null($dbdate)) {
        return 'N/A';
    }

    $datetime = new DateTime($dbdate, new DateTimeZone('UTC'));
    $datetime->setTimezone(new DateTimeZone('Europe/Paris')); // Set the desired timezone (GMT+1)

    $formattedDate = $datetime->format("M d, Y");
    return $formattedDate;
}

function formatDateWithSlash($dbdate)
{
    if ($dbdate == '' || is_null($dbdate)) {
        return 'N/A';
    }

    $datetime = new DateTime($dbdate, new DateTimeZone('UTC'));
    $datetime->setTimezone(new DateTimeZone('Europe/Paris')); // Set the desired timezone (GMT+1)

    $formattedDate = $datetime->format("d M, Y");
    return $formattedDate;
}

function formatTime($dbtime)
{
    if ($dbtime == '' || is_null($dbtime)) {
        return 'N/A';
    }

    $time = strtotime($dbtime);
    $formattedTime = date("H:i a", $time);

    return $formattedTime;
}


function formatDateTime2($dbdate)
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

function formatDate2($dbdate)
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

function formatDateWithSlash2($dbdate)
{
    if ($dbdate == '' || is_null($dbdate)) {
        return 'N/A';
    }
    $time = strtotime($dbdate);

    $r = date("d M, Y", $time);

    if (strlen($dbdate) > 10) {
        $r = date("d M, Y", $time);
    }

    return $r;
}

function formatTime2($dbtime)
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

function calculateAge($dateOfBirth)
{
    return Carbon::parse($dateOfBirth)->age;
}

function formatAmount($number, $decimal_places = 2)
{
    return number_format($number, $decimal_places, '.', ',');
}

function strEncrypt($dataToEncrypt)
{
    $encryptedData = Crypt::encryptString($dataToEncrypt);
    return $encryptedData;
}

function strDecrypt($encryptedData)
{
    $decryptedData = Crypt::decryptString($encryptedData);
    return $decryptedData;
}

function numberToWords($number)
{
    $number = str_replace(',', '', $number);
    $number = (float) $number;
    $fmt = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
    return $fmt->format($number);
}

function numberToWordsNairaKobo($amount)
{
    // Remove commas and format decimal point as a dot
    $amount = str_replace(',', '', $amount);

    // Separate integer and decimal parts
    list($integerPart, $decimalPart) = explode('.', $amount . '.00');

    // Convert the integer part to words
    $integerWords = (int) $integerPart;
    $result = ucfirst(numberToWords($integerWords)) . ' Naira';

    // Convert the decimal part to words
    $decimalWords = (int) $decimalPart;

    if ($decimalWords != 0) {
        $result .= ' and ' . ucfirst(numberToWords($decimalWords)) . ' Kobo';
    }

    return $result;
}

// get customer all time contribution.
function getCustomerTotalContribution($customer_id)
{
    $customer_obj = new CustomerController;

    $total_contribution = $customer_obj->getCustomerTotalContribution($customer_id)->getData()->data;
    $total_contribution = $total_contribution ?? 0;

    return $total_contribution;
}

// get customer all time withdrawal.
function getCustomerTotalWithdrawal($customer_id)
{
    $customer_obj = new CustomerController;

    $total_withdrawal = $customer_obj->getCustomerTotalWithdrawal($customer_id)->getData()->data;
    $total_withdrawal = $total_withdrawal ?? 0;

    return $total_withdrawal;
}

// get customer total balance.
function getCustomerTotalBalance($customer_id)
{
    $customer_obj = new CustomerController;

    $total_balance = $customer_obj->getCustomerTotalBalance($customer_id)->getData()->data;
    $total_balance = $total_balance;

    return $total_balance;
}

// get customer savings plan balance.
function getCustomerPlanBalance($customer_id, $savings_plan_id)
{
    $customer_obj = new CustomerController;

    $plan_balance = $customer_obj->getCustomerPlanBalance($customer_id, $savings_plan_id)->getData()->data;
    $plan_balance = $plan_balance ?? 0;

    return $plan_balance;
}
