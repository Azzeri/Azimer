<?php

namespace App\Actions\EqServiceTemplate;

use App\Models\EqServiceTemplate;
use Illuminate\Http\Request;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateEqServiceTemplateAction
{
    /**
     * Updates unit in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request,
        EqServiceTemplate $eqServiceTemplate
    ): bool {
        return $eqServiceTemplate->update([
            'name' => $request->name,
            'description' => $request->description,
            'interval' => $request->interval,
        ]);
    }
}
