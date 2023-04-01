<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Learner>
 */
class LearnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'first_name' =>fake()->word(),
            'last_name' =>fake()->word(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'level' => fake()->randomElement(['beginner' ,'intermediate', 'advanced']),

            


         ];
    }
}
