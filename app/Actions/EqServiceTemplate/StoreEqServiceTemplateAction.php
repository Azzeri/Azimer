<?php

namespace App\Actions\EqServiceTemplate;

use App\Models\EqServiceTemplate;
use Illuminate\Http\Request;

/**
 * @author Mariusz Waloszczyk
 */
class StoreEqServiceTemplateAction
{
    /**
     * Stores template in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request
    ): EqServiceTemplate {
        return EqServiceTemplate::create([
            'eq_item_template_id' => $request->eq_item_template_id,
            'name' => $request->name,
            'description' => $request->description,
            'interval' => $request->interval,
        ]);
    }
}
