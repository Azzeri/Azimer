<?php

namespace App\Actions\FireBrigadeUnit;

use App\Models\FireBrigadeUnit;
use App\Services\FireBrigadeUnitService;

/**
 * @author Mariusz Waloszczyk
 */
class DeleteFireBrigadeUnitAction
{
    public function __construct(
        public FireBrigadeUnitService $fireBrigadeUnitService
    ) {
    }

    /**
     * Deletes unit from db
     *
     * @author Mariusz Waloszczyk
     */
    public function execute(
        FireBrigadeUnit $fireBrigadeUnit
    ): bool|null {
        $this
            ->fireBrigadeUnitService
            ->detachRelationships($fireBrigadeUnit);

        return $fireBrigadeUnit->delete();
    }
}
