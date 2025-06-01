<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    protected $model = Staff::class;

    public function definition()
    {
        return [
            'account_id' => $this->faker->unique()->uuid,
            'surname' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'other_names' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'date_of_birth' => $this->faker->date(),
            'phone_1' => $this->faker->phoneNumber,
            'phone_2' => $this->faker->phoneNumber,
            'email_address' => $this->faker->unique()->safeEmail,
            'home_address' => $this->faker->address,
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}
