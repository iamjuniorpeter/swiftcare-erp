<?php

namespace Database\Factories;

use App\Models\AccountCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountCategoryFactory extends Factory
{
    protected $model = AccountCategory::class;

    public function definition()
    {
        return [
            'category' => $this->faker->word,
            'code' => $this->faker->unique()->randomNumber(5),
        ];
    }
}
