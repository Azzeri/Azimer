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

    /**
     * Determine whether the user can view any models.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
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
        return $user->hasResourceWithAction(
            Resource::RES_FIRE_BRIGADE_UNITS_OVERALL,
            Resource::ACTION_UPDATE
        ) ||
            ($user->hasResourceWithAction(
                Resource::RES_FIRE_BRIGADE_UNIT_OWN,
                Resource::ACTION_UPDATE
            ) &&
                $fireBrigadeUnit->id == $user->fire_brigade_unit_id
            ) ||
            ($user->hasResourceWithAction(
                Resource::RES_FIRE_BRIGADE_UNITS_LOWLY,
                Resource::ACTION_UPDATE
            ) &&
                $fireBrigadeUnit->superior_unit_id == $user->fire_brigade_unit_id
            );
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
}
