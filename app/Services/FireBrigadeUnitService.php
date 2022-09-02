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

    /**
     * Returns random fire brigade unit or creates one
     * if none exists
     *
     * @author Mariusz Waloszczyk
     */
    public static function getRandomFireBrigadeUnit(): FireBrigadeUnit
    {
        $unit = FireBrigadeUnit::inRandomOrder()->first();

        if (is_null($unit)) {
            return FireBrigadeUnit::factory()
                ->create();
        }

        return $unit;
    }
}
