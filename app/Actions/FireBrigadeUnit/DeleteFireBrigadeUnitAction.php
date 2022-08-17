<?php

namespace App\Actions\FireBrigadeUnit;

use App\Models\FireBrigadeUnit;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteFireBrigadeUnitAction
{
    /**
     * Deletes unit from db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        FireBrigadeUnit $fireBrigadeUnit
    ): bool|null {
        return $fireBrigadeUnit->delete();
    }
}
