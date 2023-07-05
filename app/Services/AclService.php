<?php

namespace App\Services;

use App\Http\Resources\AclResourceResource;
use App\Http\Resources\AclRoleResource;
use App\Models\AclResource;
use App\Models\AclRole;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class for acl roles and resources operations
 *
 * @author Mariusz Waloszczyk
 */
class AclService
{
    /**
     * Returns all roles from database
     *
     * @author Mariusz Waloszczyk
     */
    public function getAclRolesCollection(): AnonymousResourceCollection
    {
        $query = AclRole::with(['resources', 'users'])->get(); // KOLEJNOŚĆ

        return AclRoleResource::collection($query);
    }

    /**
     * Returns all resources from database
     *
     * @author Mariusz Waloszczyk
     */
    public function getAclResourcesCollection(): AnonymousResourceCollection
    {
        $query = AclResource::where(
            'suffix', '!=', AclResource::RES_DUMMY
        )->get();

        return AclResourceResource::collection($query);
    }

    /**
     * Finds all users who have the role attached and detaches it
     *
     * @author Mariusz Waloszczyk
     */
    public function detachRoleFromAllUsers(AclRole $aclRole): void
    {
        $usersWithRole = User::whereRelation(
            'roles',
            'role_suffix',
            $aclRole->suffix
        )->get();

        foreach ($usersWithRole as $user) {
            $user->roles()->detach($aclRole);
        }
    }
}
