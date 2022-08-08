<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manufactures\StoreManufacturerRequest;
use App\Http\Requests\Manufactures\UpdateManufacturerRequest;
use App\Models\Manufacturer;
use App\Models\Resource;
use App\Services\ManufacturerService;
use Exception;

class ManufacturerController extends Controller
{
    public function __construct(
        public ManufacturerService $manufacturerService,
    ) {
    }

    /**
     * Display a listing of the resource.
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
     * @param  \App\Http\Requests\Manufactures\StoreManufacturerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        StoreManufacturerRequest $request
    ) {
        $this->manufacturerService->storeManufacturer($request);

        return redirect()->route('manufacturers.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Manufactures\UpdateManufacturerRequest  $request
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $this->manufacturerService->updateManufacturer(
            $request,
            $manufacturer
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $this->authorize(
            Resource::ACTION_DELETE,
            $manufacturer,
            Manufacturer::class
        );

        try {
            $this->manufacurerService->destroyManufacturer($manufacturer);
        } catch (Exception $e) {
        }

        return redirect()->route('manufacturers.index');
    }
}
