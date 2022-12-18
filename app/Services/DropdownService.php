<?php

namespace App\Services;

use App\Models\EqItemCategory;
use App\Models\EqItemTemplate;
use App\Models\FireBrigadeUnit;
use App\Models\Manufacturer;
use App\Models\Resource;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class for returning lists of models,
 * which can be used in select fields
 *
 * @author Mariusz Waloszczyk
 */
class DropdownService
{
    /**
     * Get resources list prepared for select field
     *
     * @author Mariusz Waloszczyk
     */
    public static function getResourcesDropdown(): Collection
    {
        return Resource::select([
            'suffix as value',
            'name as label',
        ])->get();
    }

    /**
     * Get units list prepared for select field
     *
     * @author Mariusz Waloszczyk
     */
    public static function getFireBrigadeUnitsDropdown(): Collection
    {
        return FireBrigadeUnit::select([
            'id as value',
            'name as label',
        ])->get();
    }

    /**
     * Get manufacturers list prepared for select field
     *
     * @author Mariusz Waloszczyk
     */
    public static function getManufacturersDropdown(): Collection
    {
        return Manufacturer::select([
            'id as value',
            'name as label',
        ])->get();
    }

    /**
     * Get eq templates list prepared for select field
     *
     * @author Mariusz Waloszczyk
     */
    public static function getEqItemTemplatesDropdown(): Collection
    {
        return EqItemTemplate::select([
            'id as value',
            'name as label',
            'has_vehicle as vehicle_number',
            'has_construction_number as construction_number',
            'has_inventory_number as inventory_number',
            'has_identification_number as identification_number',
            'has_date_expiry as date_expiry',
            'has_date_legalisation as date_legalisation',
            'has_date_legalisation_due as date_legalisation_due',
            'has_date_production as date_production'
        ])->get();
    }

    /**
     * Get vehicles list prepared for select field
     *
     * @author Mariusz Waloszczyk
     */
    public static function getVehiclesDropdown(
        FireBrigadeUnit $fireBrigadeUnit = null
    ): Collection {
        $query = Vehicle::select([
            'number as value',
            'name as label',
        ]);

        if ($fireBrigadeUnit) {
            $query->where(
                'fire_brigade_unit_id',
                $fireBrigadeUnit->id
            );
        }

        return $query->get();
    }

    /**
     * Get eqItemCategories list prepared for select field
     *
     * @author Mariusz Waloszczyk
     */
    public static function getEqItemCategoriesDropdown(): Collection
    {
        return EqItemCategory::select([
            'id as value',
            'name as label',
        ])->get();
    }
}
