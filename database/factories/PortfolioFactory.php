<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'subtitle' => fake()->name(),
            'slug' => fake()->slug(),
            'content' => fake()->text(),
            'portfolio_type_id' => '1',
            'status' => 'draft',
        ];
    }
}
