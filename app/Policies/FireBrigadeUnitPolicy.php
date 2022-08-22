<?php

namespace App\Policies;

use App\Models\FireBrigadeUnit;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @author Mariusz Waloszczyk
 */
class FireBrigadeUnitPolicy
{
    use HandlesAuthorization;

    private User $user;

    private FireBrigadeUnit $fireBrigadeUnit;

    /**
     * Determine whether the user can view any models.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        $this->user = $user;

        return $this->canAccessOverallUnits(
            Resource::ACTION_VIEW_ANY
        ) || $user->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNIT_OWN,
            Resource::ACTION_VIEW_ANY
        ) || $user->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNITS_LOWLY,
            Resource::ACTION_VIEW_ANY
        );
    }

    /**
     * Determine whether the user can view the model.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(
        User $user,
        FireBrigadeUnit $fireBrigadeUnit
    ) {
        $this->user = $user;
        $this->fireBrigadeUnit = $fireBrigadeUnit;

        return $this->canAccessOverallUnits(
            Resource::ACTION_VIEW
        ) ||
            $this->canAccessOwnUnit(Resource::ACTION_VIEW) ||
            $this->canAccessLowlyUnit(Resource::ACTION_VIEW);
    }

    /**
     * Determine whether the user can create models.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            Resource::ACTION_CREATE
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(
        User $user,
        FireBrigadeUnit $fireBrigadeUnit
    ) {
        $this->user = $user;
        $this->fireBrigadeUnit = $fireBrigadeUnit;

        return $this->canAccessOverallUnits(
            Resource::ACTION_UPDATE
        ) ||
            $this->canAccessOwnUnit(Resource::ACTION_UPDATE) ||
            $this->canAccessLowlyUnit(Resource::ACTION_UPDATE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(
        User $user,
        FireBrigadeUnit $fireBrigadeUnit
    ) {
        return $user->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            Resource::ACTION_DELETE
        );
    }

    /**
     * Determines if user can access overall units
     *
     * @author Mariusz Waloszczyk
     */
    private function canAccessOverallUnits(
        string $action
    ): bool {
        return $this->user->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            $action
        );
    }

    /**
     * Determines if user can access own unit
     *
     * @author Mariusz Waloszczyk
     */
    private function canAccessOwnUnit(
        string $action
    ): bool {
        return $this->user->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNIT_OWN,
            $action
        ) &&
            $this->fireBrigadeUnit == $this->user->fireBrigadeUnit;
    }

    /**
     * Determines if user can access lowly unit of his unit
     *
     * @author Mariusz Waloszczyk
     */
    private function canAccessLowlyUnit(
        string $action
    ): bool {
        return $this->user->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNITS_LOWLY,
            $action
        ) &&
            $this->fireBrigadeUnit->superiorFireBrigadeUnit ==
            $this->user->fireBrigadeUnit;
    }
}
