<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Zone;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zone>
 */
class ZoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Zone::class;

    public function definition()
    {
        return [
            'zone_name' => $this->faker->name,
            'code' => $this->faker->unique()->randomNumber(5),
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}

