<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerNok;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerNokFactory extends Factory
{
    protected $model = CustomerNok::class;

    public function definition()
    {
        return [
            'customer_accountID' => \App\Models\Customer::all()->random()->account_id,
            'surname' => $this->faker->lastName,
            'other_names' => $this->faker->firstName,
            'relationship' => $this->faker->word,
            'phone_number' => $this->faker->phoneNumber,
            'contact_address' => $this->faker->streetAddress,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
