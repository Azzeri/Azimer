<?php

namespace App\Services;

use App\Http\Requests\vehicle\StorevehicleRequest;
use App\Http\Requests\vehicle\UpdatevehicleRequest;
use App\Models\vehicle;
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
        StoreVehicleRequest 
        $request
        ): vehicle {
        return Vehicle::create([
            'number' => $request->number,
            'name' => $request->name,
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
