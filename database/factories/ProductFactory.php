<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->name(),
            'price' => fake()->numberBetween(1000, 9999),
            'quantity' => fake()->numberBetween(10, 99),
            'description' => fake()->text(),
            'image' => fake()->image(),
            'category_id' => '1',
            'status' => rand(0, 1)
        ];
    }
}
