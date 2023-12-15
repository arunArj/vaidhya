<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=MedicalTests>
 */
class MedicalTestsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(2),
                'local_fee' => fake()->randomFloat(2, 50, 500),
                'indian_fee' => fake()->randomFloat(2, 100, 1000),
                'int_fee' => fake()->randomFloat(2, 200, 2000),
        ];
    }
}
