<?php

namespace Database\Factories;

use App\Services\EqItemCategoryService;
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
        $category = EqItemCategoryService::getRandomEqItemCategory();

        return [
            'name' => fake()
                ->unique()
                ->numerify('Template - ####'),
            'description' => fake()->paragraph(),
            'interval' => fake()->numberBetween(0, 1000),
            'eq_item_category_id' => $category->id,
            'manufacturer_id' => $manufacturer->id,
        ];
    }
}
