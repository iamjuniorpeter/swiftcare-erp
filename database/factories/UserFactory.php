<?php

namespace Database\Factories;

use App\Models\AccountRole;
use App\Models\AccountCategory;
use App\Models\AccountType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => bcrypt('password'), // You might want to generate a random password instead
            'accountID' => $this->faker->unique()->uuid,
            'account_categoryID' => \App\Models\AccountCategory::all()->random()->sn,
            'account_typeID' => \App\Models\AccountType::all()->random()->sn,
            'account_roleID' => \App\Models\AccountRole::all()->random()->sn,
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}

