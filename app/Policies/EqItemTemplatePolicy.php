<?php

namespace App\Policies;

use App\Models\EqItemTemplate;
use App\Models\AclResource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemTemplatePolicy
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
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
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
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
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
    public function update(
        User $user,
        EqItemTemplate $eqItemTemplate
    ) {
        return $user->hasResourceWithAction(
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
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
    public function delete(
        User $user,
        EqItemTemplate $eqItemTemplate
    ) {
        return $user->hasResourceWithAction(
            AclResource::RES_OVERALL_EQUIPMENT_RESOURCES,
            AclResource::ACTION_DELETE
        );
    }
}
