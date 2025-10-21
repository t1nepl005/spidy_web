<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Watermelon>
 */
class WatermelonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'color' => $this->faker->randomElement(['red', 'green', 'yellow']),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'price' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
