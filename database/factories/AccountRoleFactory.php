<?php

namespace Database\Factories;

use App\Models\AccountRole;
use App\Models\AccountCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountRoleFactory extends Factory
{
    protected $model = AccountRole::class;

    public function definition()
    {
        return [
            'role' => $this->faker->word,
            'account_categoryID' => \App\Models\AccountCategory::all()->random()->sn,
        ];
    }
}
