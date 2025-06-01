<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\SavingsPlanCategory;
use Illuminate\Http\Request;

class SavingsPlanCategoryController extends Controller
{
    // Display a listing of the savings plan categories.
    public function index()
    {
        $categories = SavingsPlanCategory::all();
        return view('savings_plan_categories.index', compact('categories'));
    }

    // Show the form for creating a new savings plan category.
    public function create()
    {
        return view('savings_plan_categories.create');
    }

    // Store a newly created savings plan category in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:150',
            'code' => 'required|max:50|unique:savings_plan_categories',
        ]);

        SavingsPlanCategory::create($validatedData);
        return redirect()->route('savings_plan_categories.index')->with('success', 'Savings plan category created successfully.');
    }

    // Display the specified savings plan category.
    public function show(SavingsPlanCategory $category)
    {
        return view('savings_plan_categories.show', compact('category'));
    }

    // Show the form for editing the specified savings plan category.
    public function edit(SavingsPlanCategory $category)
    {
        return view('savings_plan_categories.edit', compact('category'));
    }

    // Update the specified savings plan category in storage.
    public function update(Request $request, SavingsPlanCategory $category)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:150',
            'code' => 'required|max:50|unique:savings_plan_categories,code,' . $category->id,
        ]);

        $category->update($validatedData);
        return redirect()->route('savings_plan_categories.index')->with('success', 'Savings plan category updated successfully.');
    }

    // Remove the specified savings plan category from storage.
    public function destroy(SavingsPlanCategory $category)
    {
        $category->delete();
        return redirect()->route('savings_plan_categories.index')->with('success', 'Savings plan category deleted successfully.');
    }

    // Generate a report of savings plan categories by name
    public function categoriesByName($name)
    {
        $categories = SavingsPlanCategory::where('category_name', 'like', '%' . $name . '%')->get();
        return view('savings_plan_categories.reports.by_name', compact('categories'));
    }

    // Generate a report of savings plan categories by code
    public function categoriesByCode($code)
    {
        $categories = SavingsPlanCategory::where('code', $code)->get();
        return view('savings_plan_categories.reports.by_code', compact('categories'));
    }
}
