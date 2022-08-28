<?php

namespace App\Http\Controllers;

use App\Actions\EqItemTemplate\DeleteEqItemTemplateAction;
use App\Actions\EqItemTemplate\StoreEqItemTemplateAction;
use App\Actions\EqItemTemplate\UpdateEqItemTemplateAction;
use App\Http\Requests\EqItemTemplate\EqItemTemplateRequest;
use App\Models\EqItemTemplate;
use Illuminate\Http\RedirectResponse;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @author Mariusz Waloszczyk
     */
    public function index(
        EqItemTemplateRequest $request
    ) {
        $query = $this
            ->getEqItemTemplatesQuery();

        $eqItemTemplates = $query
            ->paginate()
            ->withQueryString();

        return inertia('EqItemTemplate/Index', [
            'eqItemTemplates' => $eqItemTemplates,
            'eqItemCategories' => [1, 2, 3, 4], // temporary
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
                    key: 'eq_item_category_id',
                    label: 'Category',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'manufacturer_id',
                    label: 'Manufacturer',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'has_vehicle',
                    label: 'Vehicle',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'has_construction_number',
                    label: 'Construction number',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'has_inventory_number',
                    label: 'Inventory number',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'has_identification_number',
                    label: 'Identification number',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'has_date_expiry',
                    label: 'Date expiry',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'has_date_legalisation',
                    label: 'Date legalisation',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'has_date_legalisation_due',
                    label: 'Date legalisation due',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'has_date_production',
                    label: 'Date production',
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
        EqItemTemplateRequest $request,
        StoreEqItemTemplateAction $storeEqItemTemplateAction
    ): RedirectResponse {
        $storeEqItemTemplateAction->execute($request);

        return redirect()
            ->route('eqItemTemplates.index')
            ->with('message', 'Pomyślnie dodano szablon');
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function update(
        EqItemTemplateRequest $request,
        UpdateEqItemTemplateAction $updateEqItemTemplateAction,
        EqItemTemplate $eqItemTemplate
    ): RedirectResponse {
        $updateEqItemTemplateAction->execute(
            $request,
            $eqItemTemplate
        );

        return redirect(route('eqItemTemplates.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function destroy(
        EqItemTemplateRequest $request,
        EqItemTemplate $eqItemTemplate,
        DeleteEqItemTemplateAction $deleteEqItemTemplateAction
    ): RedirectResponse {
        $deleteEqItemTemplateAction
            ->execute($eqItemTemplate);

        return redirect(route('eqItemTemplates.index'));
    }

    /**
     * Returns templates list for index
     *
     * @author Mariusz Waloszczyk
     */
    private function getEqItemTemplatesQuery(): QueryBuilder
    {
        $query = QueryBuilder::for(EqItemTemplate::class)
            ->select(
                'id',
                'name',
                'eq_item_category_id',
                'manufacturer_id',
                'has_vehicle',
                'has_construction_number',
                'has_inventory_number',
                'has_identification_number',
                'has_date_expiry',
                'has_date_legalisation',
                'has_date_legalisation_due',
                'has_date_production',
            )
            ->allowedSorts([
                'id',
                'name',
                'eq_item_category_id',
                'manufacturer_id',
                'has_vehicle',
                'has_construction_number',
                'has_inventory_number',
                'has_identification_number',
                'has_date_expiry',
                'has_date_legalisation',
                'has_date_legalisation_due',
                'has_date_production',
            ])
            ->allowedFilters([
                'id',
                'name',
                'eq_item_category_id',
                'manufacturer_id',
                'has_vehicle',
                'has_construction_number',
                'has_inventory_number',
                'has_identification_number',
                'has_date_expiry',
                'has_date_legalisation',
                'has_date_legalisation_due',
                'has_date_production',
            ])
            ->defaultSort('id');

        return $query;
    }
}
