<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $staff = Staff::all();
        return view('staff.index', compact('staff'));
    }

    // Display active customers.
    public function activeStaff()
    {
        $staff = Staff::where("status", "Active")->get();

        return $this->successResponse("success",
            $staff
        );
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('staff.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'account_id' => 'required|unique:tbl_staff|max:50',
            'surname' => 'required|max:150',
            'first_name' => 'required|max:150',
            'other_names' => 'nullable|max:150',
            'date_of_birth' => 'required',
            'phone_1' => 'required|max:50',
            'phone_2' => 'nullable|max:50',
            'email_address' => 'nullable|email|max:300',
            'home_address' => 'nullable',
        ]);

        Staff::create($validatedData);
        return redirect()->route('staff.index')->with('success', 'Staff created successfully.');
    }

    // Display the specified resource.
    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    // Show the form for editing the specified resource.
    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Staff $staff)
    {
        $validatedData = $request->validate([
            'account_id' => 'required|unique:tbl_staff,account_id,' . $staff->id . '|max:50',
            'surname' => 'required|max:150',
            'first_name' => 'required|max:150',
            'other_names' => 'nullable|max:150',
            'date_of_birth' => 'required',
            'phone_1' => 'required|max:50',
            'phone_2' => 'nullable|max:50',
            'email_address' => 'nullable|email|max:300',
            'home_address' => 'nullable',
        ]);

        $staff->update($validatedData);
        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }

    // Report: Staff by state
    public function staffByState($state)
    {
        $staff = Staff::where('state', $state)->get();
        return view('staff.reports.staff_by_state', compact('staff', 'state'));
    }

    // Report: Staff by age range
    public function staffByAgeRange($minAge, $maxAge)
    {
        $staff = Staff::whereBetween('age', [$minAge, $maxAge])->get();
        return view('staff.reports.staff_by_age_range', compact('staff', 'minAge', 'maxAge'));
    }

    // Report: Staff by employment status
    public function staffByEmploymentStatus($status)
    {
        $staff = Staff::where('employment_status', $status)->get();
        return view('staff.reports.staff_by_employment_status', compact('staff', 'status'));
    }

    // Report: Staff by department
    public function staffByDepartment($department)
    {
        $staff = Staff::where('department', $department)->get();
        return view('staff.reports.staff_by_department', compact('staff', 'department'));
    }
    
}
