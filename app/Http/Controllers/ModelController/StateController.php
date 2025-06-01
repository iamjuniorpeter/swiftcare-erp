<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;


class StateController extends Controller
{
    /**
     * list all state.
     */
    public function getAllState()
    {
        $records = State::all();
        return $this->successResponse("success", $records);
    }

    /**
     * list state by ID.
     */
    public function getStateById($state_id)
    {
        $records = State::where("sn", $state_id)->get();
        return $this->successResponse("success", $records);
    }

}
