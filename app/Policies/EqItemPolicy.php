<?php

namespace App\Policies;

use App\Models\EqItem;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @author Mariusz Waloszczyk
 */
class EqItemPolicy
{
    use HandlesAuthorization;

    private User $user;

    private EqItem $eqItem;

    /**
     * Determine whether the user can view any models.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        $this->user = $user;

        return $this->canAccessOverallEquipment(
            Resource::ACTION_VIEW_ANY
        ) || $user->hasResourceWithAction(
            Resource::RES_EQUIPMENT_OWN_UNIT,
            Resource::ACTION_VIEW_ANY
        ) || $user->hasResourceWithAction(
            Resource::RES_EQUIPMENT_LOWLY_UNITS,
            Resource::ACTION_VIEW_ANY
        );
    }

    /**
     * Determine whether the user can view specified model.
     *
     * @author Mariusz Waloszczyk
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, EqItem $eqItem)
    {
        $this->user = $user;
        $this->eqItem = $eqItem;

        return $this->canAccessOverallEquipment(
            Resource::ACTION_VIEW
        ) ||
            $this->canAccessOwnUnitEquipment(Resource::ACTION_VIEW) ||
            $this->canAccessLowlyUnitEquipment(Resource::ACTION_VIEW);
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
        $this->user = $user;

        return $this->canAccessOverallEquipment(
            Resource::ACTION_CREATE
        ) || $user->hasResourceWithAction(
            Resource::RES_EQUIPMENT_OWN_UNIT,
            Resource::ACTION_CREATE
        ) || $user->hasResourceWithAction(
            Resource::RES_EQUIPMENT_LOWLY_UNITS,
            Resource::ACTION_CREATE
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
        EqItem $eqItem
    ) {
        $this->user = $user;
        $this->eqItem = $eqItem;

        return $this->canAccessOverallEquipment(
            Resource::ACTION_UPDATE
        ) ||
            $this->canAccessOwnUnitEquipment(Resource::ACTION_UPDATE) ||
            $this->canAccessLowlyUnitEquipment(Resource::ACTION_UPDATE);
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
        EqItem $eqItem
    ) {
        $this->user = $user;
        $this->eqItem = $eqItem;

        return $this->canAccessOverallEquipment(
            Resource::ACTION_DELETE
        ) ||
            $this->canAccessOwnUnitEquipment(Resource::ACTION_DELETE) ||
            $this->canAccessLowlyUnitEquipment(Resource::ACTION_DELETE);
    }

    /**
     * Determines if user can access overall equipment
     *
     * @author Mariusz Waloszczyk
     */
    private function canAccessOverallEquipment(
        string $action
    ): bool {
        return $this->user->hasResourceWithAction(
            Resource::RES_EQUIPMENT_OVERALL,
            $action
        );
    }

    /**
     * Determines if user can access own unit equipment
     *
     * @author Mariusz Waloszczyk
     */
    private function canAccessOwnUnitEquipment(
        string $action
    ): bool {
        return $this->user->hasResourceWithAction(
            Resource::RES_EQUIPMENT_OWN_UNIT,
            $action
        ) &&
            $this->eqItem->fireBrigadeUnit
            ->is($this->user->fireBrigadeUnit);
    }

    /**
     * Determines if user can access lowly unit of his unit equipment
     *
     * @author Mariusz Waloszczyk
     */
    private function canAccessLowlyUnitEquipment(
        string $action
    ): bool {
        return $this->user->hasResourceWithAction(
            Resource::RES_EQUIPMENT_LOWLY_UNITS,
            $action
        ) &&
            $this->eqItem->fireBrigadeUnit->superiorFireBrigadeUnit
            ->is($this->user->fireBrigadeUnit);
    }
}
