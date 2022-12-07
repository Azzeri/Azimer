<?php

namespace App\Http\Controllers;

use App\Actions\FireBrigadeUnit\DeleteFireBrigadeUnitAction;
use App\Actions\FireBrigadeUnit\StoreFireBrigadeUnitAction;
use App\Actions\FireBrigadeUnit\UpdateFireBrigadeUnitAction;
use App\Http\Requests\FireBrigadeUnit\FireBrigadeUnitRequest;
use App\Models\FireBrigadeUnit;
use App\Models\Resource;
use App\Models\User;
use App\Services\DataTableService;
use App\Services\DropdownService;
use App\Services\FireBrigadeUnitService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @author Mariusz Waloszczyk
 */
class FireBrigadeUnitController extends Controller
{
    public function __construct(
        private FireBrigadeUnitService $fireBrigadeUnitService,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @author Mariusz Waloszczyk
     */
    public function index(
        FireBrigadeUnitRequest $request
    ) {
        $fireBrigadeUnits = $this
            ->fireBrigadeUnitService
            ->getFireBrigadeUnitsQuery();

        return inertia('FireBrigadeUnit/Index', [
            'fireBrigadeUnits' => $fireBrigadeUnits,
            'superiorUnitSelect' => DropdownService::getFireBrigadeUnitsDropdown(),
            'filters' => DataTableService::getFilters(),
        ]);
    }

    /**
     * Display the resource.
     *
     * @author Mariusz Waloszczyk
     */
    public function show(
        FireBrigadeUnitRequest $request,
        FireBrigadeUnit $fireBrigadeUnit
    ) {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function store(
        FireBrigadeUnitRequest $request,
        StoreFireBrigadeUnitAction $storeFireBrigadeUnitAction
    ): RedirectResponse {
        $storeFireBrigadeUnitAction->execute($request);

        return redirect()
            ->route('fireBrigadeUnits.index')
            ->with('message', 'Pomyślnie dodano jednostkę');
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function update(
        FireBrigadeUnitRequest $request,
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
        FireBrigadeUnitRequest $request,
        FireBrigadeUnit $fireBrigadeUnit,
        DeleteFireBrigadeUnitAction $deleteFireBrigadeUnitAction
    ): RedirectResponse {
        $deleteFireBrigadeUnitAction
            ->execute($fireBrigadeUnit);

        return redirect(route('fireBrigadeUnits.index'));
    }

    /**
     * Returns units list for index
     *
     * @author Mariusz Waloszczyk
     */
    private function getFireBrigadeUnitsQuery(): QueryBuilder
    {
        $query = QueryBuilder::for(FireBrigadeUnit::class)
            ->select(
                'id',
                'name',
                'addr_locality',
                'superior_unit_id',
            )
            ->with(
                'superiorFireBrigadeUnit:id,name'
            )
            ->allowedSorts([
                'id',
                'name',
                'addr_locality',
                'superior_unit_id',
            ])
            ->allowedFilters([
                'id',
                'name',
                'addr_locality',
                'superior_unit_id',
            ])
            ->defaultSort('id');

        return $this->appendQueryConditions($query);
    }

    /**
     * Adds conditions to query based on user resources
     *
     * @author Mariusz Waloszczyk
     */
    private function appendQueryConditions(
        QueryBuilder $query
    ): QueryBuilder {
        $auth = User::findOrFail(Auth::user()->id);

        if ($auth->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            Resource::ACTION_VIEW_ANY
        )) {
            return $query;
        }

        if ($auth->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNIT_OWN,
            Resource::ACTION_VIEW_ANY
        )) {
            $query->orWhere(
                'id',
                $auth->fire_brigade_unit_id
            );
        }

        if ($auth->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNITS_LOWLY,
            Resource::ACTION_VIEW_ANY
        )) {
            $query->orWhere(
                'superior_unit_id',
                $auth->fire_brigade_unit_id
            );
        }

        return $query;
    }
}
