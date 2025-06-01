<?php

namespace Database\Factories;

use App\Models\SavingsPlanCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SavingsPlanCategoryFactory extends Factory
{
    protected $model = SavingsPlanCategory::class;

    public function definition()
    {
        return [
            'category_name' => $this->faker->unique()->word,
            'code' => $this->faker->unique()->randomNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
