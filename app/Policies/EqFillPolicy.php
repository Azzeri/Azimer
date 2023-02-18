<?php

namespace App\Policies;

use App\Models\AclResource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EqFillPolicy
{
    use HandlesAuthorization;

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
            AclResource::RES_OVERALL_EQUIPMENT,
            AclResource::ACTION_CREATE,
        );
    }
}
