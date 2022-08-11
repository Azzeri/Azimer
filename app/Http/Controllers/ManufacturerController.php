<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manufactures\StoreManufacturerRequest;
use App\Http\Requests\Manufactures\UpdateManufacturerRequest;
use App\Models\Manufacturer;
use App\Models\Resource;
use App\Services\ManufacturerService;

/**
 * @author Piotr Nagónry
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
     * @author Piotr Nagónry
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
     * @author Piotr Nagónry
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
     * @author Piotr Nagónry
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
     * @author Piotr Nagónry
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

        return redirect()->route('manufacturers.index');
    }
}
