<?php

namespace App\Services;

use App\Models\FireBrigadeUnit;
use App\Models\Manufacturer;
use App\Models\Resource;
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
}
