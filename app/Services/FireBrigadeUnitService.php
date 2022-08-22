<?php

namespace App\Services;

use App\Models\FireBrigadeUnit;
use Illuminate\Support\Facades\DB;

/**
 * Fire brigade units services class
 *
 * @author Mariusz Waloszczyk
 */
class FireBrigadeUnitService
{
    /**
     * Detaches all related models
     *
     * @author Mariusz Waloszczyk
     */
    public function detachRelationships(
        FireBrigadeUnit $fireBrigadeUnit
    ): void {
        DB::table('users')
            ->where('fire_brigade_unit_id', $fireBrigadeUnit->id)
            ->update(['fire_brigade_unit_id' => null]);

        DB::table('fire_brigade_units')
            ->where('superior_unit_id', $fireBrigadeUnit->id)
            ->update(['superior_unit_id' => null]);
    }
}
