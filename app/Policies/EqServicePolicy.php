<?php

namespace App\Policies;

use App\Models\AclResource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @author Mariusz Waloszczyk
 */
class EqServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->hasResourceWithAction(
            AclResource::RES_OVERALL_EQUIPMENT,
            AclResource::ACTION_UPDATE
        );
    }
}
