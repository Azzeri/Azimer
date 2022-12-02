<?php

namespace App\Actions\EqFill;

use App\Models\EqFill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @author Mariusz Waloszczyk
 */
class StoreEqFillAction
{
    /**
     * Stores item in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request
    ): EqFill {
        return EqFill::create([
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
            'eq_item_code' => $request->eq_item_code,
            'user_id' => Auth::user()->id,
        ]);
    }
}
