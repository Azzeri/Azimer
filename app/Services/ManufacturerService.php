<?php

namespace App\Services;

use App\Http\Requests\Manufactures\StoreManufacturerRequest;
use App\Http\Requests\Manufactures\UpdateManufacturerRequest;
use App\Models\Manufacturer;
use Exception;

/**
 * Class for roles operations
 *
 * @author Piotr Nagórny
 */
class ManufacturerService
{
    /**
     * Stores role in the database
     *
     * @author Piotr Nagórny
     */
    public function storeManufacturer(StoreManufacturerRequest $request): Manufacturer
    {
        return Manufacturer::create([
            'name' => $request->name,
        ]);
    }

    /**
     * @throws Exception
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
     * Removes the role from storage
     * also detaches all relations
     *
     * @author Piotr Nagórny
     */
    public function destroyManufacturer(Manufacturer $manufacturer): bool|null
    {
        return $manufacturer->delete();
    }
}
