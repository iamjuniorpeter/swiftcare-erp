<?php

namespace Database\Factories;

use App\Models\CustomerSavingsPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerSavingsPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerSavingsPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_accountID' => \App\Models\Customer::all()->random()->account_id,
            'savings_planID' => \App\Models\SavingsPlan::all()->random()->sn,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => null,
        ];
    }
}
