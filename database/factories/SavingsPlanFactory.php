<?php

namespace Database\Factories;

use App\Models\SavingsPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class SavingsPlanFactory extends Factory
{
    protected $model = SavingsPlan::class;

    public function definition()
    {
        return [
            'plan_name' => $this->faker->sentence(3),
            'code' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'plan_categoryID' => function () {
                // Assuming you have a relationship with SavingsPlanCategory
                return \App\Models\SavingsPlanCategory::factory()->create()->sn; 
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
