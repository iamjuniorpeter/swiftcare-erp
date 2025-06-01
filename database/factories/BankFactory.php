<?php

namespace Database\Factories;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFactory extends Factory
{
    protected $model = Bank::class;

    public function definition()
    {
        return [
            'bank_name' => $this->faker->company,
            'branch' => $this->faker->city . ' Branch',
            'sort_code' => $this->faker->numerify('######'),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'created_at' => now(),
            'updated_at' => null,
            'deleted_at' => null,
        ];
    }
}
