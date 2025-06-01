<?php

namespace Database\Factories;

use App\Models\CustomerBankAccount;
use App\Models\Customer;
use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerBankAccountFactory extends Factory
{
    protected $model = CustomerBankAccount::class;

    public function definition()
    {
        return [
            'customer_accountID' => \App\Models\Customer::all()->random()->account_id,
            'bankID' => $this->faker->numberBetween(1, 10),
            'account_number' => $this->faker->bankAccountNumber,
            'account_name' => $this->faker->name,
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}
