<?php

namespace App\Policies;

use App\Models\AclResource;
use App\Models\AclRole;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @author Mariusz Waloszczyk
 */
class RolePolicy
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
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Role $role)
    {
        return $user->hasResourceWithAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_UPDATE
        );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Role $role)
    {
        return $user->hasResourceWithAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_DELETE
        );
    }
}
