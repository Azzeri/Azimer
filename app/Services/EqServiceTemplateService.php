<?php

namespace App\Services;

use App\Models\EqServiceTemplate;

/**
 * Equipment Item Templates services class
 *
 * @author Mariusz Waloszczyk
 */
class EqServiceTemplateService
{
    /**
     * Returns form that will pass validation
     *
     * @author Mariusz Waloszczyk
     */
    public function getSampleCorrectForm(
        bool $withStoreParams
    ): array {
        $manufacturer = ManufacturerService::getRandomManufacturer();

        $commonParameters = [
            'name' => 'T1234',
            'description' => 'Lorem ipsum sit...',
            'interval' => 24,
        ];

        $storeParameters = [
            'eq_item_category_id' => 1, // temp
            'manufacturer_id' => $manufacturer->id,
        ];

        return $withStoreParams
            ? $commonParameters + $storeParameters
            : $commonParameters;
    }


    /**
     * Returns random service template or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomEqServiceTemplate(): EqServiceTemplate
    {
        $template = EqServiceTemplate::inRandomOrder()->first();

        if (is_null($template)) {
            return EqServiceTemplate::factory()
                ->create();
        }

        return $template;
    }
}
