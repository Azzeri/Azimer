<?php

namespace App\Http\Controllers;

use App\Actions\FireBrigadeUnit\DeleteFireBrigadeUnitAction;
use App\Actions\FireBrigadeUnit\StoreFireBrigadeUnitAction;
use App\Actions\FireBrigadeUnit\UpdateFireBrigadeUnitAction;
use App\Http\Requests\FireBrigadeUnit\StoreFireBrigadeUnitRequest;
use App\Http\Requests\FireBrigadeUnit\UpdateFireBrigadeUnitRequest;
use App\Models\FireBrigadeUnit;
use Illuminate\Http\RedirectResponse;

class FireBrigadeUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author Mariusz Waloszczyk
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
     * @author Mariusz Waloszczyk
     */
    public function store(
        StoreFireBrigadeUnitRequest $request,
        StoreFireBrigadeUnitAction $storeFireBrigadeUnitAction
    ): RedirectResponse {
        $storeFireBrigadeUnitAction->execute($request);

        return redirect(route('fireBrigadeUnits.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function update(
        UpdateFireBrigadeUnitRequest $request,
        UpdateFireBrigadeUnitAction $updateFireBrigadeUnitAction,
        FireBrigadeUnit $fireBrigadeUnit
    ): RedirectResponse {
        $updateFireBrigadeUnitAction->execute(
            $request,
            $fireBrigadeUnit
        );

        return redirect(route('fireBrigadeUnits.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function destroy(
        FireBrigadeUnit $fireBrigadeUnit,
        DeleteFireBrigadeUnitAction $deleteFireBrigadeUnitAction
    ): RedirectResponse {
        $deleteFireBrigadeUnitAction
            ->execute($fireBrigadeUnit);

        return redirect(route('fireBrigadeUnits.index'));
    }
}
