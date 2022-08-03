<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manufacturer>
 *
 * @author Piotr Nagórny
 */
class ManufacturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @author Piotr Nagórny
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name(),
        ];
    }
}
