<?php

namespace App\Http\Controllers;

use App\Actions\EqItem\DeleteEqItemAction;
use App\Actions\EqItem\EqItemActivateServiceAction;
use App\Actions\EqItem\StoreEqItemAction;
use App\Actions\EqItem\UpdateEqItemAction;
use App\Http\Requests\EqItem\EqItemActivateServiceRequest;
use App\Http\Requests\EqItem\EqItemRequest;
use App\Models\EqItem;
use App\Models\Resource;
use App\Models\User;
use App\Services\DropdownService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @author Mariusz Waloszczyk
     */
    public function index(
        EqItemRequest $request
    ) {
        return inertia(
            'FireBrigadeUnit/Index',
            $this->getIndexProps()
        )->table(function (InertiaTable $table) {
            $table
                ->column(
                    key: 'code',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'name',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'construction_number',
                    label: 'construction number',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'inventory_number',
                    label: 'inventory number',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'identification_number',
                    label: 'identification number',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'date_production',
                    label: 'production date',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'date_expiry',
                    label: 'expire date',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'date_legalisation',
                    label: 'legalisation date',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'date_legalisation_due',
                    label: 'legalisation due',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'vehicle_number',
                    label: 'vehicle',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'eq_item_template_id',
                    label: 'template',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'fire_brigade_unit_id',
                    label: 'fire brigade unit',
                    searchable: true,
                    sortable: true
                );
        });
    }

    /**
     * Display the resource.
     *
     * @author Mariusz Waloszczyk
     */
    public function show(
        EqItemRequest $request,
        EqItem $eqItem
    ) {
        return inertia(
            'FireBrigadeUnit/Show',
            [
                'eqItem' => [
                    'code' => $eqItem->code,
                    'name' => $eqItem->code,
                    'eq_item_template' => [
                        'id' => $eqItem->eqItemTemplate->id,
                        'name' => $eqItem->eqItemTemplate->name,
                    ],
                    'fire_brigade_unit' => [
                        'id' => $eqItem->fireBrigadeUnit->id,
                        'name' => $eqItem->fireBrigadeUnit->name,
                    ],
                    'vehicle' => [
                        'number' => $eqItem->vehicle->number ?? null,
                        'name' => $eqItem->vehicle->name ?? null,
                    ],
                    'construction_number' => $eqItem->construction_number,
                    'inventory_number' => $eqItem->inventory_number,
                    'identification_number' => $eqItem->identification_number,
                    'date_expiry' => $eqItem->date_expiry,
                    'date_legalisation' => $eqItem->date_legalisation,
                    'date_legalisation_due' => $eqItem->date_legalisation_due,
                    'date_production' => $eqItem->date_production,
                ],
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function store(
        EqItemRequest $request,
        StoreEqItemAction $storeEqItemAction
    ): RedirectResponse {
        $storeEqItemAction->execute($request);

        return redirect()
            ->route('eqItems.index')
            ->with('message', 'Pomyślnie dodano przedmiot');
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function update(
        EqItemRequest $request,
        UpdateEqItemAction $updateEqItemAction,
        EqItem $eqItem
    ): RedirectResponse {
        $updateEqItemAction->execute(
            $request,
            $eqItem
        );

        return redirect(route('eqItems.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function destroy(
        EqItemRequest $request,
        DeleteEqItemAction $deleteEqItemAction,
        EqItem $eqItem,
    ): RedirectResponse {
        $deleteEqItemAction->execute($eqItem);

        return redirect(route('eqItems.index'));
    }

    /**
     * Creates service for given item and template
     *
     * @author Mariusz Waloszczyk
     */
    public function activateService(
        EqItemActivateServiceRequest $request,
        EqItemActivateServiceAction $EqItemActivateServiceAction,
        EqItem $eqItem,
    ): RedirectResponse {
        $EqItemActivateServiceAction->execute(
            $request,
            $eqItem
        );

        return redirect()
            ->back()
            ->with('message', 'Sukces');
    }

    /**
     * Returns props for frontend page component
     *
     * @author Mariusz Waloszczyk
     */
    private function getIndexProps(): array
    {
        $query = $this
            ->getEqItemsQuery();

        $eqItems = $query
            ->paginate()
            ->withQueryString();

        return [
            'eqItems' => $eqItems,
            'eqItemTemplatesSelect' => DropdownService::getEqItemTemplatesDropdown(),
            'eqItemVehiclesSelect' => $this->getVehiclesDropdown(),
            'fireBrigadeUnitsSelect' => DropdownService::getFireBrigadeUnitsDropdown(),
        ];
    }

    /**
     * Returns units list for index
     *
     * @author Mariusz Waloszczyk
     */
    private function getEqItemsQuery(): QueryBuilder
    {
        $query = QueryBuilder::for(EqItem::class)
            ->select(
                'code',
                'name',
                'eq_item_template_id',
                'fire_brigade_unit_id',
                'vehicle_number',
                'construction_number',
                'inventory_number',
                'identification_number',
                'date_expiry',
                'date_legalisation',
                'date_legalisation_due',
                'date_production',
            )
            ->with(
                'fireBrigadeUnit:id,name',
                'eqItemTemplate:id,name',
                'vehicle:number,name',
            )
            ->allowedSorts([
                'code',
                'name',
                'eq_item_template_id',
                'fire_brigade_unit_id',
                'vehicle_number',
                'construction_number',
                'inventory_number',
                'identification_number',
                'date_expiry',
                'date_legalisation',
                'date_legalisation_due',
                'date_production',
            ])
            ->allowedFilters([
                'code',
                'name',
                'eq_item_template_id',
                'fire_brigade_unit_id',
                'vehicle_number',
                'construction_number',
                'inventory_number',
                'identification_number',
                'date_expiry',
                'date_legalisation',
                'date_legalisation_due',
                'date_production',
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
            Resource::RES_EQUIPMENT_OVERALL,
            Resource::ACTION_VIEW_ANY
        )) {
            return $query;
        }

        if ($auth->hasResourceWithAction(
            Resource::RES_EQUIPMENT_OWN_UNIT,
            Resource::ACTION_VIEW_ANY
        )) {
            $query->orWhere(
                'fire_brigade_unit_id',
                $auth->fire_brigade_unit_id
            );
        }

        if ($auth->hasResourceWithAction(
            Resource::RES_EQUIPMENT_LOWLY_UNITS,
            Resource::ACTION_VIEW_ANY
        )) {
            $query->with('fireBrigadeUnit');
            $query->whereRelation(
                'fireBrigadeUnit',
                'superior_unit_id',
                'like',
                $auth->fireBrigadeUnit->id
            );
        }

        return $query;
    }

    /**
     * Get vehicles for index select
     *
     * @author Mariusz Waloszczyk
     */
    private function getVehiclesDropdown(): Collection
    {
        $auth = User::findOrFail(Auth::user()->id);

        if ($auth->hasResourceWithAction(
            Resource::RES_EQUIPMENT_OVERALL,
            Resource::ACTION_CREATE
        )) {
            return DropdownService::getVehiclesDropdown();
        }

        return DropdownService::getVehiclesDropdown(
            $auth->fireBrigadeUnit
        );
    }
}
