<?php

namespace Database\Factories;

use App\Services\ManufacturerService;
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
        $manufacturer = ManufacturerService::getRandomManufacturer();

        return [
            'name' => fake()
                ->unique()
                ->numerify('Template - ####'),
            'description' => fake()->paragraph(),
            'interval' => fake()->numberBetween(0, 1000),
            'eq_item_category_id' => 1, // temporary
            'manufacturer_id' => $manufacturer->id,
        ];
    }
}
