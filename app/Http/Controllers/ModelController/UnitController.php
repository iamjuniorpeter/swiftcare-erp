<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function create()
    {
        $merchant_id = Auth::user()->accountID;

        $units = Unit::where("merchantID", $merchant_id)->get();

        return view('units.create', compact('units'));
    }

    public function index()
    {
        $merchant_id = Auth::user()->accountID;

        try {
            $units = Unit::where("merchantID", $merchant_id)->get();
            return $this->successResponse("Units retrieved successfully.", $units);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving units.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'merchantID' => ['required'],
            'unit_name'  => ['required'],
            'abbreviation' => ['sometimes'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data) {
                $unit = Unit::create([
                    'merchantID' => $data['merchantID'],
                    'unit_name'  => ucwords($data['unit_name']),
                    'abbreviation' => $data['abbreviation'] ?? null,
                ]);
                return $this->successResponse("Unit successfully created.", $unit);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating unit.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $unit = Unit::find($id);
            if (!$unit) {
                return $this->errorResponse("Unit not found.", [], 201);
            }
            return $this->successResponse("Unit retrieved successfully.", $unit);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving unit.", $e->getMessage(), 201);
        }
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'unit_name' => ['required'],
            'abbreviation' => ['sometimes'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }
        try {
            $result = DB::transaction(function () use ($data, $id) {
                $unit = Unit::find($id);
                if (!$unit) {
                    return $this->errorResponse("Unit not found.", [], 201);
                }
                $unit->update([
                    'unit_name'   => $data['unit_name'],
                    'abbreviation' => $data['abbreviation'] ?? $unit->abbreviation,
                ]);
                return $this->successResponse("Unit successfully updated.", $unit);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating unit.", $e->getMessage(), 201);
        }
    }

    public function destroy($id)
    {
        try {
            $unit = Unit::find($id);
            if (!$unit) {
                return $this->errorResponse("Unit not found.", [], 201);
            }
            DB::transaction(function () use ($unit) {
                $unit->delete();
            });
            return $this->successResponse("Unit successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting unit.", $e->getMessage(), 201);
        }
    }
}
