<?php

namespace App\Actions\FireBrigadeUnit;

use App\Models\FireBrigadeUnit;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteFireBrigadeUnitAction
{
    /**
     * Stores unit in db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        FireBrigadeUnit $fireBrigadeUnit
    ): bool|null {
        return $fireBrigadeUnit->delete();
    }
}
