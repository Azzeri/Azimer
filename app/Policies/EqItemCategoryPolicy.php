<?php

namespace App\Policies;

use App\Models\EqItemCategory;
use App\Models\AclResource;
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
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_VIEW,
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
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_CREATE,
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
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_UPDATE,
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
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_DELETE,
        );
    }
}
