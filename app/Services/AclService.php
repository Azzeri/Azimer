<?php

namespace App\Services;

use App\Http\Resources\AclRoleResource;
use App\Models\AclRole;
use App\Models\User;

/**
 * Class for acl roles and resources operations
 *
 * @author Mariusz Waloszczyk
 */
class AclService
{
    /**
     * Returns all roles from database
     * with optional pagination
     *
     * @return mixed
     *
     * @author Mariusz Waloszczyk
     */
    public function getAclRolesCollection()
    {
        $query = AclRole::with('resources')->get();

        return AclRoleResource::collection($query);
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
