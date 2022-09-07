<?php

namespace App\Services;

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
}
