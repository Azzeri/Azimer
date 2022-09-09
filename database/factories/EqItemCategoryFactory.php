<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EqItemCategory>
 *
 * @author Piotr Nagórny
 */
class EqItemCategoryFactory extends Factory
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
            'name' => fake()->unique()->numerify('Category - ####'),
            'photo_path' => fake()->image(null, 640, 480),
            'is_fillable' => fake()->boolean(),
            'parent_category_id' => null,

        ];
    }
}
