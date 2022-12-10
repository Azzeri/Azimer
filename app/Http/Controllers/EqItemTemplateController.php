<?php

namespace App\Http\Controllers;

use App\Actions\EqItemTemplate\DeleteEqItemTemplateAction;
use App\Actions\EqItemTemplate\StoreEqItemTemplateAction;
use App\Actions\EqItemTemplate\UpdateEqItemTemplateAction;
use App\Http\Requests\EqItemTemplate\EqItemTemplateRequest;
use App\Models\EqItemTemplate;
use App\Services\DataTableService;
use App\Services\DropdownService;
use App\Services\EqItemTemplateService;
use Illuminate\Http\RedirectResponse;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemTemplateController extends Controller
{
    public function __construct(
        public EqItemTemplateService $eqItemTemplateService,
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
        EqItemTemplateRequest $request
    ) {
        $eqItemTemplates = $this
            ->eqItemTemplateService
            ->getEqItemTemplatesQuery();

        return inertia('EqItemTemplate/Index', [
            'eqItemTemplates' => $eqItemTemplates,
            'eqItemManufacturersSelect' => DropdownService::getManufacturersDropdown(),
            'eqItemCategoriesSelect' => DropdownService::getEqItemCategoriesDropdown(),
            'filters' => DataTableService::getFilters(),
        ]);
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
}
