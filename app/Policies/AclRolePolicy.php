<?php

namespace App\Policies;

use App\Models\AclResource;
use App\Models\AclRole;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

/**
 * @author Mariusz Waloszczyk
 */
class AclRolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @author Mariusz Waloszczyk
     */
    public function viewAny(User $user): Response|bool
    {
        return $user->hasResourceWithAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_VIEW_ANY
        );
    }

    /**
     * Determine whether the user can create models.
     *
     * @author Mariusz Waloszczyk
     */
    public function create(User $user): Response|bool
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
     */
    public function update(User $user, AclRole $role): Response|bool
    {
        $userHasPermissions = $user->hasResourceWithAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_UPDATE
        );

        return $userHasPermissions && ! $role->isSuperAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @author Mariusz Waloszczyk
     */
    public function delete(User $user, AclRole $role): Response|bool
    {
        $userHasPermissions = $user->hasResourceWithAction(
            AclResource::RES_OVERALL_USERS,
            AclResource::ACTION_DELETE
        );

        return $userHasPermissions && ! $role->isSuperAdmin();
    }
}
