<?php

namespace Database\Factories;

use App\Models\AccountType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountTypeFactory extends Factory
{
    protected $model = AccountType::class;

    public function definition()
    {
        return [
            'account_type' => $this->faker->word,
            'code' => $this->faker->unique()->randomNumber(5),
        ];
    }
}

