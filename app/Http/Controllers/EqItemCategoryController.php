<?php

namespace App\Http\Controllers;

use App\Actions\EqItemCategory\DeleteEqItemCategoryAction;
use App\Actions\EqItemCategory\StoreEqItemCategoryAction;
use App\Actions\EqItemCategory\UpdateEqItemCategoryAction;
use App\Http\Requests\EqItemCategory\EqItemCategoryRequest;
use App\Models\EqItemCategory;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;

/**
 * @author Piotr Nagórny
 */
class EqItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author Piotr Nagórny
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        EqItemCategoryRequest $request,
    ) {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author Piotr Nagórny
     */
    public function store(
        EqItemCategoryRequest $request,
        StoreEqItemCategoryAction $storeEqItemCategoryAction
    ): RedirectResponse {
        $storeEqItemCategoryAction->execute($request);

        return redirect()
            ->route('eqItemCategories.index')
            ->with('message', 'Pomyślnie dodano kategorię');
    }

    /**
     * Update the specified resource in storage.
     *
     * @author Piotr Nagórny
     */
    public function update(
        EqItemCategoryRequest $request,
        EqItemCategory $eqItemCategory,
        UpdateEqItemCategoryAction $updateEqItemCategoryAction
    ): RedirectResponse {
        $updateEqItemCategoryAction->execute(
            $request,
            $eqItemCategory
        );

        return redirect(route('eqItemCategories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author Piotr Nagórny
     */
    public function destroy(
        EqItemCategoryRequest $request,
        EqItemCategory $eqItemCategory,
        DeleteEqItemCategoryAction $deleteEqItemCategoryAction
    ): RedirectResponse {
        $deleteEqItemCategoryAction
            ->execute($eqItemCategory);

        return redirect()->route('eqItemCategories.index');
    }
}
