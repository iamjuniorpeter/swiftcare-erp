<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Staff;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'trans_reference' => $this->faker->unique()->uuid,
            'customer_accountID' => \App\Models\Customer::all()->random()->account_id,
            'account_officerID' => \App\Models\Staff::all()->random()->account_id,
            'trans_typeID' => \App\Models\TransactionType::all()->random()->sn,
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'description' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}

