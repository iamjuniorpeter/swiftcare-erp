<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            $suppliers = Supplier::all();

            return view('suppliers.index', compact('suppliers'));
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving suppliers.", $e->getMessage(), 201);
        }
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $rules = [
            //'supplier_id' => ['required', 'unique:tbl_iv_suppliers,supplier_id'],
            'merchantID'  => ['required'],
            'name'        => ['required'],
            'contact_person' => ['sometimes'],
            'phone'          => ['sometimes'],
            'email'          => ['sometimes', 'email'],
            'address'        => ['sometimes'],
            'status'         => ['sometimes'],
        ];

        $validation = $this->validateData($data, $rules);
        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        // if user didn't supply one, generate it
        if (empty($data['supplier_id'])) {
            $data['supplier_id'] = $this->generateUniqueId("SP", 8);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $supplier = Supplier::create([
                    'supplier_id'   => $data['supplier_id'],
                    'merchantID'    => $data['merchantID'],
                    'name'          => $data['name'],
                    'contact_person' => $data['contact_person'] ?? null,
                    'phone'         => $data['phone'] ?? null,
                    'email'         => $data['email'] ?? null,
                    'address'       => $data['address'] ?? null,
                    'status'        => $data['status'] ?? 'active',
                ]);
                return $this->successResponse("Supplier successfully created.", $supplier);
            });
            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating supplier.", $e->getMessage(), 201);
        }
    }

    public function edit($id)
    {
        $supplier = Supplier::where('supplier_id', $id)->firstOrFail();
        return view('suppliers.edit', compact('supplier'));
    }

    public function show($id)
    {
        try {
            $supplier = Supplier::find($id);
            if (!$supplier) {
                return $this->errorResponse("Supplier not found.", [], 201);
            }
            return $this->successResponse("Supplier retrieved successfully.", $supplier);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving supplier.", $e->getMessage(), 201);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'type' => 'required|in:inventory,service,both',
            'status' => 'required|in:active,inactive',
            'address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Get the supplier by ID (adjust if using custom key)
        $supplier = Supplier::where('supplier_id', $id)->firstOrFail(); // or use where('supplier_id', $id)->firstOrFail()

        // Update fields
        $supplier->update([
            'name' => $validated['name'],
            'contact_person' => $validated['contact_person'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'type' => $validated['type'],
            'status' => $validated['status'],
            'address' => $validated['address'],
            'notes' => $validated['notes'],
        ]);

        // Optionally update merchantID if passed
        if ($request->has('merchantID')) {
            $supplier->merchantID = $request->merchantID;
            $supplier->save();
        }

        // Redirect back with success message
        //return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully!');

        return $this->successResponse("Supplier successfully updated.", $supplier);
    }

    public function destroy($id)
    {
        try {
            $supplier = Supplier::find($id);
            if (!$supplier) {
                return $this->errorResponse("Supplier not found.", [], 201);
            }
            DB::transaction(function () use ($supplier) {
                $supplier->delete();
            });
            return $this->successResponse("Supplier successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting supplier.", $e->getMessage(), 201);
        }
    }
}
