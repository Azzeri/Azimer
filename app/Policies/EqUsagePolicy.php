<?php

namespace App\Policies;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EqUsagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @author Piotr Nagórny
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasResourceWithAction(
            Resource::RES_EQ_USAGES,
            Resource::ACTION_VIEW_ANY,
        );
    }

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
            Resource::RES_EQ_USAGES,
            Resource::ACTION_CREATE,
        );
    }
}
