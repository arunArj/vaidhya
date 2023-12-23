<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Patients>
 */
class PatientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'dob' => fake()->date,
            'sex' => fake()->randomElement(['0', '1']),
            'user_type' => fake()->randomElement(['0', '1','2']),
            'phone' => fake()->phoneNumber,
            'mrd_no' => fake()->word(1),
            'address' => fake()->address,
            'advance' => fake()->randomFloat(2, 100, 1000),
            'refund' => fake()->randomFloat(2, 0, 500),
        ];
    }
}
