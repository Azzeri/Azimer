<?php

namespace App\Http\Controllers;

use App\Actions\FireBrigadeUnit\DeleteFireBrigadeUnitAction;
use App\Actions\FireBrigadeUnit\StoreFireBrigadeUnitAction;
use App\Actions\FireBrigadeUnit\UpdateFireBrigadeUnitAction;
use App\Http\Requests\FireBrigadeUnit\StoreFireBrigadeUnitRequest;
use App\Http\Requests\FireBrigadeUnit\UpdateFireBrigadeUnitRequest;
use App\Models\FireBrigadeUnit;
use App\Models\Resource;
use App\Models\User;
use App\Services\DropdownService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

class FireBrigadeUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Inertia\ResponseFactory|\Inertia\Response
     */
    public function index()
    {
        $this->authorize(
            Resource::ACTION_VIEW_ANY,
            FireBrigadeUnit::class
        );

        $query = $this
            ->getFireBrigadeUnitsQuery();

        $fireBrigadeUnits = $query
            ->paginate()
            ->withQueryString();

        return inertia('FireBrigadeUnit/Index', [
            'fireBrigadeUnits' => $fireBrigadeUnits,
            'superiorUnitSelect' => DropdownService::getFireBrigadeUnitsDropdown(),
        ])->table(function (InertiaTable $table) {
            $table
                ->column(
                    key: 'id',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'name',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'addr_locality',
                    label: 'Locality',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'superior_unit_id',
                    label: 'Superior unit',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    label: 'Actions'
                );
        });
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
