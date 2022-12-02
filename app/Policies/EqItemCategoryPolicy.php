<?php

namespace App\Policies;

use App\Models\EqItemCategory;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EqItemCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @author Piotr Nagórny
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasResourceWithAction(
            Resource::RES_EQ_ITEM_CATEGORIES_OVERALL,
            Resource::ACTION_VIEW_ANY,
        );
    }

    /**
     * Determine whether the user can create models.
     *
     * @author Piotr Nagórny
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasResourceWithAction(
            Resource::RES_EQ_ITEM_CATEGORIES_OVERALL,
            Resource::ACTION_CREATE,
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @author Piotr Nagórny
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manufacturer  $manufacturer TODO
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, EqItemCategory $eqItemCategory)
    {
        return $user->hasResourceWithAction(
            Resource::RES_EQ_ITEM_CATEGORIES_OVERALL,
            Resource::ACTION_UPDATE,
        );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @author Piotr Nagórny
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EqItemCategory  $eqItemCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, EqItemCategory $eqItemCategory)
    {
        return $user->hasResourceWithAction(
            Resource::RES_EQ_ITEM_CATEGORIES_OVERALL,
            Resource::ACTION_DELETE,
        );
    }
}
