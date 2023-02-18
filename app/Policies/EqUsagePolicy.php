<?php

namespace App\Policies;

use App\Models\AclResource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EqUsagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @author Piotr Nagórny
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
