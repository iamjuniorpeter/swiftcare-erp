<?php

namespace Database\Factories;

use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionTypeFactory extends Factory
{
    protected $model = TransactionType::class;

    public function definition()
    {
        return [
            'trans_type' => $this->faker->word,
            'code' => $this->faker->unique()->randomNumber(3),
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}
