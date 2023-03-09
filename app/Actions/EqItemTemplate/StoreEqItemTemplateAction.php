<?php

namespace App\Actions\EqItemTemplate;

use App\Models\EqItemTemplate;
use Illuminate\Http\Request;

/**
 * @author Mariusz Waloszczyk
 */
class StoreEqItemTemplateAction
{
    /**
     * Stores template in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request
    ): EqItemTemplate {
        return EqItemTemplate::create([
            'eq_item_category_id' => $request->eq_item_category_id,
            'manufacturer_id' => $request->manufacturer_id,
            'has_name' => $request->has_name,
            'has_construction_number' => $request->has_construction_number,
            'has_inventory_number' => $request->has_inventory_number,
            'has_identification_number' => $request->has_identification_number,
            'has_date_production' => $request->has_date_production,
            'has_date_expiry' => $request->has_date_expiry,
            'has_date_legalisation' => $request->has_date_legalisation,
            'has_date_legalisation_due' => $request->has_date_legalisation_due,
            'has_vehicle' => $request->has_vehicle,
            'is_fillable' => $request->is_fillable,
        ]);
    }
}
