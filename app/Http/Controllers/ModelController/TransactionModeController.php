<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionMode;

class TransactionModeController extends Controller
{
    // get all transaction records
    public function get()
    {
        $transactions = TransactionMode::all();

        return $this->successResponse("success", $transactions);
    }

}
