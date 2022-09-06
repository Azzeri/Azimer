<?php

namespace App\Services;

use App\Models\EqItemTemplate;
use App\Models\FireBrigadeUnit;
use App\Models\Vehicle;

/**
 * Equipment Item Templates services class
 *
 * @author Mariusz Waloszczyk
 */
class EqItemService
{
    /**
     * Returns form that will pass validation
     *
     * @author Mariusz Waloszczyk
     */
    public function getSampleCorrectForm(): array
    {
        $template = EqItemTemplate::factory()->create();
        $unit = FireBrigadeUnit::factory()->create();
        $vehicle = Vehicle::factory()->create();

        return [
            'code' => 'C1234',
            'name' => 'testName',
            'eq_item_template_id' => $template->id,
            'fire_brigade_unit_id' => $unit->id,
            'vehicle_number' => $vehicle->id,
            'construction_number' => '1234',
            'inventory_number' => '1234',
            'identification_number' => '1234',
            'date_expiry' => '2010-10-10',
            'date_legalisation' => '2010-10-10',
            'date_legalisation_due' => '2010-10-10',
            'date_production' => '2010-10-10',
        ];
    }
}
