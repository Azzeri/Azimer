<?php

namespace App\Policies;

use App\Models\Resource;
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
            Resource::RES_USERS_OVERALL,
            Resource::ACTION_VIEW_ANY
        ) || $user->hasResourceWithAction(
            Resource::RES_USERS_OWN_UNIT,
            Resource::ACTION_VIEW_ANY
        ) || $user->hasResourceWithAction(
            Resource::RES_USERS_LOWLY_UNITS,
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
            Resource::RES_USERS_OVERALL,
            Resource::ACTION_CREATE
        ) || $user->hasResourceWithAction(
            Resource::RES_USERS_OWN_UNIT,
            Resource::ACTION_CREATE
        ) || $user->hasResourceWithAction(
            Resource::RES_USERS_LOWLY_UNITS,
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
    public function update(User $user, User $model)
    {
        return $user->hasResourceWithAction(
            Resource::RES_USERS_OVERALL,
            Resource::ACTION_UPDATE
        ) ||
            ($user->hasResourceWithAction(
                Resource::RES_USERS_OWN_UNIT,
                Resource::ACTION_UPDATE
            ) &&
                $model->fire_brigade_unit_id == $user->fire_brigade_unit_id
            ) ||
            ($user->hasResourceWithAction(
                Resource::RES_USERS_LOWLY_UNITS,
                Resource::ACTION_UPDATE
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
            Resource::RES_USERS_OVERALL,
            Resource::ACTION_DELETE
        ) ||
            ($user->hasResourceWithAction(
                Resource::RES_USERS_OWN_UNIT,
                Resource::ACTION_DELETE
            ) &&
                $model->fire_brigade_unit_id == $user->fire_brigade_unit_id
            ) ||
            ($user->hasResourceWithAction(
                Resource::RES_USERS_LOWLY_UNITS,
                Resource::ACTION_DELETE
            ) &&
                $model->fireBrigadeUnit->superior_unit_id == $user->fire_brigade_unit_id
            );
    }
}
