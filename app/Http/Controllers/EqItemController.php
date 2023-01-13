<?php

namespace App\Http\Controllers;

use App\Actions\EqItem\DeleteEqItemAction;
use App\Actions\EqItem\EqItemActivateServiceAction;
use App\Actions\EqItem\StoreEqItemAction;
use App\Actions\EqItem\UpdateEqItemAction;
use App\Http\Requests\EqItem\EqItemActivateServiceRequest;
use App\Http\Requests\EqItem\EqItemRequest;
use App\Http\Resources\EqItemResource;
use App\Models\EqItem;
use App\Models\Resource;
use App\Models\User;
use App\Services\DataTableService;
use App\Services\DropdownService;
use App\Services\EqItemService;
use App\Services\EqServiceTemplateService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemController extends Controller
{
    public function __construct(
        public EqItemService $eqItemService,
        public EqServiceTemplateService $eqServiceTemplateService,
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
        EqItemRequest $eqItemRequest
    ) {
        $eqItems = $this->eqItemService->getEqItems();

        return inertia(
            'EqItem/Index',
            [
                'eqItems' => $eqItems,
                'eqItemTemplatesSelect' => DropdownService::getEqItemTemplatesDropdown(),
                'eqItemVehiclesSelect' => DropdownService::getVehiclesDropdown(),
                'fireBrigadeUnitsSelect' => DropdownService::getFireBrigadeUnitsDropdown(),
                'filters' => DataTableService::getFilters(),
            ]
        );
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
        $itemServicesTemplates = $this
            ->eqServiceTemplateService
            ->getTemplateServices(
                $eqItem->eqItemTemplate->manufacturer->id,
                $eqItem->eqItemTemplate->eqItemCategory->id,
            );

        $eqItemWithRelations = (new EqItemResource($eqItem->load([
            'fireBrigadeUnit',
            'eqItemTemplate' => [
                'eqItemCategory',
                'manufacturer',
            ],
            'vehicle',
            'eqItemServices' => [
                'eqServiceTemplate',
            ],
        ])))
            ->additional(['data' => [
                'eqServiceTemplates' => $itemServicesTemplates,
            ]]);

        return inertia(
            'EqItem/Show',
            [
                'eqItem' => $eqItemWithRelations,
                'fireBrigadeUnitsSelect' => DropdownService::getFireBrigadeUnitsDropdown(),
                'eqItemVehiclesSelect' => DropdownService::getVehiclesDropdown(),
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
            ->with('message', __('Pomyślnie dodano przedmiot'));
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

        return redirect()
            ->back()
            ->with('message', __('Pomyślnie zaktualizowano przedmiot'));
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

    // /**
    //  * Adds conditions to query based on user resources
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // private function appendQueryConditions(
    //     QueryBuilder $query
    // ): QueryBuilder {
    //     $auth = User::findOrFail(Auth::user()->id);

    //     if ($auth->hasResourceWithAction(
    //         Resource::RES_EQUIPMENT_OVERALL,
    //         Resource::ACTION_VIEW_ANY
    //     )) {
    //         return $query;
    //     }

    //     if ($auth->hasResourceWithAction(
    //         Resource::RES_EQUIPMENT_OWN_UNIT,
    //         Resource::ACTION_VIEW_ANY
    //     )) {
    //         $query->orWhere(
    //             'fire_brigade_unit_id',
    //             $auth->fire_brigade_unit_id
    //         );
    //     }

    //     if ($auth->hasResourceWithAction(
    //         Resource::RES_EQUIPMENT_LOWLY_UNITS,
    //         Resource::ACTION_VIEW_ANY
    //     )) {
    //         $query->with('fireBrigadeUnit');
    //         $query->whereRelation(
    //             'fireBrigadeUnit',
    //             'superior_unit_id',
    //             'like',
    //             $auth->fireBrigadeUnit->id
    //         );
    //     }

    //     return $query;
    // }

    // /**
    //  * Get vehicles for index select
    //  *
    //  * @author Mariusz Waloszczyk
    //  */
    // private function getVehiclesDropdown(): Collection
    // {
    //     $auth = User::findOrFail(Auth::user()->id);

    //     if ($auth->hasResourceWithAction(
    //         Resource::RES_EQUIPMENT_OVERALL,
    //         Resource::ACTION_CREATE
    //     )) {
    //         return DropdownService::getVehiclesDropdown();
    //     }

    //     return DropdownService::getVehiclesDropdown(
    //         $auth->fireBrigadeUnit
    //     );
    // }
}
