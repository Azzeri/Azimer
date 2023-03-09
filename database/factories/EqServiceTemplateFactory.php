<?php

namespace Database\Factories;

use App\Services\EqItemTemplateService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model\EqServiceTemplate>
 *
 * @author Mariusz Waloszczyk
 */
class EqServiceTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @author Mariusz Waloszczyk
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $eqItemTemplate = EqItemTemplateService::getRandomEqItemTemplate();

        return [
            'eq_item_template_id' => $eqItemTemplate->id,
            'name' => fake()->unique()->numerify('Template - ####'),
            'description' => fake()->paragraph(),
            'interval' => fake()->numberBetween(0, 1000),
        ];
    }
}
