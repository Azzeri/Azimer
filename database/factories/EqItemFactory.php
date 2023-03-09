<?php

namespace Database\Factories;

use App\Services\EqItemTemplateService;
use App\Services\FireBrigadeUnitService;
use App\Services\VehicleService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EqItem>
 *
 * @author Mariusz Waloszczyk
 */
class EqItemFactory extends Factory
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
        $code = fake()->unique()->numerify('######');
        $template = EqItemTemplateService::getRandomEqItemTemplate();
        $unit = FireBrigadeUnitService::getRandomFireBrigadeUnit();

        $vehicle = $template->has_vehicle
            ? VehicleService::getRandomVehicle($unit->id)
            : null;

        return [
            'code' => 'I'.$code,
            'eq_item_template_id' => $template->id,
            'fire_brigade_unit_id' => $unit->id,
            'vehicle_number' => $vehicle->number ?? null,
            'name' => 'Item - '.$code,
            'construction_number' => $template->has_construction_number
                ? fake()->unique()->numerify('CN######')
                : null,
            'inventory_number' => $template->has_inventory_number
                ? fake()->unique()->numerify('IN######')
                : null,
            'identification_number' => $template->has_identification_number
                ? fake()->unique()->numerify('ID######')
                : null,
            'date_production' => $template->has_date_production
                ? fake()->date()
                : null,
            'date_expiry' => $template->has_date_expiry
                ? fake()->date()
                : null,
            'date_legalisation' => $template->has_date_legalisation
                ? fake()->date()
                : null,
            'date_legalisation_due' => $template->has_date_legalisation_due
                ? fake()->date()
                : null,
        ];
    }
}
