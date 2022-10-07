<?php

//TODO

namespace App\Http\Controllers;

use App\Actions\EqUsage\StoreEqUsageAction;
use App\Http\Requests\EqUsage\EqUsageRequest;
use App\Models\EqUsage;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @author Piotr Nagórny
 */
class EqUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author Piotr Nagórny
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        EqUsageRequest $request,
    ) {
        return inertia(
            'EqUsage/Index',
            $this->getIndexProps()
        )->table(function (InertiaTable $table) {
            $table
                ->column(
                    key: 'id',
                    searchable: true,
                    sortable: true,
                )
                ->column(
                    key: 'description',
                    searchable: true,
                    sortable: false,
                )
                ->column(
                    key: 'executed_at',
                    label: 'Executed at',
                    searchable: true,
                    sortable: true,
                )
                ->column(
                    key: 'duration_minutes',
                    label: 'Duration minutes',
                    searchable: true,
                    sortable: true,
                )
                ->column(
                    key: 'eq_item_code',
                    label: 'Item code',
                    searchable: true,
                    sortable: true,
                )
                ->column(
                    key: 'user_id',
                    label: 'User id',
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
        EqUsageRequest $request,
        StoreEqUsageAction $storeEqUsageAction
    ): RedirectResponse {
        $storeEqUsageAction->execute($request);

        return redirect()
            ->route('eqUsages.index')
            ->with('message', 'Pomyślnie dodano użycie');
    }

    /**
     * Returns props for frontend page component
     *
     * @author Piotr Nagórny
     */
    private function getIndexProps(): array
    {
        $query = $this
            ->getEqUsageQuery();

        $eqUsages = $query
            ->paginate()
            ->withQueryString();

        return [
            'eqUsages' => $eqUsages,
        ];
    }

    /**
     * Returns categories list for index
     *
     * @author Piotr Nagórny
     */
    private function getEqUsageQuery(): QueryBuilder
    {
        $query = QueryBuilder::for(EqUsage::class)
            ->select(
                'id',
                'description',
                'executed_at',
                'duration_minutes',
                'eq_item_code',
                'user_id',
            )
            ->allowedSorts([
                'id',
                'executed_at',
                'duration_minutes',
                'eq_item_code',
                'user_id',
            ])
            ->allowedFilters([
                'id',
                'description',
                'executed_at',
                'duration_minutes',
                'eq_item_code',
                'user_id',
            ])
            ->defaultSort('id');

        return $query;
    }
}
