<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Models\Resource;
use App\Models\Vehicle;
use App\Services\VehicleService;

/**
 * @author Piotr Nagórny
 */
class VehicleController extends Controller
{
    public function __construct(
        public VehicleService $vehicleService,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @author Piotr Nagórny
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Piotr Nagórny
     *
     * @return \Illuminate\Http\Response
     */
    public function store(
        StoreVehicleRequest $request
    ) {
        $this->vehicleService->storeVehicle($request);

        return redirect()->route('vehicles.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Piotr Nagórny
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdateVehicleRequest $request,
        Vehicle $vehicle
    ) {
        $this->vehicleService->updateVehicle(
            $request,
            $vehicle
        );

        return redirect()->route('vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Piotr Nagórny
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $this->authorize(
            Resource::ACTION_DELETE,
            $vehicle,
            Vehicle::class
        );

        $this->vehicleService->destroyVehicle(
            $vehicle
        );

        return redirect()->route('vehicles.index');
    }
}
