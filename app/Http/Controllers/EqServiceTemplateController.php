<?php

namespace App\Http\Controllers;

use App\Actions\EqServiceTemplate\DeleteEqServiceTemplateAction;
use App\Actions\EqServiceTemplate\StoreEqServiceTemplateAction;
use App\Actions\EqServiceTemplate\UpdateEqServiceTemplateAction;
use App\Http\Requests\EqServiceTemplate\EqServiceTemplateRequest;
use App\Models\EqServiceTemplate;
use App\Services\DropdownService;
use Illuminate\Http\RedirectResponse;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @author Mariusz Waloszczyk
 */
class EqServiceTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @author Mariusz Waloszczyk
     */
    public function index(
        EqServiceTemplateRequest $request
    ) {
        return inertia(
            'EqServiceTemplate/Index',
            $this->getIndexProps()
        )->table(function (InertiaTable $table) {
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
                    key: 'interval',
                    label: '',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'eq_item_category_id',
                    label: 'category',
                    searchable: true,
                    sortable: true
                )
                ->column(
                    key: 'manufacturer_id',
                    label: 'manufacturer',
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
        EqServiceTemplateRequest $request,
        StoreEqServiceTemplateAction $storeEqServiceTemplateAction
    ): RedirectResponse {
        $storeEqServiceTemplateAction->execute($request);

        return redirect()
            ->route('eqServiceTemplates.index')
            ->with('message', 'Pomyślnie dodano szablon');
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function update(
        EqServiceTemplateRequest $request,
        UpdateEqServiceTemplateAction $updateEqServiceTemplateAction,
        EqServiceTemplate $eqServiceTemplate
    ): RedirectResponse {
        $updateEqServiceTemplateAction->execute(
            $request,
            $eqServiceTemplate
        );

        return redirect(route('eqServiceTemplates.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function destroy(
        EqServiceTemplateRequest $request,
        EqServiceTemplate $eqServiceTemplate,
        DeleteEqServiceTemplateAction $deleteEqServiceTemplateAction
    ): RedirectResponse {
        $deleteEqServiceTemplateAction
            ->execute($eqServiceTemplate);

        return redirect(route('eqServiceTemplates.index'));
    }

    /**
     * Returns props for frontend page component
     *
     * @author Mariusz Waloszczyk
     */
    private function getIndexProps(): array
    {
        $query = $this
            ->getEqServiceTemplatesQuery();

        $eqServiceTemplates = $query
            ->paginate()
            ->withQueryString();

        return [
            'eqServiceTemplates' => $eqServiceTemplates,
            'eqItemManufacturersSelect' => DropdownService::getManufacturersDropdown(),
            'eqItemCategoriesSelect' => [['value' => 1, 'label' => 'cat 1'], ['value' => 2, 'label' => 'cat 2']], // temporary
        ];
    }

    /**
     * Returns templates list for index
     *
     * @author Mariusz Waloszczyk
     */
    private function getEqServiceTemplatesQuery(): QueryBuilder
    {
        $query = QueryBuilder::for(EqServiceTemplate::class)
            ->select(
                'id',
                'name',
                'description',
                'interval',
                'eq_item_category_id',
                'manufacturer_id',
            )
            ->with('manufacturer')
            // ->with('eqItemCategory')
            ->allowedSorts([
                'id',
                'name',
                'description',
                'interval',
                'eq_item_category_id',
                'manufacturer_id',
            ])
            ->allowedFilters([
                'id',
                'name',
                'description',
                'interval',
                'eq_item_category_id',
                'manufacturer_id',
            ])
            ->defaultSort('id');

        return $query;
    }
}
