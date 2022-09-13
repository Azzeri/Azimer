<?php

namespace App\Services;

use App\Models\EqItemTemplate;

/**
 * Equipment Item Templates services class
 *
 * @author Mariusz Waloszczyk
 */
class EqItemTemplateService
{
    /**
     * Returns random eq item template or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomEqItemTemplate(): EqItemTemplate
    {
        $template = EqItemTemplate::inRandomOrder()->first();

        if (is_null($template)) {
            return EqItemTemplate::factory()
                ->create();
        }

        return $template;
    }

    /**
     * Returns form that will pass validation
     *
     * @author Mariusz Waloszczyk
     */
    public function getSampleCorrectForm(): array
    {
        $category = 1; // temporary
        $manufacturer = ManufacturerService::getRandomManufacturer();

        return [
            'name' => 'test template',
            'eq_item_category_id' => $category,
            'manufacturer_id' => $manufacturer->id,
            'has_vehicle' => true,
            'has_construction_number' => true,
            'has_inventory_number' => true,
            'has_identification_number' => true,
            'has_date_expiry' => true,
            'has_date_legalisation' => true,
            'has_date_legalisation_due' => true,
            'has_date_production' => true,
        ];
    }
}
