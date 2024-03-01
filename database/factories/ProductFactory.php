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
    public function definition(): array
    {
        static $key = 1;

        return [
            'name' => 'Celular ' . $key++,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'description' => $this->faker->text,
            'available' => $this->faker->boolean,
        ];
    }
}
