<?php

namespace App\Http\Controllers;

use App\Actions\EqFill\StoreEqFillAction;
use App\Http\Requests\EqFill\EqFillRequest;
use Illuminate\Http\RedirectResponse;

/**
 * @author Mariusz Waloszczyk
 */
class EqFillController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @author Mariusz Waloszczyk
     */
    public function store(
        EqFillRequest $request,
        StoreEqFillAction $storeEqFillAction
    ): RedirectResponse {
        $storeEqFillAction->execute($request);

        return redirect()
            ->back()
            ->with('message', 'Sukces');
    }
}
