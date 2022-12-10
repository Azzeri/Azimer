<?php

namespace Database\Factories;

use App\Services\EqItemCategoryService;
use App\Services\ManufacturerService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EqItemTemplate>
 *
 * @author Mariusz Waloszczyk
 */
class EqItemTemplateFactory extends Factory
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
        $eqItemCategory = EqItemCategoryService::getRandomEqItemCategory();

        return [
            'name' => fake()
                ->unique()
                ->numerify('Template - ####'),
            'eq_item_category_id' => $eqItemCategory->id,
            'manufacturer_id' => $manufacturer->id,
            'has_vehicle' => fake()->boolean(),
            'has_construction_number' => fake()->boolean(),
            'has_inventory_number' => fake()->boolean(),
            'has_identification_number' => fake()->boolean(),
            'has_date_expiry' => fake()->boolean(),
            'has_date_legalisation' => fake()->boolean(),
            'has_date_legalisation_due' => fake()->boolean(),
            'has_date_production' => fake()->boolean(),

        ];
    }
}
