<?php

namespace App\Actions\FireBrigadeUnit;

use App\Models\FireBrigadeUnit;
use Illuminate\Http\Request;

/**
 * @author Mariusz Waloszczyk
 */
class UpdateFireBrigadeUnitAction
{
    /**
     * Stores unit in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        Request $request,
        FireBrigadeUnit $fireBrigadeUnit
    ): bool {
        return $fireBrigadeUnit->update([
            'name' => $request->name,
            'addr_street' => $request->addr_street,
            'addr_number' => $request->addr_number,
            'addr_postcode' => $request->addr_postcode,
            'addr_locality' => $request->addr_locality,
            'superior_unit_id' => $request->superior_unit_id,
        ]);
    }
}
