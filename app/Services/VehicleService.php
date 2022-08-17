<?php

namespace App\Services;

use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Models\Vehicle;
use Exception;

/**
 * Class for vehicles operations
 *
 * @author Piotr Nagórny
 */
class vehicleService
{
    /**
     * Stores vehicle in the database
     *
     * @author Piotr Nagórny
     */
    public function storeVehicle(
        StoreVehicleRequest $request
    ): Vehicle {
        return Vehicle::create([
            'number' => $request->number,
            'name' => $request->name,
            'fire_brigade_unit_id' => $request->fire_brigade_unit_id,
        ]);
    }

    /**
     * Updates given model
     *
     * @throws Exception
     *
     * @author Piotr Nagórny
     */
    public function updateVehicle(
        UpdateVehicleRequest $request,
        Vehicle $vehicle
    ): bool {
        return $vehicle->update([
            'number' => $request->number,
            'name' => $request->name,
            'fire_brigade_unit_id' => $request->fire_brigade_unit_id,
        ]);
    }

    /**
     * Removes the vehicle from storage
     * also detaches all relations
     *
     * @author Piotr Nagórny
     */
    public function destroyVehicle(
        Vehicle $vehicle
    ): bool|null {
        return $vehicle->delete();
    }
}
