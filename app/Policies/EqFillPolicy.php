<?php

namespace App\Policies;

use App\Models\Resource;
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
            Resource::RES_EQUIPMENT_OVERALL,
            Resource::ACTION_CREATE,
        );
    }
}