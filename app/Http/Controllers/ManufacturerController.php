<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manufacturer\ManufacturerRequest;
use App\Models\Manufacturer;
use App\Services\DataTableService;
use App\Services\ManufacturerService;

/**
 * @author Piotr Nagórny
 */
class ManufacturerController extends Controller
{
    public function __construct(
        public ManufacturerService $manufacturerService,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        ManufacturerRequest $manufacturerRequest
    ) {
        $manufacturers = $this
            ->manufacturerService
            ->getManufacturersQuery();

        return inertia('Manufacturer/Index', [
            'manufacturers' => $manufacturers,
            'filters' => DataTableService::getFilters(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Piotr Nagónry
     *
     * @return \Illuminate\Http\Response
     */
    public function store(
        ManufacturerRequest $manufacturerRequest
    ) {
        $this->manufacturerService->storeManufacturer($manufacturerRequest);

        return redirect()->route('manufacturers.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Piotr Nagónry
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        ManufacturerRequest $manufacturerRequest,
        Manufacturer $manufacturer
    ) {
        $this->manufacturerService->updateManufacturer(
            $manufacturerRequest,
            $manufacturer
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Piotr Nagónry
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        ManufacturerRequest $manufacturerRequest,
        Manufacturer $manufacturer
    ) {
        $this->manufacturerService->destroyManufacturer(
            $manufacturer
        );

        return redirect()->route('manufacturers.index');
    }
}
