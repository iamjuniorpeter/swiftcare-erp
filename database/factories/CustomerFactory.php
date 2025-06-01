<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Lga;
use App\Models\State;
use App\Models\Zone;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'account_id' => $this->faker->unique()->uuid,
            'account_no' => $this->faker->bankAccountNumber,
            'surname' => $this->faker->lastName,
            'other_names' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'marital_status' => $this->faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
            'date_of_birth' => $this->faker->date(),
            'phone_1' => $this->faker->phoneNumber,
            'phone_2' => $this->faker->phoneNumber,
            'lga_of_originID' => $this->faker->numberBetween(1, 774),
            'state_of_originID' => $this->faker->numberBetween(1, 37),
            'is_employed' => $this->faker->randomElement(['Y', 'N']),
            'zoneID' => \App\Models\Zone::all()->random()->sn,
            'account_officerID' => \App\Models\Staff::all()->random()->account_id,
            'mothers_maiden_name' => $this->faker->lastName,
            'remark' => $this->faker->sentence,
            'avatar' => $this->faker->imageUrl(),
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}
