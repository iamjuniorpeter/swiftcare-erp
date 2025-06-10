<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function create()
    {
        $merchant_id = Auth::user()->accountID;

        $category_list = $this->loadCategoryIntoCombo();
        $status = $this->loadStatusIntoCombo();

        $categories = SubCategory::where("merchantID", $merchant_id)->with(['category'])->get();

        return view('sub-categories.create', compact('categories', 'category_list', 'status'));
    }

    public function index()
    {
        $merchant_id = Auth::user()->accountID;

        try {
            $categories = SubCategory::where("merchantID", $merchant_id)->get();
            return $this->successResponse("Sub Categories retrieved successfully.", $categories);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving sub categories.", $e->getMessage(), 201);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'merchantID'  => ['required'],
            'categoryID' => ['required'],
            'name'        => ['required', 'unique:tbl_iv_categories,name'],
            'status' => ['sometimes']
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $category = SubCategory::create([
                    'merchantID'  => $data['merchantID'],
                    'categoryID'  => $data['categoryID'],
                    'name'        => ucwords($data['name']),
                    'status' => $data['status'] ?? "active",
                ]);
                return $this->successResponse("Sub Category successfully created.", $category);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating sub category.", $e->getMessage(), 201);
        }
    }

    public function show($id)
    {
        try {
            $category = SubCategory::find($id);
            if (!$category) {
                return $this->errorResponse("Sub Category not found.", [], 201);
            }
            return $this->successResponse("Sub Category retrieved successfully.", $category);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving sub category.", $e->getMessage(), 201);
        }
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $rules = [
            'name'        => ['required'],
            'status' => ['required'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data, $id) {
                $category = SubCategory::find($id);
                if (!$category) {
                    return $this->errorResponse("Sub Category not found.", [], 201);
                }
                $category->update([
                    'name'        => ucwords($data['name']),
                    'status' => $data['status'] ?? "active",
                ]);
                return $this->successResponse("Sub Category successfully updated.", $category);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating sub category.", $e->getMessage(), 201);
        }
    }

    public function edit($id)
    {
        $category = SubCategory::findOrFail($id);
        $category_list = $this->loadCategoryIntoCombo();
        $status = $this->loadStatusIntoCombo($category->status);

        return view('sub-categories.edit', compact('category', 'category_list', 'status'));
    }

    public function destroy($id)
    {
        try {
            $category = SubCategory::find($id);
            if (!$category) {
                return $this->errorResponse("Sub Category not found.", [], 201);
            }
            DB::transaction(function () use ($category) {
                $category->delete();
            });
            return $this->successResponse("Sub Category successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting sub category.", $e->getMessage(), 201);
        }
    }

    public function getByCategory($category_id)
    {
        $subcategories = SubCategory::where('categoryID', $category_id)
            ->select('sn', 'name')
            ->get();

        return response()->json($subcategories);
    }
}
