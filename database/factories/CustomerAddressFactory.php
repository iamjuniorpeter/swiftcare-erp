<?php

namespace Database\Factories;

use App\Models\CustomerAddress;
use App\Models\Customer;
use App\Models\Lga;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerAddressFactory extends Factory
{
    protected $model = CustomerAddress::class;

    public function definition()
    {
        return [
            'customer_accountID' => \App\Models\Customer::all()->random()->account_id,
            'house_no' => $this->faker->buildingNumber,
            'state_of_residenceID' => $this->faker->numberBetween(1, 37),
            'city' => $this->faker->city,
            'residential_address' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'major_landmark' => $this->faker->word,
            'business_address' => $this->faker->streetAddress,
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}

