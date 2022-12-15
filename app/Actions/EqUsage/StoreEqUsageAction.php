<?php

namespace App\Actions\EqUsage;

use App\Models\EqUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @author Piotr Nagórny
 */
class StoreEqUsageAction
{
    /**
     * Stores usage in db
     *
     * @author Piotr Nagórny
     */
    public function execute(
        Request $request
    ): EqUsage {
        return EqUsage::create([
            'description' => $request->description,
            'usage_start' => $request->usage_start,
            'usage_end' => $request->usage_end,
            'eq_item_code' => $request->eq_item_code,
            'user_id' => Auth::user()->id,
        ]);
    }
}
