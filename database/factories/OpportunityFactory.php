<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Opportunity>
 */
class OpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'image' => fake()->imageUrl(),
            'description' => fake()->paragraph,
            'category' => fake()->randomElement(['Job','Intern','Volunteer']),
            'user_id' => fake()->numberBetween(1 , 10)
        ];
    }
}
