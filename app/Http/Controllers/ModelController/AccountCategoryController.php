<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;
use App\Models\AccountCategory;
use Illuminate\Http\Request;

class AccountCategoryController extends Controller
{
    public function index()
    {
        $categories = AccountCategory::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        AccountCategory::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(AccountCategory $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(AccountCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, AccountCategory $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(AccountCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    public function activeCategoryReport()
    {
        $activeCategories = AccountCategory::where('status', 'Active')->get();
        return view('reports.active_categories', compact('activeCategories'));
    }

    public function inactiveCategoryReport()
    {
        $inactiveCategories = AccountCategory::where('status', 'Inactive')->get();
        return view('reports.inactive_categories', compact('inactiveCategories'));
    }

    public function categorySummaryReport()
    {
        $categorySummary = AccountCategory::select('name', 'description', 'status')
            ->orderBy('status')
            ->get();
        return view('reports.category_summary', compact('categorySummary'));
    }
}
