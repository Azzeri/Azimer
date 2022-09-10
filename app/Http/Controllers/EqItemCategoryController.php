<?php

namespace App\Http\Controllers;

use App\Actions\EqItemCategory\DeleteEqItemCategoryAction;
use App\Actions\EqItemCategory\StoreEqItemCategoryAction;
use App\Actions\EqItemCategory\UpdateEqItemCategoryAction;
use App\Http\Requests\EqItemCategory\EqItemCategoryRequest;
use App\Models\EqItemCategory;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

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
        return inertia(
            'EqItemCategory/Index',
            $this->getIndexProps()
        )->table(function (InertiaTable $table) {
            $table
                ->column(
                    key: 'id',
                    searchable: true,
                    sortable: true,
                )
                ->column(
                    key: 'name',
                    searchable: true,
                    sortable: true,
                )
                ->column(
                    key: 'photo_path',
                    label: 'Photo path',
                    searchable: true,
                    sortable: true,
                )
                ->column(
                    key: 'is_fillable',
                    label: 'Fillable',
                    searchable: true,
                    sortable: true,
                )
                ->column(
                    key: 'parent_category_id',
                    label: 'Parent category',
                    searchable: true,
                    sortable: true,
                );
        });
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

    /**
     * Returns props for frontend page component
     *
     * @author Piotr Nagórny
     */
    private function getIndexProps(): array
    {
        $query = $this
            ->getEqItemCategoryQuery();

        $eqItemCategory = $query
            ->paginate()
            ->withQueryString();

        return [
            'eqItemTemplates' => $eqItemCategory,
        ];
    }

    /**
     * Returns categories list for index
     *
     * @author Piotr Nagórny
     */
    private function getEqItemCategoryQuery(): QueryBuilder
    {
        $query = QueryBuilder::for(EqItemCategory::class)
            ->select(
                'id',
                'name',
                'photo_path',
                'is_fillable',
                'parent_category_id',
            )
            ->allowedSorts([
                'id',
                'name',
                'photo_path',
                'is_fillable',
                'parent_category_id',
            ])
            ->allowedFilters([
                'id',
                'name',
                'photo_path',
                'is_fillable',
                'parent_category_id',
            ])
            ->defaultSort('id');

        return $query;
    }
}
