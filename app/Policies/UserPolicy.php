<?php

namespace App\Policies;

use App\Models\AclResource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @author Mariusz Waloszczyk
 */
class UserPolicy
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
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_VIEW
        ) || $user->hasResourceWithAction(
            AclResource::RES_OWN_UNIT_FIRE_BRIGADE_UNIT,
            AclResource::ACTION_VIEW
        ) || $user->hasResourceWithAction(
            AclResource::RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT,
            AclResource::ACTION_VIEW
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
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_CREATE
        ) || $user->hasResourceWithAction(
            AclResource::RES_OWN_UNIT_FIRE_BRIGADE_UNIT,
            AclResource::ACTION_CREATE
        ) || $user->hasResourceWithAction(
            AclResource::RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT,
            AclResource::ACTION_CREATE
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        return $user->hasResourceWithAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_UPDATE
        ) ||
            ($user->hasResourceWithAction(
                AclResource::RES_OWN_UNIT_FIRE_BRIGADE_UNIT,
                AclResource::ACTION_UPDATE
            ) &&
                $model->fire_brigade_unit_id == $user->fire_brigade_unit_id
            ) ||
            ($user->hasResourceWithAction(
                AclResource::RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT,
                AclResource::ACTION_UPDATE
            ) &&
                $model->fireBrigadeUnit->superior_unit_id == $user->fire_brigade_unit_id
            );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return $user->hasResourceWithAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_DELETE
        ) ||
            ($user->hasResourceWithAction(
                AclResource::RES_OWN_UNIT_FIRE_BRIGADE_UNIT,
                AclResource::ACTION_DELETE
            ) &&
                $model->fire_brigade_unit_id == $user->fire_brigade_unit_id
            ) ||
            ($user->hasResourceWithAction(
                AclResource::RES_LOWLY_UNITS_FIRE_BRIGADE_UNIT,
                AclResource::ACTION_DELETE
            ) &&
                $model->fireBrigadeUnit->superior_unit_id == $user->fire_brigade_unit_id
            );
    }
}
