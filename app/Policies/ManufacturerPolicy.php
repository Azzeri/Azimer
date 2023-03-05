<?php

namespace App\Policies;

use App\Models\AclResource;
use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManufacturerPolicy
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
            AclResource::ACTION_VIEW_ANY,
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
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Manufacturer $manufacturer)
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
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Manufacturer $manufacturer)
    {
        return $user->hasResourceWithAction(
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_DELETE,
        );
    }
}
