<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function create()
    {
        $merchant_id = Auth::user()->accountID;

        $categories = Category::get();

        return view('categories.create', compact('categories'));
    }

    public function index()
    {
        $merchant_id = Auth::user()->accountID;

        try {
            $categories = Category::get();
            return $this->successResponse("Categories retrieved successfully.", $categories);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving categories.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'merchantID'  => ['required'],
            'name'        => ['required', 'unique:tbl_iv_categories,name'],
            'description' => ['sometimes']
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $category = Category::create([
                    'merchantID'  => $data['merchantID'],
                    'name'        => ucwords($data['name']),
                    'description' => $data['description'] ?? null,
                ]);
                return $this->successResponse("Category successfully created.", $category);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating category.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return $this->errorResponse("Category not found.", [], 201);
            }
            return $this->successResponse("Category retrieved successfully.", $category);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving category.", $e->getMessage(), 201);
        }
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'name'        => ['required'],
            'description' => ['sometimes'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data, $id) {
                $category = Category::find($id);
                if (!$category) {
                    return $this->errorResponse("Category not found.", [], 201);
                }
                $category->update([
                    'name'        => $data['name'],
                    'description' => $data['description'] ?? $category->description,
                ]);
                return $this->successResponse("Category successfully updated.", $category);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating category.", $e->getMessage(), 201);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return $this->errorResponse("Category not found.", [], 201);
            }
            DB::transaction(function () use ($category) {
                $category->delete();
            });
            return $this->successResponse("Category successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting category.", $e->getMessage(), 201);
        }
    }
}
