<?php

namespace App\Actions\EqItem;

use App\Models\EqItem;
use Illuminate\Http\Request;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateEqItemAction
{
    /**
     * Updates item in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request,
        EqItem $eqItem,
    ): bool {
        return $eqItem->update([
            'code' => $request->code,
            'name' => $request->name,
            'eq_item_template_id' => $request->eq_item_template_id,
            'fire_brigade_unit_id' => $request->fire_brigade_unit_id,
            'vehicle_number' => $request->vehicle_number,
            'construction_number' => $request->construction_number,
            'inventory_number' => $request->inventory_number,
            'identification_number' => $request->identification_number,
            'date_expiry' => $request->date_expiry,
            'date_legalisation' => $request->date_legalisation,
            'date_legalisation_due' => $request->date_legalisation_due,
            'date_production' => $request->date_production,
        ]);
    }
}
