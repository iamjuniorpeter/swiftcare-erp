<?php

namespace App\Http\Controllers\ModelController;

use App\Http\Controllers\Controller;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MerchantController extends Controller
{
    /**
     * Display a listing of merchants.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $merchants = Merchant::all();
            return $this->successResponse("Merchants retrieved successfully.", $merchants);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving merchants.", $e->getMessage(), 201);
        }
    }

    /**
     * Store a newly created merchant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'merchantID'       => ['required', 'unique:tbl_merchants,merchantID'],
            'name'             => ['required'],
            'address'          => ['sometimes'],
            'phone'            => ['sometimes'],
            'email'            => ['sometimes', 'email'],
            'tax_identifier'   => ['sometimes'],
            'subscription_plan' => ['sometimes'],
            'is_active'        => ['sometimes'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data) {
                $merchant = Merchant::create([
                    'merchantID'       => $data['merchantID'],
                    'name'             => $data['name'],
                    'address'          => $data['address'] ?? null,
                    'phone'            => $data['phone'] ?? null,
                    'email'            => $data['email'] ?? null,
                    'tax_identifier'   => $data['tax_identifier'] ?? null,
                    'subscription_plan' => $data['subscription_plan'] ?? null,
                    'is_active'        => $data['is_active'] ?? true,
                    'created_at'       => now(),
                ]);

                return $this->successResponse("Merchant successfully created.", $merchant);
            });

            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while creating merchant.", $e->getMessage(), 201);
        }
    }

    /**
     * Display the specified merchant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $merchant = Merchant::find($id);
            if (!$merchant) {
                return $this->errorResponse("Merchant not found.", [], 201);
            }
            return $this->successResponse("Merchant retrieved successfully.", $merchant);
        } catch (\Exception $e) {
            return $this->errorResponse("Error retrieving merchant.", $e->getMessage(), 201);
        }
    }

    /**
     * Update the specified merchant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $rules = [
            'name'             => ['required'],
            'address'          => ['sometimes'],
            'phone'            => ['sometimes'],
            'email'            => ['sometimes', 'email'],
            'tax_identifier'   => ['sometimes'],
            'subscription_plan' => ['sometimes'],
            'is_active'        => ['sometimes'],
        ];

        $validation = $this->validateData($data, $rules);

        if ($validation->fails()) {
            return $this->errorResponse("Kindly fill in all required fields.", ['errors' => $validation->errors()], 201);
        }

        try {
            $result = DB::transaction(function () use ($data, $id) {
                $merchant = Merchant::find($id);
                if (!$merchant) {
                    return $this->errorResponse("Merchant not found.", [], 201);
                }

                $merchant->update([
                    'name'             => $data['name'],
                    'address'          => $data['address'] ?? $merchant->address,
                    'phone'            => $data['phone'] ?? $merchant->phone,
                    'email'            => $data['email'] ?? $merchant->email,
                    'tax_identifier'   => $data['tax_identifier'] ?? $merchant->tax_identifier,
                    'subscription_plan' => $data['subscription_plan'] ?? $merchant->subscription_plan,
                    'is_active'        => $data['is_active'] ?? $merchant->is_active,
                    'updated_at'       => now(),
                ]);

                return $this->successResponse("Merchant successfully updated.", $merchant);
            });

            return $result;
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while updating merchant.", $e->getMessage(), 201);
        }
    }

    /**
     * Remove the specified merchant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $merchant = Merchant::find($id);
            if (!$merchant) {
                return $this->errorResponse("Merchant not found.", [], 201);
            }

            DB::transaction(function () use ($merchant) {
                $merchant->delete();
            });

            return $this->successResponse("Merchant successfully deleted.");
        } catch (\Exception $e) {
            return $this->errorResponse("Error encountered while deleting merchant.", $e->getMessage(), 201);
        }
    }
}
