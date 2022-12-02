<?php

namespace App\Http\Controllers;

use App\Actions\EqUsage\StoreEqUsageAction;
use App\Http\Requests\EqUsage\EqUsageRequest;
use Illuminate\Http\RedirectResponse;

/**
 * @author Piotr Nagórny
 */
class EqUsageController extends Controller
{
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
            ->back()
            ->with('message', 'Pomyślnie dodano użycie');
    }
}
