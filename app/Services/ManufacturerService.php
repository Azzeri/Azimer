<?php

namespace App\Services;

use App\Http\Requests\Manufacturer\StoreManufacturerRequest;
use App\Http\Requests\Manufacturer\UpdateManufacturerRequest;
use App\Models\Manufacturer;

/**
 * Class for roles operations
 *
 * @author Piotr Nagórny
 */
class ManufacturerService
{
    /**
     * Stores manufacturer in the database
     *
     * @author Piotr Nagórny
     */
    public function storeManufacturer(
        StoreManufacturerRequest $request
    ): Manufacturer {
        return Manufacturer::create([
            'name' => $request->name,
        ]);
    }

    /**
     * Updates manufacturer data
     *
     * @author Piotr Nagórny
     */
    public function updateManufacturer(
        UpdateManufacturerRequest $request,
        Manufacturer $manufacturer,
    ): bool {
        return $manufacturer->update([
            'name' => $request->name,
        ]);
    }

    /**
     * Removes the manufacturer from storage
     *
     * @author Piotr Nagórny
     */
    public function destroyManufacturer(
        Manufacturer $manufacturer
    ): bool|null {
        return $manufacturer->delete();
    }
}
