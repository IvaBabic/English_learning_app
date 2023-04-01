<?php

namespace Database\Factories;

use App\Models\Learner;
use App\Models\Sentence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' =>fake()->text(),
            'learner_id' => fake()->randomElement(Learner::pluck('id')->toArray()),
            'sentence_id' => fake()->randomElement(Sentence::pluck('id')->toArray()),



        ];
    }
}
